<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    public $timestamps = true; 
    public $months_arr = [];
    public $months_profit_arr = [];
    public $trades = '';

    public function init( $input = false )
    {
    	if ( $input ) {
    		$trades = $this->getTrades( $input['data'] );
    	} elseif ( $this->raw_data ) {
    		$trades = $this->getTrades( $this->raw_data );
    	}
    	
    	$this->mainLoop( $trades );

  		$trades = [
			'name' 						=> $input['name'] ?? $this->getTheBotName(),
			'profit_factor' 			=> $this->profit_factor,
			'total_net_profit'			=> $this->net_profit,
			'gross_profit'				=> $this->gross_profit,
			'gross_loss'				=> $this->gross_loss,
			'wins' 						=> $this->wins,
			'losses' 					=> $this->losses,
			'bes' 						=> $this->bes,
			'max_consecutive_wins'		=> $this->cons_wins,
			'max_consecutive_losses'	=> $this->cons_losses,
			'total_comission'			=> $this->total_comission,
			'earliest_open_trade_time'	=> $this->open_time_min,
			'latest_open_trade_time'	=> $this->open_time_max,
			'total_trades'				=> count( $trades ),
	  		'raw_data' 					=> $input['data'],
	  		'months_arr'				=> serialize( $this->months_arr ),
	  		'months_profit_arr'			=> serialize( $this->months_profit_arr ),
	  		'trade_list_html'			=> $this->trades,
	  		'bot_name'					=> $this->getTheBotName(),
	  		'server_name'				=> $this->getTheServerName(),
	  		'symbol_name'				=> $this->getTheSymbolName(),
	  		'timeframe'					=> $this->getTheTimeframe(),
	  		'period'					=> $this->getThePeriod(),
	  		'parameters'				=> $this->getTheParameters(),
	  		'absolute_drawdown'			=> $this->getAbsoluteDrawdown(),
	  		'maximal_drawdown_dollar'	=> $this->getMaximalDrawdownDollar(),
	  		'maximal_drawdown_persent'	=> $this->getMaximalDrawdownPersent(),
	  		'spread'					=> $this->getTheSpread(),
	  		'created_at'				=> new \DateTime()
  		];

		return $trades;
    }
    public function getTrades($input)
    {
    	$trade_num = 1;
		$buffer = $rows = [];
		$header = 'Strategy Tester Report';
		if ( strpos( $input, $header ) === false ) {
			echo '<h1>Please upload right MT4 Stats.</h1>';
			die();
		}
		$data = preg_split( "/\r\n|\n|\r/", $input );
		$this->header_info = array_splice( $data, 0, 23 );

		foreach ( $data as $item ) {
			$item = preg_split( '/\t/', $item );
			if ( $item[3] == $trade_num ) {
				$buffer[] = $item;
			} else {
				$rows[] = $buffer;
				unset( $buffer );
				$buffer[] = $item;
				$trade_num = $item[3];
			}
		}
		return $rows;
    }
    /**
     * Identify max and min trade open times of profitable trades
     * @return void
     */
    public function calculateProfitableOpenTime( $open_time, $profit, $i, $time )
    {
		if ( $profit >= $this->profit_edge ) {
			if ( $open_time > $this->open_time_max ) {
				$this->open_time_max = $open_time;
			} elseif ( $open_time < $this->open_time_min ) {
				$this->open_time_min = $open_time;
			}
		}
    }
    /**
	 * This function calculates net profit, gross profit and gross loss
	 * @return void
	 */
	public function netGrossProfitLoss( $profit )
	{
		$this->net_profit += $profit;
		if ( $profit > 0 ) {
			$this->gross_profit += $profit;
		} else {
			$this->gross_loss += $profit;
		}
	}
	/**
	 * Calculate Month and Make Month Arr
	 * @return void
	 */
	public function calculateMonths( $profit, $month, $i )
	{
		if ( $i == 1 ) {
			$this->months_arr[] = $month;
			$this->months_profit_arr[] = $profit;
		} else {
			if ( $this->months_arr[ count( $this->months_arr ) - 1 ] == $month ) {
				$this->buffer = $this->months_profit_arr[ count( $this->months_profit_arr ) - 1 ] + $profit;
				$this->months_profit_arr[ count( $this->months_profit_arr ) - 1 ] = $this->buffer;
			} else {
				$this->months_arr[] = $month;
				$this->months_profit_arr[] = $profit;
			}
		}
	}
	/**
	 * Builds and saves trade history list html
	 * @return void
	 */
	public function buildTradeList( $i, $profit, $lot, $month )
	{
		$this->trades .= '<div class="' . $this->pl_class . '-trade trade">';
		$this->trades .= '<span>Trade # ' . $i . '</span>';
		$this->trades .= '<span class="' . $this->pl_class . ' figure"> PL $ ' . $profit . '</span> ';
		$this->trades .= '<span>Volume ' . $lot . ' lot</class> ';
		$this->trades .= '<span>Comission $' . $lot * 10 . '</class>';
		$this->trades .= '<span class="time">' . $month . '</span>';
		$this->trades .= '</div>';
	}
	/**
	 * Calculate Consecutive Wins Losses
	 * @return void
	 */
	public function consecutiveWinLoss( $profit )
	{
		if ( $profit >= 100 ) {
			$this->wins++;
			$this->win_buffer++;
			$this->loss_buffer = 0;
			$this->pl_class = 'profit';
		} elseif ( $profit <= -30 ) {
			$this->losses++;
			$this->loss_buffer++;
			$this->win_buffer = 0;
			$this->pl_class = 'loss';
		} else {
			$this->bes++;
			$this->pl_class = 'be';
		}
		if ( $this->cons_wins < $this->win_buffer ) {
			$this->cons_wins = $this->win_buffer;
		}
		if ( $this->cons_losses < $this->loss_buffer ) {
			$this->cons_losses = $this->loss_buffer;
		}
	}
	/**
	 * The Main Loop
	 * @return void
	 */
	public function mainLoop( $trades )
	{
		for ( $i = 1; $i < count( $trades ); $i++ )
		{
			$lot = $trades[ $i ][ count( $trades[$i] ) - 1 ][4];
			$profit = ( int ) $trades[ $i ][ count( $trades[$i] ) - 1 ][8];
			$time = $trades[ $i ][ count( $trades[$i] ) - 1 ][1];
			if ( $i == 1 ) {
	    		$this->open_time_min = $this->open_time_max = (int) substr( $trades[ $i ][0][1], 11, 2);
	    	}
			$open_time = ( int ) substr( $trades[ $i ][0][1], 11, 2);
			$month = substr( $time, 5, 2 );

			$this->consecutiveWinLoss( $profit );
			$this->calculateMonths( $profit, $month, $i );
			$this->buildTradeList( $i, $profit, $lot, $month );
			$this->calculateProfitableOpenTime( $open_time, $profit, $i, $time );
			$this->netGrossProfitLoss( $profit );
			$this->total_comission += $lot * 10;
		}
		$this->profit_factor = number_format( $this->gross_profit / abs( $this->gross_loss ), 2, '.', '');
	}
	/**
	 * Gets The Name Of The Robot
	 * @return string
	 */
	public function getTheBotName()
	{
		return $this->header_info[1];
	}
	/**
	 * Gets The Server Name
	 * @return string
	 */
	public function getTheServerName()
	{
		return $this->header_info[2];
	}
	/**
	 * Gets The Symbol Name
	 * @return string
	 */
	public function getTheSymbolName()
	{
		return substr( $this->header_info[4], 7, 6 );
	}
	/**
	 * Gets The Timeframe
	 * @return string
	 */
	public function getTheTimeframe()
	{
		$start 	= strpos( $this->header_info[5], '(' ) + 1;
		$end 	= strpos( $this->header_info[5], ')' );
		return substr( $this->header_info[5], $start, $end - $start );
	}
	/**
	 * Gets The Perion
	 * @return string
	 */
	public function getThePeriod()
	{
		$start 	= strpos( $this->header_info[5], ')' ) + 1;
		$date = substr( $this->header_info[5], $start );
		return trim( $date );
	}
	/**
	 * Gets The Parameters
	 * @return string
	 */
	public function getTheParameters()
	{
		return substr( $this->header_info[7], 11 );
	}
	/**
	 * Gets Absalute Drawdown
	 * @return integer
	 */
	public function getAbsoluteDrawdown()
	{
		$start = strpos( $this->header_info[13], '	' ) + 1;
		$drawdown = substr( $this->header_info[13], $start );
		$drawdown = substr( $drawdown, 0, strpos( $drawdown, '	' ) );
		return ( int ) $drawdown;
	}
	/**
	 * Gets Maximal Drawdown
	 * @return integer
	 */
	public function getMaximalDrawdownDollar()
	{
		$start = strpos( $this->header_info[13], '	' ) + 1;
		$drawdown = substr( $this->header_info[13], $start );
		$start = strpos( $drawdown, '	' ) + 1;
		$drawdown = substr( $drawdown, $start );
		$start = strpos( $drawdown, '	' ) + 1;
		$drawdown = substr( $drawdown, $start );
		$drawdown = substr( $drawdown, 0, strpos( $drawdown, ' ' ) );
		return ( int ) $drawdown;
	}
	/**
	 * Gets Maximal Drawdown Persentage
	 * @return integer
	 */
	public function getMaximalDrawdownPersent()
	{
		$start = strpos( $this->header_info[13], '(' ) + 1;
		$end = strpos( $this->header_info[13], '%' );
		$drawdown = substr( $this->header_info[13], $start, $end - $start );
		return ( int ) $drawdown;
	}
	public function getTheSpread()
	{
		$row = $this->header_info[10];
		$row = trim( substr( $row, strpos( $row, '	' ) ) );
		$row = trim( substr( $row, strpos( $row, '	' ) ) );
		$row = trim( substr( $row, strpos( $row, '	' ) ) );
		$first_char = substr( $row, 0, 1 );
		if ( $first_char == '(' ) {
			$row = substr( $row, 1, strlen( $row ) - 2 );
		}
		return ( int ) $row;
	}
	// /**
	//  * Scope Filter
	//  * @return void
	//  */
	// public function scopeFilter($query, $filters)
	// {
	// 	if ( $name = $filters['name'] ) {
	// 		$query->where('name', $name);
	// 	}
	// }
}

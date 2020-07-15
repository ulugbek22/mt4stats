<table class="table table-bordered table-hover table-sm">
  <thead>
    <tr>
      <th scope="col">Parameters</th>
      <th scope="col">Values</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Profit Factor</td>
      <td>{{ $data['profit_factor'] }}</td>
    </tr>
    <tr>
      <td>Total Net Profit</td>
      <td>${{ $data['total_net_profit'] }}</td>
    </tr>
    <tr>
      <td>Gross Profit</td>
      <td>${{ $data['gross_profit'] }}</td>
    </tr>
    <tr>
      <td>Gross Loss</td>
      <td>${{ $data['gross_loss'] }}</td>
    </tr>
    <tr>
      <td>Wins</td>
      <td>{{ $data['wins'] }}</td>
    </tr>
    <tr>
      <td>Losses</td>
      <td>{{ $data['losses'] }}</td>
    </tr>
    <tr>
      <td>Break Evens</td>
      <td>{{ $data['bes'] }}</td>
    </tr>
    <tr>
      <td>Maximal Consecutive Wins</td>
      <td>{{ $data['max_consecutive_wins'] }}</td>
    </tr>
    <tr>
      <td>Maximal Consecutive Losses</td>
      <td>{{ $data['max_consecutive_losses'] }}</td>
    </tr>
    <tr>
      <td>Total Comissin</td>
      <td>${{ $data['total_comission'] }}</td>
    </tr>
    <tr>
      <td>Earliest Open Trade</td>
      <td>{{ $data['earliest_open_trade_time'] }}</td>
    </tr>
    <tr>
      <td>Latest Open Trade</td>
      <td>{{ $data['latest_open_trade_time'] }}</td>
    </tr>
    <tr>
      <td>Total Trades</td>
      <td>{{ $data['total_trades'] }}</td>
    </tr>
    <tr>
      <td>Absolute Drawdown</td>
      <td>${{ $data['absolute_drawdown'] }}</td>
    </tr>
    <tr>
      <td>Maximal Drawdown Dollars</td>
      <td>${{ $data['maximal_drawdown_dollar'] }}</td>
    </tr>
    <tr>
      <td>Maximal Drawdown Persent</td>
      <td>{{ $data['maximal_drawdown_persent'] }} %</td>
    </tr>
    <tr>
      <td>Spread</td>
      <td>{{ $data['spread'] ?? 'NA' }}</td>
    </tr>
  </tbody>
</table>
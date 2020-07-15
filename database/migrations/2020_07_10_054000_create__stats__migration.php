<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('profit_factor');
            $table->integer('total_net_profit');
            $table->integer('gross_profit');
            $table->integer('gross_loss');
            $table->integer('wins');
            $table->integer('losses');
            $table->integer('bes');
            $table->integer('max_consecutive_wins');
            $table->integer('max_consecutive_losses');
            $table->integer('total_comission');
            $table->integer('earliest_open_trade_time');
            $table->integer('latest_open_trade_time');
            $table->integer('total_trades');
            $table->longText('raw_data');
            $table->longText('months_arr');
            $table->longText('months_profit_arr');
            $table->longText('trade_list_html');
            $table->string('bot_name');
            $table->string('server_name');
            $table->string('symbol_name');
            $table->string('timeframe');
            $table->string('period');
            $table->longText('parameters');
            $table->float('absolute_drawdown');
            $table->float('maximal_drawdown_dollar');
            $table->float('maximal_drawdown_persent');
            $table->integer('spread');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats');
    }
}

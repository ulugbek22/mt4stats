<table class="table table-bordered table-hover" id="trade-list">
  <thead>
    <tr>
      <th scope="col">
        <a href="#">Name</a>
      </th>
      <th scope="col">
        <a href="#">Symbol</a>
      </th>
      <th scope="col">
        <a href="#">TF</a>
      </th>
      <th scope="col">
        <a href="#">P-Fac</a>
      </th>
      <th scope="col">
        <a href="#">M-D</a>
      </th>
      <th scope="col">
        <a href="#">Net P</a>
      </th>
      <th scope="col">
        <a href="#">Comis</a>
      </th>
      <th scope="col">
        <a href="#">Real P</a>
      </th>
      <th scope="col">
        <a href="#">Wins</a>
      </th>
      <th scope="col">
        <a href="#">Losses</a>
      </th>
      <th scope="col">
        <a href="#">BEs</a>
      </th>
      <th scope="col">
        <a href="#">L|W</a>
      </th>
      <th scope="col">
        <a href="#">MCW</a>
      </th>
      <th scope="col">
        <a href="#">MCL</a>
      </th>
      <th scope="col">
        <a href="#">Trades</a>
      </th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $stats as $stat )
    <tr>
      <td>
        <a href="/stats/{{ $stat->id }}">{{ $stat->name }}</a>
      </td>
      <td>{{ $stat->symbol_name }}</td>
      <td>{{ $stat->timeframe }}</td>
      <td>{{ $stat->profit_factor }}</td>
      <td>{{ $stat->maximal_drawdown_persent }}%</td>
      <td>${{ $stat->total_net_profit }}</td>
      <td>${{ $stat->total_comission }}</td>
      <td>${{ $stat->total_net_profit - $stat->total_comission }}</td>
      <td>{{ $stat->wins }}</td>
      <td>{{ $stat->losses }}</td>
      <td>{{ $stat->bes }}</td>
      <td>{{ ( int ) ($stat->losses / $stat->wins) }}</td>
      <td>{{ $stat->max_consecutive_wins }}</td>
      <td>{{ $stat->max_consecutive_losses }}</td>
      <td>{{ $stat->total_trades }}</td>
      <td>
        <a href="/stats/{{ $stat->id }}/delete" class="badge badge-danger confirm">Delete</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

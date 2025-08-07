    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Contracts', 'Quotes', 'Weekly Value'],
          @foreach($data as $row)
            ['{{ $row->formatted_date }}', {{ $row->total_contracts }}, {{ $row->total_quotes }}, {{ $row->weekly_value }}],
          @endforeach
        ]);

        var options = {
          title: null,
          chartArea: {width: '80%'},
          hAxis: {
            title: 'Date',
          },
          vAxes: {
            0: {title: 'Contracts / Quotes Count'},
            1: {title: 'Weekly Value (£)'}
          },
          seriesType: 'bars',
          series: {
            0: {targetAxisIndex: 0, type: 'bars', color: '#afaa00'}, // contracts
            1: {targetAxisIndex: 0, type: 'bars', color: '#a1a1a1'}, // quotes
            2: {targetAxisIndex: 1, type: 'line', color: '#000000'}  // weekly value
          }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <div>
    <h2 class="text-2xl my-8">Contracts, Quotes and Value Report</h2>
    <div id="chart_div" class="bg-white w-full h-[560px]"></div>
    <h2 class="text-2xl my-8">Tabular Data</h2>
    <div class="bg-white mb-5 py-5">
        <table class="w-full text-center">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Contracts</th>
                    <th>Quotes</th>
                    <th>Weekly Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td class="py-1">{{ $row->formatted_date }}</td>
                        <td class="py-1">{{ $row->total_contracts }}</td>
                        <td class="py-1">{{ $row->total_quotes }}</td>
                        <td class="py-1">£{{ number_format($row->weekly_value, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('download-report-csv') }}" class="inline-block bg-black text-white px-5 py-3 text-xl rounded-md text-brand">
        Download Table as CSV
    </a>
  </div>
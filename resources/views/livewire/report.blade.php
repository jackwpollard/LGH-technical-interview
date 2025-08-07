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
          title: 'Contracts and Quotes per Day',
          chartArea: {width: '60%'},
          hAxis: {
            title: 'Date',
          },
          vAxes: {
            0: {title: 'Contracts / Quotes Count'},
            1: {title: 'Weekly Value (£)'}
          },
          seriesType: 'bars',
          series: {
            0: {targetAxisIndex: 0, type: 'bars', color: '#1b9e77'}, // contracts
            1: {targetAxisIndex: 0, type: 'bars', color: '#d95f02'}, // quotes
            2: {targetAxisIndex: 1, type: 'line', color: '#7570b3'}  // weekly value
          }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 800px; height: 500px;"></div>
  </body>
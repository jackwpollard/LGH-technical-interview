    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Contracts', 'Quotes'],
          @foreach($data as $row)
            ['{{ $row->generated_at }}', {{ $row->total_contracts }}, {{ $row->total_quotes }}],
          @endforeach
        ]);

        var options = {
          title: 'Contracts and Quotes per Day',
          chartArea: {width: '60%'},
          hAxis: {
            title: 'Date',
          },
          vAxis: {
            title: 'Count'
          },
          colors: ['#1b9e77', '#d95f02']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 800px; height: 500px;"></div>
  </body>
import './scss/main.scss';
import Header from './js/header.jsx';
ReactDOM.render(<Header />, document.getElementById('header'));
google.charts.load('current', {'packages':['corechart','bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Skills');
      data.addColumn('number', 'Value');
      data.addRows([
        ['Skill 1', 23],
        ['Skill 2', 36],
        ['Skill 3', 41]
      ]);

      var options = {
        title: 'SKILLS BASED CHARTS FOR PROJECT'
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data);

      var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart2 = new google.charts.Bar(document.getElementById('barchart_material'));

        chart2.draw(data, options);
    }

import Middle from './js/middle.jsx';
ReactDOM.render(<Middle />, document.getElementById('main-container'));


import Footer from './js/footer.jsx';
ReactDOM.render(<Footer />, document.getElementById('footer'));
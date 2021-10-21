$(document).ready(function () {
  showGraph();
});

function showGraph() { 
    var item = [];
    var total_sold_units = [];

    for (var i in data) {
      item.push(data[i].item);
      total_sold_units.push(data[i].total_sold_units);
    }

    var chartdata = {
      labels: item,
      datasets: [
        {
          label: "Total Sold Units",
          backgroundColor: "#49e2ff",
          borderColor: "#46d5f1",
          hoverBackgroundColor: "#cccccc",
          hoverBorderColor: "#666666",
          data: total_sold_units,
        },
      ],
    };

    var graphTarget = $("#graphCanvas");

    var barGraph = new Chart(graphTarget, {
      type: "bar",
      data: chartdata,
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              min: 0
            }
          }]
        }
      }
    });
}

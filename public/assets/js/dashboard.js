$(document).ready(function() {

    getChartData();
    setInterval(getChartData, 1000 * 360);

});

function getChartData() {
    $("#chart-line").remove();
    $(".chart").append("<canvas id='chart-line' class='chart-canvas' height='300'></canvas>");

    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, "rgba(203,12,159,0.2)");
    gradientStroke1.addColorStop(0.2, "rgba(72,72,176,0.0)");
    gradientStroke1.addColorStop(0, "rgba(203,12,159,0)"); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, "rgba(20,23,39,0.2)");
    gradientStroke2.addColorStop(0.2, "rgba(72,72,176,0.0)");
    gradientStroke2.addColorStop(0, "rgba(20,23,39,0)"); //purple colors

    $.ajax({
        type: "GET",
        url: "/getChartData",
        dataType: "JSON",
        success: function(response) {
            let years = response.years;
            let twenty20 = years[0].twenty20;
            let twenty21 = years[1].twenty21;

            let twenty21Months = [];
            let twenty21Amounts = [];
            let twenty20Months = [];
            let twenty20Amounts = [];

            for (i = 0; i < twenty20[0].length; i++) {
                twenty20Months.push(twenty20[1][i]);
                twenty20Amounts.push(twenty20[0][i]);
            }
            for (i = 0; i < twenty21[0].length; i++) {
                twenty21Months.push(twenty21[1][i]);
                twenty21Amounts.push(twenty21[0][i]);
            }
            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: twenty20Months,
                    datasets: [{
                            label: "2022",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#cb0c9f",
                            borderWidth: 3,
                            backgroundColor: gradientStroke1,
                            fill: true,
                            data: twenty21Amounts,
                            maxBarThickness: 6
                        },
                        {
                            label: "2021",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#3A416F",
                            borderWidth: 3,
                            backgroundColor: gradientStroke2,
                            fill: true,
                            data: twenty20Amounts,
                            maxBarThickness: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: "index"
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: "#b2b9bf",
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: "normal",
                                    lineHeight: 2
                                }
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: "#b2b9bf",
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: "normal",
                                    lineHeight: 2
                                }
                            }
                        }
                    }
                }
            });

        }
    });
}

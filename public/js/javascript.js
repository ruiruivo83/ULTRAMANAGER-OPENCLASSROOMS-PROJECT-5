window.onload = function getStatData() {
    $(function () {
        $('body').show();
    }); // end ready
}

// Basic example
$(document).ready(function () {
    $('#dtBasicExample').DataTable({
        "retrieve": true,
        "paging": false // false to disable pagination (or any other option)
    });


    $('.dataTables_length').addClass('bs-select');
});


/*
function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}


window.onload = function getStatData() {

    if (window.location.pathname.startsWith('/index')) {
        // TOTAL OPEN TICKETS THIS MONTH
        var oReq = new XMLHttpRequest(); // New request object
        oReq.onload = function () {
            jSonLenght = this.responseText.length;
            result = this.responseText.substring(0, jSonLenght - 4);
            array = JSON.parse(result);
            // GET ARRAY MAX FOR Y AXIS
            yMax = 0;
            for (a = 1; a < array.length; a++) {
                if (array[a] > yMax) {
                    yMax = array[a];
                }
            }
            chartType = "bar";
            BuildBarChart(array, "TotalOpenTicketsThisMonth", yMax, chartType);
        };
        oReq.open("get", "index.php?action=TotalOpenTicketsThisMonth", true);
        oReq.send();

        // TOTAL CLOSED TICKETS THIS MONTH
        var oReq = new XMLHttpRequest(); // New request object
        oReq.onload = function () {
            jSonLenght = this.responseText.length;
            result = this.responseText.substring(0, jSonLenght - 4);
            array = JSON.parse(result);
            // console.log(array);
            // GET ARRAY MAX FOR Y AXIS AND X AXIS
            yMax = 0;
            for (a = 1; a < array.length; a++) {
                if (array[a] > yMax) {
                    yMax = array[a];
                }
            }
            chartType = "bar";
            BuildBarChart(array, "TotalClosedTicketsThisMonth", yMax, chartType);
        };
        oReq.open("get", "index.php?action=TotalClosedTicketsThisMonth", true);
        oReq.send();

        // TOTAL INTERVENTIONS THIS MONTH
        var oReq = new XMLHttpRequest(); // New request object
        oReq.onload = function () {
            // console.log(this.responseText);
            jSonLenght = this.responseText.length;
            result = this.responseText.substring(0, jSonLenght - 4);
            array = JSON.parse(result);
            // GET ARRAY MAX FOR Y AXIS
            yMax = 0;
            for (yAxis = 1; yAxis < array.length; yAxis++) {
                if (array[yAxis] > yMax) {
                    yMax = array[yAxis];
                }
            }
            chartType = "line";
            BuildLineChart(array, "TotalInterventionsThisMonth", yMax, chartType);
        };
        oReq.open("get", "index.php?action=TotalInterventionsThisMonth", true);
        oReq.send();
    } else {

    }
}


function BuildBarChart(TotalsPerDay, elementId, yMax, chartType) {
    var ctx = document.getElementById(elementId).getContext('2d');
    DaysInTheMonthString = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: chartType,
        // The data for our dataset
        data: {
            labels: DaysInTheMonthString,
            datasets: [{
                label: 'Total on this day',
                backgroundColor: 'rgb(2, 117, 216)',
                borderColor: 'rgb(2, 117, 216)',
                data: TotalsPerDay
            }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 0,
                    right: 15,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: ''
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 31
                    },
                    maxBarThickness: 50,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: yMax, // HERE FOR Y MAXIMUM
                        maxTicksLimit: 1,
                        padding: 1,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ": " + number_format(tooltipItem.yLabel);
                    }
                }
            },
        }
    });
}


function BuildLineChart(TotalsPerDay, elementId, yMax, chartType) {
    var ctx = document.getElementById(elementId).getContext('2d');
    DaysInTheMonthString = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: chartType,

        // The data for our dataset
        data: {
            labels: DaysInTheMonthString,
            datasets: [{
                label: 'Total Interventions on this day',
                backgroundColor: 'rgb(135, 236, 238)',
                borderColor: 'rgb(135, 236, 160)',
                data: TotalsPerDay,
                borderColor: 'rgb(135, 236, 160)',
                fill: false
            }]
        },

        // Configuration options go here
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 0,
                    right: 15,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: ''
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 31
                    },
                    maxBarThickness: 50,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: yMax, // HERE FOR Y MAXIMUM
                        maxTicksLimit: 5,
                        padding: 1,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ": " + number_format(tooltipItem.yLabel);
                    }
                }
            },
        }
    });
}
*/


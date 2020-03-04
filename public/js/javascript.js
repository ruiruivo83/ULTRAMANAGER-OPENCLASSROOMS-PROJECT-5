window.onload = function getStatData() {

    // Show Body after page loaded
    $(function () {
        $('body').show();
    }); // end ready


    // Run datatable JS for table pagination and search
    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            "retrieve": true,
            "paging": true // false to disable pagination (or any other option)
        });
        $('.dataTables_length').addClass('bs-select');
    });

    // Detects if current path is index.php and run stats script
    if (window.location.href.toString().substring(window.location.href.toString().length - 9) == "index.php" || window.location.href.toString() == "https://www.ultramanager.net/" || window.location.href.toString() == "http://www.ultramanager.net/") {

        let elementId;
        // Build label for Chart
        const labels = buildLabelForChart(daysInMonth());
        /////////////////////////// CHARTS ///////////////////////
        // OPEN TICKETS THIS MONTH
        elementId = 'opentickets01';
        ajaxGetOpenTicketsForCurrentMonthFunction(elementId, labels);

        // OPEN Interventions THIS MONTH
        elementId = 'openinterventions01';
        ajaxGetOpenInterventionsForCurrentMonthFunction(elementId, labels);

    }
}


function ajaxGetOpenTicketsForCurrentMonthFunction(elementId, labels) {
    const oReq = new XMLHttpRequest(); // New request object
    oReq.onload = function () {
        let data = JSON.parse(this.responseText);
        buildData(elementId, data, labels);
    };
    oReq.open("get", "../index.php?action=ajaxGetTotalOpenTicketsThisMonthFunction", true);
    oReq.send();
}

function ajaxGetOpenInterventionsForCurrentMonthFunction(elementId, labels) {
    const oReq = new XMLHttpRequest(); // New request object
    oReq.onload = function () {
        let data = JSON.parse(this.responseText);
        buildData(elementId, data, labels);
    };
    oReq.open("get", "../index.php?action=ajaxGetTotalOpenInterventionsThisMonthFunction", true);
    oReq.send();
}


function buildData(elementId, data, labels) {
    // EXAMPLE: string data = [12, 19, 3, 5, 2, 3, 21]
    let temp = Array(daysInMonth());
    for (let i = 1; i < daysInMonth() + 1; i++) {
        let k = 0;
        for (let j = 0; j < data.length; j++) {
            if (i == data[j][0].substring(8, 10)) {
                k++;
            }
        }
        temp[i] = k;
    }
    temp.splice(0, 1);
    data = temp;
    buildBarChart(elementId, labels, data);
}


// Build barchart
function buildBarChart(elementId, labels, data) {
    var ctx = document.getElementById(elementId).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            // LABELS FOR EACH DAY TITLE
            labels: labels,
            datasets: [{
                label: 'Total on this day',
                // COUNT FOR EACH DAY
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}


// Get Total Days in Current Month
function daysInMonth(month, year) {
    return new Date(new Date().getFullYear(), (new Date().getMonth() + 1), 0).getDate();
}

// Build Labels For Days in the Current Month
function buildLabelForChart(daysInMonth) {
    var labels = [];
    for (let i = 1; i < daysInMonth + 1; i++) {
        labels.push(i);
    }
    // console.log(labels);
    return labels
}


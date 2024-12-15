<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Real-Time BME280 Sensor Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
    canvas {
        width: 100% !important;
        max-height: 400px;
    }

    .card {
        margin-bottom: 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    h2 {
        text-align: center;
        color: #4e73df;
        font-weight: bold;
    }

    body {
        background-color: #f8f9fc;
    }
    </style>
</head>

<body>
    <div class="row">
        <!-- Temperature Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Temperature (°C)</h2>
                    <canvas id="tempChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Pressure Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Pressure (hPa)</h2>
                    <canvas id="pressureChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Altitude Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Altitude (m)</h2>
                    <canvas id="altitudeChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Humidity Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Humidity (%)</h2>
                    <canvas id="humidityChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    const maxDataPoints = 10;

    const tempChart = new Chart(document.getElementById("tempChart"), {
        type: "line",
        data: {
            labels: [],
            datasets: [{
                label: "Temperature (°C)",
                borderColor: "rgb(255, 99, 132)",
                data: [],
            }, ],
        },
    });

    const pressureChart = new Chart(
        document.getElementById("pressureChart"), {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Pressure (hPa)",
                    borderColor: "rgb(54, 162, 235)",
                    data: [],
                }, ],
            },
        }
    );

    const altitudeChart = new Chart(
        document.getElementById("altitudeChart"), {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Altitude (m)",
                    borderColor: "rgb(75, 192, 192)",
                    data: [],
                }, ],
            },
        }
    );

    const humidityChart = new Chart(
        document.getElementById("humidityChart"), {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Humidity (%)",
                    borderColor: "rgb(153, 102, 255)",
                    data: [],
                }, ],
            },
        }
    );

    // Update charts with real-time data and limit to 10 data points
    function updateCharts(data) {
        const now = new Date().toLocaleTimeString();

        // Update temperature chart
        tempChart.data.labels.push(now);
        tempChart.data.datasets[0].data.push(data.suhu);
        if (tempChart.data.labels.length > maxDataPoints) {
            tempChart.data.labels.shift();
            tempChart.data.datasets[0].data.shift();
        }
        tempChart.update();

        // Update pressure chart
        pressureChart.data.labels.push(now);
        pressureChart.data.datasets[0].data.push(data.tekanan);
        if (pressureChart.data.labels.length > maxDataPoints) {
            pressureChart.data.labels.shift();
            pressureChart.data.datasets[0].data.shift();
        }
        pressureChart.update();

        // Update altitude chart
        altitudeChart.data.labels.push(now);
        altitudeChart.data.datasets[0].data.push(data.ketinggian);
        if (altitudeChart.data.labels.length > maxDataPoints) {
            altitudeChart.data.labels.shift();
            altitudeChart.data.datasets[0].data.shift();
        }
        altitudeChart.update();

        // Update humidity chart
        humidityChart.data.labels.push(now);
        humidityChart.data.datasets[0].data.push(data.kelembaban);
        if (humidityChart.data.labels.length > maxDataPoints) {
            humidityChart.data.labels.shift();
            humidityChart.data.datasets[0].data.shift();
        }
        humidityChart.update();
    }

    // Fetch data from server every 2 seconds
    setInterval(() => {
        fetch("get_data.php")
            .then((response) => response.json())
            .then((data) => updateCharts(data))
            .catch((error) => console.error("Error fetching data:", error));
    }, 2000);
    </script>
</body>

</html>
<?php include 'fitur/penggunah.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'fitur/head.php'; ?>

<body>
    <div class="wrapper">
        <?php include 'fitur/sidebar.php'; ?>
        <div class="main-panel">
            <?php include 'fitur/navbar.php'; ?>
            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <h6 class="op-7 mb-2">Halaman dashboard</h6>
                        </div>
                    </div>

                    <div class="ke_atas" style="margin-bottom: 20%;">
                        <div class="row">
                            <!-- Teperature Card -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Suhu (°C)</h2>
                                        <canvas id="tempChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- Pressure Card -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Tekanan (hPa)</h2>
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
                                        <h2>Ketinggian (m)</h2>
                                        <canvas id="altitudeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- Humidity Card -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Kelembaban (%)</h2>
                                        <canvas id="humidityChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'fitur/footer.php'; ?>
        </div>
        <script>
            const maxDataPoints = 10;

            const tempChart = new Chart(document.getElementById("tempChart"), {
                type: "line",
                data: {
                    labels: [],
                    datasets: [{
                        label: "Suhu (°C)",
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
                            label: "Tekanan (hPa)",
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
                            label: "Ketinggian (m)",
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
                            label: "Kelembaban (%)",
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
    </div>
    <?php include 'fitur/js.php'; ?>
</body>

</html>
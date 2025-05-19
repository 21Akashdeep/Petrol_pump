<?php
$conn = new mysqli("localhost", "root", "Rajukumar@21", "vendors");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Sabhi tables ka array
$tables = ['shift', 'shifta2', 'shifta3', 'shiftb1', 'shiftb2', 'shiftb3', 'shiftc1', 'shiftc2', 'shiftc3'];

// Naye tables jinmein column names alag hain
$new_tables = ['shifta4', 'shiftb4', 'shiftc4'];


$total_cash = 0;

foreach ($tables as $table) {
  $sql = "SELECT COALESCE(SUM(xp_cash + ms_cash), 0) AS table_total FROM $table";
  $result = $conn->query($sql);

  if ($result && $row = $result->fetch_assoc()) {
    $total_cash += $row['table_total'];
  }
}

// Naye tables ka sum (jisme alag column names hain)
foreach ($new_tables as $table) {
  $sql = "SELECT COALESCE(SUM(xg1_cash + xg2_cash + ms1_cash + ms2_cash), 0) AS table_total FROM $table";
  $result = $conn->query($sql);

  if ($result && $row = $result->fetch_assoc()) {
    $total_cash += $row['table_total'];
  }
}

//net sale

// Sabhi tables ka array
$netsaletables = ['shift', 'shifta2', 'shifta3', 'shiftb1', 'shiftb2', 'shiftb3', 'shiftc1', 'shiftc2', 'shiftc3'];
$netsalenew_tables = ['shifta4', 'shiftb4', 'shiftc4'];

$netsaletotal_cash = 0;

foreach ($netsaletables as $table) {  // ✅ Corrected variable name
  $sql = "SELECT COALESCE(SUM(xp_net_sale + ms_net_sale), 0) AS table_total FROM $table";
  $result = $conn->query($sql);

  if ($result && $row = $result->fetch_assoc()) {
    $netsaletotal_cash += $row['table_total'];  // ✅ Corrected column name
  }
}

// Naye tables ka sum (jisme alag column names hain)
foreach ($netsalenew_tables as $table) {  // ✅ Corrected variable name
  $sql = "SELECT COALESCE(SUM(xg1_net_sale + xg2_net_sale + ms1_net_sale + ms2_net_sale), 0) AS table_total FROM $table";
  $result = $conn->query($sql);

  if ($result && $row = $result->fetch_assoc()) {
    $netsaletotal_cash += $row['table_total'];  // ✅ Corrected column name
  }
}

//expenses

// Sabhi tables ka array
$expensetables = ['expense', 'expensea2', 'expensea3', 'expensea4', 'expenseb1', 'expenseb2', 'expenseb3', 'expenseb4', 'expensec1', 'expensec2', 'expensec3', 'expensec4'];

$expensetotal_cash = 0;

foreach ($expensetables as $table) {  // ✅ Corrected variable name
  $sql = "SELECT COALESCE(SUM(amount), 0) AS table_total FROM $table";
  $result = $conn->query($sql);

  if ($result && $row = $result->fetch_assoc()) {
    $expensetotal_cash += $row['table_total'];  // ✅ Corrected column name
  }
}


//line chart

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Custom Navbar</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-chart-3d/dist/chartjs-chart-3d.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    /* General body styling */
    body {
      background-image: url('images/station.jpg');
      background-size: cover;
      background-position: center;
      color: #f5f6f8;
      font-family: Arial, sans-serif;
    }

    .navbar-nav {
      gap: 30px;
      /* Space between menu items */
    }

    .dropdown-menu {
      background-color: #212529 !important;
      /* Black dropdown background */
    }

    .dropdown-menu a {
      color: white !important;
      /* White text in dropdown */
    }

    .dropdown-menu a:hover {
      background-color: #333 !important;
      /* Dark gray on hover */
    }


    .cards-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      padding: 30px;
      margin-top: 20px;
      height: 10%;
    }

    .card {
      position: relative;
      background: linear-gradient(135deg, #f8fafc 60%, #e3e9f0 100%);
      border-radius: 18px;
      box-shadow: 0 6px 32px 0 rgba(31, 38, 135, 0.13);
      border: none;
      min-height: 260px;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 36px 24px 24px 24px;
      transition: box-shadow 0.2s, transform 0.2s;
      overflow: visible;
    }

    .card:hover {
      box-shadow: 0 12px 36px 0 rgba(31, 38, 135, 0.18);
      transform: translateY(-6px) scale(1.03);
    }

    .card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
      /* Keeps the card image with rounded corners */
    }

    .circle-img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      overflow: hidden;
      border: 4px solid #fff;
      margin-bottom: 18px;
      background: #f8fafc;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 12px rgba(31, 38, 135, 0.10);
    }

    .circle-img img {
      width: 70%;
      height: 70%;
      object-fit: contain;
      margin: auto;
      display: block;
    }

    .card h3 {
      margin: 12px 0 8px 0;
      color: rgb(255, 255, 255);
      font-size: 1.3rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-align: center;
    }

    .card p {
      color: white;
      font-size: 1.08rem;
      margin: 0;
      font-weight: 500;
      text-align: center;
    }

    .a {
      width: 47.5%;
      /* Width of the div */
      height: 390px;
      /* Height of the div */
      border: 2px solid black;
      /* Adds a black border */
      margin: 20px auto;
      /* Centers the div horizontally */
      position: relative;
      right: 24.5%;
      bottom: 30px;
      display: flex;
      justify-content: center;
      align-items: center;
      background: rgba(255, 255, 255, 0.7);
      /* Semi-transparent white */
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
      border-radius: 18px;
    }

    .b {
      width: 47.5%;
      /* Width of the div */
      height: 390px;
      /* Height of the div */
      border: 2px solid black;
      /* Adds a black border */
      margin: 20px auto;
      /* Centers the div horizontally */
      position: relative;
      left: 24.5%;
      bottom: 444px;
      display: flex;
      justify-content: center;
      align-items: center;
      background: rgba(255, 255, 255, 0.7);
      /* Semi-transparent white */
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
      border-radius: 18px;
    }

    .c {
      width: 47.5%;
      height: 90px;
      margin: 30px auto;
      position: relative;
      right: 24.5%;
      bottom: 445px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, 0.25);
      /* Glass effect */
      border-radius: 18px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
      border: 1.5px solid rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(5px);
      overflow: hidden;
      padding: 0 40px;
      font-size: 1.3rem;
      transition: box-shadow 0.3s;
    }

    .c::before {
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      width: 8px;
      height: 100%;
      background: linear-gradient(180deg, #00bfae 0%, #1a237e 100%);
      border-radius: 18px 0 0 18px;
    }

    .c-title {
      font-weight: bold;
      color: #1a237e;
      font-size: 1.4rem;
      letter-spacing: 1.5px;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      margin-left: 18px;
      margin-bottom: 0;
      flex: 1;
      text-align: center;
      background: linear-gradient(90deg, #00bfae 0%, #1a237e 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .d {
      width: 47.5%;
      height: 80px;
      border: 2px solid black;
      margin: 20px auto;
      position: relative;
      left: 24.5%;
      bottom: 548px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #222;
      border-radius: 8px;
      backdrop-filter: blur(5px);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .digital-watch {
      font-family: 'Courier New', Courier, monospace;
      font-size: 2rem;
      color: #0dcaf0;
      background: #181818;
      padding: 14px 36px;
      border-radius: 10px;
      letter-spacing: 2px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      font-weight: bold;
      width: 100%;
      text-align: center;
    }

    @media (max-width: 480px) {
      .cards-container {
        grid-template-columns: 1fr;
        /* Single column on smaller screens */
      }

      .card .circle-img {
        width: 50px;
        /* Smaller circle on small screens */
        height: 50px;
      }

      .card h3 {
        font-size: 1rem;
        /* Smaller font for smaller screens */
      }

      .a,
      .b,
      .c,
      .d {
        width: 100%;
        /* Full width for smaller screens */
        margin: 10px auto;
      }

      .d {
        width: 100%;
        left: 0;
        bottom: 0;
        height: auto;
        padding: 10px 0;
      }

      .digital-watch {
        font-size: 1.1rem;
        padding: 8px 8px;
      }

      .c {
        width: 100%;
        right: 0;
        padding: 0 10px;
        font-size: 1rem;
        height: auto;
        min-height: 70px;
      }

      .c-title {
        font-size: 1.1rem;
        margin-left: 10px;
      }
    }

    .c-title {
      display: block;
      font-size: 1.5rem;
      font-weight: bold;
      color: #333;
      margin-bottom: 5px;
    }

    .digital-watch {
      float: right;
      font-weight: bold;
      font-size: 1.2rem;
      color: rgb(244, 245, 247);
      background: rgb(53, 53, 53);
    }

    footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      background: #212529;
      color: #6c757d;
      text-align: center;
      padding: 10px;
      font-size: 14px;
      font-family: Arial, sans-serif;
      box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    }

    footer p {
      margin: 0;
    }

    footer a.brand {
      font-weight: bold;
      color: #007bff;
      text-decoration: none;
    }

    footer a.brand:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <?php include 'list/navbar.php'; ?>
  <div class="cards-container">
    <div class="card" style="background: linear-gradient(135deg, #df190a, #a3ad11)" ">
      <div class=" circle-img">
      <img src="images/Cash.jpg" alt="Profile Picture" />
    </div>
    <h3>Cash</h3>
    <!-- <p>Cash-In-Hand</p> -->
    <p>Cash-In-Hand: <strong>₹ <?php echo number_format($total_cash); ?></strong></p>
  </div>
  <!-- <div
        class="card"
        style="background: linear-gradient(135deg, #71808f, #371daa)"
        onclick="window.location.href='outstanding.html';"
      >
        <div class="circle-img" style="background-color: white">
          <img src="images/Outstanding.png" alt="Outstanding Balance" />
        </div>
        <h3>Outstanding Balance</h3>
        <p>Pending Amounts</p>
      </div> -->
  <div class="card" style="background: linear-gradient(135deg, #70646f, #581010)">
    <div class="circle-img" style="background-color: white">
      <img src="images/sale.png" alt="Sale" />
    </div>
    <h3>Sale</h3>
    <!-- <p>Yesterdays Sale Amounts</p> -->
    <p>Total Sale Amounts: <strong>₹ <?php echo number_format($netsaletotal_cash); ?></strong></p>

  </div>
  <div class="card" style="background: linear-gradient(135deg, #0f68c0, #b62727)">
    <div class="circle-img">
      <img src="images/expense.png" alt="Expenses" />
    </div>
    <h3>Expenses</h3>
    <!-- <p>Yesterdays Expenses</p> -->
    <p>Total Expenses: <strong>₹ <?php echo number_format($expensetotal_cash); ?></strong></p>
  </div>
  </div>

  <div class="a">
    <canvas id="dailyChart" width="400" height="200"></canvas>
    <script>
      // Modern color palette
      const chartColors = {
        xp: "#009688",      // Teal
        ms: "#1976d2",      // Blue
        xg: "#ff9800",      // Orange
        hsd: "#8e24aa",     // Purple
        liquid: "#43a047"   // Green
      };

      // Line chart data
      const dailyData = {
        labels: [
          "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
        ],
        datasets: [
          {
            label: "XP-95 (Rs)",
            data: [104.57, 104.69, 102.96, 105.63, 104.98, 104.86, 104.36],
            backgroundColor: chartColors.xp,
            borderColor: chartColors.xp,
            borderWidth: 3,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: chartColors.xp,
            fill: false
          },
          {
            label: "MS (Rs)",
            data: [150, 120, 100, 160, 145, 136, 189],
            backgroundColor: chartColors.ms,
            borderColor: chartColors.ms,
            borderWidth: 3,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: chartColors.ms,
            fill: false
          },
          {
            label: "XG (Rs)",
            data: [70, 130, 140, 150, 200, 220, 250],
            backgroundColor: chartColors.xg,
            borderColor: chartColors.xg,
            borderWidth: 3,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: chartColors.xg,
            fill: false
          },
          {
            label: "HSD (Rs)",
            data: [90, 110, 130, 140, 160, 180, 200],
            backgroundColor: chartColors.hsd,
            borderColor: chartColors.hsd,
            borderWidth: 3,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: chartColors.hsd,
            fill: false
          },
          {
            label: "LIQUID (Rs)",
            data: [80, 100, 120, 140, 160, 180, 200],
            backgroundColor: chartColors.liquid,
            borderColor: chartColors.liquid,
            borderWidth: 3,
            tension: 0.4,
            pointRadius: 5,
            pointBackgroundColor: chartColors.liquid,
            fill: false
          }
        ]
      };

      const config = {
        type: "line",
        data: dailyData,
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true,
              position: "top",
              labels: {
                color: "#222",
                font: { size: 14, weight: "bold" }
              }
            },
            tooltip: {
              enabled: true,
              backgroundColor: "#fff",
              titleColor: "#222",
              bodyColor: "#222",
              borderColor: "#1976d2",
              borderWidth: 1
            }
          },
          scales: {
            x: {
              title: {
                display: true,
                text: "Day of the Week",
                color: "#222",
                font: { size: 14, weight: "bold" }
              },
              ticks: { color: "#222" }
            },
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: "Amount in Rs",
                color: "#222",
                font: { size: 14, weight: "bold" }
              },
              ticks: { color: "#222" }
            }
          }
        }
      };

      // Render the chart in the canvas
      const ctx = document.getElementById("dailyChart").getContext("2d");
      const dailyChart = new Chart(ctx, config);

      // Function to update data (could be used for daily updates)
      function updateChart(newData) {
        dailyChart.data.datasets[0].data = newData;
        dailyChart.update();
      }

      // Example of updating chart data (simulate daily update)
      setTimeout(() => {
        const newData = [130, 160, 200, 220, 270, 310, 370]; // New data
        updateChart(newData);
      }, 5000); // Update after 5 seconds (example)
    </script>
  </div>
  <div class="b">
    <canvas id="pieChart" width="400" height="200"></canvas>
    <script>
      // Pie chart with modern colors
      const pieData = {
        labels: ["XP-95", "MS", "HSD", "XG", "LIQUID"],
        datasets: [
          {
            data: [1500, 2000, 500, 700, 800],
            backgroundColor: [
              "#009688", // Teal
              "#1976d2", // Blue
              "#8e24aa", // Purple
              "#ff9800", // Orange
              "#43a047"  // Green
            ],
            borderColor: "#fff",
            borderWidth: 2,
            hoverOffset: 8
          }
        ]
      };

      const pieConfig = {
        type: "pie",
        data: pieData,
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true,
              position: "top",
              labels: {
                color: "#222",
                font: { size: 14, weight: "bold" }
              }
            },
            tooltip: {
              enabled: true,
              backgroundColor: "#fff",
              titleColor: "#222",
              bodyColor: "#222",
              borderColor: "#1976d2",
              borderWidth: 1
            }
          }
        }
      };

      // Render the pie chart in the canvas inside div.b
      const pieCtx = document.getElementById("pieChart").getContext("2d");
      const pieChart = new Chart(pieCtx, pieConfig);
    </script>
  </div>
  <div class="c">
    <span class="c-title">BHARAT PETROLEUM TRADERS - DHATKIDIH</span>
  </div>
  <div class="d">
    <span id="datetime" class="digital-watch"></span>
  </div>
  <footer>
    <p><strong>Copyright © 2025 <a href="https://pcats.co.in/" class="brand" target="_blank">P-Cats,
          Jamshedpur</a>.</strong> All
      rights reserved.</p>
  </footer>
  <script>
    function updateDateTime() {
      const now = new Date();
      const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      const dayName = days[now.getDay()];
      const date = now.toLocaleDateString('en-GB'); // DD/MM/YYYY
      const time = now.toLocaleTimeString('en-GB'); // HH:MM:SS
      document.getElementById('datetime').textContent = `${dayName}, ${date} ${time}`;
    }
    updateDateTime();
    setInterval(updateDateTime, 1000); // Update every second
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    /* General body styling */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
      overflow: hidden;
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
      background-color: #eff1ef;
      border: 1px solid #ddd;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
      /* Keeps the card image with rounded corners */
    }

    .card .circle-img {
      position: absolute;
      top: 50px;
      /* Adjust as needed */
      right: 10px;
      /* Adjust as needed */
      width: 70px;
      /* Circle diameter */
      height: 70px;
      /* Circle diameter */
      border-radius: 50%;
      /* Makes it a circle */
      overflow: hidden;
      /* Ensures the image stays within the circle */
      border: 2px solid #fff;
      /* Optional: Adds a border around the circle */
    }

    .card .circle-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Keeps the image contained within the circle */
    }

    .card h3 {
      margin: 15px 0 10px;
      color: #e2e6e9;
      font-size: 1.25rem;
      padding-top: 70px;
    }

    .card p {
      color: #f5f6f8;
      font-size: 0.9rem;
      margin: 0 10px 15px;
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
      /* Flexbox for centering */
      justify-content: center;
      /* Center horizontally */
      align-items: center;
      /* Center vertically */
    }

    .c {
      width: 47.5%;
      height: 80px;
      border: 2px solid black;
      margin: 20px auto;
      position: relative;
      right: 24.5%;
      bottom: 445px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgb(0, 190, 162);
      padding: 0 30px;
      font-size: 1.2rem;
      border-radius: 5px;
    }

    .c-title {
      font-weight: bold;
      color: #1a237e;
      font-size: 1.1rem;
      letter-spacing: 1px;
    }

    .digital-watch {
      font-family: 'Courier New', Courier, monospace;
      font-size: 1.5rem;
      color: #0d6efd;
      background: #222;
      padding: 8px 18px;
      border-radius: 8px;
      letter-spacing: 2px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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
      // Sample daily data
      const dailyData = {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ], // Days of the week
        datasets: [
          {
            label: "Petrol (Rs)",
            data: [120, 150, 180, 200, 250, 300, 350], // Example data
            backgroundColor: "red",
            borderColor: "red",
            borderWidth: 2,
          },
          {
            label: "Diesel (Rs)",
            data: [150, 120, 100, 160, 145, 136, 189], // Example data
            backgroundColor: "blue",
            borderColor: "blue",
            borderWidth: 2,
          },
          {
            label: "Lubricants (Rs)",
            data: [70, 130, 140, 150, 200, 220, 250], // Example data
            backgroundColor: "brown",
            borderColor: "brown",
            borderWidth: 2,
          },
        ],
      };

      const config = {
        type: "line", // Chart type
        data: dailyData,
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true,
              position: "top",
            },
            tooltip: {
              enabled: true,
            },
          },
          scales: {
            x: {
              title: {
                display: true,
                text: "Day of the Week",
              },
            },
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: "Amount in Rs",
              },
            },
          },
        },
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
      // Data for pie chart
      const pieData = {
        labels: ["Petrol", "Diesel", "Lubricants"],
        datasets: [
          {
            data: [1500, 2000, 500], // Example data for total sales in Rs
            backgroundColor: ["red", "blue", "brown"], // Colors for each segment
            hoverOffset: 4, // Hover offset for better interactivity
          },
        ],
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
            },
            tooltip: {
              enabled: true,
            },
          },
        },
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
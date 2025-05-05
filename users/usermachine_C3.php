<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Create connection
error_reporting(E_ALL); ini_set('display_errors', 1);
$conn = new mysqli("localhost", "root", "", "vendors");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data exists before accessing it
$current_date_time = isset($_POST['current_date_time']) ? $_POST['current_date_time'] : "";
$closingmeter = isset($_POST['closingmeter']) ? $_POST['closingmeter'] : "";
$employee_name = isset($_POST['employee_name']) ? $_POST['employee_name'] : "";
$readingdiff = isset($_POST['readingdiff']) ? $_POST['readingdiff'] : "";
$shift = isset($_POST['shift']) ? $_POST['shift'] : "";
$testing = isset($_POST['testing']) ? $_POST['testing'] : "";
$product = isset($_POST['product']) ? $_POST['product'] : "";
$net_sale = isset($_POST['net_sale']) ? $_POST['net_sale'] : "";
$nozzle = isset($_POST['nozzle']) ? $_POST['nozzle'] : "";
$rate = isset($_POST['rate']) ? $_POST['rate'] : "";
$openingmeter = isset($_POST['openingmeter']) ? $_POST['openingmeter'] : "";
$cash = isset($_POST['cash']) ? $_POST['cash'] : "";
$paytm = isset($_POST['paytm']) ? $_POST['paytm'] : "";
$card = isset($_POST['card']) ? $_POST['card'] : "";
$totalamount = isset($_POST['totalamount']) ? $_POST['totalamount'] : "";

// Ensure that the form is submitted before inserting into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Insert data into database
    $sql = "INSERT INTO shiftC3 (current_date_time, closingmeter, employee_name, readingdiff, shift, testing, product, net_sale, nozzle, rate, openingmeter, cash, paytm, card,totalamount) 
            VALUES ('$current_date_time', '$closingmeter', '$employee_name', '$readingdiff', '$shift', '$testing', '$product', '$net_sale', '$nozzle', '$rate', '$openingmeter', '$cash', '$paytm', '$card','$totalamount')";

if ($conn->query($sql) === TRUE) {
  echo "<script>
          alert('machine record added successfully!');
          window.location.href='usermachine_A1.php'; // Redirect to dashboard or another page
        </script>";
} else {
  echo "<script>
          alert('Error: " . $conn->error . "');
        </script>";
}
}

// Step 1: shift table se latest closing meter value lena
$sql = "SELECT closingmeter FROM shiftB3 ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$latestClosingMeter = 0; // Default value
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latestClosingMeter = $row["closingmeter"];
}

// Step 2: shiftb1 table me opening_meter update karna
$updateQuery = "UPDATE shiftC3 SET openingmeter = ? ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("i", $latestClosingMeter);
$stmt->execute();
$stmt->close();
$conn->close();

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report Logger</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <style>
      body {
        background-color: #f8f9fa;
      }

      .form-container {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .form-header {
        background: #343a40;
        color: #fff;
        padding: 10px;
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
      }

      .btn-log {
        background: green;
        color: white;
      }

      .btn-reset {
        background: red;
        color: white;
      }

      .table-bordered {
        border: 2px solid black;
      }

      .table thead {
        background-color: #cce5ff;
        /* Light blue header */
      }

      .table th,
      .table td {
        text-align: center;
        /* Center text alignment */
        vertical-align: middle;
        padding: 10px;
      }
      .navbar-nav {
            gap: 30px; /* Space between menu items */
        }
        .dropdown-menu {
            background-color: #212529 !important; /* Black dropdown background */
        }
        .dropdown-menu a {
            color: white !important; /* White text in dropdown */
        }
        .dropdown-menu a:hover {
            background-color: #333 !important; /* Dark gray on hover */
        }
    </style>
  </head>

  <body>
  <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <div class="form-container">
        <div class="form-header">MACHINE C3. REPORT LOGGER</div>
        <form id="reportForm" method="POST">
          <div class="row mt-3">
            <div class="col-md-6">
              <label class="form-label"><b>Report Date & Time :</b></label>
              <input
                type="datetime-local"
                class="form-control"
                id="reportDateTime"
                name="current_date_time"
                readonly
              />
            </div>
            <div class="col-md-6">
              <label class="form-label"><b>Closing Reading :</b></label>
              <input
                type="number"
                class="form-control"
                id="closingMeter"
                name="closingmeter"
                placeholder="Enter closing Reading"
              />
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <label class="form-label"><b>Enter Employee :</b></label>
              <select class="form-control"name="employee_name">
                <option>Select</option>
                <option>Ravi</option>
                <option>Akash</option>
                <option>Rahul</option>
                <option>Raj</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label"><b>Reading Difference :</b></label>
              <input
                type="number"
                class="form-control"
                placeholder="Enter Reading Difference"
                id="readingDifference"
                name="readingdiff"
                readonly
              />
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <label class="form-label"><b>Shift :</b></label>
              <select class="form-control"name="shift">
                <option value="" disabled selected>Select</option>
                <option>Shift A</option>
                <option>Shift B</option>
                <option>Shift C</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label"><b>Testing :</b></label>
              <input
                type="number"
                class="form-control"
                placeholder="Enter Testing"
                name="testing"
                id="testing"
              />
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <label class="form-label"><b>Product :</b></label>
              <select class="form-control"name="product">
                <option value="" disabled selected>Select Product</option>
                <option>HSD</option>
                <option>HD</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label"><b>Net Sale :</b></label>
              <input
                type="number"
                class="form-control"
                placeholder="Enter Net Sale"
                name="net_sale"
                id="netSale"
                readonly
              />
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <label class="form-label"><b>Nozzle :</b></label>
              <select class="form-control"name="nozzle">
                <option value="" disabled selected>Select Nozzle</option>
                <option>Nozzle 1</option>
                <option>Nozzle 2</option>
              </select>
            </div>
            <div class="col-md-6">
            <label class="form-label"><b>Rate :</b></label>
              <input
                type="number"
                id="rate"
                class="form-control"
                name="rate"
                placeholder="Enter rate"
              />
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label"><b>Opening Reading :</b></label>
            <input
              type="number"
              class="form-control"
              id="openingMeter"
              name="openingmeter"
              value="<?php echo $latestClosingMeter; ?>"
              readonly
            />
          </div>
          <div class="row mt-4">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>Total Amount</th>
                  <th>Cash</th>
                  <th>Paytm</th>
                  <th>Card</th>
                  <!-- <th>Balance</th> -->
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input
                      type="number"
                      class="form-control"
                      id="totalAmount"
                      name="totalamount"
                      readonly
                    />
                  </td>
                  <td>
                    <input type="number" class="form-control" id="cash" name="cash" />
                  </td>
                  <td>
                    <input type="number" class="form-control" id="paytm" name="paytm"/>
                  </td>
                  <td>
                    <input type="number" class="form-control" id="card" name="card"/>
                  </td>
                  <!-- <td><input type="number" class="form-control" id="balance" readonly></td> -->
                </tr>
              </tbody>
            </table>
          </div>
          <div class="row mt-4">
            <div class="col text-end">
            <!-- <button
                type="button"
                class="btn btn-reset"
                onclick="window.location.href='../home.php'"
              >
                Back
              </button> -->
              <button class="btn btn-log">Submit</button>
              <button id="submitBtn"class="btn btn-log"hidden>Submi</button>
              <!-- <button
                type="button"
                class="btn btn-reset"
                onclick="window.location.href='../list/machineC3_list.php'"
              >
                Show Report
              </button> -->
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        setReportDateTime();

        document
          .getElementById("submitBtn")
          .addEventListener("click", function (event) {
            event.preventDefault(); // Prevent form submission
            validateAndSubmit();
          });

        // Auto-calculate values when input changes
        document
          .querySelectorAll("#closingMeter, #testing")
          .forEach((input) => input.addEventListener("input", calculateValues));
      });

      function setReportDateTime() {
        let now = new Date();
        let year = now.getFullYear();
        let month = String(now.getMonth() + 1).padStart(2, "0");
        let day = String(now.getDate()).padStart(2, "0");
        let hours = String(now.getHours()).padStart(2, "0");
        let minutes = String(now.getMinutes()).padStart(2, "0");

        let formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.getElementById("reportDateTime").value = formattedDateTime;
      }

      function calculateValues() {
        let opening =
          parseFloat(document.getElementById("openingMeter").value) || 0;
        let closing =
          parseFloat(document.getElementById("closingMeter").value) || 0;
        let testing = parseFloat(document.getElementById("testing").value) || 0;
        let rate = parseFloat(document.getElementById("rate").value) || 0; // Get rate input value

        let readingDiff = closing - opening;
        let netSale = readingDiff + testing;
        let totalAmount = netSale * rate; // Fetching totalAmount from netSale

        document.getElementById("readingDifference").value =
          readingDiff.toFixed(2);
        document.getElementById("netSale").value = netSale.toFixed(2);
        document.getElementById("totalAmount").value = totalAmount.toFixed(2);
        document
          .getElementById("rate")
          .addEventListener("input", calculateValues);
      }

      // Function to update opening reading with previous closing reading
      function updateOpeningReadings() {
        let closing = document.getElementById("closingMeter").value;
        if (closing) {
          document.getElementById("openingMeter").value = closing;
        }
      }

      // Function to reset all fields except opening reading
      function resetFormExceptOpening() {
        document.getElementById("closingMeter").value = "";
        document.getElementById("readingDifference").value = "";
        document.getElementById("testing").value = "";
        document.getElementById("netSale").value = "";
        document.getElementById("rate").value = "";
        document.getElementById("totalAmount").value = "";
        document.getElementById("cash").value = "";
        document.getElementById("paytm").value = "";
        document.getElementById("card").value = "";
      }

      function validateAndSubmit() {
        let formData = new FormData(document.getElementById("reportForm"));

        fetch("save_report.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              alert("Data submitted successfully!");
              updateOpeningReadings(); // Set closing as new opening for next entry
              resetFormExceptOpening(); // Clear fields except opening reading
            } else {
              alert("Error: " + data.message);
            }
          })
          .catch((error) => {
            console.error("Error:", error);
            alert("An error occurred. Please try again.");
          });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

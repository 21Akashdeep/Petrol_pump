<?php
session_start();
// echo 'Hello ',$_SESSION['username'];
require_once('dp.php');
$qurey = "SELECT id, work_order_no, Job_type, workDetails, work_Reason, User_complain, user_Reason,inpdfFile,location, 
          DATE_FORMAT(dateTimeField, '%d-%m-%Y %r') AS dateTimeField, username 
          FROM ad_m ORDER BY id ASC";
$result = mysqli_query($conn, $qurey);
$result = mysqli_query($conn, $qurey);
if (!$result) {
  die("Query Failed: " . mysqli_error($conn));
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Material</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #0080FF;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: Black;
      display: block;
      transition: 0.3s;
    }

    .sidenav a:hover {
      color: #f1f1f1;
    }

    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
      .sidenav {
        padding-top: 15px;
      }

      .sidenav a {
        font-size: 18px;
      }
    }

    .table-container {
      height: 300px;
      /* Set the desired height */
      overflow-y: auto;
      /* Allows vertical scrolling */
    }

    #myTable {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      table-layout: fixed;
      width: 100%;
    }

    #myTable td,
    #myTable th {
      border: 1px solid #ddd;
      padding: 8px;
      word-wrap: break-word;
      /* Ensures the text breaks into a new line */
      white-space: normal;
      overflow-wrap: break-word;
      /* Ensures long words wrap correctly */
      max-width: 150px;
    }

    #myTable tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #myTable tr:hover {
      background-color: #ddd;
    }

    #myTable th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
      position: sticky;
      /* Makes the header sticky */
      top: 0;
      z-index: 2;
    }

    .scroll {
      overflow: scroll;
      width: 90%;
      height: 75%;
    }
  </style>
</head>

<body>
  <nav class="navbar bg-primary">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">
        <a href="Adminlogin.php">
          <button type="button" class="btn btn-primary">LOGOUT</button>
        </a>
      </span>
    </div>
  </nav>
  <?php
  echo 'Hello ', $_SESSION['username'];

  ?>
  <div class="row">
    <div class="col-6 col-md-3">
    </div>
    <div class="col-6 col-md-3">
      <form style="padding: 10px;">
        <div class="mb-3">
          <label for="Location" class="form-label">Enter Supervisior name</label>
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Supervisior.."
            title="Type in a name">
        </div>
      </form>
    </div>
    <div class="col-6 col-md-3">
      <a href="filter.php">
        <button type="button" class="btn btn-primary">Move To Filter</button>
      </a>

    </div>

  </div>
  <div class="row">
    <div class="col-6 col-md-1">

    </div>
    <div class="col-6 col-md-10">
      <!-- <div style="padding: 0px;"> -->
      <div class="containerl">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <!-- <th scope="col">#</th> -->
              <th scope="col">Supervisior Name</th>
              <th scope="col">Order No.</th>
              <th scope="col">Job Type</th>
              <th scope="col">Work Details</th>
              <th scope="col">Work Reason</th>
              <th scope="col">User Complain</th>
              <th scope="col">User Reason</th>
              <th scope="col">Date & Time</th>


            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              while ($row = mysqli_fetch_array($result)) {
                ?>
                <td>
                  <b>
                    <?php echo strtoupper($row['username']); ?>
                  </b>
                </td>
                <td>
                  <?php if (!empty($row['work_order_no'])): ?>
                    <?php echo $row['work_order_no']; ?>

                    <?php if (!empty($row['inpdfFile'])): ?>
                      <!-- Show PDF icon if both work_order_no and inpdfFile exist -->
                      <a href="view_pdf.php?file=<?php echo urlencode($row['inpdfFile']); ?>" target="_blank"
                        style="margin-left: 8px;">
                        <img src="pdf-icon.png" alt="PDF Icon" style="width: 20px; height: 20px;">
                      </a>
                    <?php endif; ?>
                  <?php endif; ?>
                </td>

                <td>
                  <?php echo $row['Job_type'] ?>
                </td>
                <td <?php if ($row['workDetails'] == 'All OK') {
                  echo 'style="background-color: green; color: white;"';
                } else {
                  echo 'style="background-color: red; color: white;"';
                } ?>>
                  <?php
                  if ($row['workDetails'] == 'All OK') {
                    echo 'Complete';
                  } else {
                    echo 'Not Complete';
                  }
                  ?>
                </td>
                <td>
                  <?php echo $row['work_Reason'] ?>
                </td>
                <td <?php if ($row['User_complain'] == 'Not Complain') {
                  echo 'style="background-color: green; color: white;"';
                } else {
                  echo 'style="background-color: red; color: white;"';
                } ?>>
                  <?php
                  if ($row['User_complain'] == 'Not Complain') {
                    echo 'Not Complain';
                  } else {
                    echo 'Complain';
                  }
                  ?>
                </td>

                <td>
                  <?php echo $row['user_Reason'] ?>
                </td>
                <td>
                  <?php echo $row['dateTimeField']; ?>
                  <i class="fa fa-map-marker" style="color: red; margin-left: 5px; cursor: pointer;"
                    onclick="showLocationPopup('<?php echo $row['location']; ?>',event)"></i>
                </td>
              </tr>
              <?php
              }
              ?>
          </tbody>
        </table>
      </div>

      <!-- </div> -->
    </div>
    <div class="col-6 col-md-1">

    </div>
  </div>
  <!-- Popup Container -->
  <div id="locationPopup"
    style="display: none; position: absolute; padding: 10px; border: 1px solid #ccc; background-color: red; z-index: 1000; box-shadow: 0px 0px 10px rgba(0,0,0,0.2);">
    <span id="popupLocationText"></span>
    <button onclick="closeLocationPopup()" style="display: block; margin-top: 10px;">Close</button>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
  </script>
  <script>
    // Function to show the location popup
    function showLocationPopup(location) {
      const popup = document.getElementById("locationPopup");
      document.getElementById("popupLocationText").innerText = "Location: " + location;
      popup.style.display = "block";

      // Position the popup near the clicked icon
      popup.style.top = event.clientY + window.scrollY + 10 + 'px';  // Adjust 10px to place the popup slightly below the icon
      popup.style.left = event.clientX + 10 + 'px';  // Adjust 10px to place the popup slightly right of the icon
    }

    // Function to close the location popup
    function closeLocationPopup() {
      document.getElementById("locationPopup").style.display = "none";
    }
  </script>
</body>

</html>
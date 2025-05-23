<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Data Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            width: 160%;
        }

        .container-box {
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            width: 35%;
            margin: 10px;
        }

        .contai-box {
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            width: 30%;
            margin: 10px;
        }

        .header {
            text-align: center;
            font-weight: bold;
            color: #ff6200;
        }

        .machine-info {
            background: #ff6200;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .psn {
            color: red;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
        }

        .btn-submit {
            background: #ff6200;
            color: white;
            font-weight: bold;
            width: 100%;
        }

        .containe {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header,
        .machine-info,
        .psn {
            margin: 0 10px;
        }

        .color {
            background-color: red;
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
    <?php include '../navbar.php'; ?>

    <div class="contai d-flex flex-container">

        <div style="display: flex;">

            <div style="display: flex;">
                <?php include 'shiftBm1.php'; ?>
                <?php include 'shiftBm2.php'; ?>
                <?php include 'shiftBm3.php'; ?>
            </div>
            <div style="display: flex;">
                <?php
                include '../shiftB/shiftBm4.php';
                ?>
            </div>


        </div>


    </div>
    <div class="row mt-3">
        <div class="col-12 text-center">
            <button type="button" class="btn btn-danger" onclick="resetForm()"
                style="width:100%; font-size: 22px; font-weight: 700; height: 50px;">Reset</button>
            <div>
                <button type="button" class="btn btn-success mt-2" onclick="window.location.href='advancemoney.php';"
                    style="width:100%; font-size: 22px; font-weight: 700; height: 50px; margin-bottom: 45px;">Advance</button>
            </div>
        </div>
    </div>
    <footer>
        <p><strong>Copyright © 2025 <a href="https://pcats.co.in/" class="brand" target="_blank">P-Cats,
                    Jamshedpur</a>.</strong> All
            rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".select-option").forEach(function (item) {
                item.addEventListener("click", function (e) {
                    e.preventDefault();
                    var inputId = this.getAttribute("data-input");
                    document.getElementById(inputId).value = this.textContent;
                });
            });
        });
        function resetForm() {
            // Exclude open readings, date, and all rate fields from reset
            document.querySelectorAll(
                'input:not([name="xp_start_reading"]):not([name="ms_start_reading"]):not([name="shifta1_datetime"]):not([name="datetime"]):not([name$="_rate"]), select'
            ).forEach(field => {
                if (field.tagName === 'INPUT') {
                    field.value = ''; // Clear input fields
                } else if (field.tagName === 'SELECT') {
                    field.selectedIndex = 0; // Reset select dropdowns
                }
            });
        }
    </script>
</body>

</html>
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

        .contai-wrapper {
            /* width: 150%;
    overflow-x: auto;
    white-space: nowrap; */
        }
    </style>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <div class="contai-wrapper">
        <div class="contai d-flex flex-container">
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-danger me-2" onclick="resetForm()">Reset</button>
                    <div>
                        <button type="button" class="btn btn-success mt-2"
                            onclick="window.location.href='advancemoney.php';">Advance</button>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <div style="display: flex;">
                    <?php include 'shiftAm1.php'; ?>
                    <?php include 'shiftAm2.php'; ?>
                    <?php include 'shiftAm3.php'; ?>
                </div>
                <div style="display: flex;">
                    <?php include 'shiftAm4.php'; ?>
                </div>
            </div>

        </div>
    </div>
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
                'input:not([name="xp_start_reading"]):not([name="ms_start_reading"]):not([name="shifta1_datetime"]):not([id*="_rate"]), select'
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
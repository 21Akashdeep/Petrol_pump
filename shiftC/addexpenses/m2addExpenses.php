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
        }

        .container-box {
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            /* width: 20%; */
            margin: 10px;
        }

        .contai-box {
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            width: 50%;
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
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="container-box">
            <div class="containe">
                <!-- <p class="machine-info">BPT SHIFT A</p> -->
                <div class="machine-info">Expenses</div>
                <!-- <div class="machine-info">PSN: 821V</div> -->
            </div>

            <form action="" method="POST">
                <div class="row mb-3 mt-2">
                    <div class="col-12 d-flex align-items-center">
                        <label class="me-2"><strong>Date_&_Time:</strong></label>
                        <input type="text" class="form-control" name="datetime"
                            value="<?php echo date('d/m/Y H:i:s'); ?>" readonly>
                    </div>
                </div>

<!-- Employee Selection -->
<div class="row mb-3">
                    <div class="col-4"><strong>Select Employee</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Employee</option>
                            <option value="1">Employee 1</option>
                            <option value="2">Employee 2</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Employee</option>
                            <option value="1">Employee 1</option>
                            <option value="2">Employee 2</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4"><strong>Select Liquid</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Liquid</option>
                            <option value="1">Mobile-2T</option>
                            <option value="1">Mobile-1 Ltr</option>
                            <option value="2">D Water 1 Ltr</option>
                            <option value="2">D Water 5 Ltr</option>

                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Liquid</option>
                            <option value="1">Mobile-2T</option>
                            <option value="1">Mobile-1 Ltr</option>
                            <option value="2">D Water 1 Ltr</option>
                            <option value="2">D Water 5 Ltr</option>
                        </select>
                    </div>
                </div>
                <?php
        $fields = ["Opening QTY", "Sale", "Sale AMT", "Closing QTY"];
        foreach ($fields as $field) {
            echo '
            <div class="row mb-2">
                <div class="col-4">'.$field.'</div>
                <div class="col-4"><input type="text" class="form-control" name="xp_'.strtolower(str_replace(" ", "_", $field)).'"></div>
                <div class="col-4"><input type="text" class="form-control" name="ms_'.strtolower(str_replace(" ", "_", $field)).'"></div>
            </div>';
        }
        ?>

                <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
            </form>
        </div>

        
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
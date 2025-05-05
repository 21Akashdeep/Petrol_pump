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
        width: 20%;
        margin: 10px;
    }

    .contai-box {
        background: white;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        width: 35%;
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
    <div class="contai d-flex flex-container">
        <div class="container-box">
            <div class="containe">
                <p class="machine-info">BPT SHIFT A</p>
                <div class="machine-info">MACHINE NO. 01</div>
                <div class="machine-info">PSN: 1299</div>
            </div>

            <form action="" method="POST">
                <div class="row mb-3 mt-2">
                    <div class="col-12 d-flex align-items-center">
                        <label class="me-2"><strong>Date_&_Time:</strong></label>
                        <input type="text" class="form-control" name="datetime"
                            value="<?php echo date('d/m/Y H:i:s'); ?>" readonly>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-4"><strong>Select product</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select product</option>
                            <option value="1">XP-95</option>
                            <option value="2">MS</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Product</option>
                            <option value="1">XP-95</option>
                            <option value="2">MS</option>
                        </select>
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
                    <div class="col-4"><strong>Shift</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>

                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-4"><strong>Nozzle</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>

                        </select>
                    </div>

                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>

                        </select>
                    </div>
                </div>

                <?php
                    $fields = ["Start Reading", "Close Reading", "Reading Difference", "Testing Less", "Net. Sale", "Rate", "Cash", "Paytm machine No.", "Paytm Amount", "Card Machine No.","Card Amount","Sortage","Surplus", "Total Amount"];
                    $paytm_numbers = ["1", "2", "3", "4"]; // Predefined Paytm numbers
                    $cash_denominations = ["1", "2", "3", "4"]; // Predefined Cash denominations

                    foreach ($fields as $field) {
                        echo '<div class="row mb-2">
                                <div class="col-4">'.$field.'</div>';

                        if ($field == "Paytm machine No.") {
                            // Paytm dropdown field
                            echo '<div class="col-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="xp_paytm" name="xp_paytm" placeholder="Enter Amount">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">';
                                            foreach ($paytm_numbers as $number) {
                                                echo '<li><a class="dropdown-item select-option" data-input="xp_paytm" href="#">'.$number.'</a></li>';
                                            }
                            echo       '</ul>
                                    </div>
                                </div>';

                            echo '<div class="col-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="ms_paytm" name="ms_paytm" placeholder="Enter Amount">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">';
                                            foreach ($paytm_numbers as $number) {
                                                echo '<li><a class="dropdown-item select-option" data-input="ms_paytm" href="#">'.$number.'</a></li>';
                                            }
                            echo       '</ul>
                                    </div>
                                </div>';
                        } elseif ($field == "Card Machine No.") {
                            // Cash dropdown field
                            echo '<div class="col-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="xp_cash" name="xp_cash" placeholder="Enter Amount">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">';
                                            foreach ($cash_denominations as $denomination) {
                                                echo '<li><a class="dropdown-item select-option" data-input="xp_cash" href="#">'.$denomination.'</a></li>';
                                            }
                            echo       '</ul>
                                    </div>
                                </div>';

                            echo '<div class="col-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="ms_cash" name="ms_cash" placeholder="Enter Amount">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">';
                                            foreach ($cash_denominations as $denomination) {
                                                echo '<li><a class="dropdown-item select-option" data-input="ms_cash" href="#">'.$denomination.'</a></li>';
                                            }
                            echo       '</ul>
                                    </div>
                                </div>';
                        } else {
                            // Normal input fields
                            echo '<div class="col-4"><input type="text" class="form-control" name="xp_'.strtolower(str_replace(" ", "_", $field)).'"></div>
                                <div class="col-4"><input type="text" class="form-control" name="ms_'.strtolower(str_replace(" ", "_", $field)).'"></div>';
                        }

                        echo '</div>';
                    }
                ?>



                <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
            </form>
            <div class="row mt-2">
                <div class="col-12 text-center">
                    <a href="moneycash.php" class="">Add your cash</a>
                    <a href="addliquid.php" class="">Add Liquid</a>

                </div>
            </div>
        </div>

        <div class="container-box">
            <div class="containe">
                <p class="machine-info">BPT SHIFT A</p>
                <div class="machine-info">MACHINE NO. 02</div>
                <div class="machine-info">PSN: 821V</div>
            </div>

            <form action="" method="POST">
                <div class="row mb-3 mt-2">
                    <div class="col-12 d-flex align-items-center">
                        <label class="me-2"><strong>Date_&_Time:</strong></label>
                        <input type="text" class="form-control" name="datetime"
                            value="<?php echo date('d/m/Y H:i:s'); ?>" readonly>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-4"><strong>Select product</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select product</option>
                            <option value="1">XP-95</option>
                            <option value="2">MS</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Product</option>
                            <option value="1">XP-95</option>
                            <option value="2">MS</option>
                        </select>
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
                    <div class="col-4"><strong>Shift</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>

                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-4"><strong>Nozzle</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>

                        </select>
                    </div>

                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>

                        </select>
                    </div>
                </div>
                <?php
                    $fields = ["Start Reading", "Close Reading", "Reading Difference", "Testing Less", "Net. Sale", "Rate", "Cash", "Paytm machine No.", "Paytm Amount", "Card Machine No.","Card Amount","Sortage","Surplus", "Total Amount"];
                    $paytm_numbers = ["1", "2", "3", "4"]; // Predefined Paytm numbers
                    $cash_denominations = ["1", "2", "3", "4"]; // Predefined Cash denominations

                    foreach ($fields as $field) {
                        echo '<div class="row mb-2">
                                <div class="col-4">'.$field.'</div>';

                        if ($field == "Paytm machine No.") {
                            // Paytm dropdown field
                            echo '<div class="col-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="xp_paytm" name="xp_paytm" placeholder="Enter Amount">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">';
                                            foreach ($paytm_numbers as $number) {
                                                echo '<li><a class="dropdown-item select-option" data-input="xp_paytm" href="#">'.$number.'</a></li>';
                                            }
                            echo       '</ul>
                                    </div>
                                </div>';

                            echo '<div class="col-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="ms_paytm" name="ms_paytm" placeholder="Enter Amount">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">';
                                            foreach ($paytm_numbers as $number) {
                                                echo '<li><a class="dropdown-item select-option" data-input="ms_paytm" href="#">'.$number.'</a></li>';
                                            }
                            echo       '</ul>
                                    </div>
                                </div>';
                        } elseif ($field == "Card Machine No.") {
                            // Cash dropdown field
                            echo '<div class="col-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="xp_cash" name="xp_cash" placeholder="Enter Amount">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">';
                                            foreach ($cash_denominations as $denomination) {
                                                echo '<li><a class="dropdown-item select-option" data-input="xp_cash" href="#">'.$denomination.'</a></li>';
                                            }
                            echo       '</ul>
                                    </div>
                                </div>';

                            echo '<div class="col-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="ms_cash" name="ms_cash" placeholder="Enter Amount">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                        <ul class="dropdown-menu">';
                                            foreach ($cash_denominations as $denomination) {
                                                echo '<li><a class="dropdown-item select-option" data-input="ms_cash" href="#">'.$denomination.'</a></li>';
                                            }
                            echo       '</ul>
                                    </div>
                                </div>';
                        } else {
                            // Normal input fields
                            echo '<div class="col-4"><input type="text" class="form-control" name="xp_'.strtolower(str_replace(" ", "_", $field)).'"></div>
                                <div class="col-4"><input type="text" class="form-control" name="ms_'.strtolower(str_replace(" ", "_", $field)).'"></div>';
                        }

                        echo '</div>';
                    }
                ?>


                <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
            </form>
            <div class="row mt-2">
                <div class="col-12 text-center">
                    <a href="moneycash.php" class="">Add your cash</a>
                    <a href="addliquid.php" class="">Add Liquid</a>

                </div>
            </div>
        </div>

        <div class="container-box">
            <div class="containe">
                <p class="machine-info">BPT SHIFT A</p>
                <div class="machine-info">MACHINE NO. 03</div>
                <div class="machine-info">PSN: 822V</div>
            </div>

            <form action="" method="POST">
                <div class="row mb-3 mt-2">
                    <div class="col-12 d-flex align-items-center">
                        <label class="me-2"><strong>Date_&_Time:</strong></label>
                        <input type="text" class="form-control" name="datetime"
                            value="<?php echo date('d/m/Y H:i:s'); ?>" readonly>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-4"><strong>Select product</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select product</option>
                            <option value="1">HSD</option>
                            <option value="2">HD</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Product</option>
                            <option value="1">HSD</option>
                            <option value="2">HD</option>
                        </select>
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
                    <div class="col-4"><strong>Shift</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>

                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-4"><strong>Nozzle</strong></div>
                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>

                        </select>
                    </div>

                    <div class="col-4">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>

                        </select>
                    </div>
                </div>
                <?php
$fields = ["Start Reading", "Close Reading", "Reading Difference", "Testing Less", "Net. Sale", "Rate", "Cash", "Paytm machine No.", "Paytm Amount", "Card Machine No.","Card Amount","Sortage","Surplus", "Total Amount"];
$paytm_numbers = ["1", "2", "3", "4"]; // Predefined Paytm numbers
$cash_denominations = ["1", "2", "3", "4"]; // Predefined Cash denominations

foreach ($fields as $field) {
    echo '<div class="row mb-2">
            <div class="col-4">'.$field.'</div>';

    if ($field == "Paytm machine No.") {
        // Paytm dropdown field
        echo '<div class="col-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="xp_paytm" name="xp_paytm" placeholder="Enter Amount">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                    <ul class="dropdown-menu">';
                        foreach ($paytm_numbers as $number) {
                            echo '<li><a class="dropdown-item select-option" data-input="xp_paytm" href="#">'.$number.'</a></li>';
                        }
        echo       '</ul>
                </div>
            </div>';

        echo '<div class="col-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="ms_paytm" name="ms_paytm" placeholder="Enter Amount">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                    <ul class="dropdown-menu">';
                        foreach ($paytm_numbers as $number) {
                            echo '<li><a class="dropdown-item select-option" data-input="ms_paytm" href="#">'.$number.'</a></li>';
                        }
        echo       '</ul>
                </div>
            </div>';
    } elseif ($field == "Card Machine No.") {
        // Cash dropdown field
        echo '<div class="col-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="xp_cash" name="xp_cash" placeholder="Enter Amount">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                    <ul class="dropdown-menu">';
                        foreach ($cash_denominations as $denomination) {
                            echo '<li><a class="dropdown-item select-option" data-input="xp_cash" href="#">'.$denomination.'</a></li>';
                        }
        echo       '</ul>
                </div>
            </div>';

        echo '<div class="col-4">
                <div class="input-group">
                    <input type="text" class="form-control" id="ms_cash" name="ms_cash" placeholder="Enter Amount">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                    <ul class="dropdown-menu">';
                        foreach ($cash_denominations as $denomination) {
                            echo '<li><a class="dropdown-item select-option" data-input="ms_cash" href="#">'.$denomination.'</a></li>';
                        }
        echo       '</ul>
                </div>
            </div>';
    } else {
        // Normal input fields
        echo '<div class="col-4"><input type="text" class="form-control" name="xp_'.strtolower(str_replace(" ", "_", $field)).'"></div>
            <div class="col-4"><input type="text" class="form-control" name="ms_'.strtolower(str_replace(" ", "_", $field)).'"></div>';
    }

    echo '</div>';
}
?>

                <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
            </form>
            <div class="row mt-2">
                <div class="col-12 text-center">
                    <a href="moneycash.php" class="">Add your cash</a>
                    <a href="addliquid.php" class="">Add Liquid</a>

                </div>
            </div>
        </div>

        <div class="contai-box">
            <div class="containe">
                <p class="machine-info">BPT SHIFT A</p>
                <div class="machine-info">MACHINE NO. 04</div>
                <div class="machine-info">PSN: 1295</div>
            </div>

            <form action="" method="POST">
                <div class="row mb-3 mt-2">
                    <div class="col-12 d-flex align-items-center">
                        <label class="me-2"><strong>Date_&_Time:</strong></label>
                        <input type="text" class="form-control" name="datetime"
                            value="<?php echo date('d/m/Y H:i:s'); ?>" readonly>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-2"><strong>product</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select product</option>
                            <option value="1">XG-1</option>
                            <option value="2">XG-2</option>
                            <option value="1">MS-1</option>
                            <option value="2">MS-2</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Product</option>
                            <option value="1">XG-1</option>
                            <option value="2">XG-2</option>
                            <option value="1">MS-1</option>
                            <option value="2">MS-2</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Product</option>
                            <option value="1">XG-1</option>
                            <option value="2">XG-2</option>
                            <option value="1">MS-1</option>
                            <option value="2">MS-2</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Product</option>
                            <option value="1">XG-1</option>
                            <option value="2">XG-2</option>
                            <option value="1">MS-1</option>
                            <option value="2">MS-2</option>
                        </select>
                    </div>
                </div>

                <!-- Employee Selection -->
                <div class="row mb-3">
                    <div class="col-2"><strong>Select Employee</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Employee</option>
                            <option value="1">Employee 1</option>
                            <option value="2">Employee 2</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Employee</option>
                            <option value="1">Employee 1</option>
                            <option value="2">Employee 2</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="ms_employee">
                            <option selected>Select Employee</option>
                            <option value="1">Employee 1</option>
                            <option value="2">Employee 2</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Employee</option>
                            <option value="1">Employee 1</option>
                            <option value="2">Employee 2</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2"><strong>Shift</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Shift</option>
                            <option value="1">Shift A</option>
                            <option value="2">Shift B</option>
                            <option value="2">Shift C</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-2"><strong>Nozzle</strong></div>
                    <div class="col-3">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>
                            <option value="1">Nozzle 3</option>
                            <option value="2">Nozzle 4</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>
                            <option value="1">Nozzle 3</option>
                            <option value="2">Nozzle 4</option>

                        </select>
                    </div>

                    <div class="col-2">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>
                            <option value="1">Nozzle 3</option>
                            <option value="2">Nozzle 4</option>

                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="xp_employee">
                            <option selected>Select Nozzle</option>
                            <option value="1">Nozzle 1</option>
                            <option value="2">Nozzle 2</option>
                            <option value="1">Nozzle 3</option>
                            <option value="2">Nozzle 4</option>

                        </select>
                    </div>
                </div>
                <?php
                    $fields = ["Start Reading", "Close Reading", "Reading Difference", "Testing Less", "Net. Sale", "Rate", "Cash", "Paytm machine No.", "Paytm Amount", "Card Machine No.","Card Amount","Sortage","Surplus", "Total Amount"];
                    $paytm_numbers = ["1", "2", "3", "4", "5"];
                    $cash_denominations = ["1", "2", "3", "4", "5"];

                    foreach ($fields as $field) {
                        echo '<div class="row mb-2">
                                <div class="col-2">'.$field.'</div>';

                        if ($field == "Paytm machine No." || $field == "Card Machine No.") {
                            // Dropdowns for Paytm and Card Machines
                            $dropdown_values = ($field == "Paytm machine No.") ? $paytm_numbers : $cash_denominations;
                            $name_prefix = ($field == "Paytm machine No.") ? "paytm" : "cash";

                            for ($i = 0; $i < 4; $i++) {
                                echo '<div class="col-2">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="'.$name_prefix.'_'.$i.'" placeholder="Enter Amount">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"></button>
                                            <ul class="dropdown-menu">';
                                                foreach ($dropdown_values as $value) {
                                                    echo '<li><a class="dropdown-item select-'.$name_prefix.'" data-input="'.$name_prefix.'_'.$i.'" href="#">'.$value.'</a></li>';
                                                }
                                echo       '</ul>
                                        </div>
                                    </div>';
                            }
                        } else {
                            // Normal input fields
                            echo '<div class="col-3"><input type="text" class="form-control" name="xp_'.strtolower(str_replace(" ", "_", $field)).'"></div>
                                <div class="col-2"><input type="text" class="form-control" name="ms_'.strtolower(str_replace(" ", "_", $field)).'"></div>
                                <div class="col-2"><input type="text" class="form-control" name="m_'.strtolower(str_replace(" ", "_", $field)).'"></div>
                                <div class="col-3"><input type="text" class="form-control" name="mh_'.strtolower(str_replace(" ", "_", $field)).'"></div>';
                        }

                        echo '</div>'; // Close row
                    }
                ?>


                <button type="submit" class="btn btn-submit mt-3">SUBMIT</button>
            </form>
            <div class="row mt-2">
                <div class="col-12 text-center">
                    <a href="moneycash.php" class="">Add your cash</a>
                    <a href="addliquid.php" class="">Add Liquid</a>

                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".dropdown-menu .select-option").forEach(function(item) {
            item.addEventListener("click", function(event) {
                event.preventDefault();
                var inputId = this.getAttribute("data-input");
                var inputField = document.getElementById(inputId);
                if (inputField) {
                    inputField.value = this.textContent;
                }
            });
        });
    });
    // JavaScript to update input field when dropdown is selected
    document.querySelectorAll('.select-paytm').forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            let inputName = this.getAttribute('data-input');
            document.querySelector(`[name="${inputName}"]`).value = this.textContent;
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
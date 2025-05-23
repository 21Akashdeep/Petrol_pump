<style>
    /* Style for dropdown submenu */
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
        display: none;
        position: absolute;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }
</style>
<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- <a class="navbar-brand fw-bold" href="#">Item List</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../home.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button"
                        data-bs-toggle="dropdown">
                        Users
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="employeelist.php">Employee</a></li>
                        <li><a class="dropdown-item" href="Adminlist.php">Admin</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button"
                        data-bs-toggle="dropdown">
                        Master
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="vendorlist.php">Vendor</a></li>
                        <li><a class="dropdown-item" href="customerlist.php">Customer</a></li>
                        <li><a class="dropdown-item" href="itemlist.php">Add Item</a></li>
                        <li><a class="dropdown-item" href="locationlist.php">Add Location</a></li>
                        <li><a class="dropdown-item" href="UOMlist.php">Add UOM</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="purchaseDropdown" role="button"
                        data-bs-toggle="dropdown">
                        Purchase
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../create/createpurchase.php">Purchase Bill</a></li>
                        <li><a class="dropdown-item" href="purchaselist.php">Purchase Invoice Registered</a></li>
                    </ul>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Sal Shift
                        Wise</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="#">Shift A</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="usermachine_A1.php">Machine 1</a></li>
                                <li><a class="dropdown-item" href="usermachine_A2.php">Machine 2</a></li>
                                <li><a class="dropdown-item" href="usermachine_A3.php">Machine 3</a></li>
                                <li><a class="dropdown-item" href="usermachine_A4.php">Machine 4</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="#">Shift B</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="usermachine_B1.php">Machine 1</a></li>
                                <li><a class="dropdown-item" href="usermachine_B2.php">Machine 2</a></li>
                                <li><a class="dropdown-item" href="usermachine_B3.php">Machine 3</a></li>
                                <li><a class="dropdown-item" href="usermachine_B4.php">Machine 4</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="#">Shift C</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="usermachine_C1.php">Machine 1</a></li>
                                <li><a class="dropdown-item" href="usermachine_C2.php">Machine 2</a></li>
                                <li><a class="dropdown-item" href="usermachine_C3.php">Machine 3</a></li>
                                <li><a class="dropdown-item" href="usermachine_C4.php">Machine 4</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountingDropdown" role="button" data-bs-toggle="dropdown">
                        Accounting Report
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="challan.php">Challan Report</a></li>
                        <li><a class="dropdown-item" href="#">Bill Report</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="inventoryDropdown" role="button" data-bs-toggle="dropdown">
                        Inventory Report
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Daily Summary Report</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
    crossorigin="anonymous"></script>
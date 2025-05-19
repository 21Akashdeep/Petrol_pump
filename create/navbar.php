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
        <a class="navbar-brand" href="../home.php">
            <img src="../images/bptlogo.png" alt="Logo" style="height:40px;">
        </a>
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
                        <li><a class="dropdown-item" href="../list/employeelist.php">Employee</a></li>
                        <li><a class="dropdown-item" href="../list/Adminlist.php">Admin</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="masterDropdown" role="button"
                        data-bs-toggle="dropdown">
                        Master
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../list/vendorlist.php">Vendor</a></li>
                        <li><a class="dropdown-item" href="../list/customerlist.php">Customer</a></li>
                        <li><a class="dropdown-item" href="../list/itemlist.php">Add Item</a></li>
                        <li><a class="dropdown-item" href="../list/locationlist.php">Add Location</a></li>
                        <li><a class="dropdown-item" href="ratelist.php">Add petrol rate</a></li>
                        <li><a class="dropdown-item" href="../list/UOMlist.php">Add UOM</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="purchaseDropdown" role="button"
                        data-bs-toggle="dropdown">
                        Purchase
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../create/createpurchase.php">Purchase Bill</a></li>
                        <li><a class="dropdown-item" href="../list/purchaselist.php">Purchase Invoice Registered</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Sale Shift
                        Wise</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="../shiftA/mainshiftA.php">Shift A</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../shiftA/shiftm1report.php">Machine 1</a></li>
                                <li><a class="dropdown-item" href="../shiftA/shiftm2report.php">Machine 2</a></li>
                                <li><a class="dropdown-item" href="../shiftA/shiftm3report.php">Machine 3</a></li>
                                <li><a class="dropdown-item" href="../shiftA/shiftm4report.php">Machine 4</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="../shiftB/mainshiftB.php">Shift B</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../shiftB/shiftm1report.php">Machine 1</a></li>
                                <li><a class="dropdown-item" href="../shiftB/shiftm2report.php">Machine 2</a></li>
                                <li><a class="dropdown-item" href="../shiftB/shiftm3report.php">Machine 3</a></li>
                                <li><a class="dropdown-item" href="../shiftB/shiftm4report.php">Machine 4</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item" href="../shiftC/mainshiftC.php">Shift C</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../shiftC/shiftm1report.php">Machine 1</a></li>
                                <li><a class="dropdown-item" href="../shiftC/shiftm2report.php">Machine 2</a></li>
                                <li><a class="dropdown-item" href="../shiftC/shiftm3report.php">Machine 3</a></li>
                                <li><a class="dropdown-item" href="../shiftC/shiftm4report.php">Machine 4</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
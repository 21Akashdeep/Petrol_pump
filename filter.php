<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>" required>
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="export_pdf.php?start_date=<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>&end_date=<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="btn btn-danger">Export PDF</a>
            <a href="export_excel.php?start_date=<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>&end_date=<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>&search=<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="btn btn-success">Export Excel</a>
        </div>
    </div>
</form>

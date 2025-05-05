<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white fw-bold">
            Money Details
        </div>
        <div class="card-body">
            <div class="row g-2">
                <!-- Table Header -->
                <div class="col-4 fw-bold">Note</div>
                <div class="col-4 fw-bold">Pieces</div>
                <div class="col-4 fw-bold">Amount</div>

                <!-- Money Inputs -->
                <script>
                    const denominations = [500, 200, 100, 50, 20, 10];

                    denominations.forEach(value => {
                        document.write(`
                            <div class="col-4">${value} *</div>
                            <div class="col-4">
                                <input type="number" class="form-control qty" id="qty-${value}" data-value="${value}" value="0" min="0">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control total" id="total-${value}" value="0" readonly>
                            </div>
                        `);
                    });
                </script>

                <!-- Coins and Total -->
                <div class="col-4 fw-bold">Coins</div>
                <div class="col-4"><input type="text" class="form-control" id="coins" value="0.00"></div>
                <div class="col-4"></div>

                <div class="col-4 fw-bold">Total</div>
                <div class="col-4"></div>
                <div class="col-4"><input type="text" class="form-control" id="grand-total" value="0.00" readonly></div>
                <div class="col-12 text-center mt-3">
                    <button class="btn btn-primary" onclick="submitForm()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".qty").forEach(input => {
        input.addEventListener("input", calculateTotal);
    });

    function calculateTotal() {
        let grandTotal = 0;
        document.querySelectorAll(".qty").forEach(input => {
            let denomination = parseInt(input.getAttribute("data-value"));
            let quantity = parseInt(input.value) || 0;
            let total = denomination * quantity;
            document.querySelector(`#total-${denomination}`).value = total.toFixed(2);
            grandTotal += total;
        });

        let coins = parseFloat(document.getElementById("coins").value) || 0;
        grandTotal += coins;
        document.getElementById("grand-total").value = grandTotal.toFixed(2);
    }

    document.getElementById("coins").addEventListener("input", calculateTotal);
</script>

</body>
</html>

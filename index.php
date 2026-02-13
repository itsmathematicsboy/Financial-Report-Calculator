<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Financial Dashboard</a>
    </div>
</nav>

<div class="container mt-4">

    <div class="row">
        <div class="col-lg-6">

            <!-- FORM CARD -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Input Financial Data
                </div>
                <div class="card-body">
                    <form method="POST">

                        <h6 class="fw-bold">Profitability</h6>

                        <div class="mb-2">
                            <label class="form-label">Revenue</label>
                            <input type="text" step="0.01" name="revenue" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">COGS</label>
                            <input type="text" step="0.01" name="cogs" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Net Income</label>
                            <input type="text" step="0.01" name="net_income" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Total Assets</label>
                            <input type="text" step="0.01" name="total_assets" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Equity</label>
                            <input type="text" step="0.01" name="total_equity" class="form-control" required>
                        </div>

                        <h6 class="fw-bold">Liquidity</h6>

                        <div class="mb-2">
                            <label class="form-label">Current Assets</label>
                            <input type="text" step="0.01" name="current_assets" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Current Liabilities</label>
                            <input type="text" step="0.01" name="current_liabilities" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Inventory</label>
                            <input type="text" step="0.01" name="inventory" class="form-control" required>
                        </div>

                        <h6 class="fw-bold">Leverage</h6>

                        <div class="mb-3">
                            <label class="form-label">Total Debt</label>
                            <input type="text" step="0.01" name="total_debt" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Calculate
                        </button>

                    </form>
                </div>
            </div>
        </div>

        <?php 
        // ======================= Profitability Ratios ================= 
        // Gross Profit Margin 
        function gross_profit_margin($revenue, $cogs){ 
            return ($revenue - $cogs) / $revenue; 
            } 
        
        // Net Profit Margin 
        function net_profit_margin($net_income, $revenue){ 
            return $net_income / $revenue; 
        }

        // Return On Assets 
            function return_on_assets($net_income, $total_assets){ 
        return $net_income / $total_assets; 
        } 

        // // Return On Equity 
            function return_on_equity($net_income, $total_equity){ 
        return $net_income / $total_equity;
        } 

        // ================ Liquidity Ratios ============================ 
        // Current Ratio 
            function current_ratio($current_assets, $current_liabilities){ 
        return $current_assets / $current_liabilities; 
        } 

        // // Quick Ratio 
            function quick_ratio($current_assets, $inventory, $current_liabilities){ 
        return ($current_assets - $inventory) / $current_liabilities; 
        }

        // ========================= Leverage Ratios =========================== 
        
        // Debt to Equity Ratio 
            function debt_to_equity_ratio($total_debt, $total_equity){ 
        return $total_debt / $total_equity; 
        } 

        // Debt to Asset Ratio 
            function debt_to_asset_ratio($total_debt, $total_assets){ 
        return $total_debt / $total_assets; 
        } ?>

        <?php
        // Mengambil Data Variabel
        if($_SERVER["REQUEST_METHOD"] == "POST"){ 
            $revenue = (float) $_POST['revenue']; 
            $cogs = (float) $_POST['cogs']; 
            $net_income = (float) $_POST['net_income']; 
            $total_assets = (float) $_POST['total_assets']; 
            $total_equity = (float) $_POST['total_equity']; 
            $current_assets = (float) $_POST['current_assets']; 
            $current_liabilities = (float) $_POST['current_liabilities']; 
            $inventory = (float) $_POST['inventory']; 
            $total_debt = (float) $_POST['total_debt'];
            // ================= HITUNG =================
            $errors = []; 
            if ($revenue == 0){ 
                $errors[] = "Revenue tidak boleh 0."; 
            } 
            if ($total_assets == 0){ 
                $errors[] = "Total Assets tidak boleh 0."; 
            } 
            if ($total_equity == 0) { 
                $errors[] = "Total Equity tidak boleh 0."; 
            } 
            if ($current_liabilities == 0) { 
                $errors[] = "Current Liabilities tidak boleh 0."; 
            } 
            if (empty($errors)) { 
                $gross_margin_profit = gross_profit_margin($revenue, $cogs); 
                $net_margin = net_profit_margin($net_income, $revenue); 
                $roa = return_on_assets($net_income, $total_assets); 
                $roe = return_on_equity($net_income, $total_equity); 
                $current_ratio = current_ratio($current_assets, $current_liabilities); 
                $quick_ratio = quick_ratio($current_assets, $inventory, $current_liabilities); 
                $debt_to_equity = debt_to_equity_ratio($total_debt, $total_equity); 
                $debt_to_asset = debt_to_asset_ratio($total_debt, $total_assets); }
        }
        ?>

        <!-- OUTPUT COLUMN -->
        <div class="col-lg-6">

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        Financial Ratios Result
                    </div>
                    <div class="card-body">

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Gross Profit Margin:
                                <strong><?= round($gross_margin_profit * 100, 2) ?>%</strong>
                            </li>
                            <li class="list-group-item">
                                Net Profit Margin:
                                <strong><?= round($net_margin * 100, 2) ?>%</strong>
                            </li>
                            <li class="list-group-item">
                                Return On Assets:
                                <strong><?= round($roa * 100, 2) ?>%</strong>
                            </li>
                            <li class="list-group-item">
                                Return On Equity:
                                <strong><?= round($roe * 100, 2) ?>%</strong>
                            </li>
                            <li class="list-group-item">
                                Current Ratio:
                                <strong><?= round($current_ratio, 2) ?></strong>
                            </li>
                            <li class="list-group-item">
                                Quick Ratio:
                                <strong><?= round($quick_ratio, 2) ?></strong>
                            </li>
                            <li class="list-group-item">
                                Debt to Equity Ratio:
                                <strong><?= round($debt_to_equity, 2) ?></strong>
                            </li>
                            <li class="list-group-item">
                                Debt to Asset Ratio:
                                <strong><?= round($debt_to_asset, 2) ?></strong>
                            </li>
                        </ul>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

</body>
</html>
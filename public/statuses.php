<?php
require_once __DIR__ . '/../api_functions.php';

// Set dates to get filtered lead statuses
$date_from = date("Y-m-d 00:00:00", strtotime("-30 days"));
$date_to = date("Y-m-d 23:59:59");

$leads = getLeadStatuses($date_from, $date_to);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Statuses</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/css/intlTelInput.css">
</head>
<body>

    <nav>
        <a href="/">Add new Lead</a>
        <a href="#" class='active'>Statuses</a>
    </nav>

    <div class="container">
        <h2>Leads Statuses</h2>
        <form id="lead-filter">
            <label for="date_from">Date From: </label>
            <input type="date" name="date_from" value="<?= date('Y-m-d', strtotime($date_from)) ?>">
            <label for="date_to" >Date To: </label>
            <input type="date" name="date_to" value="<?= date('Y-m-d', strtotime($date_to)) ?>">
            <button class="submit-btn" id="filter-submit">Filter</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>FTD</th>
                </tr>
            </thead>
            <tbody id="leads-table-body">
                    <?php if ($leads['status'] === true): 
                    ?>
                    <?php foreach ($leads['data'] as $lead): ?>
                        <tr>
                            <td><?= $lead['id'] ?></td>
                            <td><?= $lead['email'] ?></td>
                            <td><?= $lead['status'] ?></td>
                            <td><?= $lead['ftd'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">Error: <?= $leads['error'] ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/intlTelInput.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>

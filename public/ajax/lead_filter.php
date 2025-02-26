<?php
require_once __DIR__ . '/../../api_functions.php';

$date_from = $_POST['date_from'] ?? date("Y-m-d 00:00:00", strtotime("-30 days"));
$date_to = $_POST['date_to'] ?? date("Y-m-d 23:59:59");

$leads = getLeadStatuses($date_from, $date_to);

header('Content-Type: application/json'); // Set the content type to JSON

echo json_encode($leads);

<?php
require_once __DIR__ . '/../../api_functions.php';

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data from the POST request
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $phone = $_POST['fullPhone'] ?? ''; // Full phone number
    $email = $_POST['email'] ?? '';

    file_put_contents("logs.txt", date("Y-m-d H:i:s") . " - Data To Be Sent: " . $firstName . $lastName . $phone . $email . "\n\n", FILE_APPEND);

    if ($firstName && $lastName && $phone && $email) {
        $response = addLead($firstName, $lastName, $phone, $email); // Call the function to add the lead through API
        echo json_encode($response);
    } else {
        // Return an error message if any required fields are missing
        echo json_encode(["status" => false, "error" => "Fill out all the required fields!"]);
    }
} else {
    // Return an error message if the request method is not POST
    echo json_encode(["status" => false, "error" => "Invalid request method"]);
}
?>

<?php require_once __DIR__ . '/../api_functions.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead creation form</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/css/intlTelInput.css">
</head>
<body>

    <nav>
        <a href="/" class='active'>Add new Lead</a>
        <a href="statuses.php">Leads Statuses</a>
    </nav>

    <div class="container">
        <h2>Add Lead</h2>
        <form id="lead-form">
            <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
            <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
            <input type="text" name="phone" id="phone" placeholder="Phone" required>
            <input type="hidden" id="fullPhone" name="fullPhone">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <button class="submit-btn" id="submit-btn">Save</button>
        </form>
        <p id="responseMessage"></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/intlTelInput.min.js"></script>
    <script src="/js/script.js"></script>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Patient</title>
</head>
<body>
    <h2>Verify Patient</h2>

    <?php
    // Check if there is a message to display (e.g., error message)
    if (isset($_SESSION['verification_message'])) {
        echo '<p>' . $_SESSION['verification_message'] . '</p>';
        unset($_SESSION['verification_message']); // Clear the message to display it only once
    }
    ?>

    <form method="post" action="verify_patient_process.php">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>
        <br>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>
        <br>
        <label for="patientID">Patient ID:</label>
        <input type="text" id="patientID" name="patientID" required>
        <br>
        <input type="submit" value="Verify Patient">
    </form>
</body>
</html>

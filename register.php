<!-- register.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Customer Account</title>
</head>
<body>
    <h2>Create New Customer Account</h2>
    <form method="post" action="register_process.php">
        <label for="patientID">Patient ID:</label>
        <input type="text" name="patientID" required>
        <br>
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>
        <br>
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>
        <br>
        <input type="submit" value="Create Account">
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Appointment</title>
</head>
<body>
    <h2>Cancel Appointment</h2>
    <form method="post" action="cancel_appointment_process.php">
        <label for="appointmentID">Appointment ID:</label>
        <input type="text" name="appointmentID" required>
        <br>
        <input type="submit" value="Cancel Appointment">
    </form>
</body>
</html>

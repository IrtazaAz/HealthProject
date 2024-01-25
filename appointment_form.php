<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
</head>
<body>
    <h2>Appointment Form</h2>
    <form method="post" action="make_appointment_process.php">
        <label for="appointmentDate">Appointment Date:</label>
        <input type="date" name="appointmentDate" required>
        <br>
        <label for="appointmentType">Appointment Type:</label>
        <input type="text" name="appointmentType" required>
        <br>
        <label for="doctorID">Doctor ID:</label>
        <input type="text" name="doctorID" required>
        <br>
        <input type="submit" value="Make Appointment">
    </form>
</body>
</html>

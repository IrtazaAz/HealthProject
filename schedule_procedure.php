<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Procedure</title>
</head>
<body>
    <h2>Schedule Procedure</h2>
    <form method="post" action="schedule_procedure_process.php">
        <label for="procedureType">Procedure Type:</label>
        <input type="text" name="procedureType" required>
        <br>

        <label for="procedureDate">Procedure Date:</label>
        <input type="date" name="procedureDate" required>
        <br>

        <label for="appointmentID">Appointment ID:</label>
        <input type="text" name="appointmentID" required>
        <br>

        <input type="submit" value="Schedule Procedure">
    </form>
</body>
</html>

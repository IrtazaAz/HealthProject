<!-- update_patient.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Record</title>
</head>
<body>
    <h2>Update Patient Record</h2>
    <form method="post" action="update_patient_process.php">
        <label for="patientID">Patient ID:</label>
        <input type="text" name="patientID" required>
        <br>
        <label for="shots">Update Shots:</label>
        <input type="text" name="shots">
        <br>
        <label for="illnesses">Update Illnesses:</label>
        <input type="text" name="illnesses">
        <br>
        <input type="submit" value="Update Record">
    </form>
</body>
</html>

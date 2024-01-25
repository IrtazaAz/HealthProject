<!-- cancel_procedure.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Procedure</title>
</head>
<body>
    <h2>Cancel Procedure</h2>
    <form method="post" action="cancel_procedure_process.php">
        <label for="procedureID">Procedure ID:</label>
        <input type="text" name="procedureID" required>
        <br>
        <input type="submit" value="Cancel Procedure">
    </form>
</body>
</html>

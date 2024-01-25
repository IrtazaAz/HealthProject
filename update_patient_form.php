<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Information</title>
    <!-- Include your styles or scripts here -->
</head>
<body>

<!-- HTML Form -->
<form method="post" action="update_patient_records.php">
    <label for="Shots">Shots:</label>
    <input type="text" name="Shots" id="Shots">
    <br>

    <label for="Illnesses">Illnesses:</label>
    <input type="text" name="Illnesses" id="Illnesses">
    <br>

    <label for="PatientID">Patient ID:</label>
    <input type="text" name="PatientID" id="PatientID">
    <br>

    <input type="hidden" name="transaction_type" value="Update Patient Record">
    <input type="submit" value="Update Patient Record">
</form>

<!-- JavaScript Code -->
<script>
    document.querySelector('form').addEventListener('submit', function (event) {
        var confirmation = confirm('Are you sure you want to update the patient\'s records?');
        if (!confirmation) {
            // User declined, prevent the form submission
            event.preventDefault();
            alert('Update canceled.');
        } else {
            // User confirmed, form submission will proceed
            // You can add further validation for Shots and Illnesses here
            // ...
        }
    });
</script>

<!-- You can include additional content or scripts here -->

</body>
</html>

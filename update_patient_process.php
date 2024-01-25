<!-- update_patient_process.php -->
<?php
$servername = "sql1.njit.edu";
$username = "ia46";
$password = "Secret4892!";
$dbname = "ia46";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST['patientID'];
    $updateType = $_POST['updateType'];

    // Check if the patient exists
    $checkPatientQuery = "SELECT * FROM PatientsData WHERE PatientID = '$patientID'";
    $checkPatientResult = mysqli_query($con, $checkPatientQuery);

    if ($checkPatientResult && mysqli_num_rows($checkPatientResult) > 0) {
        // Patient exists, ask for confirmation
        echo '<script>';
        echo 'if (confirm("Are you sure you wish to update the patient\'s records?")) {';
        echo '  var confirmed = true;';
        echo '} else {';
        echo '  var confirmed = false;';
        echo '}';
        echo '</script>';

        // Check if the user confirmed the action
        echo '<script>';
        echo 'if (confirmed) {';

        // Specific updates based on the user's choice
        if ($updateType == 'shots' || $updateType == 'both') {
            // Add your code to update shots in the PatientsData table
            $updateShotsQuery = "UPDATE PatientsData SET ShotsGiven = 'Updated Shots' WHERE PatientID = '$patientID'";
            mysqli_query($con, $updateShotsQuery);
        }

        if ($updateType == 'illness' || $updateType == 'both') {
            // Add your code to update illness in the PatientsData table
            $updateIllnessQuery = "UPDATE PatientsData SET Illnesses = 'Updated Illness' WHERE PatientID = '$patientID'";
            mysqli_query($con, $updateIllnessQuery);
        }

        echo '    alert("Update done. Updated: ' . $updateType . '");';
        echo '} else {';
        echo '    alert("Update canceled.");';
        echo '}';
        echo '</script>';
    } else {
        // Patient does not exist
        echo '<script>alert("Patient does not exist. Please check the patient ID.");</script>';
    }
}

// Redirect back to the update form
echo '<script>window.location.href = "update_patient.php";</script>';
?>

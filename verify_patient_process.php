<?php
session_start(); // Start the session

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
    $updateShots = isset($_POST['shots']) ? $_POST['shots'] : null;
    $updateIllnesses = isset($_POST['illnesses']) ? $_POST['illnesses'] : null;

    // Check if the patient exists
    $checkPatientQuery = "SELECT * FROM PatientsData WHERE PatientID = '$patientID'";
    $checkPatientResult = mysqli_query($con, $checkPatientQuery);

    if ($checkPatientResult && mysqli_num_rows($checkPatientResult) > 0) {
        // Patient exists, perform updates based on user's choice
        $updateMessage = "Update done. Updated fields:";

        if (!is_null($updateShots)) {
            $updateShotsQuery = "UPDATE PatientsData SET ShotsGiven = '$updateShots' WHERE PatientID = '$patientID'";
            $resultShots = mysqli_query($con, $updateShotsQuery);
            
            if (!$resultShots) {
                die('Error updating ShotsGiven: ' . mysqli_error($con));
            }

            $updateMessage .= " ShotsGiven: '$updateShots'";
        }

        if (!is_null($updateIllnesses)) {
            $updateIllnessesQuery = "UPDATE PatientsData SET Illnesses = '$updateIllnesses' WHERE PatientID = '$patientID'";
            $resultIllnesses = mysqli_query($con, $updateIllnessesQuery);
            
            if (!$resultIllnesses) {
                die('Error updating Illnesses: ' . mysqli_error($con));
            }

            $updateMessage .= " Illnesses: '$updateIllnesses'";
        }

        $_SESSION['verification_message'] = $updateMessage;
    } else {
        // Patient does not exist
        $_SESSION['verification_message'] = "Patient does not exist. Please check the patient ID.";
    }
}

// Redirect back to the update form
header('Location: update_patient.php');
exit();
?>

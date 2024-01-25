<!-- register_process.php -->
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
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // Check if the patient already exists
    $checkPatientQuery = "SELECT * FROM PatientsData WHERE PatientID = '$patientID'";
    $checkPatientResult = mysqli_query($con, $checkPatientQuery);

    if ($checkPatientResult && mysqli_num_rows($checkPatientResult) > 0) {
        // Patient already exists
        echo '<script>alert("Patient already exists in the system.");</script>';
    } else {
        // Patient does not exist, insert a new record
        $insertPatientQuery = "INSERT INTO PatientsData (PatientID, FirstName, LastName) VALUES ('$patientID', '$firstName', '$lastName')";
        $insertPatientResult = mysqli_query($con, $insertPatientQuery);

        if ($insertPatientResult) {
            // Patient inserted successfully
            echo '<script>alert("Patient record inserted successfully.");</script>';
        } else {
            // Error in inserting patient record
            echo '<script>alert("Error inserting patient record. ' . mysqli_error($con) . '");</script>';
        }
    }
}

// Redirect back to the registration form
echo '<script>window.location.href = "register.php";</script>';
?>

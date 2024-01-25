<?php
$servername = "sql1.njit.edu";
$username = "ia46";
$password = "Secret4892!";
$dbname = "ia46";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'patientID' is set in the session
    if (!isset($_SESSION['patientID']) || empty($_SESSION['patientID'])) {
        echo '<script>alert("Error: Patient ID not set. Please log in again.");</script>';
    } else {
        $patientID = $_SESSION['patientID'];
        $appointmentDate = $_POST['appointmentDate'];
        $appointmentType = $_POST['appointmentType'];
        $doctorID = $_POST['doctorID'];

        // Check if the doctor ID is valid
        $checkDoctorQuery = "SELECT * FROM Receptionists WHERE ReceptionistID = '$doctorID'";
        $checkDoctorResult = mysqli_query($con, $checkDoctorQuery);

        if (!$checkDoctorResult || mysqli_num_rows($checkDoctorResult) == 0) {
            // Invalid doctor ID
            echo '<script>alert("Invalid Doctor ID. Please enter a valid Doctor ID.");</script>';
        } else {
            // Valid doctor ID, proceed with the appointment
            $appointmentID = rand(1, 999); // Generates a random 3-digit number

            // Use prepared statements to avoid SQL injection
            $insertQuery = "INSERT INTO AppointmentsTable (PatientID, AppointmentID, AppointmentDate, AppointmentType, DoctorID) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $insertQuery);

            // Check for errors in preparing the statement
            if ($stmt === false) {
                die('Error in preparing the statement: ' . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, 'sssss', $patientID, $appointmentID, $appointmentDate, $appointmentType, $doctorID);

            // Check for errors in binding parameters
            if (mysqli_stmt_execute($stmt)) {
                // Appointment successful
                echo '<script>alert("Appointment confirmed! Your Appointment ID is: ' . $appointmentID . '");</script>';
            } else {
                // Error in inserting appointment
                echo '<script>alert("Error making appointment. Please try again.");</script>';
                // Add this line to see the specific error from MySQL
                echo 'MySQL Error: ' . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        }
    }
}
?>

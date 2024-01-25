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
    $patientID = $_SESSION['patientID']; // Assuming you set the patientID during the patient verification process
    $appointmentID = $_POST['appointmentID'];

    // Check if the appointment exists for the given patient
    $checkAppointmentQuery = "SELECT * FROM AppointmentsTable WHERE PatientID = '$patientID' AND AppointmentID = '$appointmentID'";
    $checkAppointmentResult = mysqli_query($con, $checkAppointmentQuery);

    if ($checkAppointmentResult && mysqli_num_rows($checkAppointmentResult) > 0) {
        // Appointment exists, proceed with cancellation logic
        $cancelQuery = "DELETE FROM AppointmentsTable WHERE PatientID = '$patientID' AND AppointmentID = '$appointmentID'";
        $cancelResult = mysqli_query($con, $cancelQuery);

        if ($cancelResult) {
            // Cancellation successful
            echo '<script>alert("Appointment canceled successfully.");</script>';
        } else {
            // Error in canceling appointment
            echo '<script>alert("Error canceling appointment. Please try again.");</script>';
        }
    } else {
        // Appointment does not exist
        echo '<script>alert("Appointment does not exist. Please check your information and try again.");</script>';
    }
}

// Redirect back to the cancel appointment page
echo '<script>window.location.href = "cancel_appointment.php";</script>';
?>

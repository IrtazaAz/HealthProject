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
    $enteredAppointmentID = $_POST['appointmentID']; // Appointment ID entered by the user
    $procedureType = $_POST['procedureType'];

    // Check if the entered appointment ID exists
    $checkAppointmentQuery = "SELECT * FROM AppointmentsTable WHERE AppointmentID = '$enteredAppointmentID'";
    $checkAppointmentResult = mysqli_query($con, $checkAppointmentQuery);

    if ($checkAppointmentResult && mysqli_num_rows($checkAppointmentResult) > 0) {
        // Appointment ID exists, proceed with scheduling a procedure
        $appointmentRow = mysqli_fetch_assoc($checkAppointmentResult);
        $patientID = $appointmentRow['PatientID'];
        $procedureID = rand(1, 999); // Generate a random 3-digit number
        $procedureDate = date('Y-m-d'); // Current date, adjust format if needed

        // Insert the procedure into the ProcedureAppointments table
        $insertProcedureQuery = "INSERT INTO ProcedureAppointments (ProcedureID, PatientID, AppointmentID, ProcedureDate, ProcedureType) VALUES ('$procedureID', '$patientID', '$enteredAppointmentID', '$procedureDate', '$procedureType')";
        $insertProcedureResult = mysqli_query($con, $insertProcedureQuery);

        if ($insertProcedureResult) {
            // Procedure scheduled successfully
            echo '<script>alert("Procedure scheduled successfully. Your Procedure ID is: ' . $procedureID . '");</script>';
        } else {
            // Error in scheduling procedure
            echo '<script>alert("Error scheduling procedure. ' . mysqli_error($con) . '");</script>';
        }
    } else {
        // Appointment ID does not exist
        echo '<script>alert("The entered Appointment ID does not match any existing appointments.");</script>';
    }
}

// Redirect back to the schedule procedure page
echo '<script>window.location.href = "schedule_procedure.php";</script>';
?>

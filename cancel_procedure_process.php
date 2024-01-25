<!-- cancel_procedure_process.php -->
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
    $procedureID = $_POST['procedureID'];

    // Check if the procedure is scheduled
    $checkProcedureQuery = "SELECT * FROM ProcedureAppointments WHERE ProcedureID = '$procedureID'";
    $checkProcedureResult = mysqli_query($con, $checkProcedureQuery);

    if ($checkProcedureResult && mysqli_num_rows($checkProcedureResult) > 0) {
        // Procedure is scheduled, ask for confirmation
        echo '<script>';
        echo 'if (confirm("Are you sure you want to cancel this procedure?")) {';
        echo '  var confirmed = true;';
        echo '} else {';
        echo '  var confirmed = false;';
        echo '}';
        echo '</script>';

        // Check if the user confirmed the action
        echo '<script>';
        echo 'if (confirmed) {';
        // Delete the procedure
        $deleteProcedureQuery = "DELETE FROM ProcedureAppointments WHERE ProcedureID = '$procedureID'";
        $deleteProcedureResult = mysqli_query($con, $deleteProcedureQuery);

        if ($deleteProcedureResult) {
            // Procedure deleted successfully
            echo '  alert("Procedure canceled successfully.");';
        } else {
            // Error in canceling procedure
            echo '  alert("Error canceling procedure. ' . mysqli_error($con) . '");';
        }

        // Redirect to the login page (adjust the URL as needed)
        echo '  window.location.href = "Project40.php";';
        echo '} else {';
        echo '  alert("Procedure cancellation canceled.");';
        echo '}';
        echo '</script>';
    } else {
        // Procedure does not exist
        echo '<script>alert("Procedure does not exist. Please check the information and re-enter valid data.");</script>';
        echo '<script>window.location.href = "cancel_procedure.php";</script>';
        exit();
    }
}

// Redirect back to the cancel procedure page (adjust the URL as needed)
echo '<script>window.location.href = "cancel_procedure.php";</script>';
?>

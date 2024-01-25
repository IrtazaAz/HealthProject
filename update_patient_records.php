<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$servername = "sql1.njit.edu";
$username = "ia46";
$password = "Secret4892!";
$dbname = "ia46";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

session_start();
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transactionType = $_POST['transaction_type'];

    if ($transactionType == 'Update Patient Record') {
        // Retrieve update data
        $ShotsGiven = mysqli_real_escape_string($con, $_POST['Shots']);
        $Illnesses = mysqli_real_escape_string($con, $_POST['Illnesses']);
        $PatientID = mysqli_real_escape_string($con, $_POST['PatientID']);

        // Check if the patient exists
        $checkQuery = "SELECT * FROM PatientsData WHERE PatientID = '$PatientID'";
        $checkResult = mysqli_query($con, $checkQuery);

        
?>

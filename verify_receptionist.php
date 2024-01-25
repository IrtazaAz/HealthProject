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

include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $verificationData = json_decode(file_get_contents("php://input"), true);

    $FirstName = mysqli_real_escape_string($con, $verificationData['firstName']);
    $LastName = mysqli_real_escape_string($con, $verificationData['lastName']);
    $EmailAddress = mysqli_real_escape_string($con, $verificationData['email']);
    $Password = mysqli_real_escape_string($con, $verificationData['password']);
    $IDNumber = mysqli_real_escape_string($con, $verificationData['receptionistId']);

    $query = "SELECT * FROM Receptionists WHERE FirstName = '$FirstName' AND LastName = '$LastName' AND EmailAddress = '$EmailAddress' AND Password = '$Password' AND IDNumber = '$IDNumber'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "success"; 
    } else {
        echo "failure"; 
    }
}
?>

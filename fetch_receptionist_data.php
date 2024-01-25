<?php
session_start();

$servername = "sql1.njit.edu";
$username = "ia46";
$password = "Secret4892!";
$dbname = "ia46";
$con = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist and Patient Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $transactionType = isset($_POST['transaction_type']) ? $_POST['transaction_type'] : '';

    if ($transactionType == 'Search A Receptionists Account') {
        $FirstName = mysqli_real_escape_string($con, $_POST['FirstName']);
        $LastName = mysqli_real_escape_string($con, $_POST['LastName']);
        $EmailAddress = mysqli_real_escape_string($con, $_POST['EmailAddress']);
        $Password = mysqli_real_escape_string($con, $_POST['Password']);
        $IDNumber = mysqli_real_escape_string($con, $_POST['IDNumber']);

        $query = "SELECT 
        Receptionists.FirstName AS ReceptionistFirstName, 
        Receptionists.LastName AS ReceptionistLastName, 
        Receptionists.ReceptionistID AS ReceptionistID, 
        Receptionists.PhoneNumber AS ReceptionistPhoneNumber, 
        Receptionists.EmailAddress AS ReceptionistEmail,
        PatientsData.FirstName AS PatientFirstName,
        PatientsData.LastName AS PatientLastName,
        PatientsData.PatientID AS PatientID,
        PatientsData.DateOfBirth AS PatientDateOfBirth,
        PatientsData.Age AS PatientAge,
        PatientsData.PhoneNumber AS PatientPhoneNumber,
        PatientsData.Address AS PatientAddress,
        PatientsData.ShotsGiven AS PatientShotsGiven,
        PatientsData.Illnesses AS PatientIllnesses,
        PatientsData.AppointmentDate AS PatientAppointmentDate,
        PatientsData.AppointmentType AS PatientAppointmentType,
        PatientsData.ProcedureDate AS PatientProcedureDate,
        PatientsData.ProcedureType AS PatientProcedureType,
        PatientsData.DoctorName AS PatientDoctorName
    FROM Receptionists
    LEFT JOIN PatientsData ON Receptionists.ReceptionistID = PatientsData.ReceptionistID;
    ";

        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Receptionist's Name</th>
                        <th>Receptionist's ID</th>
                        <th>Receptionist's Phone Number</th>
                        <th>Receptionist's Email</th>
                        <th>Patient's Name</th>
                        <th>Patient's ID</th>
                        <th>Patient's Date of Birth</th>
                        <th>Patient's Age</th>
                        <th>Patient's Phone Number</th>
                        <th>Patient's Address</th>
                        <th>Patient's Immunization/Shot Record</th>
                        <th>Patient's Illness Record</th>
                        <th>Patient's Appointment Date(s)</th>
                        <th>Patient's Appointment Type(s)</th>
                        <th>Patient's Procedure Date(s)</th>
                        <th>Patient's Procedure Type(s)</th>
                        <th>Patient's Doctor's Name</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['ReceptionistFirstName']} {$row['ReceptionistLastName']}</td>
                        <td>{$row['ReceptionistID']}</td>
                        <td>{$row['ReceptionistPhoneNumber']}</td>
                        <td>{$row['ReceptionistEmail']}</td>
                        <td>{$row['PatientFirstName']} {$row['PatientLastName']}</td>
                        <td>{$row['PatientID']}</td>
                        <td>{$row['PatientDateOfBirth']}</td>
                        <td>{$row['PatientAge']}</td>
                        <td>{$row['PatientPhoneNumber']}</td>
                        <td>{$row['PatientAddress']}</td>
                        <td>{$row['PatientShotsGiven']}</td>
                        <td>{$row['PatientIllnesses']}</td>
                        <td>{$row['PatientAppointmentDate']}</td>
                        <td>{$row['PatientAppointmentType']}</td>
                        <td>{$row['PatientProcedureDate']}</td>
                        <td>{$row['PatientProcedureType']}</td>
                        <td>{$row['PatientDoctorName']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No records found.";
        }
    }
}

?>


</body>
</html>

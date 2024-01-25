<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>House of Health Receptionist Login</title>
    <style>
        body {
            background-image: url('https://dk4fkkwa4o9l0.cloudfront.net/production/uploads/article/image/2202/front-view-woman-holding-heart-shape_11zon.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            background-color: rgb(255, 255, 255);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }

        input[type="checkbox"],
        input[type="radio"] {
            margin-right: 380px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
        }
        #emailRequiredText {
            display: inline-block;
            float: left;
            margin-left: 12px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>House of Health Receptionist Login</h2>
        <form id="loginForm" action="#" method="POST" onsubmit="validate(); verify(event); updateFormAction();">
            <div class="form-group">
                <input type="text" id="first_name" name="first_name" placeholder="First Name (Required)">
                <input type="text" id="last_name" name="last_name" placeholder="Last Name (Required)">
            </div>
            <div class="form-group">
                <input type="tel" id="phone" name="phone" placeholder="Phone Number (Required)">
                <input type="email" id="email" name="email" placeholder="Email Address">
                <span id="emailRequiredText" style="color: red;"></span>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password (Required)">
                <input type="number" id="receptionist_id" name="receptionist_id" placeholder="Receptionist ID (Required)">
            </div>
            <div class="form-group">
                <label for="email_confirmation">Check Box for Email Confirmation:</label>
                <input type="checkbox" id="email_confirmation" name="email_confirmation" onclick="toggleEmailRequired()">
            </div>
            <div class="form-group">
                <label for="transaction_type">Transaction Type:</label>
                <select id="transaction_type" name="transaction_type">
                    <option value="Search A Receptionists Account">Search A Receptionists Account</option>
                    <option value="Update a Patients Record ">Update a Patients Record</option>
                    <option value="Schedule An Appointment">Schedule An Appointment</option>
                    <option value="Cancel an Appointment ">Cancel an Appointment</option>
                    <option value="Schedule A Procedure ">Schedule A Procedure </option>
                    <option value="Cancel a Procedure ">Cancel a Procedure </option>
                    <option value="Create A New Patient Account">Create A New Patient Account</option>
                </select>
            </div>
            <input type="hidden" id="verificationResult" name="verificationResult">
            <div class="form-group">
                <input type="submit" value="Login">
                <input type="reset" value="Reset">
            </div>
        </form>
        <div id="resultTableContainer" style="display:none;">
            <!-- The table will be appended here -->
        </div>
    </div>

    <script>
        function toggleEmailRequired() {
            const emailInput = document.getElementById('email');
            const emailRequiredText = document.getElementById('emailRequiredText');
            if (document.getElementById('email_confirmation').checked) {
                emailInput.required = true;
                emailRequiredText.textContent = 'Required';
            } else {
                emailInput.required = false;
                emailRequiredText.textContent = '';
            }
        }
function validate() {
            const firstName = document.getElementById('first_name').value;
            const lastName = document.getElementById('last_name').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const receptionistId = document.getElementById('receptionist_id').value;

            
            const nameRegex = /^[A-Za-z]+$/;
            const phoneRegex = /^\d{10}$/;
            const emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{3,5}$/;
            const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*\d).{8,16}$/;
            const receptionistIdRegex = /^\d{4}$/;

            if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
                alert("First Name and Last Name must contain only letters.");
                document.getElementById('first_name').focus();
                return false;
            }

            if (!phoneRegex.test(phone)) {
                alert("Phone Number must be 10 digits.");
                document.getElementById('phone').focus();
                return false;
            }

            if (email && !emailRegex.test(email)) {
                alert("Invalid Email Address.");
                document.getElementById('email').focus();
                return false;
            }

            if (!passwordRegex.test(password)) {
                alert("Password must contain at least 1 uppercase letter, 1 special character, and 1 digit (8-16 characters).");
                document.getElementById('password').focus();
                return false;
            }

            if (!receptionistIdRegex.test(receptionistId)) {
                alert("Receptionist ID must be a 4-digit number.");
                document.getElementById('receptionist_id').focus();
                return false;
            }

            return true; 
        }
        function verify(e) {
    e.preventDefault(); // Prevent the default form submission

    const firstName = document.getElementById('first_name').value;
    const lastName = document.getElementById('last_name').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const receptionistId = document.getElementById('receptionist_id').value;
    const transactionType = document.getElementById('transaction_type').value;

    const verificationData = {
        firstName: firstName,
        lastName: lastName,
        email: email,
        password: password,
        receptionistId: receptionistId
    };

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const result = xhr.responseText;

                // Assuming you have an element with the id 'verificationResult'
                document.getElementById('verificationResult').value = result;

                if (result === 'success') {
                    // Verification successful, update the form action and submit the form
                    updateFormAction();
                    document.getElementById('loginForm').submit();
                } else {
                    alert(`Receptionist ${firstName} ${lastName} cannot be found. Please check your credentials.`);
                }
            } else {
                alert('Error during verification');
            }
        }
    };

    xhr.open('POST', 'verify_receptionist.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(verificationData));
}



function updateFormAction() {
    var selectedOption = $('#transaction_type').val();
    var form = $('#loginForm');

    // Define redirection URLs based on selected option
    switch (selectedOption) {
        case 'Search A Receptionists Account':
            form.attr('action', 'fetch_receptionist_data.php');
            break;
        case 'Update a Patients Record ':
            form.attr('action', 'update_patient.php');
            break;
        case 'Schedule An Appointment':
            form.attr('action', 'verify_patient.php');
            break;
        case 'Cancel an Appointment ':
            form.attr('action', 'cancel_appointment.php');
            break;
        case 'Schedule A Procedure ':
            form.attr('action', 'schedule_procedure.php');
            break;
        case 'Cancel a Procedure ':
            form.attr('action', 'cancel_procedure.php');
            break;
        case 'Create A New Patient Account':
            form.attr('action', 'register.php');
            break;

        default:
            // Set a default action if needed
            form.attr('action', '#');
    }

    // The form will now submit with the updated action
    return true;
}
    </script>
</body>
</html>
<?php

?>


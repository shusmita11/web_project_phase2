<?php
session_start();
if (!isset($_COOKIE['status'])) {
    header('location: login.html');
}
require_once('../model/appointmentHistoryModel.php');
$currentDate = date('Y-m-d');
$appointments = fetchExpiredAppointments($currentDate);
$userType = $_SESSION['type']; // we will pass this to JS
?>

<html>
<head>
    <title>View Appointments</title>
</head>
<body>
    <script>
        function goBack(userType)
        {
            if (userType === 'patient') {
                window.location.href = '../view/patientDashboard.php';
            } else if (userType === 'doctor') {
                window.location.href = '../view/doctorDashboard.php';
            } else if (userType === 'admin') {
                window.location.href = '../view/adminDashboard.php';
            }
        }

        function showNoAppointmentsMessage()
        {
            document.getElementById("appointmentsTable").style.display = "none";
            document.getElementById("noAppointmentsMessage").style.display = "block";
        }

        window.onload = function()
        {
            var appointmentsExist = <?= !empty($appointments) ? 'true' : 'false'; ?>;
            if (!appointmentsExist) {
                showNoAppointmentsMessage();
            }
        };
    </script>

    <form method="post" action="../controller/appointmentHistoryCheck.php">
        <h1>Appointment History</h1>

        <table id="appointmentsTable" border="1" cellspacing="0">
            <tr>
                <th>Appointment ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Doctor ID</th>
                <th>Doctor Name</th>
                <th>Appointment Time</th>
                <th>Appointment Date</th>
                <th>Problem</th>
                <th>Token</th>
            </tr>
            <?php if (!empty($appointments)): ?>
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= $appointment['appointment_id']; ?></td>
                        <td><?= $appointment['name']; ?></td>
                        <td><?= $appointment['email']; ?></td>
                        <td><?= $appointment['doctor_id']; ?></td>
                        <td><?= $appointment['doctor_name']; ?></td>
                        <td><?= $appointment['appointment_time']; ?></td>
                        <td><?= $appointment['appointment_date']; ?></td>
                        <td><?= $appointment['problem']; ?></td>
                        <td><?= $appointment['token']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

        <div id="noAppointmentsMessage" style="display:none; text-align:center;">
            No available appointments found.
        </div>

        <input type="button" name="back" value="Go Back" onclick="goBack('<?= $userType; ?>')">
        <a href="../controller/logout.php">Log Out</a>
        
    </form>

    <script src="../asset/JS/AppointmentHistoryCheck.js"></script>
</body>
</html>

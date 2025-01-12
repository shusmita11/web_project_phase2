<?php
    session_start();
    if(!isset($_COOKIE['status'])){
        header('location: login.html'); 
    }
?>

<html>
    <head></head>

    <body>
        <h1>PATIENT DASHBOARD</h1>
        <a href = "appointmentBooking.php">Book Appointment</a><br>
        <a href = "appointmentHistory.php">View Appointment History</a><br>
        <a href = "searchDoctor.php">view Doctors</a><br>
        <a href = "../controller/logout.php">Log Out </a>
    </body>
    
</html>
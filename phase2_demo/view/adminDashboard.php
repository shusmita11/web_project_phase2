<?php
    session_start();
    if(!isset($_COOKIE['status']))
    {
        header('location: login.html'); 
    }
?>

<html>
    <head></head>

    <body>
        <h1>ADMIN DASHBOARD</h1>
        <a href="appointmentHistory.php">view appointment history</a><br>
        <a href = "../controller/logout.php">Log Out </a>
    </body>

</html>
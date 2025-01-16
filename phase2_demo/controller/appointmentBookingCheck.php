<?php
session_start();
require_once('../model/appointmentBookingModel.php');

$input = json_decode(file_get_contents('php://input'), true);

if($input)
{
    $name = $input['name'];
    $email = $input['email'];
    $problem = $input['problem'];
    $doctorID = $input['doctorID'];
    $date = $input['date'];
    
    $tokenCount = checkAppointmentSlot($doctorID, $date);

    if ($tokenCount >= 3)
    {
        echo "Sorry, the slot is full";
    }

    else
    {
        $result = bookAppointment($name, $email, $doctorID, $date,  $problem, $tokenCount + 1);
        if($result)
        {
            echo 'success';
        }

        else
        {
            echo "Error booking the appointment Or you have already requested for an appointment.";
        }
    }
}
?>
<?php
session_start();
header('Content-type: application/json');

$valid = true;

$pwd = $_SESSION['pwd'];
if (isset($_POST['oldPwd']) && $pwd!=$_POST['oldPwd']) {
    $valid = false;
} 
echo json_encode(array(
    'valid' => $valid,
));

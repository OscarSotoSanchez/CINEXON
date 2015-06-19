<?php

    include_once '../../db/FunctionsDB.php';
    include_once '../../core/class/Mail.php';

if (!empty($_REQUEST['email'])) {
    $email = $_REQUEST['email'];
    
    $functionDB = new FunctionsDB();
    $mail = new Mail();
    
    $pass = substr(md5(microtime()), 1, 8);
    $pass_sha1 = sha1($pass);
    
    $functionDB->changePassWord($email, $pass_sha1);
    $mail->resetPassword($pass, $email);
} else {
    echo "NOT PARAMETERS";
}


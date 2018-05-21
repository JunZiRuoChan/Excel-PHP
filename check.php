<?php
if($_POST){
    $verifyId = $_POST['verifyId'];
    if($verifyId){
        session_start();
        if($verifyId!=$_SESSION['verify_code']){
            echo 0;
        }
    }
}
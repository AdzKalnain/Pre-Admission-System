<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: ../index.php");
        exit(); 
    }

    function message($msg="", $msgtype="") {
        global $message;
        if(!empty($msg)) {
          $_SESSION['message'] = $msg;
          $_SESSION['msgtype'] = $msgtype;
        } else {
            return $message;
        }
    }
    function check_message(){
        if(isset($_SESSION['message'])){
            if(isset($_SESSION['msgtype'])){
                if ($_SESSION['msgtype']=="error"){
                    echo "<script>window.onload = function(){document.getElementById('error_alert').click();}</script>";
                    
                }elseif($_SESSION['msgtype']=="success"){
                    echo "<script>window.onload = function(){document.getElementById('success_alert').click();}</script>";
                
                }elseif($_SESSION['msgtype']=="file_info"){
                    echo "<script>window.onload = function(){document.getElementById('file_info_alert').click();}</script>";
                } 
                unset($_SESSION['message']);
                unset($_SESSION['msgtype']);
            }
        
        }
    }
?>
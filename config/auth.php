<?php
error_reporting(0);

function login($status, $id){
    $_SESSION['login'] = $status;
    $_SESSION['id'] = $id;
}

function logout(){
    unset($_SESSION['login']);
}
?>
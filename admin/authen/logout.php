<?php 
    session_start();
    require_once ('../../database/dbhelper.php');
    require_once ('../../utility/utility.php');

    $user = getUserToken();
    if ($user != null) {
        $token = getCookie('token');
        $id = $user['id'];
        $sql = "DELETE FROM tokens WHERE users_id = '$id' AND tokens = '$token'";
        var_dump($sql);
        execute($sql);
        SETCOOKIE('token', '', time() - 100, '/');
    }  
    header('location: login.php');
    session_destroy();
?>
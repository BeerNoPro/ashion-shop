
<?php

    $email = $password = $error = '';

    if (isset($_POST['submit'])) {
        $email = getPost('email');
        $password = getPost('password');
        $password = getSecurityMd5($password);

        $sqlSelect = "SELECT * FROM users WHERE email = '$email' AND passwords = '$password'";
        $userExist = executeResult($sqlSelect, true);

        if ($userExist !== null) {
            if ($userExist['fullname'] == "admin") {
                header('Location: ../');
                die();
            } else {
                // get token
                $token = getSecurityMd5($userExist['email'].time());
                setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/');
                $created_at = date('Y-m-d H:i:s');
    
                $_SESSION['user'] = $userExist;
    
                // save info tokens
                $userId = $userExist['id'];
                $sql = "INSERT INTO tokens (tokens, created_at, users_id) VALUES ('$token', '$created_at', '$userId')";
                execute($sql);
    
                header('Location: ../../');
            }
        } else {
            $error = "Bạn nhập thông tin sai sồi!";
        }
        
    }

?>
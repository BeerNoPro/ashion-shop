
<?php 

    $fullName = $email = $errorEmail = '';

    if (isset($_POST['submit'])) {

        $fullName = getPost('fullname');
        $email = getPost('email');
        $password = getPost('password');
        $passConfirm = getPost('password_confirmation');

        // validate 
        if (empty($fullName) || empty($email) || empty($password) || strlen($password) < 6) {
            $error = 'Please enter info';
        } else {
            // validate success
            $sqlSelect = "SELECT * FROM users WHERE email = '$email'";
            $userExist = executeResult($sqlSelect, true);

            if ($userExist !== null) {
                $errorEmail = 'Email đã tồn tại';
                
            } else {
                // init time
                $created_at =  date("Y-m-d H:i:s");

                // encode password
                $password = getSecurityMd5($password);

                // save info user
                $sql = "INSERT INTO users(fullname, email, passwords, created_at, updated_at, deleted, role_id) VALUES('$fullName', '$email', '$password', '$created_at', '0', '0', '2')";
                execute($sql);

                // get token
                $sqlSelect = "SELECT * FROM users WHERE email = '$email'";
                $userExist = executeResult($sqlSelect, true);
                $token = getSecurityMd5($userExist['email'].time());
                setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/');
                $created_at = date('Y-m-d H:i:s');
                $_SESSION['user'] = $userExist;

                // save info tokens
                $userId = $userExist['id'];
                $sql = "INSERT INTO tokens (tokens, created_at, users_id) VALUES ('$token', '$created_at', '$userId')";
                execute($sql);

                // navigation home page
                header('Location: ../../');
                die();
            }
        }
    }

?>
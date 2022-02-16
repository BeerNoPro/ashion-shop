

<?php
    session_start();
    require_once ('../../database/dbhelper.php');
    require_once ('../../utility/utility.php');
    require_once ('./data_form_login.php');

    // get user tokens
    $user = getUserToken();
    if ($user != null) {
        header('location: ../../');
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" 
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/form_register.css">
    </head>
    <body>
        <div class="main">
            <form action="" method="post" class="form" id="form-1">
                <h3 class="heading">Đăng nhập</h3>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" name="email" type="text" 
                        placeholder="VD: email@domain.com" required="true"
                        value="<?php if (isset($email)) echo $email;?>">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input id="password" class="form-control" name="password" 
                        type="password" placeholder="Nhập mật khẩu" required="true">
                    <span class="form-message"></span>
                    <?php 
                        if (isset($error)) echo "<span class='invalid font-14 error'>$error</span>";
                    ?>
                </div>
                <div class="form-group">
                    <a href="./register.php" class="font-14">Đăng ký tài khoản</a>
                </div>
                <div class="form-group">
                    <a href="./forgotpass.php" class="font-14">Quên mật khẩu ?</a>
                </div>
                <div class="form-group mt-5 mb-0">
                    <button class="btn btn-success btn-register" id="btn-register" name="submit">
                        Đăng nhập
                    </button>
                </div>
            </form>
        </div>
        <script>
            $(document).ready(function () {
                const error = $('.invalid');
                if (error[0].innerText != '') {
                    $('input').css('border', '1px solid red');
                } 
                $('input').on('input', function () {
                    $('input').css('border', '1px solid #ccc');
                    $('.error').css('display', 'none');
                })
            });
        </script>
    </body>
</html>
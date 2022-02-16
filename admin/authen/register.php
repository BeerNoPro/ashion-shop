
<?php
    session_start();
    require_once ('../../database/dbhelper.php');
    require_once ('../../utility/utility.php');
    require_once ('./data_form_register.php');

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
        <title>Register page</title>
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
                <h3 class="heading">Thành viên đăng ký</h3>
                <div class="form-group">
                    <label for="fullname" class="form-label">Tên đầy đủ</label>
                    <input id="fullname" class="form-control" name="fullname" type="text" 
                        placeholder="VD: Pham Viet Hung" required="true"
                        value="<?php if (isset($fullName)) echo $fullName; ?>">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" name="email" type="text" 
                        placeholder="VD: email@domain.com" required="true"
                        value="<?php if (isset($email)) echo $email; ?>">
                    <?php 
                        if (isset($errorEmail)) echo "<span class='form-message invalid'>$errorEmail</span>";
                    ?>
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input id="password" class="form-control" name="password" type="password" 
                        placeholder="Nhập mật khẩu" required="true" minlength="6"
                        value="<?php if (isset($password)) echo $password; ?>">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                    <input id="password_confirmation" class="form-control" name="password_confirmation"
                        placeholder="Nhập lại mật khẩu" type="password" required="true" minlength="6"
                        value="<?php if (isset($passConfirm)) echo $passConfirm; ?>">
                    <span class="form-message"></span>
                </div>
                <div class="form-group mt-5 mb-0">
                    <button class="btn btn-success btn-register" id="btn-register" name="submit">
                        Đăng ký
                    </button>
                </div>
            </form>
        </div>
        <script>
            $(document).ready(function () {
                const getInvalid = $('.invalid');
                const getFormGroup = $(getInvalid).closest('.form-group');

                // check error email add border red
                if (getInvalid[0].innerText != '') {
                    $(getFormGroup).addClass('invalid');
                }

                // on input remove class error
                $('#email').on('input', function() {
                    $(getFormGroup).removeClass('invalid');
                    $(getInvalid).css('display', 'none');
                })
            })
        </script>
        <script src="../assets/js/form-register.js"></script>
    </body>
</html>
<?php

    $title = 'Add user';
    $baseUrl = '../';
    require_once('../layout/header.php');

    if (isset($_POST['submit'])) {
        $fullName = getPost('fullname');
        $email = getPost('email');
        $password = getPost('password');

        $sqlSelect = "SELECT * FROM users WHERE email = '$email'";
        $userExist = executeResult($sqlSelect, true);

        if ($userExist != null) {
            $errorEmail = 'Email đã tồn tại';
        } else {
            // init time
            $created_at = date("Y-m-d H:i:s");

            // encode password
            $password = getSecurityMd5($password);

            // save info user
            $sql = "INSERT INTO users(fullname, email, passwords, created_at, updated_at, deleted, role_id) VALUES('$fullName', '$email', '$password', '$created_at', '0', '0', '2')";
            $success = mysqli_query($conn, $sql);

            if ($success) { ?>
                <script> location.replace("index.php"); </script>
            <?php } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
?>

<div class="row">
    <div class="col-md-12">
        <div class="header d-flex mt-3 align-items-center">
            <h1 class="">Thêm người dùng</h1>
            <a href="index.php" class="btn btn-primary">Quay lại</a>
        </div>
        <div class="main">
            <form action="" method="post" class="form" id="form-1" >
                <div class="form-group">
                    <label for="fullname" class="form-label">Tên đầy đủ :</label>
                    <input id="fullname" class="form-control" name="fullname" type="text" 
                        placeholder="VD: Pham Viet Hung" required="true"
                        value="<?php if (isset($fullName)) echo $fullName; ?>">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email :</label>
                    <input id="email" class="form-control" name="email" type="text" 
                        placeholder="VD: email@domain.com" required="true"
                        value="<?php if (isset($email)) echo $email; ?>">
                    <?php 
                        if (isset($errorEmail)) echo "<span class='form-message invalid'>$errorEmail</span>";
                    ?>
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu :</label>
                    <input id="password" class="form-control" name="password" type="password" 
                        placeholder="Nhập mật khẩu" required="true" minlength="6" value="">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu :</label>
                    <input id="password_confirmation" class="form-control" name="password_confirmation"
                        placeholder="Nhập lại mật khẩu" type="password" required="true" minlength="6"
                        value="">
                    <span class="form-message"></span>
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-success btn-register w-25 " id="btn-register" name="submit">
                        Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    require_once('../layout/footer.php');
?>

<script src="../assets/js/form-register.js"></script>
<script>
    $(document).ready(function () {
        
        const getInvalid = $('.invalid');
        const getFormGroup = $(getInvalid).closest('.form-group');

        // check error email add border red
        if (getInvalid.length > 0) {
            $(getFormGroup).addClass('invalid');
        }

        // on input remove class error
        $('#email').on('input', function() {
            $(getFormGroup).removeClass('invalid');
            $(getInvalid).css('display', 'none');
        })
    })
</script>
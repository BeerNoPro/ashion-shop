<?php

    $title = 'Edit user';
    $baseUrl = '../';
    require_once('../layout/header.php');

    // get info
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $select = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $select);
        while ($row = mysqli_fetch_array($result)) {
            $fullName = $row['fullname'];
            $email = $row['email'];
            $password = $row['passwords']; 
        }
    }

    // save info
    if (isset($_POST['submit'])) {
        $newfullName = getPost('fullname');
        $newemail = getPost('email');
        $newpassword = getPost('password');
        // check email
        $check = "SELECT * FROM users WHERE email = '$newemail'";
        $result = executeResult($check);

        $updated_at = date("Y-m-d H:i:s");

        if ($result != null) {
            $errorEmail = 'Email đã tồn tại';
        } else {
            if ($newpassword == '') {
                $update = "UPDATE users SET fullname = '$newfullName', email = '$newemail', updated_at = '$updated_at' WHERE id = $id";
                $result = mysqli_query($conn, $update);
                if ($result) { ?>
                    <script> location.replace("index.php"); </script>
                <?php } else {
                    echo "failed to update" . mysqli_error($conn);
                }
            } else {
                $newpassword = getSecurityMd5($newpassword);
                $update = "UPDATE users SET fullname = '$newfullName', email = '$newemail', passwords = '$newpassword', updated_at = '$updated_at' WHERE id = $id";
                $result = mysqli_query($conn, $update);
                if ($result) { ?>
                    <script> location.replace("index.php"); </script>
                <?php } else {
                    echo "failed to update" . mysqli_error($conn);
                }
            }
        }
    }
?>

<div class="row">
    <div class="col-md-12">
        <div class="header d-flex mt-3 align-items-center">
            <h1 class="">Sửa người dùng</h1>
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
                        placeholder="Nhập mật khẩu" minlength="6" value="">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu :</label>
                    <input id="password_confirmation" class="form-control" name="password_confirmation"
                        placeholder="Nhập lại mật khẩu" type="password" minlength="6"
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
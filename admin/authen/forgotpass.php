
<?php
    require_once ('../../database/dbhelper.php');
    require_once ('../../utility/utility.php');
    require_once ('./data_forgotpass.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Forgot password page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" 
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <style> 
            a {
                color: white;
                text-decoration: none;
            }
            .header {
                align-items: center;
            }
            .form-content {
                width: 50%;
            }
        </style>
    </head>
    <body>
        <div class="container-full">
            <div class="container header text-center mt-2 ">
                <h1 class="">Welcome to forgot password page</h1>
            </div>
            <hr class="mb-5">
            <div class="container">
                <div class="card mx-auto form-content">
                    <h2 class="card-header text-center">
                        Tìm tài khoản của bạn
                    </h2>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="">
                                <label for="" class="form-label">Nhập email để tìm tài khoản</label>
                                <input type="email" class="form-control mt-2" id="email" name="email"
                                    placeholder=" Email..." required="true">
                            </div>
                            <div class="get-email">
                                <?php 
                                    if(isset($email)){
                                        echo "<div class='mt-2'>Gửi mã về: <b>$email</b></div>";
                                    }
                                ?>
                            </div>
                            <div class="d-flex mt-4 justify-content-evenly">
                                <button class="btn btn-success">
                                    <a href="./login.php">Quay lại</a>
                                </button>
                                <button type="" class="btn btn-primary" name="submit">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
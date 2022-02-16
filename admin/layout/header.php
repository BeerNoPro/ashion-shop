
<?php
    session_start();
    require_once ($baseUrl.'../database/dbhelper.php');
    require_once ($baseUrl.'../utility/utility.php');

    $conn = mysqli_connect('localhost','root','','web_clothes');
    
    // // check not user come back page login
    // $user = getUserToken();
    // if ($user == null) {
    //     header('location: '.$baseUrl.'authen/login.php');
    //     die();
    // }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$title?></title>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        
        <!-- jQuery library -->
        <script src="<?=$baseUrl?>./../../ashion/js/jquery-3.3.1.min.js"></script>
        <script src="<?=$baseUrl?>./../../ashion/js/bootstrap.min.js"></script></script>

        <!-- jquery modal -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- link icons -->
        <link rel="stylesheet" href="<?=$baseUrl?>./../../ashion/css/elegant-icons.css">
        <!-- link bootstrap -->
        <link rel="stylesheet" href="<?=$baseUrl?>./../../ashion/css/bootstrap.min.css">
        <!-- link css main -->
        <link rel="stylesheet" href="<?=$baseUrl?>./assets/css/style.css">

    </head>
    <body>
        <div class="container-fluid">
            <div class="header">
                <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow p-3">
                    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="#">Admin | Ashion</a>
                    <input class="form-control form-control-dark w-100" type="text" 
                        placeholder=" Tìm kiếm..." aria-label="Search">
                    <ul class="navbar-nav px-3">
                        <li class="nav-item-logout text-nowrap">
                            <a class="nav-link" href="<?=$baseUrl?>authen/logout.php">Thoát</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row">
                <nav class="col-md-3 d-md-block bg-light sidebar">
                    <div class="">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>">
                                    <i class="icon_house_alt"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>category">
                                    <i class="icon_folder-alt"></i>
                                    Danh Mục Sản Phẩm
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>product">
                                    <i class="icon_film"></i>
                                    Sản Phẩm
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>order">
                                    <i class="icon_cart_alt"></i>
                                    Quản Lý Đơn Hàng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>feedback">
                                    <i class="icon_question_alt2"></i>
                                    Quản Lý Phản Hồi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=$baseUrl?>user">
                                    <i class="icon_profile"></i>
                                    Quản Lý Người Dùng
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9">
                    
<?php
    require_once('./utility/utility.php');
    require_once('./database/dbhelper.php');

    // get user tokens
    $userId = '31';
    require_once('./utility/getusers.php');

    // select price total product order
    $totalPrice = '0 VND';
    if (isset($userId)) {
        // total price
        $sqlPrice = "SELECT SUM(total_money) AS sum_price FROM order_detail WHERE users_id = $userId";
        $resultPrice = executeResult2($sqlPrice);
        $rowPrice = mysqli_fetch_assoc($resultPrice);
        $sumPrice = $rowPrice['sum_price'];
        $totalPrice = number_format($sumPrice);

        // get product order
    }

?>

<!DOCTYPE html>
<html lang="zxx">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Ashion Template">
        <meta name="keywords" content="Ashion, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ashion <?php if (isset($fullNameUser)) echo "| " . $fullNameUser; ?></title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
        <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="./payment/css/style.css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <style>
            .cart__product__item img {
                width: 90px;
                height: 90px;
            }

            .checkout {
                padding-top: 160px;
            }

            .checkout__order {
                border-radius: 16px;
            }

            .checkout__order__product p {
                width: calc(100% / 3);
                font-size: 12px;
                margin-bottom: 0px;
            }

            .pay-success {
                background-color: #24df8a;
            }
        </style>

    </head>

    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Offcanvas Menu Begin -->
        <div class="offcanvas-menu-overlay"></div>
        <div class="offcanvas-menu-wrapper">
            <div class="offcanvas__close">+</div>
            <ul class="offcanvas__widget">
                <li><span class="icon_search search-switch"></span></li>
                <li>
                    <a href="#"><span class="icon_heart_alt"></span>
                        <!-- <div class="tip"></div> -->
                    </a>
                </li>
                <li class="shop_cart">
                    <a href="shop-cart.php">
                        <span class="icon_cart_alt"></span>
                        <div class="tip num-product-order"><?= $productOrder ?></div>
                    </a>
                </li>
            </ul>
            <div class="offcanvas__logo">
                <a href="./"><img src="img/logo.png" alt=""></a>
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="offcanvas__auth">
                <?php if (isset($fullNameUser)) : ?>
                    <a class=""><?= $fullNameUser ?></a>
                    <a href="./admin/authen/logout.php">Đăng xuất</a>
                <?php else : ?>
                    <a href="./admin/authen/login.php">Đăng nhập</a>
                    <a href="./admin/authen/register.php">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
        <!-- Offcanvas Menu End -->

        <!-- Header Section Begin -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-lg-2">
                        <div class="header__logo">
                            <a href="./"><img src="img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                        <nav class="header__menu">
                            <ul>
                                <li><a href="./">Trang chủ</a></li>
                                <li><a href="#">Shops</a>
                                    <ul class="dropdown">
                                        <li><a href="womens.php">Shop Nữ</a></li>
                                        <li><a href="mens.php">Shop nam</a></li>
                                        <li><a href="kids.php">Shop Trẻ em</a></li>
                                        <li><a href="accessory.php">Phụ kiện</a></li>
                                        <li><a href="cosmetics.php">Đồ mỹ phẩm</a></li>
                                        <li><a href="./checkout.php">Checkout</a></li>
                                        <li><a href="./blog-details.php">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li class="active"><a href="shop-cart.php">Shop Cart</a>
                                    <ul class="dropdown">
                                        <li><a href="shop-cart.php">Giỏ hàng</a></li>
                                        <li><a href="#">Sản phẩm đã thích</a></li>
                                    </ul>
                                </li>
                                <li><a href="./blog.php">Blog</a></li>
                                <li><a href="./contact.php">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="header__right">
                            <div class="header__right__auth">
                                <?php if (isset($fullNameUser)) : ?>
                                    <a class=""><?= $fullNameUser ?></a>
                                    <a href="./admin/authen/logout.php">Đăng xuất</a>
                                <?php else : ?>
                                    <a href="./admin/authen/login.php">Đăng nhập</a>
                                    <a href="./admin/authen/register.php">Đăng ký</a>
                                <?php endif; ?>
                            </div>
                            <ul class="header__right__widget">
                                <li><span class="icon_search search-switch"></span></li>
                                <li><a href="#"><span class="icon_heart_alt"></span>
                                        <!-- <div class="tip"></div> -->
                                    </a></li>
                                <li class="shop_cart">
                                    <a href="shop-cart.php">
                                        <span class="icon_cart_alt"></span>
                                        <div class="tip num-product-order"><?= $productOrder ?></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="canvas__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Checkout Section Begin -->
        <section class="checkout spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="coupon__link">
                            <span class="icon_tag_alt"></span>
                            Hóa đơn thanh toán của bạn.
                        </h6>
                    </div>
                </div>
                <form action="" class="checkout__form" method="post">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5>Thông tin của bạn</h5>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__form__input">
                                        <p>Họ và Tên <span>*</span></p>
                                        <input type="text" name="fullname" placeholder="Họ và tên...">
                                    </div>
                                    <div class="checkout__form__input">
                                        <p>Địa chỉ <span>*</span></p>
                                        <input type="text" name="address" placeholder="Địa chỉ...">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="checkout__form__input">
                                        <p>Số điện thoại <span>*</span></p>
                                        <input type="text" name="number" placeholder="Số điện thoại...">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="checkout__form__input">
                                        <p>Email <span>*</span></p>
                                        <input type="email" name="email" placeholder="Email...">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__form__checkbox">
                                        <div class="checkout__form__input">
                                            <p>Ghi chú về đơn hàng <span>*</span></p>
                                            <input type="text" placeholder="Giao hàng sau 17h..." name="note">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkout__order">
                                <h5>Hóa đơn của bạn</h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li class="d-flex justify-content-between">
                                            <span class="top__text">Sản phẩm</span>
                                            <span class="top__text">Số lượng</span>
                                            <span class="top__text__right">Giá tiền</span>
                                        </li>
                                        <?php
                                        if (isset($userId)) {
                                            $sql = "SELECT product.titles, order_detail.num, order_detail.total_money FROM order_detail
                                                    INNER JOIN product
                                                    ON product.id = order_detail.product_id WHERE users_id = $userId";
                                            $result = executeResult2($sql);
                                            $index = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                                echo '
                                                            <li class="d-flex justify-content-between mb-0">
                                                                <p>
                                                                    ' . $index++ . '. ' . $row['titles'] . '
                                                                </p>
                                                                <p class="text-center">' . $row['num'] . '</p>
                                                                <p>' . number_format($row['total_money']) . ' VND</p>
                                                            </li>
                                                        ';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                        <li class="d-flex justify-content-between">
                                            <span>Tổng tiền</span>
                                            <div>
                                                <span>VND</span>
                                                <span><?=$totalPrice?></span> 
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>Giảm giá</span> 
                                            <div>
                                                <span>VND</span>
                                                <span>0</span>
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <span>Tổng tiền thanh toán </span>
                                            <div>
                                                <span>VND</span>
                                                <span id="total_price"><?=$totalPrice?></span> 
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-center error-payment mb-2"></div>
                                <button type="button" class="site-btn btn-payment">Thanh toán</button>
                                <button type="button" class="site-btn d-none pay-success">Thanh toán thành công</button>
                            </div>
                        </div>
                    </div>
                    <div class="boxContent">
                        <p>
                            <i>
                                <span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>: Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước khi thực hiện.
                            </i>
                        </p>
                        <ul class="cardList clearfix">
                            <li class="bank-online-methods ">
                                <label for="vcb_ck_on">
                                    <i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
                                    <input type="radio" value="BIDV" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="vcb_ck_on">
                                    <i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
                                    <input type="radio" value="VCB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="vnbc_ck_on">
                                    <i class="DAB" title="Ngân hàng Đông Á"></i>
                                    <input type="radio" value="DAB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="tcb_ck_on">
                                    <i class="TCB" title="Ngân hàng Kỹ Thương"></i>
                                    <input type="radio" value="TCB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_mb_ck_on">
                                    <i class="MB" title="Ngân hàng Quân Đội"></i>
                                    <input type="radio" value="MB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_vib_ck_on">
                                    <i class="VIB" title="Ngân hàng Quốc tế"></i>
                                    <input type="radio" value="VIB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_vtb_ck_on">
                                    <i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
                                    <input type="radio" value="ICB" name="bankcode">

                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_exb_ck_on">
                                    <i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
                                    <input type="radio" value="EXB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_acb_ck_on">
                                    <i class="ACB" title="Ngân hàng Á Châu"></i>
                                    <input type="radio" value="ACB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_hdb_ck_on">
                                    <i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM"></i>
                                    <input type="radio" value="HDB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_msb_ck_on">
                                    <i class="MSB" title="Ngân hàng Hàng Hải"></i>
                                    <input type="radio" value="MSB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_nvb_ck_on">
                                    <i class="NVB" title="Ngân hàng Nam Việt"></i>
                                    <input type="radio" value="NVB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_vab_ck_on">
                                    <i class="VAB" title="Ngân hàng Việt Á"></i>
                                    <input type="radio" value="VAB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_vpb_ck_on">
                                    <i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng"></i>
                                    <input type="radio" value="VPB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_scb_ck_on">
                                    <i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
                                    <input type="radio" value="SCB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="bnt_atm_pgb_ck_on">
                                    <i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
                                    <input type="radio" value="PGB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="bnt_atm_gpb_ck_on">
                                    <i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu"></i>
                                    <input type="radio" value="GPB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="bnt_atm_agb_ck_on">
                                    <i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
                                    <input type="radio" value="AGB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="bnt_atm_sgb_ck_on">
                                    <i class="SGB" title="Ngân hàng Sài Gòn Công Thương"></i>
                                    <input type="radio" value="SGB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="BAB" title="Ngân hàng Bắc Á"></i>
                                    <input type="radio" value="BAB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="TPB" title="Tền phong bank"></i>
                                    <input type="radio" value="TPB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="NAB" title="Ngân hàng Nam Á"></i>
                                    <input type="radio" value="NAB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
                                    <input type="radio" value="SHB" name="bankcode">
                                </label>
                            </li>
                            <li class="bank-online-methods ">
                                <label for="sml_atm_bab_ck_on">
                                    <i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)"></i>
                                    <input type="radio" value="OJB" name="bankcode">
                                </label>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </section>
        <!-- Checkout Section End -->

        <!-- Instagram Begin -->
        <div class="instagram">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Instagram End -->

        <!-- Footer Section Begin -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-7">
                        <div class="footer__about">
                            <div class="footer__logo">
                                <a href="./index.php"><img src="img/logo.png" alt=""></a>
                            </div>
                            <p>Khách hàng là thượng đế - Ashion luôn lấy uy tín làm đầu</p>
                            <div class="footer__payment">
                                <a href="#"><img src="img/payment/payment-1.png" alt=""></a>
                                <a href="#"><img src="img/payment/payment-2.png" alt=""></a>
                                <a href="#"><img src="img/payment/payment-3.png" alt=""></a>
                                <a href="#"><img src="img/payment/payment-4.png" alt=""></a>
                                <a href="#"><img src="img/payment/payment-5.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-5">
                        <div class="footer__widget">
                            <h6>Links</h6>
                            <ul>
                                <li><a href="./">Trang chủ</a></li>
                                <li><a href="blog.php">Blogs</a></li>
                                <li><a href="contact.php">Liên hệ</a></li>
                                <li><a href="shop-cart.php">Giỏ hàng</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <div class="footer__widget">
                            <h6>Tài khoản của bạn</h6>
                            <ul>
                                <li><a href="#">Tài khoản</a></li>
                                <li><a href="#">Hàng đã đặt</a></li>
                                <li><a href="#">Hàng đang theo dõi</a></li>
                                <li><a href="#">Hãng đã thích</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-8">
                        <div class="footer__newslatter">
                            <h6>Gửi đánh giá cho chúng tôi</h6>
                            <form action="#">
                                <input type="text" placeholder="Email">
                                <button type="submit" class="site-btn">Gửi</button>
                            </form>
                            <div class="footer__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer__copyright__text">
                            <p>Shop Ashion &copy; <script>
                                    document.write(new Date().getFullYear());
                                </script> Pham Viet Hung <i class="fa fa-heart" aria-hidden="true"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Search Begin -->
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search End -->

        <!-- Js Plugins -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(document).ready(function() {
                $('.btn-payment').on('click', function(e) {
                    var fullname = $('input[name="fullname"]').val();
                    var address = $('input[name="address"]').val();
                    var number = $('input[name="number"]').val();
                    var email = $('input[name="email"]').val();
                    var note = $('input[name="note"]').val();
                    var price = $('#total_price').text();
                    var bankcode = $('input[type="radio"]:checked').val();
                    // fix comma price
                    var totalmoney = price.replace(new RegExp(',', 'g'),'');
                    // var totalmoney = 6000;

                    if (fullname && address && number && email && note != '' && bankcode != null) {
                        $.ajax({
                            url: 'ajax-api.php',
                            // dataType: 'json',
                            method: 'POST',
                            data: {
                                'payment': 1,
                                'fullname': fullname,
                                'address': address,
                                'number': number,
                                'email': email,
                                'note': note,
                                'totalmoney': totalmoney,
                                'bankcode': bankcode
                            },
                            success: function(data) {
                                window.location = data;
                                // console.log(data)
                                // if (data.success) {
                                //     $('.btn-payment').addClass('d-none');
                                //     $('.pay-success').removeClass('d-none');
                                // } else {
                                //     $('.error-payment').text('Thanh toán thất bại. Vui lòng liên hệ admin')
                                //     $('.error-payment').css('color', 'red');
                                // }
                            }
                        })
                    } else {
                        $('.error-payment').text('Thông tin của bạn chưa đầy đủ!')
                        $('.error-payment').css('color', 'red');
                    }
                })
                // remove error message payment
                $(document).on('input', function() {
                    $('.error-payment').text('')
                })
            })
        </script>
    </body>

</html>
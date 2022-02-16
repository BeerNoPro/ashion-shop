
<?php 
    require_once('./utility/utility.php');
    require_once('./database/dbhelper.php');

    // get user tokens
    $userId = '31';
    require_once('./utility/getusers.php');

    // select price total product order
    $totalPrice = '0 VND';
    if (isset($userId)) {
        $sqlPrice = "SELECT SUM(total_money) AS sum_price FROM order_detail WHERE users_id = $userId";
        $resultPrice = executeResult2($sqlPrice);
        $rowPrice = mysqli_fetch_assoc($resultPrice); 
        $sumPrice = $rowPrice['sum_price'];
        $totalPrice = number_format($sumPrice) . ' VND';
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
        <title>Ashion <?php if(isset($fullNameUser)) echo "| ".$fullNameUser;?></title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
        <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
        <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <style>
            .cart__product__item img {
                width: 90px;
                height: 90px;
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
                        <div class="tip num-product-order"><?=$productOrder?></div>
                    </a>
                </li>
            </ul>
            <div class="offcanvas__logo">
                <a href="./"><img src="img/logo.png" alt=""></a>
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="offcanvas__auth">
                <?php if (isset($fullNameUser)): ?>
                    <a class=""><?=$fullNameUser?></a>
                    <a href="./admin/authen/logout.php">Đăng xuất</a>
                <?php else: ?>
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
                                <?php if (isset($fullNameUser)): ?>
                                    <a class=""><?=$fullNameUser?></a>
                                    <a href="./admin/authen/logout.php">Đăng xuất</a>
                                <?php else: ?>
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
                                    <a href="#">
                                        <span class="icon_cart_alt"></span>
                                        <div class="tip num-product-order"><?=$productOrder?></div>
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

        <!-- Breadcrumb Begin -->
        <div class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <a href="./"><i class="fa fa-home"></i> Trang chủ</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Shop Cart Section Begin -->
        <section class="shop-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá tiền</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sqlSel = "SELECT product.thumbnail, product.titles, order_detail.*
                                        FROM `order_detail`
                                        INNER JOIN product
                                        ON order_detail.product_id = product.id
                                        WHERE order_detail.users_id = $userId";
                                        $resultSel = executeResult2($sqlSel);
                                        while ($item = mysqli_fetch_array($resultSel)) {
                                            $id = $item['id'];
                                            $thumbnail = fixUrl($item['thumbnail'], '../');
                                            $titles = $item['titles'];
                                            $price = number_format($item['price']);
                                            $num = $item['num'];
                                            $totalMoney = number_format($item['total_money']); ?>
                                            <tr>
                                                <td data-id="<?=$id?>" class="cart__product__item">
                                                    <img src="<?=$thumbnail?>" alt="">
                                                    <div class="cart__product__item__title">
                                                        <h6><?=$titles?></h6>
                                                        <div class="rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price"><span><?=$price?></span> VND</td>
                                                <td class="cart__quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" value="<?=$num?>">
                                                    </div>
                                                </td>
                                                <td class="cart__total"><span><?=$totalMoney?></span> VND</td>
                                                <td class="cart__close"><span class="icon_close"></span></td>
                                            </tr>
                                        <?php };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__btn">
                            <a href="./">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__btn update__btn">
                            <a href="#" class="update_total_price"><span class="icon_loading"></span> Cập nhật giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="discount__content">
                            <h6>Mã giảm giá</h6>
                            <form action="#">
                                <input type="text" placeholder="Mã giảm giá của bạn...">
                                <button type="submit" class="site-btn">Gửi</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-2">
                        <div class="cart__total__procced">
                            <h6>Tổng giỏ hàng</h6>
                            <ul>
                                <li>Tổng <span id="total_money_cart"><?=$totalPrice?></span></li>
                            </ul>
                            <a href="checkout.php" class="primary-btn">Thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shop Cart Section End -->

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
                            <p>Shop Ashion &copy; <script>document.write(new Date().getFullYear());</script> Pham Viet Hung <i class="fa fa-heart" aria-hidden="true"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

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
        <!-- <script src="js/ajax-api.js"></script> -->

        <script type="text/javascript">
            $(document).ready(function() {
                // count total money when add quantity
                // // add product order
                function addProducOrder() {
                    $(document).on('click', '.pro-qty .inc', function() {
                        var id = $(this).closest('tr').find('.cart__product__item').attr('data-id');
                        var price = $(this).closest('tr').find('.cart__price span').text();
                        var num = $(this).closest('tr').find('.cart__quantity input').val();
                        var totalResult = $(this).closest('tr').find('.cart__total span');
                        // fix comma price
                        var fixPrice = price.replace(new RegExp(',', 'g'),'');
                        var totalPrice = parseInt(fixPrice) * parseInt(num);

                        $.ajax({
                            url: 'ajax-api.php',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                'addProductOrder': 1,
                                'id': id,
                                'num': num,
                                'totalPrice': totalPrice
                            }, success: function(res) {
                                res.map(item => {
                                    $(num).val(item.num);
                                    $(totalResult).html(item.total);
                                })
                            }
                        })
                    })
                }
                addProducOrder()

                // // reduce product order
                function reduceProductOrder() {
                    $(document).on('click', '.pro-qty .dec', function() {
                        var id = $(this).closest('tr').find('.cart__product__item').attr('data-id');
                        var num = $(this).closest('tr').find('.cart__quantity input').val();
                        var price = $(this).closest('tr').find('.cart__price span').text();
                        var total = $(this).closest('tr').find('.cart__total span').text();
                        var totalResult = $(this).closest('tr').find('.cart__total span');
                        // fix comma price
                        var fixTotal = total.replace(new RegExp(',', 'g'),'');
                        var fixPrice = price.replace(new RegExp(',', 'g'),'');
                        var totalPrice = parseInt(fixTotal) - parseInt(fixPrice);
                        
                        $.ajax({
                            url: 'ajax-api.php',
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                'reduceProductOrder': 1,
                                'id': id,
                                'num': num,
                                'totalPrice': totalPrice
                            }, success: function(res) {
                                res.map(item => {
                                    $(num).val(item.num);
                                    $(totalResult).html(item.total);
                                })
                            }
                        })
                    })
                }
                reduceProductOrder()

                // delete product order
                $(document).on('click', '.icon_close', function () {
                    var id = $(this).closest('tr').find('.cart__product__item').attr('data-id');
                    var trTag = $(this).closest('tr');
                    var numProduct = $('.shop_cart').text();
                    $.ajax({
                        url: 'ajax-api.php',
                        method: 'POST',
                        dataType: 'json',
                        data:{
                            'deleteProducOrder': 1,
                            'id': id
                        }, success: function (data) {
                            if (data.success) {
                                var num = parseInt(numProduct) - 1;
                                $('.shop_cart .tip').html(num);
                                $(trTag).remove();
                            }
                        }
                    })
                })

                // click total price product order
                $(document).on('click', '.update_total_price', function(e) {
                    e.preventDefault();
                    var sum = 0;
                    $('.cart__total span').each(function(index, element) {
                        var price = $(this).text();
                        // fix comma price
                        var fixPrice = price.replace(new RegExp(',', 'g'),'');
                        sum += parseInt(fixPrice);
                    })
                    function formatNumber(num) {
                        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                    }
                    $('#total_money_cart').html(formatNumber(sum) + ' VND');
                })
            })
        </script>
        
    </body>

</html>
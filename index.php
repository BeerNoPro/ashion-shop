
<?php 

    require_once('./utility/utility.php');
    require_once('./database/dbhelper.php');

    // get user tokens
    require_once('./utility/getusers.php');

    // Trend Section (hot trend - best sell - fueture)
    function trendSection($id) {
        $sql = "SELECT * FROM product WHERE category_id = $id ORDER BY created_at DESC LIMIT 3";
        $result = executeResult2($sql);
        foreach ($result as $row) {
            echo '
                <div class="trend__item">
                    <div class="trend__item__pic">
                        <img src="'.fixUrl($row['thumbnail'], '../').'" alt="">
                    </div>
                    <div class="trend__item__text">
                        <h6>
                            <a href="product-details.php?id='.$row['id'].'">'.$row['titles'].'</a>
                        </h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">'.number_format($row['price']).' VND</div>
                    </div>
                </div>
            ';
        }
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
            .trend__item__text h6 a {
                font-size: 18px;
                color: black;
            }
        </style>
    </head>

    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Offcanvas Menu Begin mobile-->
        <div class="offcanvas-menu-overlay"></div>
        <div class="offcanvas-menu-wrapper">
            <div class="offcanvas__close">+</div>
            <ul class="offcanvas__widget">
                <li><span class="icon_search search-switch"></span></li>
                <li>
                    <a href="#">
                        <span class="icon_heart_alt"></span>
                        <!-- <div class="tip">2</div> -->
                    </a>
                </li>
                <li>
                    <a href="shop-cart.php">
                        <span class="icon_cart_alt"></span>
                        <div class="tip"><?=$productOrder?></div>
                    </a>
                </li>
            </ul>
            <div class="offcanvas__logo">
                <a href="./index.php"><img src="img/logo.png" alt=""></a>
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="offcanvas__auth">
                <?php if (isset($fullNameUser)): ?>
                    <a class=""><?=$fullNameUser?></a>
                    <a href="./admin/authen/logout.php">????ng xu???t</a>
                <?php else: ?>
                    <a href="./admin/authen/login.php">????ng nh???p</a>
                    <a href="./admin/authen/register.php">????ng k??</a>
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
                                <li class="active"><a href="./">Trang ch???</a></li>
                                <li><a href="#">Shops</a>
                                    <ul class="dropdown">
                                        <li><a href="womens.php">Shop N???</a></li>
                                        <li><a href="mens.php">Shop nam</a></li>
                                        <li><a href="kids.php">Shop Tr??? em</a></li>
                                        <li><a href="accessory.php">Ph??? ki???n</a></li>
                                        <li><a href="cosmetics.php">????? m??? ph???m</a></li>
                                        <li><a href="./checkout.php">Checkout</a></li>
                                        <li><a href="./blog-details.php">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="./shop-cart.php">Shop Cart</a></li>
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
                                    <a href="./admin/authen/logout.php">????ng xu???t</a>
                                <?php else: ?>
                                    <a href="./admin/authen/login.php">????ng nh???p</a>
                                    <a href="./admin/authen/register.php">????ng k??</a>
                                <?php endif; ?>
                            </div>
                            <ul class="header__right__widget">
                                <li><span class="icon_search search-switch"></span></li>
                                <li><a href="#"><span class="icon_heart_alt"></span>
                                    <!-- <div class="tip">2</div> -->
                                </a></li>
                                <li><a href="shop-cart.php"><span class="icon_cart_alt"></span>
                                    <div class="tip"><?=$productOrder?></div>
                                </a></li>
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

        <!-- Categories Section Begin -->
        <section class="categories">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 p-0">
                        <div class="categories__item categories__large__item set-bg"
                        data-setbg="img/categories/category-1.jpg">
                        <div class="categories__text">
                            <h1>Shop N???</h1>
                            <p>?????n v???i n??i n??y s??? cho b???n m???t con ng?????i ho??n to??n kh??c. N??o c??ng ??i th??i...</p>
                            <a href="womens.php">Xem Ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="img/categories/category-2.jpg">
                                <div class="categories__text">
                                    <h4>Shop ????n ??ng</h4>
                                    <p>99 s???n ph???m</p>
                                    <a href="mens.php">Xem Ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="img/categories/category-3.jpg">
                                <div class="categories__text">
                                    <h4>Shop Tr??? Em</h4>
                                    <p>273 s???n ph???m</p>
                                    <a href="kids.php">Xem Ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="img/categories/category-4.jpg">
                                <div class="categories__text">
                                    <h4>????? m??? ph???m</h4>
                                    <p>159 items</p>
                                    <a href="cosmetics.php">Xem Ngay</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                            <div class="categories__item set-bg" data-setbg="img/categories/category-5.jpg">
                                <div class="categories__text">
                                    <h4>????? ph??? ki???n</h4>
                                    <p>792 items</p>
                                    <a href="accessory.php">Xem Ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- Categories Section End -->

        <!-- Product Section Begin -->
        <section class="product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="section-title">
                            <h4>S???n ph???m m???i</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <ul class="filter__controls">
                            <!-- <li class="active all-none" data-filter="*">T???t c???</li> -->
                            <li data-id="31" class="filter__control_show" data-filter=".women">????? N???</li>
                            <li data-id="30" class="filter__control_show" data-filter=".men">????? Nam</li>
                            <li data-id="35" class="filter__control_show" data-filter=".kid">????? tr??? em</li>
                            <li data-id="37" class="filter__control_show" data-filter=".accessories">Ph??? ki???n</li>
                            <li data-id="40" class="filter__control_show" data-filter=".cosmetic">H??ng m??? ph???m</li>
                        </ul>
                    </div>
                </div>
                <div class="row property__gallery" id="product_section">
                    <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                                <div class="label new">New</div>
                                <ul class="product__hover">
                                    <li><a href="img/product/product-1.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">??o th???i trang n???</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">300.000 VND</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                                <ul class="product__hover">
                                    <li><a href="img/product/product-2.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">??o kho??c gi??</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">500.000 VND</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                                <div class="label stockout">out of stock</div>
                                <ul class="product__hover">
                                    <li><a href="img/product/product-3.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">V??y n??? c?? t??nh</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">700.000 VND</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                                <ul class="product__hover">
                                    <li><a href="img/product/product-4.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">??o d??i tay nam</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">400.000 VND</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Section End -->

        <!-- Banner Section Begin Slider -->
        <section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-8 m-auto">
                        <div class="banner__slider owl-carousel">
                            <div class="banner__item">
                                <div class="banner__text">
                                    <span>Th??? gi???i ????? nam</span>
                                    <h1>S???n ph???m ch???t l?????ng</h1>
                                    <a href="mens.php">Xem Ngay</a>
                                </div>
                            </div>
                            <div class="banner__item">
                                <div class="banner__text">
                                    <span>Th??? gi???i ????? n???</span>
                                    <h1>C??n ng???i g?? m?? kh??ng xem</h1>
                                    <a href="womens.php">Xem Ngay</a>
                                </div>
                            </div>
                            <div class="banner__item">
                                <div class="banner__text">
                                    <span>Th??? gi???i ????? c???a b??</span>
                                    <h1>Ch???t l?????ng l??m uy t??n</h1>
                                    <a href="kids.php">Xem Ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner Section End -->

        <!-- Trend Section Begin -->
        <section class="trend spad">
            <div class="container">
                <div class="row">
                    <!-- hot trend -->
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="trend__content">
                            <div class="section-title">
                                <h4>Hot trend</h4>
                            </div>
                            <?php 
                                $hotTrend = 36;
                                echo trendSection($hotTrend);
                            ?>
                        </div>
                    </div>
                    <!-- best sell -->
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="trend__content">
                            <div class="section-title">
                                <h4>Best seller</h4>
                            </div>
                            <?php 
                                $bestSell = 39;
                                echo trendSection($bestSell);
                            ?>
                        </div>
                    </div>
                    <!-- fueture -->
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="trend__content">
                            <div class="section-title">
                                <h4>Feature</h4>
                            </div>
                            <?php 
                                $fueture = 44;
                                echo trendSection($fueture);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Trend Section End -->

        <!-- Discount Section Begin -->
        <section class="discount">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 p-0">
                        <div class="discount__pic">
                            <img src="img/discount.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 p-0">
                        <div class="discount__text">
                            <div class="discount__text__title">
                                <span>Gi???m gi??</span>
                                <h2>M??a xu??n 2022</h2>
                                <h5><span>Sale</span> 50%</h5>
                            </div>
                            <div class="discount__countdown" id="countdown-time">
                                <div class="countdown__item">
                                    <span>22</span>
                                    <p>Ng??y</p>
                                </div>
                                <div class="countdown__item">
                                    <span>18</span>
                                    <p>Gi???</p>
                                </div>
                                <div class="countdown__item">
                                    <span>46</span>
                                    <p>Ph??t</p>
                                </div>
                                <div class="countdown__item">
                                    <span>05</span>
                                    <p>Gi??y</p>
                                </div>
                            </div>
                            <a href="#">Xem Ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Discount Section End -->

        <!-- Services Section Begin -->
        <section class="services spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="services__item">
                            <i class="fa fa-car"></i>
                            <h6>Mi???n ph?? ship</h6>
                            <p>S???n ph???m tr??n 500.000 VND</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="services__item">
                            <i class="fa fa-money"></i>
                            <h6>Ho??n l???i ti???n</h6>
                            <p>N???u s???n ph???m c?? v???n ?????</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="services__item">
                            <i class="fa fa-support"></i>
                            <h6>H??? tr??? online 24/7</h6>
                            <p><a href="https://www.facebook.com/yeue.anh.144/">Facebook</a></p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="services__item">
                            <i class="fa fa-headphones"></i>
                            <h6>Thanh to??n an to??n</h6>
                            <p>Uy t??n 100%</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services Section End -->

        <!-- Instagram Begin -->
        <div class="instagram">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi ti???t</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi ti???t</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi ti???t</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi ti???t</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi ti???t</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">Xem chi ti???t</a>
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
                            <p>Kh??ch h??ng l?? th?????ng ????? - Ashion lu??n l???y uy t??n l??m ?????u</p>
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
                                <li><a href="./">Trang ch???</a></li>
                                <li><a href="blog.php">Blogs</a></li>
                                <li><a href="contact.php">Li??n h???</a></li>
                                <li><a href="shop-cart.php">Gi??? h??ng</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <div class="footer__widget">
                            <h6>T??i kho???n c???a b???n</h6>
                            <ul>
                                <li><a href="#">T??i kho???n</a></li>
                                <li><a href="#">H??ng ???? ?????t</a></li>
                                <li><a href="#">H??ng ??ang theo d??i</a></li>
                                <li><a href="#">H??ng ???? th??ch</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-8">
                        <div class="footer__newslatter">
                            <h6>G???i ????nh gi?? cho ch??ng t??i</h6>
                            <form action="#">
                                <input type="text" placeholder="Email">
                                <button type="submit" class="site-btn">G???i</button>
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
                $('.filter__control_show').on('click', function(e) {
                    // $('.all-none').css('display', 'none');
                    var id = $(this).attr('data-id');
                    $.ajax({
                        url: "ajax-api.php",
                        method: 'POST',
                        data: {
                            "productSection": 1,
                            "id": id
                        },
                        success: function(data) {
                            // console.log(data)
                            $('#product_section').html(data);
                        }
                    })
                })
            })
        </script>
    </body>

</html>
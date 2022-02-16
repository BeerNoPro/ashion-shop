
<?php 

    require_once('./utility/utility.php');
    require_once('./database/dbhelper.php');

    // get user tokens
    require_once('./utility/getusers.php');

    // get product
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // select product render html
        $sql = "SELECT * FROM product WHERE id = $id";
        $data = executeResult2($sql);
        foreach ($data as $item) {
            $title = $item['titles'];
            $imageUrl = fixUrl($item['thumbnail'], '../');
            $price = number_format($item['price']);
            $discount = number_format($item['discount']);
            $description = $item['descriptions'];
            $category = $item['category_id'];
            $categoryDetail = $item['category_detail_id'];
        };

        // get related product 
        function getRelatedProduct($categoryDetail, $id) {
            $sqlRelated = "SELECT * FROM product WHERE category_detail_id = $categoryDetail AND id != $id LIMIT 4";
            $dataRel = executeResult2($sqlRelated);
            foreach ($dataRel as $item) {
                echo '
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="'.fixUrl($item['thumbnail'], '../').'">
                                <div class="label new">New</div>
                                <ul class="product__hover">
                                    <li><a href="'.fixUrl($item['thumbnail'], '../').'" class="image-popup"><span class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="?id='.$item['id'].'"><span class="icon_cart_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">'.$item['titles'].'</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">'.number_format($item['price']).' VND</div>
                            </div>
                        </div>
                    </div>
                ';
            };
        }
    }

    // select category render html
    if (isset($category)) {
        $sql = "SELECT * FROM category WHERE id = $category";
        $data = executeResult2($sql);
        foreach ($data as $item) {
            $names = $item['names'];
        };
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
            .product__details__price {
                align-items: center;
            }
            .product__details__price .price-discount {
                margin-right: 12px;
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
                <li><a href="#"><span class="icon_heart_alt"></span>
                    <!-- <div class="tip"></div> -->
                </a></li>
                <li class="shop_cart">
                    <a href="shop-cart.php">
                        <span class="icon_cart_alt"></span>
                        <div class="tip"><?=$productOrder?></div>
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
                                <li class="active"><a href="#">Shop Cart</a>
                                    <ul class="dropdown">
                                        <li><a href="./shop-cart.php">Giỏ hàng</a></li>
                                        <li><a href="./shop-cart.php">Sản phẩm đã thích</a></li>
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
                                    <!-- <div class="tip">2</div> -->
                                </a></li>
                                <li class="shop_cart">
                                    <a href="shop-cart.php">
                                        <span class="icon_cart_alt"></span>
                                        <div class="tip"><?=$productOrder?></div>
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
                            <a href="#"><?=$names?></a>
                            <span>Chi tiết sản phản phẩm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Product Details Section Begin -->
        <section class="product-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product__details__pic">
                            <div class="product__details__slider__content">
                                <div class="product__details__pic__slider owl-carousel">
                                    <img class="product__big__img" src="<?=$imageUrl?>" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="product__details__pic">
                            <div class="product__details__pic__left product__thumb nice-scroll">
                                <a class="pt active" href="#product-1">
                                    <img src="img/product/details/thumb-1.jpg" alt="">
                                </a>
                                <a class="pt" href="#product-2">
                                    <img src="img/product/details/thumb-2.jpg" alt="">
                                </a>
                                <a class="pt" href="#product-3">
                                    <img src="img/product/details/thumb-3.jpg" alt="">
                                </a>
                                <a class="pt" href="#product-4">
                                    <img src="img/product/details/thumb-4.jpg" alt="">
                                </a>
                            </div>
                            <div class="product__details__slider__content">
                                <div class="product__details__pic__slider owl-carousel">
                                    <img data-hash="product-1" class="product__big__img" src="img/product/details/product-1.jpg" alt="">
                                    <img data-hash="product-2" class="product__big__img" src="img/product/details/product-3.jpg" alt="">
                                    <img data-hash="product-3" class="product__big__img" src="img/product/details/product-2.jpg" alt="">
                                    <img data-hash="product-4" class="product__big__img" src="img/product/details/product-4.jpg" alt="">
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-lg-6">
                        <div class="product__details__text">
                            <h3><?=$title?></h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>( 138 reviews )</span>
                            </div>
                            <div class="product__details__price d-flex">
                                <div class="price-discount"><?=$discount?></div> VND<span><?=$price?> VND</span>
                            </div>
                            <div><?=$description?></div>
                            <div class="product__details__button">
                                <div class="quantity">
                                    <span>Số lượng:</span>
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                <a href="#" data-id="<?=$id?>" class="cart-btn">
                                    <span class="icon_cart_alt"></span> Thêm vào giỏ hàng
                                </a>
                                <ul>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__details__widget">
                                <ul>
                                    <li>
                                        <span>Màu sẵn có:</span>
                                        <div class="color__checkbox">
                                            <label for="red">
                                                <input type="radio" name="color__radio" id="red" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label for="black">
                                                <input type="radio" name="color__radio" id="black">
                                                <span class="checkmark black-bg"></span>
                                            </label>
                                            <label for="grey">
                                                <input type="radio" name="color__radio" id="grey">
                                                <span class="checkmark grey-bg"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Size sẵn có:</span>
                                        <div class="size__btn">
                                            <label for="xs-btn" class="active">
                                                <input type="radio" id="xs-btn">
                                                xs
                                            </label>
                                            <label for="s-btn">
                                                <input type="radio" id="s-btn">
                                                s
                                            </label>
                                            <label for="m-btn">
                                                <input type="radio" id="m-btn">
                                                m
                                            </label>
                                            <label for="l-btn">
                                                <input type="radio" id="l-btn">
                                                l
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Khuyến mãi:</span>
                                        <p>Miễn phí shipping</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Description product -->
                    <!-- <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Miêu tả về sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <h6>Miêu tả về sản phẩm</h6>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                        quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                        Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                        voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                    consequat massa quis enim.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                    quis, sem.</p>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <h6>Đánh giá ( 2 )</h6>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                        quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                        Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                        voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                    consequat massa quis enim.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                    quis, sem.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- RELATED PRODUCTS -->
                <div class="row mt-5">
                    <div class="col-lg-12 text-center">
                        <div class="related__title">
                            <h5>Các sản phẩm tương tự</h5>
                        </div>
                    </div>
                    <?php echo getRelatedProduct($categoryDetail, $id); ?>
                </div>
            </div>
        </section>
        <!-- Product Details Section End -->

        <!-- Instagram Begin -->
        <div class="instagram">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                            <div class="instagram__text">
                                <i class="icon_cart_alt"></i>
                                <a href="#">@ ashion_shop</a>
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
                                <a href="#"><i class="icon_cart_alt"></i></a>
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
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/main.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.product__details__button .cart-btn').on('click', function(e) {
                    e.preventDefault();
                    var productId = $(this).attr('data-id');
                    var price = $('.product__details__price .price-discount').text();
                    var num = $('.product__details__button input').val();
                    var numProduct = $('.shop_cart').text();

                    // fix comma price
                    var fixPrice = price.replace(new RegExp(',', 'g'),'');
                    var totalPrice = parseInt(fixPrice) * parseInt(num);
                    
                    // comfirm add product to shop cart
                    Swal.fire({
                        title: 'Thêm sản phẩm?',
                        showCancelButton: true,
                        confirmButtonText: 'Thêm',
                        cancelButtonText: 'Quay lại',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'ajax-api.php',
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    'addProduct': 1,
                                    'productId': productId,
                                    'price': fixPrice,
                                    'num': num,
                                    'totalPrice': totalPrice
                                },
                                success: function (data) {
                                    if (data.success) {
                                        Swal.fire('Thêm vào giỏ hàng thành công', '', 'success')
                                        var num = parseInt(numProduct) + 1;
                                        $('.shop_cart .tip').html(num);
                                    } else {
                                        Swal.fire('Thêm vào giỏ hàng thất bại', '', 'error')
                                    }
                                }
                            })
                        } else if (result.isDenied) {
                            Swal.fire('Changes are not saved', '', 'info')
                        }
                    })
                })
            })
        </script>
    </body>

</html>
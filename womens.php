
<?php 
    require_once('./utility/utility.php');
    require_once('./database/dbhelper.php');

    // get user tokens
    require_once('./utility/getusers.php');

    // pagination
    //// get limit
    $limit = 6;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $index = ($page - 1) * $limit;

    //// handle pagination
    $women = 31;
    $count = "SELECT COUNT(id) FROM product WHERE deleted = 0 AND category_id = $women";
    $result = executeResult2($count);
    $row = mysqli_fetch_array($result);
    $totalRecords = $row[0];
    $total_pages = ceil($totalRecords / $limit);
    $path = "womens.php";

    // select product render html
    $sql = "SELECT * FROM product WHERE deleted = 0 AND category_id = '$women' LIMIT $index, $limit";
    $data = executeResult2($sql);
    function dataProduct($data) {
        foreach ($data as $item) {
            echo '
                <div class="col-lg-4 col-md-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="'.fixUrl($item['thumbnail'], '../').'">
                            <div class="label new">New</div>
                            <ul class="product__hover">
                                <li>
                                    <a href="'.fixUrl($item['thumbnail'], '../').'" class="image-popup">
                                        <span class="arrow_expand"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" data-id="'.$item['id'].'" class="product-liked">
                                        <span class="icon_heart_alt"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="product-details.php?id='.$item['id'].'">
                                        <span class="icon_cart_alt"></span>
                                    </a>
                                </li>
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
                            <div class="product__price">
                                '.number_format($item['discount']).' VND
                                <span>'.number_format($item['price']).' VND</span>
                            </div>
                        </div>
                    </div>
                </div>
            ';
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
            .active-page {
                background-color: lightblue;
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
                <a href="./"><img src="img/logo.png" alt=""></a>
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
                                <li><a href="./">Trang ch???</a></li>
                                <li class="active"><a href="#">Shops</a>
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

        <!-- Breadcrumb Begin -->
        <div class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <a href="./"><i class="fa fa-home"></i> Trang Ch???</a>
                            <span>Shop N???</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Shop Section Begin -->
        <section class="shop spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="shop__sidebar">
                            <div class="sidebar__categories">
                                <div class="section-title">
                                    <h4>Danh m???c s???n ph???m</h4>
                                </div>
                                <div class="categories__accordion">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-heading active">
                                                <a data-toggle="collapse" data-target="#collapseOne">Shop N???</a>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        <li class="box-shadow"><a href="womens.php">Trang ch???</a></li>
                                                        <?php 
                                                            echo selectCategory($women);
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapseTwo">Shop nam</a>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        <li><a href="mens.php">Trang ch???</a></li>
                                                        <?php 
                                                            $mens = 30;
                                                            echo selectCategory($mens);
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapseThree">Shop tr??? nh???</a>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        <li><a href="kids.php">Trang ch???</a></li>
                                                        <?php 
                                                            $kid = 35;
                                                            echo selectCategory($kid);
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapseFour">Ph??? ki???n</a>
                                            </div>
                                            <div id="collapseFour" class="collapse" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        <li><a href="#">Trang ch???</a></li>
                                                        <?php 
                                                            $accessories = 37;
                                                            echo selectCategory($accessories);
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapseFive">????? m??? ph???m</a>
                                            </div>
                                            <div id="collapseFive" class="collapse" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        <li><a href="#">Trang ch???</a></li>
                                                        <?php 
                                                            $cosmetic = 40;
                                                            echo selectCategory($cosmetic);
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__filter">
                                <div class="section-title">
                                    <h4>L???a ch???n m???c gi??</h4>
                                </div>
                                <div class="filter-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="200000" data-max="3000000"></div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <p class="w-100">Gi??:</p>
                                            <input type="text" id="minamount">
                                            <input type="text" id="maxamount">
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-range-choise">
                                    <a href="#">T??m ki???m</a>
                                </div>
                            </div>
                            <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>L???a ch???n size</h4>
                                </div>
                                <div class="size__list">
                                    <label for="xxs">
                                        xxs
                                        <input type="checkbox" id="xxs">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="xs">
                                        xs
                                        <input type="checkbox" id="xs">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="xss">
                                        xs-s
                                        <input type="checkbox" id="xss">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="s">
                                        s
                                        <input type="checkbox" id="s">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="m">
                                        m
                                        <input type="checkbox" id="m">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="ml">
                                        m-l
                                        <input type="checkbox" id="ml">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="l">
                                        l
                                        <input type="checkbox" id="l">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="xl">
                                        xl
                                        <input type="checkbox" id="xl">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <!-- <div class="sidebar__color">
                                <div class="section-title">
                                    <h4>Shop by size</h4>
                                </div>
                                <div class="size__list color__list">
                                    <label for="black">
                                        Blacks
                                        <input type="checkbox" id="black">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="whites">
                                        Whites
                                        <input type="checkbox" id="whites">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="reds">
                                        Reds
                                        <input type="checkbox" id="reds">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="greys">
                                        Greys
                                        <input type="checkbox" id="greys">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="blues">
                                        Blues
                                        <input type="checkbox" id="blues">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="beige">
                                        Beige Tones
                                        <input type="checkbox" id="beige">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="greens">
                                        Greens
                                        <input type="checkbox" id="greens">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="yellows">
                                        Yellows
                                        <input type="checkbox" id="yellows">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <!-- <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-1.jpg">
                                        <div class="label new">New</div>
                                        <ul class="product__hover">
                                            <li><a href="" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Furry hooded parka</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 59.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-2.jpg">
                                        <ul class="product__hover">
                                            <li><a href="img/shop/shop-2.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Flowy striped skirt</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 49.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-3.jpg">
                                        <ul class="product__hover">
                                            <li><a href="img/shop/shop-3.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Croc-effect bag</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 59.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-4.jpg">
                                        <ul class="product__hover">
                                            <li><a href="img/shop/shop-4.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Dark wash Xavi jeans</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 59.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-5.jpg">
                                        <div class="label">Sale</div>
                                        <ul class="product__hover">
                                            <li><a href="img/shop/shop-5.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Ankle-cuff sandals</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 49.0 <span>$ 59.0</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-6.jpg">
                                        <ul class="product__hover">
                                            <li><a href="img/shop/shop-6.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Contrasting sunglasses</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 59.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-7.jpg">
                                        <ul class="product__hover">
                                            <li><a href="img/shop/shop-7.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Circular pendant earrings</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 59.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-8.jpg">
                                        <div class="label stockout stockblue">Out Of Stock</div>
                                        <ul class="product__hover">
                                            <li><a href="img/shop/shop-8.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Cotton T-Shirt</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 59.0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="img/shop/shop-9.jpg">
                                        <div class="label">Sale</div>
                                        <ul class="product__hover">
                                            <li><a href="img/shop/shop-9.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                            <li><a href="#"><span class="icon_cart_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#">Water resistant zips backpack</a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product__price">$ 49.0 <span>$ 59.0</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="pagination__option">
                                    <a href="#">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <a href="#"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div> -->
                        <div class="row" id="category-detail">
                            <?php echo dataProduct($data); ?>
                            <div class="col-lg-12 text-center">
                                <div class="pagination__option">
                                    <?php echo paginationClick($page, $total_pages, $path); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shop Section End -->

        <!-- Instagram Begin -->
        <div class="instagram">
            <div class="container-fluid">
                <div class="row">
                    <?php 
                        $sql = "SELECT * FROM product WHERE deleted = 0 AND category_id = $women ORDER BY created_at DESC LIMIT 6";
                        $data = executeResult2($sql);
                        foreach ($data as $row) {
                            echo '
                                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                                    <div class="instagram__item set-bg" 
                                        data-setbg="'.fixUrl($row['thumbnail'], '../').'"
                                    >
                                        <div class="instagram__text">
                                            <a href="product-details.php?id='.$row['id'].'">
                                                <i class="icon_cart_alt"></i>
                                            </a>
                                            <a href="product-details.php?id='.$row['id'].'" class="btn btn-success">
                                                Xem chi ti???t
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>
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
        <!-- js ajax -->
        

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

        <!-- show category details -->
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('click', '.category-detail', function(e) {
                    e.preventDefault();
                    var x = $('.category-detail').closest('ul').find('li');
                    for (var i = 0; i < x.length; i++) {
                        $(x[i]).removeClass('box-shadow');
                    }
                    $(this).parent().addClass('box-shadow');
                    var getIdDetail = $(this).attr('id-detail');
                    var getIdCategory = $(this).attr('id-category');
                    $.ajax({
                        url: "ajax-api.php",
                        method: "POST",
                        data:{
                            "getCategory": 1,
                            "idDetail": getIdDetail,
                            "idCategory": getIdCategory
                        },
                        success: function(data) {
                            $('#category-detail').html(data);
                        }
                    })
                })
            })
        </script>

    </body>

</html>
<?php 
    session_start();
    require_once('./utility/utility.php');
    require_once('./database/dbhelper.php');
    // get user 
    $user = getUserToken();
    $fullNameUser = $emailUser = '';
    if ($user != null) {
        $fullNameUser = $user["fullname"];
        $emailUser = $user["email"];

        // get user id
        $sql = "SELECT id FROM users WHERE email = '$emailUser'";
        $resultId = executeResult2($sql);
        while ($row = mysqli_fetch_array($resultId)) {
            $userId = $row['id'];
        };
    }

    // select category detail
    if (isset($_POST['getCategory'])) {
        $idDetail = $_POST['idDetail'];
        $idCategory = $_POST['idCategory'];
        // echo $idDetail . '-' . $idCategory . "<br>";
        $sql = "SELECT id, titles, thumbnail, discount, price FROM product WHERE deleted = 0 AND category_id = '$idCategory' AND category_detail_id = '$idDetail'";
        $data = executeResult2($sql);

        foreach ($data as $item) {
            $imgUrl = fixUrl($item['thumbnail'], '../');
            echo '
                <div class="col-lg-4 col-md-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="'.$imgUrl.'" 
                            style="background-image: url('.$imgUrl.');"
                        >
                            <div class="label new">New</div>
                            <ul class="product__hover">
                                <li>
                                    <a href="'.$imgUrl.'" class="image-popup">
                                        <span class="arrow_expand"></span>
                                    </a>
                                </li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
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

    // product Section
    if (isset($_POST['productSection'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM product WHERE category_id = $id AND deleted = 0 ORDER BY created_at DESC LIMIT 4";
        $result = executeResult2($sql);
        foreach ($result as $row) {
            $imgUrl = fixUrl($row['thumbnail'], '../');
            echo '
                <div class="col-lg-3 col-md-4 col-sm-6 mix women men kid accessories cosmetic">
                        <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="'.$imgUrl.'"
                            style="background-image: url('.$imgUrl.');"
                        >
                            <div class="label new">New</div>
                            <ul class="product__hover">
                                <li><a href="'.$imgUrl.'" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li>
                                    <a href="product-details.php?id='.$row['id'].'">
                                        <span class="icon_cart_alt"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="product__item__text">
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
                            <div class="product__price">
                                '.number_format($row['discount']).' VND
                                <span>'.number_format($row['price']).' VND</span>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
    }

    // add product order detail
    if (isset($_POST['addProduct'])) {
        $price = getPost('price');
        $num = getPost('num');
        $productId = getPost('productId');
        $totalPrice = getPost('totalPrice');

        // save product order details
        if (isset($userId)) {
            $sqlSave = "INSERT INTO order_detail(price, num, total_money, users_id, product_id) VALUES('$price','$num','$totalPrice','$userId','$productId')";
            $resultSave = executeResult2($sqlSave);
            $rs = array();
            if ($resultSave != null) {
                $rs['success'] = true;
            } else {
                $rs['success'] = false;
            }
            echo json_encode($rs);
            
        }
    }

    // count product order
    if (isset($_GET['countProOrder'])) {
        if (isset($userId)) {
            $sql = "SELECT * FROM `order_detail` WHERE users_id = $userId";
            $result = executeResult2($sql);
            $count = mysqli_num_rows($result);
            echo $count;
        }
    }

    // add product order details
    if (isset($_POST['addProductOrder'])) {
        $id = getPost('id');
        $num = getPost('num');
        $totalPrice = getPost('totalPrice');
        if (isset($userId)) {
            $sql = "UPDATE order_detail SET num = $num, total_money = $totalPrice WHERE id = $id AND users_id = $userId";
            $resultUp = executeResult2($sql);
            if ($resultUp != null) {
                // get new product order
                $sql = "SELECT num, total_money FROM order_detail WHERE id = $id";
                $resultSel = executeResult2($sql);
                while ($row = mysqli_fetch_array($resultSel)) {
                    $total = number_format($row["total_money"]);
                    $data[] = array("num" => $row["num"], "total" => $total);
                };
                echo json_encode($data);
            }
        }
    }

    // reduce product order details
    if (isset($_POST['reduceProductOrder'])) {
        $id = getPost('id');
        $num = getPost('num');
        $totalPrice = getPost('totalPrice');
        if (isset($userId)) {
            $sql = "UPDATE order_detail SET num = $num, total_money = $totalPrice WHERE id = $id AND users_id = $userId";
            $resultUp = executeResult2($sql);
            if ($resultUp != null) {
                // get new product order
                $sql = "SELECT num, total_money FROM order_detail WHERE id = $id";
                $resultSel = executeResult2($sql);
                while ($row = mysqli_fetch_array($resultSel)) {
                    $total = number_format($row["total_money"]);
                    $data[] = array("num" => $row["num"], "total" => $total);
                };
                echo json_encode($data);
            }
        }
    }

    // delete product order
    if (isset($_POST['deleteProducOrder'])) {
        $id = getPost('id');
        $sql = "DELETE FROM order_detail WHERE id = $id";
        $result = executeResult2($sql);
        $rs = array();
        if ($result != null) {
            $rs['success'] = true;
        } else {
            $rs['success'] = false;
        }
        echo json_encode($rs);
    }

    // payment product order
    if (isset($_POST['payment'])) {
        $fullname = getPost('fullname');
        $address = getPost('address');
        $email = getPost('email');
        $number = getPost('number');
        $note = getPost('note');
        $totalmoney = getPost('totalmoney');
        $bankcode = getPost('bankcode');
        $orderDate = date('Y-m-d');

        // if (isset($userId)) {

        //     $sql = "INSERT INTO orders(fullname, email, phone_number, address, notes, order_date, status, total_money, users_id) VALUES('$fullname', '$email', '$number', '$address', '$note', '$orderDate', '0', '$totalmoney', '$userId')";
        //     $result = executeResult2($sql);
        //     $rs = array();
        //     if ($result != null) {
        //         $rs['success'] = true;
        //     } else {
        //         $rs['success'] = false;
        //     }
        //     echo json_encode($rs);
        // }

        include('./payment/config.php');
        include('./payment/include/NL_Checkoutv3.php');
        $nlcheckout = new NL_CheckOutV3(MERCHANT_ID, MERCHANT_PASS, RECEIVER, URL_API);
    
        $total_amount = $_POST['totalmoney'];
    
        $array_items[0] = array(
            'item_name1' => 'Product name',
            'item_quantity1' => 1,
            'item_amount1' => $total_amount,
            'item_url1' => 'http://nganluong.vn/'
        );
        
        $array_items=array();				 
        $payment_method = 'ATM_ONLINE';
        $bank_code = $bankcode;
        $order_code = "macode_" . time();
    
        $payment_type = '';
        $discount_amount = 0;
        $order_description = '';
        $tax_amount = 0;
        $fee_shipping = 0;
        $return_url = 'http://localhost/learnphp/ashion/payment/data.php';
        $cancel_url = urlencode('http://localhost/nganluong.vn/checkoutv3?orderid=' . $order_code);
    
        $buyer_fullname = $fullname;
        $buyer_email = $email;
        $buyer_mobile = $number;
    
        $buyer_address = '';
        
        if ($payment_method != '' && $buyer_email != "" && $buyer_mobile != "" && $buyer_fullname != "" && filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) { 
            if ($payment_method == "ATM_ONLINE" && $bank_code != '') {
                $nl_result = $nlcheckout->BankCheckout(
                    $order_code,
                    $total_amount,
                    $bank_code,
                    $payment_type,
                    $order_description,
                    $tax_amount,
                    $fee_shipping,
                    $discount_amount,
                    $return_url,
                    $cancel_url,
                    $buyer_fullname,
                    $buyer_email,
                    $buyer_mobile,
                    $buyer_address,
                    $array_items
                );
            }
            //var_dump($nl_result); die;
            if ($nl_result->error_code == '00') {
                
                echo (string)$nl_result->checkout_url;
    
            } else {
                echo $nl_result->error_message;
            }
        }

    }

?>
<?php

    $title = 'Order';
    $baseUrl = '../';
    require_once ('../layout/header.php');
    
    $orderId = getGet('id');
    // select product
    $sql = "SELECT order_detail.*, Product.titles, Product.thumbnail from order_detail left join Product on Product.id = order_detail.product_id where order_detail.order_id = $orderId";
	$data = executeResult2($sql);

    // select customer
    $sql = "SELECT * from Orders where id = $orderId";
	$orderItem = executeResult($sql, true);

?>


<div class="row">
    <div class="col-md-12">
        <div class="header mt-3">
            <h1 class="">Chi tiết đơn hàng</h1>
            <div class="">
                <a class="btn btn-primary"href="index.php">Quay lại</a>
            </div>
        </div>
        <div class="col-md-6 p-0 mt-5">
            <h4>Thông tin khách hàng</h4>
            <table class="table table-bordered table-hover mt-3">
                <tr>
                    <th>Họ & Tên: </th>
                    <td><?=$orderItem['fullname']?></td>
                </tr>
                <tr>
                    <th>Email: </th>
                    <td><?=$orderItem['email']?></td>
                </tr>
                <tr>
                    <th>Địa Chỉ: </th>
                    <td><?=$orderItem['address']?></td>
                </tr>
                <tr>
                    <th>Phone: </th>
                    <td><?=$orderItem['phone_number']?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h4>Thông tin đơn hàng</h4>
        <table class="table table-bordered text-center mt-3">
            <thead>
                <tr>
                    <th>STT</th>
					<th>Thumbnail</th>
					<th>Tên Sản Phẩm</th>
					<th>Giá</th>
					<th>Số Lượng</th>
					<th>Tổng Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $index = 0;
                    foreach($data as $item) {
                        echo '
                            <tr>
                                <th>'.(++$index).'</th>
                                <td><img src="'.fixUrl($item['thumbnail'], '../').'" style="height: 100px"/></td>
                                <td>'.$item['titles'].'</td>
                                <td>'.$item['price'].'</td>
                                <td>'.$item['num'].'</td>
                                <td>'.$item['total_money'].'</td>
                            </tr>
                        ';
                    };
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php 
    require_once ('../layout/footer.php');
?>
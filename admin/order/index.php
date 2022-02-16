<?php

    $title = 'Order';
    $baseUrl = '../';
    require_once ('../layout/header.php');

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
    $count = "SELECT COUNT(id) FROM orders";
    $result = executeResult2($count);
    $row = mysqli_fetch_array($result);
    $totalRecords = $row[0];
    $total_pages = ceil($totalRecords / $limit);
    // LIMIT $index, $limit

    // select user
    $sql = "SELECT * FROM orders ORDER BY status ASC, order_date DESC LIMIT $index, $limit";
	$data = executeResult2($sql);
    
?>


<div class="row">
    <div class="col-md-12">
        <div class="header mt-3">
            <h1 class="">Quản lý đơn hàng</h1>
        </div>
        <div class="table-responsive">
            <table class="table mt-3 table-bordered text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>PhoneNumber</th>
                        <th>Address</th>
                        <th>Notes</th>
                        <th>TotalMoney</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Show product</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $index = 0;
                        foreach($data as $item) {
                            echo '
                                <tr>
                                    <th>'.(++$index).'</th>
                                    <td>'.$item['fullname'].'</td>
                                    <td>'.$item['email'].'</td>
                                    <td>'.$item['phone_number'].'</td>
                                    <td>'.$item['address'].'</td>
                                    <td>'.$item['notes'].'</td>
                                    <td>'.$item['total_money'].'</td>
                                    <td>'.$item['order_date'].'</td>
                                    <td>';
                                        if ($item['status'] == 0) {
                                            echo '<button class="btn btn-success" onclick=changeStatus('.$item['id'].',1)>
                                            Approve</button><br/>';
                                            echo'<button class="btn btn-primary mt-2" onclick=changeStatus('.$item['id'].',2)>Cancel</button>';
                                        } else if($item['status'] == 1) {
                                            echo '<button class="btn btn-success">Approved</button>';
                                        } else {
                                            echo '<button class="btn btn-primary">Cancel</button>';
                                        }
                                echo '</td>
                                    <td>
                                        <button class="btn btn-info">
                                            <a href="detail.php?id='.$item['id'].'">Show</a>
                                        </button>
                                    </td>
                                </tr>
                            ';
                        };
                    ?>
                </tbody>
            </table>
        </div>
        <!--  pagination -->
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <?php 
                    if ($page >= 2) {
                        echo '
                            <li class="page-item">
                                <a class="page-link" href="index.php?page='.($page - 1).'">Previous</a>
                            </li>
                        ';
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if  ($i == $page) {
                            echo '
                                <li class="page-item">
                                    <a class="page-link active" href="index.php?page='.$i.'">'.$i.'</a>
                                </li>
                            ';
                        } else {
                            echo '
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page='.$i.'">'.$i.'</a>
                                </li>
                            ';
                        }
                    }
                    if($page < $total_pages){   
                        echo '
                            <li class="page-item">
                                <a class="page-link" href="index.php?page='.($page + 1).'">Next</a>
                            </li>
                        ';
                    }   
                ?>
            </ul>
        </nav>
    </div>
</div>

<script type="text/javascript">
    // onclick status order 
	function changeStatus(id, status) {
		$.post('data.php', {
			'update_status': 1,
			'id': id,
            'status': status
		}, function(data) {
			location.reload()
		})
	}

</script>

<?php 
    require_once ('../layout/footer.php');
?>
<?php

    $title = 'Feedback';
    $baseUrl = '../';
    require_once ('../layout/header.php');

    // pagination
    //// get limit
    $limit = 8;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $index = ($page - 1) * $limit;

    //// handle pagination
    $count = "SELECT COUNT(id) FROM feedback";
    $result = executeResult2($count);
    $row = mysqli_fetch_array($result);
    $totalRecords = $row[0];
    $total_pages = ceil($totalRecords / $limit);
    // LIMIT $index, $limit

    // select user
    $sql = "SELECT * FROM feedback ORDER BY status ASC, updated_at DESC LIMIT $index, $limit";
	$data = executeResult2($sql);
    
?>


<div class="row">
    <div class="col-md-12">
        <div class="header mt-3">
            <h1 class="">Quản lý phản hồi</h1>
        </div>
        <table class="table mt-5 table-bordered text-center">
            <thead>
                <tr>
                    <th>STT</th>
					<th>Tên</th>
					<th>Họ</th>
					<th>SĐT</th>
					<th>Email</th>
					<th>Chủ Đề</th>
					<th>Nội Dung</th>
					<th>Ngày Tạo</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $index = 0;
                    foreach($data as $item) {
                        echo '
                            <tr>
                                <th>'.(++$index).'</th>
                                <td>'.$item['firstname'].'</td>
                                <td>'.$item['lastname'].'</td>
                                <td>'.$item['phone_number'].'</td>
                                <td>'.$item['email'].'</td>
                                <td>'.$item['subject_name'].'</td>
                                <td>'.$item['notes'].'</td>
                                <td>'.$item['updated_at'].'</td>
                                <td>';
                                    if ($item['status'] == 0) {
                                        echo' <button class="btn btn-primary" onclick=markRead('.$item['id'].')>
                                        Đã đọc</button>';
                                    } else {
                                        echo' <button class="btn btn-danger" onclick=deleted('.$item['id'].')>
                                        Xóa</button>';
                                    }
                            echo '</td>
                            </tr>
                        ';
                    };
                ?>
            </tbody>
        </table>
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
    // onclick markRead feedback 
	function markRead(id) {
		$.post('data.php', {
			'id': id,
			'mark': 1
		}, function(data) {
			location.reload()
		})
	}

    // onclick delete feedback
	function deleted(id) {
		$.post('data.php', {
			'id': id,
			'delete': 1
		}, function(data) {
			location.reload()
		})
	}
</script>

<?php 
    require_once ('../layout/footer.php');
?>
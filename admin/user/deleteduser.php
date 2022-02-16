<?php

    $title = 'User';
    $baseUrl = '../';
    require_once ('../layout/header.php');

    // pagination
    //// get limit
    $limit = 9;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $index = ($page - 1) * $limit;

    //// handle pagination
    $count = "SELECT COUNT(id) FROM users WHERE deleted = 1";
    $result = executeResult2($count);
    $row = mysqli_fetch_array($result);
    $totalRecords = $row[0];
    $total_pages = ceil($totalRecords / $limit);
    // LIMIT $index, $limit
    
    // select user
    $sql = "SELECT users.*, roles.names AS role_name FROM users 
        INNER JOIN roles ON roles.id = users.role_id WHERE users.deleted = 1 LIMIT $index, $limit";

	$data = executeResult2($sql);

?>

<div class="row">
    <div class="col-md-12">
        <div class="header mt-3">
            <h1 class="mb-3">Quản lý người dùng đã xóa tạm thời</h1>
            <a href="index.php" class="btn btn-primary">Quay lại</a>
        </div>
        <table class="table table-bordered mt-5 text-center">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Role-name</th>
                    <th>Deleted</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $index = 0;
                    foreach($data as $item) {
                        echo '<tr>
                            <th>'.(++$index).'</th>
                            <td>'.$item['fullname'].'</td>
                            <td>'.$item['email'].'</td>
                            <td>'.$item['role_name'].'</td>
                            <td>
                                <button class="btn btn-danger destroy" data-id="'.$item['id'].'">Xóa hẳn</button>
                            </td>
                            <td>
                                <button class="btn btn-success restore" data-id="'.$item['id'].'">Khôi phục</button>
                            </td>
                        </tr>';
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
                                <a class="page-link" href="deleteduser.php?page='.($page - 1).'">Previous</a>
                            </li>
                        ';
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if  ($i == $page) {
                            echo '
                                <li class="page-item">
                                    <a class="page-link active" href="deleteduser.php?page='.$i.'">'.$i.'</a>
                                </li>
                            ';
                        } else {
                            echo '
                                <li class="page-item">
                                    <a class="page-link" href="deleteduser.php?page='.$i.'">'.$i.'</a>
                                </li>
                            ';
                        }
                    }
                    if($page < $total_pages){   
                        echo '
                            <li class="page-item">
                                <a class="page-link" href="deleteduser.php?page='.($page + 1).'">Next</a>
                            </li>
                        ';
                    }   
                ?>
            </ul>
        </nav>
    </div>
</div>

<?php 
    require_once ('../layout/footer.php');
?>

<script>
    $(document).ready(function() {
        // destroy user
        $(document).on('click', '.destroy', function() {
            var gettr = $(this).closest('tr');
            var id = $(this).attr('data-id');
            $.ajax({
                url: 'delete.php',
                type: 'GET',
                data: {
                    'destroy': 1,
                    'id': id
                },
                success: function(data) {
                    $(gettr).hide();
                }
            })
        })

        // restore user
        $(document).on('click', '.restore', function() {
            var gettr = $(this).closest('tr');
            var id = $(this).attr('data-id');
            $.ajax({
                url: 'delete.php',
                type: 'GET',
                data: {
                    'restore': 1,
                    'id': id
                },
                success: function(data) {
                    $(gettr).hide();
                }
            })
        })

    })
</script>
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
    $count = "SELECT COUNT(id) FROM users WHERE deleted = 0";
    $result = executeResult2($count);
    $row = mysqli_fetch_array($result);
    $totalRecords = $row[0];
    $total_pages = ceil($totalRecords / $limit);
    // LIMIT $index, $limit
    
    // select user
    $sql = "SELECT users.*, roles.names AS role_name FROM users 
        INNER JOIN roles ON roles.id = users.role_id WHERE users.deleted = 0 LIMIT $index, $limit";

	$data = executeResult2($sql);

?>

<div class="row">
    <div class="col-md-12">
        <div class="header mt-3">
            <h1 class="">Quản lý người dùng</h1>
            <div class="mt-3 mb-3">
                <a href="adduser.php">
                    <button class="btn btn-success">Thêm người dùng</button>
                </a>
                <a href="deleteduser.php">
                    <button class="btn btn-secondary">Những người đã xóa</button>
                </a>
            </div>
        </div>
        <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg">
            <table class="table mt-5 table-bordered text-center">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Role-name</th>
                        <th>Edit</th>
                        <th>Delete</th>
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
                                    <button class="btn btn-primary">
                                        <a href="edituser.php?id='.$item['id'].'">Edit</a>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-warning delete" data-id="'.$item['id'].'" 
                                        data-bs-toggle="modal" data-bs-target="#formdelete"
                                    >Delete</button>
                                </td>
                            </tr>';
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
        <!-- Modal -->
        <div class="modal fade" id="formdelete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bạn có chắc chắn xóa người dùng này?</h5>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <div>Fullname </div>
                            <b id="delete-fullname"></b>
                        </div>
                        <div class="d-flex">
                            <div>Email </div>
                            <b id="delete-email"></b>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quay lại</button>
                        <button type="button" class="btn btn-danger destroy">Tiếp tục</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once ('../layout/footer.php');
?>

<script>
    $(document).ready(function() {
        // confirm delete
        var id, gettr;
        $(document).on('click', '.delete', function() {
            gettr = $(this).closest('tr');
            id = $(this).attr('data-id');
            $.ajax({
                url: 'delete.php',
                type: 'GET',
                data: {
                    'confirm': 1,
                    'id': id
                },
                success: function(data) {
                    var info = JSON.parse(data);
                    info.map(item => {
                        $('#delete-fullname').html(' : ' + item.fullname);
                        $('#delete-email').html(' : ' + item.email);
                    })
                }
            })
        })

        // soft delete info
        $(document).on('click', '.destroy', function() {
            $.ajax({
                url: 'delete.php',
                type: 'GET',
                data: {
                    'delete': 1,
                    'id': id
                },
                success: function(data) {
                    $(gettr).hide();
                    $('#formdelete').modal('hide');
                }
            })
        })

    })
</script>
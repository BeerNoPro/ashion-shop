<?php

    $title = 'Category';
    $baseUrl = '../';
    require_once ('../layout/header.php');
    require_once ('./add.php');

    // pagination
    //// get limit
    $limit = 5;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $index = ($page - 1) * $limit;

    //// handle pagination
    $count = "SELECT COUNT(id) FROM category";
    $result = executeResult2($count);
    $row = mysqli_fetch_array($result);
    $totalRecords = $row[0];
    $total_pages = ceil($totalRecords / $limit);
    // LIMIT $index, $limit

    // edit 
    if (isset($_GET['id'])) {
        $flag = true;
        $id = $_GET['id'];
        $sql = "SELECT * FROM category WHERE id = $id";
        $data = executeResult($sql, true);
        if ($data != null) {
            $nameEdit = $data['names'];
        }
    }

    // select user
    $sql = "SELECT * FROM category LIMIT $index, $limit";
	$data = executeResult2($sql);

    // select option category from
    $select = "SELECT * FROM category";
    $categorys = executeResult2($select);
    
?>

<div class="row">
    <div class="col-md-12 header mt-3">
        <h1 class="">Danh mục sản phẩm</h1>
    </div>
    <div class="col-md-6">
        <form action="" method="post" class="form form-category" id="form-1" >
            <div class="form-group">
                <h5>Lựa chọn danh mục</h5>
                <select name="category" id="" class="form-group-select">
                    <option value="">Danh mục chính</option>
                    <?php
                        foreach($categorys as $item) {
                            echo '<option value="'.$item['id'].'">'.$item['names'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <h5>Tên danh mục</h5>
                <input id="fullname" class="form-control" name="name" type="text" 
                    placeholder=" Danh mục chính..." required="true"
                    value="<?php if (isset($nameEdit)) echo $nameEdit; ?>">
                <span class="form-message"></span>
            </div>
            <div class="form-group">
                <div class="confirm-insert"><?php if (isset($success)) echo $success; ?></div>
                <div class="confirm-insert"><?php if (isset($error)) echo $error; ?></div>
                <?php if($flag == false): ?>
                    <button class="btn btn-info w-25" name="submit">Thêm</button>
                <?php else: ?>
                    <button class="btn btn-success w-25" name="save">Lưu</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="col-md-12 mt-3">
        <h5>Danh sách danh mục</h5>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Name</th>
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
                            <td>'.$item['names'].'</td>
                            <td>
                                <button class="btn btn-primary edit">
                                    <a href="index.php?id='.$item['id'].'">Edit</a>
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
    <!-- Modal -->
    <div class="modal fade" id="formdelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bạn có chắc chắn xóa danh mục này?</h5>
                </div>
                <div class="modal-body">
                    <div>Tên danh mục :</div>
                    <b id="delete-name"></b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quay lại</button>
                    <button type="button" class="btn btn-danger destroy">Tiếp tục</button>
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
        // confirm
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
                    $('#delete-name').html(data);
                }
            })
        });
        $(document).on('click', '.destroy', function() {
            $.ajax({
                url: 'delete.php',
                type: 'GET',
                data: {
                    'destroy': 1,
                    'id': id
                },
                success: function(data) {
                    $(gettr).hide();
                    $('#formdelete').modal('hide');
                }
            })
        })

        // remove confirm insert category
        $(document).on('input', function() {
            $('.confirm-insert').remove();
        })
    })
</script>

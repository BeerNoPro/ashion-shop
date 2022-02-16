<?php

    $flag = false;
    // add
    if (isset($_POST['submit'])) {
        $catogory = getPost('category');
        $name = getPost('name');
        if ($catogory === '') {
            $sql = "INSERT INTO category(names) VALUES ('$name')";
            execute($sql);
        } else {
            $sql = "INSERT INTO category_detail(names, category_id) VALUES ('$name', '$catogory')";
            if (execute($sql) != null) {
                $error = "Thêm danh mục con $name thất bại";
            } else {
                $success = "Thêm danh mục con $name thành công";
            }
        }

    }

    // edit category
    if (isset($_POST['save'])) {
        $id = getGet('id');
        $name = getPost('name');
        $sql = "UPDATE category SET names = '$name' WHERE id = $id";
        execute($sql); ?>
        <script> location.replace("index.php")</script>
    <?php }


?>
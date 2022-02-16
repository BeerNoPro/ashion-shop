<?php

    $title = 'Product';
    $baseUrl = '../';
    require_once('../layout/header.php');

    // select option category from
    $select = "SELECT * FROM category";
    $categorys = executeResult2($select);

    // select form product
    // get info
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $select = "SELECT * FROM product WHERE id = $id";
        $products = executeResult2($select);
        foreach($products as $item) {
            $id = $item['id'];
            $old_title = $item['titles'];
            $old_price = $item['price'];
            $old_discount = $item['discount'];
            $old_thumbnail = $item['thumbnail'];
            $old_description = $item['descriptions'];
            $old_category = $item['category_id'];
        }
    }

    // insert product
    if (isset($_POST['submit'])) {
        $title = getPost('title');
        $price = getPost('price');
        $discount = getPost('discount');
        // $thumbnail = moveFile('thumbnail', '../../../');
        $thumbnail = uploadImage('thumbnail', '../../');
        $description = getPost('description');
        $category_id = getPost('category');
        $updated_at = date('Y-m-d H:i:s');

        // update product
        $sql = "UPDATE product SET titles = '$title', price = '$price', discount = '$discount', thumbnail = '$thumbnail', descriptions = '$description', category_id = '$category_id', updated_at = '$updated_at', deleted = 0 WHERE id = $id";
        $success = mysqli_query($conn, $sql);

        if ($success) { ?>
            <script> location.replace("index.php"); </script>
        <?php } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

?>
<!-- include summernote css/js -->
<link rel="stylesheet" href="./summernote-summernote-ab9a852/dist/summernote.min.css">
<script src="./summernote-summernote-ab9a852/dist/summernote.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="header mt-3">
            <h1 class="">Sửa sản phẩm</h1>
            <div class="mt-3 mb-3">
                <a href="index.php">
                    <button class="btn btn-primary">Quay lại</button>
                </a>
            </div>
        </div>
        <div class="main mt-5">
            <form action="" method="post" class="form" id="form-1" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="title" class="form-label">Tên sản phẩm :</label>
                            <input id="title" class="form-control" name="title" type="text" 
                                placeholder="Aa..." required="true"
                                value="<?=$old_title?>">
                        </div>
                        <div class="form-group">
                            <label for="description" class="w-100">Nội dung :</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="w-100 text-formadd"><?=$old_description?></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button class="btn btn-success btn-submit w-25 " id="btn-submit" name="submit">
                                Lưu sản phẩm
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="price" class="form-label">Giá :</label>
                            <input id="price" class="form-control" name="price" type="text" 
                                placeholder="Giá..." required="true" value="<?=$old_price?>">
                        </div>
                        <div class="form-group">
                            <label for="discount" class="form-label">Giá giảm :</label>
                            <input id="discount" class="form-control" name="discount" type="text" 
                                placeholder="Giá giảm..." required="true" value="<?=$old_discount?>">
                        </div>
                        <div class="form-group from-upload-img">
                            <div class="">
                                <label for="thumbnail" class="form-label w-100">Hình ảnh :</label>
                                <button class="btn btn-info">Upload image</button>
                                <input type="file" class="" id="thumbnail" name="thumbnail"
                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            </div>
                            <div class="form-thumbnail-img" id="">
                                <img id="thumbnail-img" src="<?=fixUrl($old_thumbnail, '../../../')?>" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Danh mục sản phẩm:</label>
                            <select name="category" id="" required="true" class="form-group-select">
                                <option value="">-- Chọn --</option>
                                <?php
                                    foreach($categorys as $item) {
                                        if($item['id'] == $old_category) {
                                            echo '<option selected value="'.$item['id'].'">'.$item['names'].'</option>';
                                        } else {
                                            echo '<option value="'.$item['id'].'">'.$item['names'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once('../layout/footer.php');
?>

<script>
    $(document).ready(function() {
        // get image upload
        $('#thumbnail').change(function() {
            // var createImg = $('<img id="thumbnail-img">');
            var imgurl = window.URL.createObjectURL(this.files[0])
            $('#thumbnail-img').attr('src', imgurl);
            // $('.form-thumbnail-img').append(createImg);
        })
        
        // summernote
        $('#description').summernote({
            placeholder: 'Aa...',
            tabsize: 2,
            height: 200,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    })
</script>

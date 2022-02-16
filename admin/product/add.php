<?php

    $title = 'Product';
    $baseUrl = '../';
    require_once('../layout/header.php');

    // select option category from
    $select = "SELECT * FROM category";
    $categorys = executeResult2($select);

    // insert product
    if (isset($_POST['submit'])) {
        $title = getPost('title');
        $price = getPost('price');
        $discount = getPost('discount');
        // // upload img in fodel
        // $thumbnail = moveFile('thumbnail', '../../../');
        // upload img to s3
        $thumbnail = uploadImage('thumbnail', '../../');
        $description = getPost('description');
        $category_id = getPost('category');
        $category_detail = getPost('category-detail');
        
        $created_at = date('Y-m-d H:i:s');

        // save product
        $sql = "INSERT INTO product(titles, price, discount, thumbnail, descriptions, created_at, category_id, updated_at, deleted, category_detail_id) VALUES('$title', '$price', '$discount', '$thumbnail', '$description', '$created_at', '$category_id', '0', '0', '$category_detail')";
        $success = mysqli_query($conn, $sql);

        if ($success) { 
            echo "Upload Successfully";
        } else {
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
            <h1 class="">Thêm sản phẩm</h1>
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
                                placeholder="Aa..." required="true">
                        </div>
                        <div class="form-group">
                            <label for="description" class="w-100">Nội dung :</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="w-100 text-formadd"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <button class="btn btn-success btn-submit w-25 " id="btn-submit" name="submit">
                                Thêm sản phẩm
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="price" class="form-label">Giá :</label>
                            <input id="price" class="form-control" name="price" type="text" 
                                placeholder="Giá..." required="true">
                        </div>
                        <div class="form-group">
                            <label for="discount" class="form-label">Giá giảm :</label>
                            <input id="discount" class="form-control" name="discount" type="text" 
                                placeholder="Giá giảm..." required="true">
                        </div>
                        <div class="form-group from-upload-img">
                            <div class="">
                                <label for="thumbnail" class="form-label w-100">Hình ảnh :</label>
                                <button class="btn btn-info">Upload image</button>
                                <input type="file" class="" id="thumbnail" name="thumbnail" required="true"
                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            </div>
                            <div class="form-thumbnail-img" id=""></div>
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Danh mục sản phẩm:</label>
                            <select name="category" id="category-select" required="true" class="form-group-select">
                                <option value="">-- Chọn --</option>
                                <?php
                                    foreach($categorys as $item) {
                                        echo '
                                            <option class="option-category" value="'.$item['id'].'">
                                                '.$item['names'].'
                                            </option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group form-category-detail">
                            <label for="category" class="form-label">Danh mục sản phẩm con:</label>
                            <select name="category-detail" id="category-detail" 
                                required="true" class="form-group-select"></select>
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
            var createImg = $('<img id="thumbnail-img">');
            var imgurl = window.URL.createObjectURL(this.files[0])
            createImg.attr('src', imgurl);
            $('.form-thumbnail-img').append(createImg);
        });
        
        // summernote
        $('#description').summernote({
            placeholder: 'Nhập nội dung dữ liệu',
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

        // select category details
        $('#category-select').on('change', function() {
            var value = $(this).val();
            $.ajax({
                url: "delete.php",
                method: "POST",
                data:{
                    "getCategory": 1,
                    "id": value
                },
                success: function(data) {
                    if (data != '') {
                        $('.form-category-detail').css('display', 'block');
                        $('#category-detail').html(data);
                    } 
                }
            })
        });
    })
</script>

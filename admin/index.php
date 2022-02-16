
<?php

    $title = 'Home admin';
    $baseUrl = '';
    require_once ('layout/header.php');

    // check not user come back page login
    $user = getUserToken();
    if ($user != null) {
        $fullname = $user['fullname'];
        $email = $user['email'];
        if ($fullname != 'admin' && $email != 'admin@gmail.com') { ?>
            <script> location.replace("./authen/logout.php");</script>
            <?php die();
        }
    }

?>

<div class="row">
    <div class="col-md-12">
        <h1>hello home</h1>
        <!-- <a href="https://t004.gokisoft.com/">Link web demo</a> -->
    </div>
</div>

<?php 
    require_once ('layout/footer.php');
?>
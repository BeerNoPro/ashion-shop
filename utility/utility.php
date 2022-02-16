<?php 

    // function fix sql injection
    function fixSqlInjection($sql) {
        $sql = str_replace('\\', '\\\\', $sql);
        $sql = str_replace('\'', '\\\'', $sql);
        return $sql;
    };

    // function get
    function getGet($key) {
        $value = '';
        if (isset($_GET[$key])) {
            $value = $_GET[$key];
            $value = fixSqlInjection($value);
        }
        return trim($value);
    };

    // function post
    function getPost($key) {
        $value = '';
        if (isset($_POST[$key])) {
            $value = $_POST[$key];
            $value = fixSqlInjection($value);
        }
        return trim($value);
    };

    // function request
    function getRequest($key) {
        $value = '';
        if (isset($_REQUEST[$key])) {
            $value = $_REQUEST[$key];
            $value = fixSqlInjection($value);
        }
        return trim($value);
    };

    // function cookie
    function getCookie($key) {
        $value = '';
        if (isset($_COOKIE[$key])) {
            $value = $_COOKIE[$key];
            $value = fixSqlInjection($value);
        }
        return trim($value);
    };

    // ma hoa password
    function getSecurityMd5($password) {
        return md5(md5($password).PRIVATE_KEY);
    };

    // validate token
    function getUserToken() {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        $token = getCookie('token');
        $sql = "SELECT * FROM tokens WHERE tokens = '$token'";
        $item = executeResult($sql, true);
        
        if ($item != null) {
            $userId = $item['users_id'];
            $sql = "SELECT * FROM users WHERE id = '$userId'";
            $item = executeResult($sql, true);
            if ($item != null) {
                $_SESSION['user'] = $item;
                return $item;
            }
        }
        return null;
    }

    // save image to folder
    function moveFile($key, $rootPath = "../../") {
        if(!isset($_FILES[$key]) || !isset($_FILES[$key]['name']) || $_FILES[$key]['name'] == '') {
            return '';
        }
    
        $pathTemp = $_FILES[$key]["tmp_name"];
    
        $filename = $_FILES[$key]["name"];
        //filename -> remove special character, ..., ...
    
        // $newPath="assets/image/".$filename;
        $newPath="ashion/img/img-data/".$filename;
    
        move_uploaded_file($pathTemp, $rootPath.$newPath);
    
        return $newPath;
    }
    
    
    // fix url path
    function fixUrl($thumbnail, $rootPath = "../../") {
        if(stripos($thumbnail, 'http://') !== false || stripos($thumbnail, 'https://') !== false) {
        } else {
            $thumbnail = $rootPath.$thumbnail;
        }
    
        return $thumbnail;
    }

    // upload images to amazon (s3)
    // // upload image
    use Aws\S3\S3Client;
    use Aws\S3\Exception\S3Exception;
    
    function uploadImage($fileName, $path = "../") {
        require $path . "vendor/autoload.php";

        $bucket = 'labtoidayhoc';
        $keyname = 'AKIAVJH5OBNALLPJXXNB';
        $s3secret = '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';
        $region = 'ap-southeast-1';

        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => $region,
            'credentials' => [
                'key'    => $keyname,
                'secret' => $s3secret,
            ],
        ]);

        // check submit
        // $submit = isset($_POST['submit']);
        $file = isset($_FILES[$fileName]);

        if ($file && is_uploaded_file($_FILES[$fileName]['tmp_name'])) {

            // $name = $_FILES[$fileName]['name'];
            $name = "phamviethung/" . basename($_FILES[$fileName]['name']);
            $tmp = $_FILES[$fileName]['tmp_name'];
            try {
                $result = $s3->upload(
                    $bucket,
                    $name,
                    fopen($tmp, 'rb'),
                    'public-read'
                );

                $imgUrl = htmlspecialchars($result->get('ObjectURL'));
                
            } catch (S3Exception $e) {
                echo $e->getMessage();
            }

        }

        return $imgUrl;
    }

    // paginations 
    function paginationClick($page, $total_pages, $path) {
        // prev pages
        if ($page >= 2) {
            echo '
                <a class="" href="'.$path.'?page='.($page - 1).'">
                    <i class="fa fa-angle-left"></i>
                </a>
            ';
        }
        // num pages
        for ($i = 1; $i <= $total_pages; $i++) {
            if  ($i == $page) {
                echo '
                    <a class="active-page" href="'.$path.'?page='.$i.'">'.$i.'</a>
                ';
            } else {
                echo '
                    <a class="" href="'.$path.'?page='.$i.'">'.$i.'</a>
                ';
            }
        }
        // next pages
        if($page < $total_pages){   
            echo '
                <a class="" href="'.$path.'?page='.($page + 1).'">
                    <i class="fa fa-angle-right"></i>
                </a>
            ';
        }   
    }

    // select category womens
    function selectCategory($id) {
        $sql = "SELECT * FROM category_detail WHERE category_id = '$id'";
        $data = executeResult2($sql);

        foreach ($data as $item) {
            $idDetail = $item['id'];
            $names = $item['names'];
            echo "<li><a class='category-detail' href='' id-category='$id' id-detail='$idDetail'>$names</a></li>";
        }
    }


?>
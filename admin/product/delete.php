
<?php
    $conn = mysqli_connect('localhost','root','','web_clothes');

    // select info
    if (isset($_GET['confirm'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM product WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $fullname = $row['titles'];
            $email = $row['thumbnail'];
            $arr[] = array('titles' => $fullname, 'thumbnail' => $email);
            echo json_encode($arr);
        }
        mysqli_close($conn);
    };

    // soft delete
    if (isset($_GET['delete'])) {
        $id = $_GET['id'];
        $sql = "UPDATE product SET deleted = '1' WHERE id = $id ";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    // destroy product
    if (isset($_GET['destroy'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM product WHERE id = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "delete ok";
        } else {
            echo "delete failed";
        }
        mysqli_close($conn);
    }

    // restore user
    if (isset($_GET['restore'])) {
        $id = $_GET['id'];
        $sql = "UPDATE product SET deleted = '0' WHERE id = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "restore ok";
        } else {
            echo "restore failed";
        }
        mysqli_close($conn);
    }

    // get category data
    if (isset($_POST['getCategory'])) {
        $id = $_POST['id'];
        $sql = "SELECT * FROM category_detail WHERE category_id = '$id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $name = $row['names'];
            $id = $row['id'];
            echo "<option value='$id'>$name</option>";
        }
        mysqli_close($conn);
    }

?>



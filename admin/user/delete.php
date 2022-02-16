
<?php
    $conn = mysqli_connect('localhost','root','','web_clothes');

    // select info
    if (isset($_GET['confirm'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $fullname = $row['fullname'];
            $email = $row['email'];
            $arr[] = array('fullname' => $fullname, 'email' => $email);
            echo json_encode($arr);
        }
        mysqli_close($conn);
    };

    // soft delete
    if (isset($_GET['delete'])) {
        $id = $_GET['id'];
        $sql = "UPDATE users SET deleted = '1' WHERE id = $id ";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    // destroy users
    if (isset($_GET['destroy'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id = $id ";
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
        $sql = "UPDATE users SET deleted = '0' WHERE id = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "restore ok";
        } else {
            echo "restore failed";
        }
        mysqli_close($conn);
    }

?>



<?php 

    $conn = mysqli_connect('localhost','root','','web_clothes');

    if(isset($_POST['mark'])) {
        $id = $_POST['id'];
        $sql = "UPDATE feedback SET status = '1' WHERE id = $id ";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    if(isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM feedback WHERE id = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "delete ok";
        } else {
            echo "delete failed";
        }
        mysqli_close($conn);
    }



?>
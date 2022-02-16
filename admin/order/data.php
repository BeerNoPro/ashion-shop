<?php 

    $conn = mysqli_connect('localhost','root','','web_clothes');

    if(isset($_POST['update_status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];
        $sql = "UPDATE orders SET status = $status WHERE id = $id ";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }


?>
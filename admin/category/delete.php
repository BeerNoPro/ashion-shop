
<?php 
    $conn = mysqli_connect('localhost','root','','web_clothes');
    // select category
    if (isset($_GET['confirm'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM category WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            echo $row['names'];
        }
        mysqli_close($conn);
    };

    // destroy category
    if (isset($_GET['destroy'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM category WHERE id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    };

?>
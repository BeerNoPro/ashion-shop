<?php 

    // get user tokens
    $user = getUserToken();
    $productOrder = '0';
    $userId = '';
    if ($user != null) {
        $fullNameUser = $user["fullname"];
        $emailUser = $user["email"];

        // get id user
        $sql = "SELECT id FROM users WHERE email = '$emailUser'";
        $resultId = executeResult2($sql);
        while ($row = mysqli_fetch_array($resultId)) {
            $userId = $row['id'];
        };

        // get number product order
        $sql = "SELECT * FROM `order_detail` WHERE users_id = $userId";
        $result = executeResult2($sql);
        $productOrder = mysqli_num_rows($result);
    }

?>
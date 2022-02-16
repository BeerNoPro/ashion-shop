<?php 
    require_once ('config.php');
    
    // insert, update, delete
    function execute($sql) {
        // open connection
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn, 'utf8');

        // query
        mysqli_query($conn, $sql);

        // close connection
        // mysqli_close($conn);
    };

    // select
    function executeResult($sql, $isSingle = false) {
        $data = null;
        // open connection
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn, 'utf8');

        // query
        $result = mysqli_query($conn, $sql);
        if ($isSingle) {
            $data = mysqli_fetch_array($result, 1);
        } else {
            $data = [];
            while ($row = mysqli_fetch_array($result, 1) != NULL) {
                $data = $row;
            }
        }
        // close connection
        mysqli_close($conn);

        return $data;
    }

    function executeResult2($sql) {
        // open connection
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        mysqli_set_charset($conn, 'utf8');

        // query
        $result = mysqli_query($conn, $sql);
        
        return $result;
        // close connection
        mysqli_close($conn);

    }
?>
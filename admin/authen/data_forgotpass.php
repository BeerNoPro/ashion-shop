
<?php 
    $emailFlag = false;

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        
        if (isset($email)) {
            $emailFlag = true;
        }
    }

?>
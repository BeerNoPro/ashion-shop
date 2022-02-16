
<?php

    include('config.php');
    include('include/NL_Checkoutv3.php');

    $nlcheckout = new NL_CheckOutV3(MERCHANT_ID, MERCHANT_PASS, RECEIVER, URL_API);
    $nl_result = $nlcheckout->GetTransactionDetail($_GET['token']);

    if ($nl_result) {
        $nl_errorcode           = (string)$nl_result->error_code;
        $nl_transaction_status  = (string)$nl_result->transaction_status;
        if ($nl_errorcode == '00') {
            if ($nl_transaction_status == '00') {
                //trạng thái thanh toán thành công
                echo "<pre>";
                print_r($nl_result);
                echo "</pre>";
                echo "Cập nhật trạng thái thành công";
            }
        } else {
            echo $nlcheckout->GetErrorMessage($nl_errorcode);
        }
    }

?>
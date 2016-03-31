<?php
require_once 'vendor/autoload.php';

use Qiniu\Auth;


if ($_GET["la"]) {
    $accessKey = 'DcQKNgEQr6r3mrxIbA9c_ZIrqYWO0SzX9anGxmMb';
    $secretKey = 'c8jY0CNg2-FtSpScC55Fj3ttBM2l6CVsCdTx0fMq';
    $auth = new Auth($accessKey, $secretKey);
    $bucket = 'nupterarticle';
    $upToken = $auth->uploadToken($bucket);
    $arrayName = array('uptoken' => $upToken);
    echo json_encode($arrayName);
} else {
    if ($_POST["nupter"] == "nupter") {

        $accessKey = 'DcQKNgEQr6r3mrxIbA9c_ZIrqYWO0SzX9anGxmMb';
        $secretKey = 'c8jY0CNg2-FtSpScC55Fj3ttBM2l6CVsCdTx0fMq';
        $auth = new Auth($accessKey, $secretKey);
        $bucket = 'nupter';
        $upToken = $auth->uploadToken($bucket);
        $arrayName = array('token' => $upToken);
        echo json_encode($arrayName);
    } else {
        $accessKey = 'DcQKNgEQr6r3mrxIbA9c_ZIrqYWO0SzX9anGxmMb';
        $secretKey = 'c8jY0CNg2-FtSpScC55Fj3ttBM2l6CVsCdTx0fMq';
        $auth = new Auth($accessKey, $secretKey);
        $bucket = 'nupter';
        $upToken = $auth->uploadToken($bucket);
        $arrayName = array('info' => $upToken);
        $result = array('status' => "success", 'info' => $arrayName);
        echo json_encode($result);

    }


}



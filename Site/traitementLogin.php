<?php

if (isset($_GET['username']) && isset($_GET['password'])) {
    $curl = curl_init();
    $url = '0d5987d2-70b7-4a7d-a8bd-6ee8c8d649dc.mock.pstmn.io/connect?username='.$_GET['username'].'&password='.$_GET['password'];
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if ($e = curl_error($curl)) {
        $response = array('succes' => "false", 'errorCode' => 2, 'errorMessage' => $e);
        echo json_encode($response);
    } else {
        echo $response;
    }
    curl_close($curl);
} else {
    $response = array('succes' => "false", 'errorCode' => 1);
    echo json_encode($response);
}

<?php

if (isset($_GET['username']) && isset($_GET['password'])) {
    $curl = curl_init();
    $url = 'f802cccc-d0d4-4a92-a4a7-9d99442afcff.mock.pstmn.io/utilisateur?username=' . $_GET['username'];

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if ($e = curl_error($curl)) {
        $response = array('status' => "error", 'errorCode' => 2, 'errorMessage' => $e);
        echo json_encode($response);
    } else {
        $json = json_decode($response, true);
    }
    curl_close($curl);
} else {
    $response = array('status' => "error", 'errorCode' => 1);
    echo json_encode($response);
}

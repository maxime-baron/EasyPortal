<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPortal - Dashboard</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/user.css">
</head>

<body>
    <div class="content">
        <h1>EasyPortal</h1>
        <div class="open-button">
            <div class="open-header">
                <img src="images/svg/door-icon.svg" alt="">
                <h2 class="open">Ouvrir</h2>
            </div>
            <p class="open-label">Préssé pour simplement ouvrir</p>
        </div>
        <div class="plate-list">
            <h2>MES PLAQUES </h2>
            <table>
                <?php

                $curl = curl_init();
                $username = 'djboss';

                curl_setopt_array($curl, array(
                    CURLOPT_URL => '0d5987d2-70b7-4a7d-a8bd-6ee8c8d649dc.mock.pstmn.io/utilisateur?username=' . $username,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                ?>
                <tr>
                    <td class="plate-number">AA-123-BB</td>
                    <td>
                        <div class="table-img">
                            <img class="edit-ico table-ico" src="images/svg/edit-ico.svg" alt="Boutton modifier">
                            <img class="trash-ico table-ico" src="images/svg/trash-ico.svg" alt="Boutton supprimer">
                        </div>
                    </td>
                </tr>
            </table>
            <div class="plate-add">AJOUTER UNE PLAQUE</div>
        </div>
    </div>
    <script src="scripts/js/editTable.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPortal - Dashboard</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
</head>

<body>
    <div class="content">
        <div class="left-side">
            <div class="left-side-div camera-render"></div>
            <div class="left-side-div logs"></div>
        </div>
        <div class="dashboard">
            <nav>
                <h1>EasyPortal</h1>
                <img src="imgs/svg/menu-icon.svg" alt="">
            </nav>
            <div class="top-view">
                <div class="title">
                    <h1>EasyPortal</h1>
                </div>
                <div class="displ">
                    <div class="left-displ">
                        <div class="week-stats stats">
                            <span class="stat-value">0</span>
                            <p class="stat-label">Utilisation cette semaine...</p>
                        </div>
                        <div class="day-stats stats">
                            <span class="stat-value">0</span>
                            <p class="stat-label">Utilisation ce jour...</p>
                        </div>
                    </div>
                    <div class="open-button">
                        <img src="imgs/svg/door-icon.svg" alt="Icone d'ouverture de porte">
                        <h2 class="open">Ouvrir</h2>
                        <p class="open-label">Préssé pour simplement ouvrir</p>
                    </div>
                </div>
            </div>
            <div class="user-action">
                <div class="add-user user-btn">
                    <img src="imgs/svg/add-icon.svg" alt="Icone d'ajout d'utilisateur">
                    <h2 class="add-user-heading">Ajouter un utilisateur</h2>
                    <p class="add-user-desc">Indiquez le nom, prenom et nom d’utilisateur ainsi qu’une premiére plaque.
                    </p>
                </div>
                <div class="csv-user user-btn">
                    <img src="imgs/svg/csv-icon.svg" alt="Icone d'ajout d'utilisateur">
                    <h2 class="csv-user-heading">Ajouter via csv</h2>
                    <p class="csv-user-desc">Ajouter des plaques via un fichier .csv</p>
                </div>
            </div>
            <div class="users-list">
                <h2>UTILISATEUR</h2>
                <table>
                    <tr class="table-header">
                        <th>Username</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Groupe</th>
                        <th></th>
                    </tr>
                    <?php

                    $curl = curl_init();
                    $url = 'http://f802cccc-d0d4-4a92-a4a7-9d99442afcff.mock.pstmn.io/utilisateurs';

                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($curl);

                    if ($e = curl_error($curl)) {
                        echo $e;
                    } else {
                        $json = json_decode($response, true);
                        foreach ($json['result'] as $key => $value) {
                            echo '<tr class="table-row">';
                            echo '<td>' . $json['result'][$key]['username'] . '</td>';
                            echo '<td>' . $json['result'][$key]['firstname'] . '</td>';
                            echo '<td>' . $json['result'][$key]['lastname'] . '</td>';
                            echo '<td>' . $json['result'][$key]['perm'] . '</td>';
                            echo '<td><div class="table-img"><img class="arrow-ico nClick table-ico" src="imgs/svg/arrow-icon.svg" alt="Flêche d\'éxtention"><img class="edit-ico table-ico" src="imgs/svg/edit-ico.svg" alt="Boutton modifier"><img class="trash-ico table-ico" src="imgs/svg/trash-ico.svg" alt="Boutton supprimer"></div></td></tr>';
                        }
                    }
                    curl_close($curl);
                    ?>
                    <table class="extended hide">
                        <tr>
                            <th>Numéro de plaque </th>
                            <th>Derniére utilisation</th>
                            <th></th>
                        </tr>
                        <tr class="table-extended">
                            <td></td>
                            <td></td>
                            <td>
                                <div class="table-img">
                                    <img class="edit-ico table-ico edit-plate" src="imgs/svg/edit-ico.svg" alt="Boutton modifier">
                                    <img class="trash-ico table-ico del-plate" src="imgs/svg/trash-ico.svg" alt="Boutton supprimer">
                                </div>
                            </td>
                        </tr>
                    </table>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="modal">
        <div class="modal-body">

        </div>
    </div>
    <div id="overlay"></div>
    <script src="js/dashboard.js"></script>
</body>

</html>
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
            <div class="table">
                <?php

                $username = 'djboss';

                $curl = curl_init();
                $url = 'http://51.210.151.13/btssnir/projets2022/easyportal/api/utilisateur.php?username=' . $username;

                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($curl);
                if ($e = curl_error($curl)) {
                    echo $e;
                } else {
                    $json = json_decode($response, true);
                    foreach ($json['result'] as $key => $value) {
                        foreach ($json['result'][$key]['plates'] as $key2 => $val) {
                            echo '<div class="tr nex table-row">';
                            echo '<div class = "plate-number cell">' . $val['plateNumber'] . '</div>';
                            // echo '<div class = "cell">21/06/2022 10h34</div>';
                            echo '<div class = "cell">
                                    <div class="table-img">
                                        <img class="edit-ico table-ico" src="images/svg/edit-ico.svg" alt="Boutton modifier">
                                        <img class="trash-ico table-ico" src="images/svg/trash-ico.svg" alt="Boutton supprimer">
                                    </div>
                                </div>
                            </div>';
                        }
                        echo '</div>';
                    }
                }

                curl_close($curl);
                ?>
            </div>
            <div class="plate-add">AJOUTER UNE PLAQUE</div>
        </div>
    </div>
    <script>
        /* ICONE MODIFICATION*/
        var editIcones = document.querySelectorAll(".edit-ico")
        console.log(editIcones)
        editIcones.forEach((editIcon) => {
            editIcon.addEventListener('click', () => {
                var editRow = editIcon.parentElement.parentElement.parentElement
                var editRowContent = editIcon.parentElement.parentElement.parentElement.innerHTML
                let previousText = editIcon.parentElement.parentElement.previousElementSibling.textContent
                editIcon.parentElement.parentElement.parentElement.innerHTML = '<div class = "plate-number cell"><input type="text" name="Plate" class="edit-plate" placeholder="' + previousText + '" value="' + previousText + '"></div><div class = "cell"><div class="table-img"><img class="check-ico table-ico" src="images/svg/check-icon.svg" alt="Boutton modifier"></div></div>'
                document.querySelector(".edit-plate").focus()

                document.querySelector(".check-ico").addEventListener('click', async () => {
                    let newVal = document.querySelector(".edit-plate").value;
                    let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/modifierPlaque.php?platenumber=' + previousText + '&newplatenumber=' + newVal)
                    let data = await response.json()
                    console.log(data)
                    if (data.success == true) {
                        document.querySelector(".check-ico").parentElement.parentElement.parentElement.innerHTML = editRowContent
                        editRow.firstChild.childNodes[0].data = newVal
                        editIcones = document.querySelectorAll(".edit-ico")
                        console.log(editIcones)
                    }
                })
            })
        })
    </script>
</body>

</html>
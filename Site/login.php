<?php
if (isset($_GET['username'], $_GET['password'])) {

    $curl = curl_init();
    $url = 'http://51.210.151.13/btssnir/projets2022/easyportal/api/connexion.php?username=' . $_GET['username'] . '&password=' . $_GET['password'];

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    if ($e = curl_error($curl)) {
        echo $e;
    } else {
        $json = json_decode($response, true);
        // var_dump($json);
        if ($json['success'] == true) {
            if ($json['status'] == '2') {
                session_start();
                $_SESSION['username'] = $_GET['username'];
                header('Location:http://51.210.151.13/btssnir/projets2022/easyportal/site/dashboard.php');
            } elseif ($json['status'] == '1') {
                session_start();
                $_SESSION['username'] = $_GET['username'];
                header('Location:http://51.210.151.13/btssnir/projets2022/easyportal/site/user.php');
            } else {
                $access = false;
            }
        } else {
            $success = false;
        }
    }

    curl_close($curl);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyPortal - Dashboard</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="content">
        <div class="login">
            <h1>EasyPortal</h1>
            <form class="form">
                <h2>LOGIN</h2>
                <input type="text" name="username" class="log-user" placeholder="Username" value="<?php if (isset($_GET['username'])) {
                                                                                                        echo $_GET['username'];
                                                                                                    } else {
                                                                                                        echo '';
                                                                                                    } ?>">
                <input type="password" name="password" class="log-pswd" placeholder="Password" value="<?php if (isset($_GET['password'])) {
                                                                                                            echo $_GET['password'];
                                                                                                        } else {
                                                                                                            echo '';
                                                                                                        } ?>">
                <span class="error"></span>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
    <?php if ($json['success'] == false) {
        echo '<script>
        document.querySelector(".error").innerHTML ="' . $json['message'] . '"
        document.querySelector(".error").classList.add("show")
        </script>';
    }

    if ($json['status'] == '0') {
        echo '<script>
        document.querySelector(".error").innerHTML ="Vôtre accés est bloqué"
        document.querySelector(".error").classList.add("show")
        </script>';
    }
    ?>
</body>

</html>
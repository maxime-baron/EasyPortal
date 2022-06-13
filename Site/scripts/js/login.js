form = document.querySelector('form')
username = document.querySelector('.log-user')
password = document.querySelector('.log-pswd')

form.addEventListener("submit", (e) => {
    e.preventDefault()
    console.log("test");

    fetch('traitementLogin.php?username=' + username.value + '&password=' + password.value)
        .then((response) => response.json())
        .then(data => {
            data.success ? data.status == "user" ? location.href = "user.php" : location.href = "dashboard.php" : console.log("Wrong pass");
        });
})
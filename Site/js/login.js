form = document.querySelector('form')
username = document.querySelector('.log-user')
password = document.querySelector('.log-pswd')

form.addEventListener("submit", (e) => {
    e.preventDefault()
    console.log("test");

    fetch('login.php?username=' + username.value + '&password=' + password.value).then((response) => console.log(response.text()));
})
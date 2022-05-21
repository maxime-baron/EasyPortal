const openButton = document.querySelector('.open-button');
const addUser = document.querySelector('.add-user');
const addCSV = document.querySelector('.csv-user');
const modal = document.querySelector('#modal');
const modalBody = document.querySelector('.modal-body');

openButton.addEventListener("click", () => {
    fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/open.php?username=' + username)
        .then((response) => response.json())
        .then(data => {
            console.log(data)
        });
    console.log("Ouverture")
})

addUser.addEventListener("click", () => {
    console.log("Ajout d'un utilisateur");
    modalBody.innerHTML = '<h2 class="modal-header-title">Ajouter un utilisateur</h2><form action="" method="" class="addUser"><input type="text" name="username" id="usernameInput" placeholder="Username"><input type="text" name="prénom" id="firstNameInput" placeholder="Prénom"><input type="text" name="nom" id="lastNameInput" placeholder="Nom"><input type="text" name="" id="roleInput" placeholder="Rôle"><span class="formError">Erreur</span><input type="submit" value="Enregistrer"></form>';
    /* CONSTANTE DU FORMULAIRE*/
    const formAdd = document.querySelector('.addUser')
    const formAddUsername = document.querySelector('#usernameInput');
    const formAddFirstName = document.querySelector('#firstNameInput');
    const formAddLastName = document.querySelector('#lastNameInput');
    const formAddPerm = document.querySelector('#roleInput');

    formAdd.addEventListener('submit', (e) => {
        e.preventDefault()
        fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/ajouterUtilisateur.php?username=' + formAddUsername.value + '&firstname=' + formAddFirstName.value + '&lastname=' + formAddLastName.value + '&perm=' + formAddPerm.value + '&password=' + genere_mdp(4, true, true, true))
            .then((response) => response.json())
            .then(data => {
                console.log(data)
                if (data.success == true) {
                    document.querySelector(".formError").classList.remove("err")
                    modal.style.background = "white"
                    window.setTimeout(() => {
                        modalBody.innerHTML = '<img src="https://c.tenor.com/Hw7f-4l0zgEAAAAC/check-green.gif" alt="Checked">';
                        window.setTimeout(() => {
                            modalBody.innerHTML = '';
                            modal.style.background = "#E2F1F7"
                            closeModal(modal)
                            modal.classList.remove("access")
                        }, 1700)
                    }, 200)
                } else {
                    document.querySelector(".formError").classList.add("err")
                }
            });
    })
    openModal(modal)
})

addCSV.addEventListener("click", () => {
    console.log("Ajout via CSV")
    modalBody.innerHTML = '<h2 class="modal-header-title">Ajouter via fichier CSV</h2><form action="" method="" class="addUserCSV"><input type="file" name="csv" id="inputAddCSV" accept=".csv"><span class="formError">Erreur</span><input type="submit" value="Ajouter"></form>';
    /* CONSTANTE DU FORMULAIRE*/
    const formAddCSV = document.querySelector('.addUserCSV')
    const inputAddCSV = document.querySelector('#inputAddCSV');
    formAddCSV.addEventListener('submit', async (e) => {
        e.preventDefault()
        console.log(inputAddCSV.value)
        Papa.parse(inputAddCSV.files[0], {
            complete: async function (results) {
                let done = 0;
                for (element of results.data) {
                    let addCSVUser = element[0]
                    let addCSVFirstName = element[1]
                    let addCSVLastName = element[2]
                    let addCSVPerm = element[3]

                    console.log(element);

                    let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/ajouterUtilisateur.php?username=' + addCSVUser + '&firstname=' + addCSVFirstName + '&lastname=' + addCSVLastName + '&perm=' + addCSVPerm + '&password=' + genere_mdp(4, true, true, true))
                    let data = await response.json()
                    console.log(data)
                    if (data.success == true) {
                        done++
                    }

                    if (done == results.data.length) {
                        document.querySelector(".formError").classList.remove("err")
                        modal.style.background = "white"
                        window.setTimeout(() => {
                            modalBody.innerHTML = '<img src="https://c.tenor.com/Hw7f-4l0zgEAAAAC/check-green.gif" alt="Checked">';
                            window.setTimeout(() => {
                                modalBody.innerHTML = '';
                                modal.style.background = "#E2F1F7"
                                closeModal(modal)
                                modal.classList.remove("access")
                            }, 1700)
                        }, 200)
                    }
                };

            }
        });
    })
    openModal(modal)
})

overlay.addEventListener('click', () => {
    const modals = document.querySelectorAll('.modal.active')
    modals.forEach(modal => {
        closeModal(modal)
    })
})

function openModal(modal) {
    if (modal == null) return
    modal.classList.add('active')
    overlay.classList.add('active')
}

function closeModal(modal) {
    if (modal == null) return
    modal.classList.remove('active')
    overlay.classList.remove('active')
}

const extendArrows = document.querySelectorAll('.nClick')
extendArrows.forEach((extendArrow) => {
    extendArrow.addEventListener('click', () => {
        console.log("extend")
        if (extendArrow.classList.contains("nClick")) {
            extendArrow.classList.replace("nClick", "click")
            extendArrow.parentElement.parentElement.parentElement.nextElementSibling.classList.remove("hide")
        } else {
            extendArrow.classList.replace("click", "nClick")
            extendArrow.parentElement.parentElement.parentElement.nextElementSibling.classList.add("hide")
        }
    })
})

/* MENU RESPONSIVE*/
const menuOpen = document.querySelector(".menu-open")
const menuClose = document.querySelector(".menu-close")
const menu = document.querySelector(".menu")

window.onload = () => {
    menu.style.transform = "translate(" + menu.clientWidth + "px)"
}

window.onresize = () => {
    menu.style.transform = "translate(" + menu.clientWidth + "px)"
}

menuOpen.addEventListener("click", () => {
    menu.style.transform = "translate(0px)"
    menuClose.style.transformOrigin = "50% 50%"
    menuClose.style.transform = "rotateZ(720deg)"
})

menuClose.addEventListener("click", () => {
    console.log(menu.clientWidth)
    menu.style.transform = "translate(" + menu.clientWidth + "px)"
    menuClose.style.transformOrigin = "50% 50%"
    menuClose.style.transform = "rotateZ(-720deg)"
})

function genere_mdp(nombreCaracteres, activateMAJ, activateMin, activateNumber) {
    var array = "", rand_pass = "";
    if (activateMAJ) {
        array += "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
    if (activateMin) {
        array += "abcdefghijklmnopqrstuvwxyz";
    }
    if (activateNumber) {
        array += "01234567890123456789";
        // On répète 2 fois les chiffres sinon ils sortent rarement
    }
    for (var i = 0; i < nombreCaracteres; i++) {
        rand_pass += array[Math.floor(Math.random() * array.length)];
    }
    return rand_pass;
}

let click = true
/* ICONE MODIFICATION USER*/
document.body.addEventListener("click", (e) => {
    if (e.target.classList.contains("pswd")) {

        if (click == true) {
            e.target.style.filter = "blur(0px)"
            click = false
        } else {
            e.target.style.filter = "blur(3px)"
            click = true
        }
    }
})
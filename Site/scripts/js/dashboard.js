const openButton = document.querySelector('.open-button');
const exportButton = document.querySelector('.export');
const addUser = document.querySelector('.add-user');
const addCSV = document.querySelector('.csv-user');
const modal = document.querySelector('#modal');
const modalBody = document.querySelector('.modal-body');

/* BOUTON OUVRIR */
openButton.addEventListener("click", () => {
    fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/open.php?username=' + username)
        .then((response) => response.json())
        .then(data => {
            console.log(data)
        });
    console.log("Ouverture")
})
/* BOUTON EXPORT */
exportButton.addEventListener("click", () => {
    fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/utilisateurs.php')
        .then((response) => response.json())
        .then(data => {
            // let user = Papa.unparse(data.result, { header: true })
            // console.log(data.result)


            for (var i in data.result) {
                // result.push([i]);
                // result[i].shift();
                console.log(data.result[i].plates.length);
                data.result[i].plates = "";
                for (let y = 0; y < data.result[i].plates.length; y++) {
                    console.log(data.result[i].plates[y].plateNumber);
                    if (y < data.result[i].plates.length - 1) {
                        data.result[i].plates += data.result[i].plates[y].plateNumber + ",";
                    } else {
                        data.result[i].plates += data.result[i].plates[y].plateNumber;
                    }
                }
            }


            console.log(data.result);

            // let plates = Papa.unparse(data.result.plates)
            // console.log(plates);

            let blob = new Blob([user], { type: "octet-stream" })
            let href = URL.createObjectURL(blob);
            Object.assign

            let a = Object.assign(document.createElement("a"), {
                href,
                style: "display:none",
                download: "users.csv",
            })
            document.body.appendChild(a);
            a.click();
            URL.revokeObjectURL(href)
            a.remove();
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
        fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/ajouterUtilisateur.php?username=' + formAddUsername.value + '&firstname=' + formAddFirstName.value + '&lastname=' + formAddLastName.value + '&perm=' + formAddPerm.value)
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

                    let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/ajouterUtilisateur.php?username=' + addCSVUser + '&firstname=' + addCSVFirstName + '&lastname=' + addCSVLastName + '&perm=' + addCSVPerm)
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
    menu.style.transformOrigin = "right"
    menu.style.transform = "scaleX(0)"
}

window.onresize = () => {
    menu.style.transformOrigin = "right"
    menu.style.transform = "scaleX(0)"
}

menuOpen.addEventListener("click", () => {
    menu.style.transformOrigin = "right"
    menu.style.transform = "scaleX(1)"
    menuClose.style.transformOrigin = "50% 50%"
    menuClose.style.transform = "rotateZ(720deg)"
})

menuClose.addEventListener("click", () => {
    console.log(menu.clientWidth)
    menu.style.transformOrigin = "right"
    menu.style.transform = "scaleX(0)"
    menuClose.style.transformOrigin = "50% 50%"
    menuClose.style.transform = "rotateZ(-720deg)"
})


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
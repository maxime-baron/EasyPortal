const openButton = document.querySelector('.open-button');
const addUser = document.querySelector('.add-user');
const addCSV = document.querySelector('.csv-user');
const modal = document.querySelector('#modal');
const modalBody = document.querySelector('.modal-body');

openButton.addEventListener("click", () => {
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
        fetch('https://0d5987d2-70b7-4a7d-a8bd-6ee8c8d649dc.mock.pstmn.io/ajouterUtilisateur?username=' + formAddUsername.value + '&firtName=' + formAddFirstName.value + '&lastName=' + formAddLastName.value + '&perm=' + formAddPerm.value)
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

                    let response = await fetch('https://0d5987d2-70b7-4a7d-a8bd-6ee8c8d649dc.mock.pstmn.io/ajouterUtilisateur?username=' + addCSVUser + '&firtName=' + addCSVFirstName + '&lastName=' + addCSVLastName + '&perm=' + addCSVPerm)
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
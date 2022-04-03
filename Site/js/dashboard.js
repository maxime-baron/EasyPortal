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
    modalBody.innerHTML = '<h2 class="modal-header-title">Ajouter un utilisateur</h2><form action="" method="" class="addUser"><input type="text" name="username" id="username-intp" placeholder="Username"><input type="text" name="prénom" id="firstName-inpt" placeholder="Prénom"><input type="text" name="nom" id="lastName-inpt" placeholder="Nom"><input type="password" name="" id="password-inpt" placeholder="password"><input type="submit" value="Enregistrer"></form>';
    openModal(modal)
})

addCSV.addEventListener("click", () => {
    console.log("Ajout via CSV")
    modalBody.innerHTML = ''
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
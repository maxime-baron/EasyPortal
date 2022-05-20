/* ICONE MODIFICATION PLAQUE*/
document.body.addEventListener("click", (e) => {
    if (e.target.classList.contains("edit-ico") && e.target.classList.contains("edit-plate")) {
        var editRow = e.target.parentElement.parentElement.parentElement
        var editRowContent = e.target.parentElement.parentElement.parentElement.innerHTML
        let previousText = e.target.parentElement.parentElement.previousElementSibling.previousElementSibling.textContent
        e.target.parentElement.parentElement.parentElement.style.justifyContent = "space between"
        e.target.parentElement.parentElement.parentElement.innerHTML = '<div class = "plate-number cell"><input type="text" name="Plate" class="edit-plate" placeholder="' + previousText + '" value="' + previousText + '"></div><div class = "cell"><div class="table-img"><img class="check-ico table-ico" src="images/svg/check-icon.svg" alt="Boutton modifier"></div></div>'
        document.querySelector(".edit-plate").focus()

        document.querySelector(".check-ico").addEventListener('click', async () => {
            let newVal = document.querySelector(".edit-plate").value;
            let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/modifierPlaque.php?platenumber=' + previousText + '&newplatenumber=' + newVal)
            let data = await response.json()
            console.log(data)
            if (data.success == true) {
                document.querySelector(".check-ico").parentElement.parentElement.parentElement.innerHTML = editRowContent
                editRow.firstChild.childNodes[0].data = newVal
                // editIcones = document.querySelectorAll(".edit-ico")
                // editIcones.addEventListener('click');
                // console.log(editIcones)
            }
        })
    }
})

/* ICONE SUPPRESSION PLAQUE*/
document.body.addEventListener("click", (e) => {
    if (e.target.classList.contains("trash-ico") && e.target.classList.contains("del-plate")) {
        var editRow = e.target.parentElement.parentElement.parentElement
        var editRowContent = e.target.parentElement.parentElement.parentElement.lastChild.innerHTML
        let previousText = e.target.parentElement.parentElement.previousElementSibling.previousElementSibling.textContent
        e.target.parentElement.parentElement.parentElement.style.justifyContent = "space between"
        e.target.parentElement.parentElement.parentElement.lastChild.innerHTML = '<div class="table-img"><img class="check-ico table-ico" src="images/svg/check-icon.svg" alt="Boutton modifier"><img class="cancel-ico table-ico" src="images/svg/cancel-ico.svg" alt="Boutton annuler"></div>'

        document.querySelector(".check-ico").addEventListener('click', async () => {
            let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/supprimerPlaque.php?platenumber=' + previousText)
            let data = await response.json()
            console.log(data)
            if (data.success == true) {
                document.querySelector(".check-ico").parentNode.parentNode.parentNode.remove()
            }
        })

        document.querySelector(".cancel-ico").addEventListener('click', () => {
            document.querySelector(".cancel-ico").parentNode.parentNode.innerHTML = editRowContent;
        })
    }
})

/* ICONE MODIFICATION USER*/
document.body.addEventListener("click", (e) => {
    if (e.target.classList.contains("edit-ico") && e.target.classList.contains("edit-plate") == false) {
        var editRow = e.target.parentElement.parentElement.parentElement
        var headerRow = e.target.parentElement.parentElement.parentElement.previousElementSibling.innerHTML
        var editRowContent = e.target.parentElement.parentElement.parentElement.innerHTML
        let username = editRow.children[0].textContent
        e.target.parentElement.parentElement.parentElement.previousElementSibling.children[1].remove()
        e.target.parentElement.parentElement.parentElement.style.justifyContent = "space between"
        e.target.parentElement.parentElement.parentElement.innerHTML = '<div class="cell"><input type="text" name="Username" class="edit-inpt edit-user" placeholder="' + editRow.children[0].textContent + '" value="' + editRow.children[0].textContent + '"></div><div class="cell"><input type="text" name="Nom" class="edit-inpt edit-nom" placeholder="' + editRow.children[2].textContent + '" value="' + editRow.children[2].textContent + '"></div><div class="cell"><input type="text" name="Prenom" class="edit-inpt edit-prenom" placeholder="' + editRow.children[3].textContent + '" value="' + editRow.children[3].textContent + '"></div><div class="cell"><input type="text" name="Groupe" class="edit-inpt edit-grp" placeholder="' + editRow.children[4].textContent + '" value="' + editRow.children[4].textContent + '"></div><div class="cell"><div class="table-img"><img class="check-ico table-ico" src="images/svg/check-icon.svg" alt="Boutton modifier"><img class="cancel-ico table-ico" src="images/svg/cancel-ico.svg" alt="Boutton annuler"></div></div>'
        document.querySelector(".edit-user").focus()

        document.querySelector(".check-ico").addEventListener('click', async () => {
            let newUser = document.querySelector(".edit-user").value;
            let nom = document.querySelector(".edit-nom").value;
            let prenom = document.querySelector(".edit-prenom").value;
            let groupe = document.querySelector(".edit-grp").value;
            let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/modifierUtilisateur.php?username=' + username + '&firstname=' + nom + '&lastname=' + prenom + '&perm=' + groupe + '&newUsername=' + newUser)
            let data = await response.json()
            console.log(data)
            if (data.success == true) {
                document.querySelector(".check-ico").parentElement.parentElement.parentElement.previousElementSibling.innerHTML = headerRow
                document.querySelector(".check-ico").parentElement.parentElement.parentElement.innerHTML = editRowContent
                editRow.children[0].textContent = newUser;
                editRow.children[2].textContent = nom;
                editRow.children[3].textContent = prenom;
                editRow.children[4].textContent = groupe;
                // editIcones = document.querySelectorAll(".edit-ico")
                // editIcones.addEventListener('click');
                // console.log(editIcones)
            }
        })

        document.querySelector(".cancel-ico").addEventListener('click', () => {
            document.querySelector(".cancel-ico").parentNode.parentNode.parentNode.previousElementSibling.innerHTML = headerRow
            document.querySelector(".cancel-ico").parentNode.parentNode.parentNode.innerHTML = editRowContent;
        })
    }
})

/* ICONE SUPPRESSION USER*/
document.body.addEventListener("click", (e) => {
    if (e.target.classList.contains("trash-ico") && (e.target.classList.contains("del-plate") == false)) {
        var editRow = e.target.parentElement.parentElement.parentElement
        var editRowContent = e.target.parentElement.parentElement.innerHTML
        let username = e.target.parentElement.parentElement.parentElement.firstChild.textContent
        // e.target.parentElement.parentElement.parentElement.style.justifyContent = "space between"
        e.target.parentElement.parentElement.innerHTML = '<div class="table-img"><img class="check-ico table-ico" src="images/svg/check-icon.svg" alt="Boutton modifier"><img class="cancel-ico table-ico" src="images/svg/cancel-ico.svg" alt="Boutton annuler"></div>'
        // e.target.parentElement.parentElement.parentElement.lastChild.innerHTML = '<div class="tr nex table-row"><div class="cell"><input type="text" name="Username" class="edit-user" placeholder="' + editRow.children[0].textContent + '" value="' + editRow.children[0].textContent + '"></div><div class="cell">' + editRow.children[1].textContent + '"></div><div class="cell"><input type="text" name="Prenom" class="edit-user" placeholder="' + editRow.children[3].textContent + '" value="' + editRow.children[3].textContent + '"></div><div class="cell"><input type="text" name="Prenom" class="edit-user" placeholder="' + editRow.children[4].textContent + '" value="' + editRow.children[4].textContent + '"></div><div class="cell"><div class="table-img"><img class="check-ico table-ico" src="images/svg/check-icon.svg" alt="Boutton modifier"><img class="cancel-ico table-ico" src="images/svg/cancel-ico.svg" alt="Boutton annuler"></div></div></div>'

        document.querySelector(".check-ico").addEventListener('click', async () => {
            let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/supprimerUtilisateur.php?username=' + username)
            let data = await response.json()
            console.log(data)
            if (data.success == true) {
                document.querySelector(".check-ico").parentNode.parentNode.parentNode.nextSibling.remove()
                document.querySelector(".check-ico").parentNode.parentNode.parentNode.remove()
            }
        })

        document.querySelector(".cancel-ico").addEventListener('click', () => {
            document.querySelector(".cancel-ico").parentNode.parentNode.innerHTML = editRowContent;
        })
    }
})
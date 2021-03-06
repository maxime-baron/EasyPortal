/* ICONE MODIFICATION*/
document.body.addEventListener("click", (e) => {
    if (e.target.classList.contains("edit-ico")) {
        var editRow = e.target.parentElement.parentElement.parentElement
        var editRowContent = e.target.parentElement.parentElement.parentElement.innerHTML
        let previousText = e.target.parentElement.parentElement.previousElementSibling.textContent
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

/* ICONE SUPPRESSION*/
document.body.addEventListener("click", (e) => {
    if (e.target.classList.contains("trash-ico")) {
        var editRow = e.target.parentElement.parentElement.parentElement
        var editRowContent = e.target.parentElement.parentElement.parentElement.innerHTML
        let previousText = e.target.parentElement.parentElement.previousElementSibling.textContent
        e.target.parentElement.parentElement.parentElement.innerHTML = '<div class = "plate-number cell">' + previousText + '</div><div class = "cell"><div class="table-img"><img class="check-ico table-ico" src="images/svg/check-icon.svg" alt="Boutton modifier"><img class="cancel-ico table-ico" src="images/svg/cancel-ico.svg" alt="Boutton annuler"></div></div>'

        document.querySelector(".check-ico").addEventListener('click', async () => {
            let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/supprimerPlaque.php?platenumber=' + previousText)
            let data = await response.json()
            console.log(data)
            if (data.success == true) {
                document.querySelector(".check-ico").parentNode.parentNode.parentNode.remove()
            }
        })

        document.querySelector(".cancel-ico").addEventListener('click', () => {
            document.querySelector(".cancel-ico").parentNode.parentNode.parentNode.innerHTML = editRowContent;
        })
    }
})

/* AJT PLAQUE*/
document.body.addEventListener("click", (e) => {
    if (e.target.classList.contains("plate-add")) {
        var table = document.querySelector(".table")

        let div = document.createElement("div");
        div.classList.add("tr", "nex", "table-row")
        let plateNumber = document.createElement("div")
        plateNumber.classList.add("plate-number", "cell")
        let inpt = document.createElement("input")
        inpt.classList.add("edit-plate")
        let icons = document.createElement("div")
        icons.classList.add("cell")
        let tableImg = document.createElement("div")
        tableImg.classList.add("table-img")
        let checkIco = document.createElement("img")
        checkIco.classList.add("check-ico", "table-ico")
        checkIco.setAttribute("src", "images/svg/check-icon.svg")
        checkIco.setAttribute("alt", "Boutton valider")
        let cancelIco = document.createElement("img")
        cancelIco.classList.add("cancel-ico", "table-ico")
        cancelIco.setAttribute("src", "images/svg/cancel-ico.svg")
        cancelIco.setAttribute("alt", "Boutton annuler")
        tableImg.append(checkIco)
        tableImg.append(cancelIco)
        icons.append(tableImg)
        plateNumber.append(inpt)
        div.append(plateNumber, icons)
        table.append(div)
        inpt.focus();

        document.querySelector(".cancel-ico").addEventListener('click', () => {
            div.remove()
        })

        document.querySelector(".check-ico").addEventListener('click', async () => {
            let response = await fetch('http://51.210.151.13/btssnir/projets2022/easyportal/api/ajouterPlaque.php?platenumber=' + inpt.value + '&owner=' + username)
            let data = await response.json()
            console.log(data)
            if (data.success == true) {
                document.querySelector(".check-ico").parentNode.parentNode.previousElementSibling.innerText = inpt.value
                document.querySelector(".check-ico").parentNode.parentNode.innerHTML = '<div class="table-img"><img class="edit-ico table-ico" src="images/svg/edit-ico.svg" alt="Boutton modifier"><img class="trash-ico table-ico" src="images/svg/trash-ico.svg" alt="Boutton supprimer"></div>'
            } else {
                div.remove()
            }
        })
    }
})
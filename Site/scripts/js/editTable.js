/* ICONE MODIFICATION*/
const editIcones = document.querySelectorAll(".edit-ico")
editIcones.forEach((editIcon) => {
    editIcon.addEventListener('click', () => {
        var previousContent = editIcon.parentElement.parentElement.parentElement.innerHTML
        let previousText = editIcon.parentElement.parentElement.previousElementSibling.textContent
        editIcon.parentElement.parentElement.parentElement.innerHTML = '<td class="plate-number"><input type="text" name="Plate" class="edit-plate" placeholder="' + previousText + '" value="' + previousText + '"></td><td><div class="table-img"><img class="check-ico table-ico" src="images/svg/check-icon.svg" alt="Boutton modifier"></div></td>'
        document.querySelector(".edit-plate").focus()
    })
})

document.querySelector(".check-ico").addEventListener('click', async () => {
    editIcon.parentElement.parentElement.parentElement.innerHTML = previousContent
    editIcon.parentElement.parentElement.previousElementSibling.textContent = 
})
function clickImage(x) {
    let openModalButtons = document.querySelectorAll('.film-Image')
    const closeModalButtons = document.querySelectorAll('[data-close-button]')
    const overlay = document.getElementById('overlay')
    const modal = document.querySelector('#modal');
    const btnFav = document.querySelector(".buttonFav")

    openModalButtons.forEach(image => {
        image.addEventListener('click', () => {
            console.log(image.getAttribute("data-d"));
            console.log(x);
            x.forEach(film => {
                if (image.getAttribute("data-d") == film.titre) {
                    document.querySelector('.modal-image').innerHTML = "<img class=\"" + 'modal-Image ' + film.titre + "\" src=" + film.Image + " width='275px' height='420px'>";
                    document.querySelector('.modal-header .title').innerText = film.titre
                    document.querySelector('.modal-film-info-resume').innerHTML = film.resume
                    document.querySelector('.modal-film-info-annee').innerHTML = film.annee
                    document.querySelector('.modal-film-info-genre').innerHTML = film.libelle
                    document.querySelector('.modal-film-info-auteur').innerHTML = film.prenom + ' ' + film.nom
                    openModal(modal)
                }
            });
        })
    })

    overlay.addEventListener('click', () => {
        const modals = document.querySelectorAll('.modal.active')
        modals.forEach(modal => {
            closeModal(modal)
        })
    })

    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal')
            closeModal(modal)
        })
    })

    btnFav.addEventListener('click', () => {
        const xhr = new XMLHttpRequest();
        let title = document.querySelector('.modal-header .title').innerText

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    let rslt = JSON.parse(xhr.responseText);
                    if (rslt[1] == 1062) {
                        console.log("Déja favoris")
                    } else {
                        console.log("Ajouter au favoris")
                    }
                } else
                    console.log(xhr.status);
            }
        }
        xhr.open('POST', './assets/php/film.php?action=fav&title=' + title);
        xhr.send();
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
}
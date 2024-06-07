// Chargement de l'onglet 'formations' au chargement de la page
document.addEventListener("DOMContentLoaded", () => {
    displayFormations(); 
});

// ONGLET FORMATION
function displayFormations() {
    removeDisplay();
    let formationTemplate = document.querySelector('#formation-template');
    let formationClone = formationTemplate.content.cloneNode(true);
    document.querySelector("#display").appendChild(formationClone);

    let addFormations = document.querySelector("#modal-open-add-formation");
    addFormations.addEventListener('click', function () {
        let addFormation = document.querySelector('#add-formation');
        let addFormationClone = addFormation.content.cloneNode(true);
        document.querySelector("#display").appendChild(addFormationClone);

        let closeModal = document.querySelectorAll(".modal-close-add-formation");
        closeModal.forEach(function (closeModal) {
            closeModal.addEventListener('click', function () {
                let closeModal = document.querySelector(".modal-container-add-formation");
                closeModal.remove();
            })
        })
    })
}

let formations = document.querySelector("#button-formations");
formations.addEventListener('click', function (event) {
    handleClick(event);
    displayFormations();
    
})


// ONGLET SECTOR
function displaySectors() {
    removeDisplay();
    let sectorTemplate = document.querySelector('#sector-template');
    let sectorClone = sectorTemplate.content.cloneNode(true);
    document.querySelector("#display").appendChild(sectorClone);

    let addSectors = document.querySelector("#modal-open-add-sector");
    addSectors.addEventListener('click', function () {
        let addSector = document.querySelector('#add-sector');
        let addSectorClone = addSector.content.cloneNode(true);
        document.querySelector("#display").appendChild(addSectorClone);

        let closeModal = document.querySelectorAll(".modal-close-add-sector");
        closeModal.forEach(function (closeModal) {
            closeModal.addEventListener('click', function () {
                let closeModal = document.querySelector(".modal-container-add-sector");
                closeModal.remove();
            })
        })
    })
}

let sectors = document.querySelector("#button-sectors");
sectors.addEventListener('click', function (event) {
    handleClick(event);
    displaySectors();
})


// ONGLET SUBJECT
function displaySubjects() {
    removeDisplay();
    let subjectTemplate = document.querySelector('#subject-template');
    let subjectClone = subjectTemplate.content.cloneNode(true);
    document.querySelector("#display").appendChild(subjectClone);

    let addSubjects = document.querySelector("#modal-open-add-subject");
    addSubjects.addEventListener('click', function () {
        let addSubject = document.querySelector('#add-subject');
        let addSubjectClone = addSubject.content.cloneNode(true);
        document.querySelector("#display").appendChild(addSubjectClone);

        let closeModal = document.querySelectorAll(".modal-close-add-subject");
        closeModal.forEach(function (closeModal) {
            closeModal.addEventListener('click', function () {
                let closeModal = document.querySelector(".modal-container-add-subject");
                closeModal.remove();
            })
        })
    })
}

let subjects = document.querySelector("#button-subjects");
subjects.addEventListener('click', function (event) {
    handleClick(event);
    displaySubjects();
})


// DELETE DISPLAY
function removeDisplay() {
    let remove = document.querySelector('#display');
    remove.innerHTML = '';
}


function removeActiveClass() {
    document.querySelector('#button-formations').classList.remove('active');
    document.querySelector('#button-sectors').classList.remove('active');
    document.querySelector('#button-subjects').classList.remove('active');
}

function handleClick(event) {
    removeActiveClass();
    event.target.classList.add('active');
}
import { ajaxFetch } from "./lib.utils.js";

// Chargement de l'onglet 'formations' au chargement de la page
document.addEventListener("DOMContentLoaded", () => {
    displayFormations(); 
});

function addDeleteEventListener() {
    const container = document.querySelector('#subjects-cards-container');
    if (container) {
        container.addEventListener('click', async function(event) {
            if (event.target.classList.contains('delete-card')) {
                const card = event.target.closest('.card');
                const subjectId = card.getAttribute('data-id');

                const deleteSubject = ajaxFetch('delete-subject', subjectId)
                
                if (deleteSubject) {
                    card.remove();
                    refreshSubject(subjectId);
                } else {
                    alert('Erreur lors de la suppression de la matière.');
                }
            };
        });
    };
};


// ONGLET FORMATION
function displayFormations() {
    removeDisplay();
    const formationTemplate = document.querySelector('#formation-template');
    const formationClone = formationTemplate.content.cloneNode(true);
    document.querySelector("#display").appendChild(formationClone);

    const addFormations = document.querySelector("#modal-open-add-formation");
    addFormations.addEventListener('click', function () {
        const addFormation = document.querySelector('#add-formation');
        const addFormationClone = addFormation.content.cloneNode(true);
        document.querySelector("#display").appendChild(addFormationClone);

        const closeModal = document.querySelectorAll(".modal-close-add-formation");
        closeModal.forEach(function (closeModal) {
            closeModal.addEventListener('click', function () {
                const closeModal = document.querySelector(".modal-container-add-formation");
                closeModal.remove();
            })
        })
    })
}

const formations = document.querySelector("#button-formations");
formations.addEventListener('click', function (event) {
    handleClick(event);
    displayFormations();
    
})


// ONGLET SECTOR
function displaySectors() {
    removeDisplay();
    const sectorTemplate = document.querySelector('#sector-template');
    const sectorClone = sectorTemplate.content.cloneNode(true);
    document.querySelector("#display").appendChild(sectorClone);

    const addSectors = document.querySelector("#modal-open-add-sector");
    addSectors.addEventListener('click', function () {
        const addSector = document.querySelector('#add-sector');
        const addSectorClone = addSector.content.cloneNode(true);
        document.querySelector("#display").appendChild(addSectorClone);

        const closeModal = document.querySelectorAll(".modal-close-add-sector");
        closeModal.forEach(function (closeModal) {
            closeModal.addEventListener('click', function () {
                const closeModal = document.querySelector(".modal-container-add-sector");
                closeModal.remove();
            })
        })
    })
}

const sectors = document.querySelector("#button-sectors");
sectors.addEventListener('click', function (event) {
    handleClick(event);
    displaySectors();
})


// ONGLET SUBJECT
function displaySubjects() {
    removeDisplay();
    const subjectTemplate = document.querySelector('#subject-template');
    const subjectClone = subjectTemplate.content.cloneNode(true);
    document.querySelector("#display").appendChild(subjectClone);

    const addSubjects = document.querySelector("#modal-open-add-subject");
    addSubjects.addEventListener('click', function () {
        const addSubject = document.querySelector('#add-subject');
        const addSubjectClone = addSubject.content.cloneNode(true);
        document.querySelector("#display").appendChild(addSubjectClone);

        const closeModal = document.querySelectorAll(".modal-close-add-subject");
        closeModal.forEach(function (closeModal) {
            closeModal.addEventListener('click', function () {
                const closeModal = document.querySelector(".modal-container-add-subject");
                closeModal.remove();
            })
        })
    })
    addDeleteEventListener();
}

const subjects = document.querySelector("#button-subjects");
subjects.addEventListener('click', function (event) {
    handleClick(event);
    displaySubjects();
    refreshSubjects();
})


// DELETE DISPLAY
function removeDisplay() {
    const remove = document.querySelector('#display');
    remove.innerHTML = '';
}


// MISE EN EVIDENCE DE L'ONGLET ACTUEL
function removeActiveClass() {
    document.querySelector('#button-formations').classList.remove('active');
    document.querySelector('#button-sectors').classList.remove('active');
    document.querySelector('#button-subjects').classList.remove('active');
}

function handleClick(event) {
    removeActiveClass();
    event.target.classList.add('active');
}
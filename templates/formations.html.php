<div class="page-containt">
    <div class="page-header">
        <h1 class="page-title"><?= $title ?></h1>
    </div>

    <div class="tab">
        <button id="button-formations" class="active">Formations</button>
        <button id="button-sectors">Secteurs</button>
        <button id="button-subjects">Matières</button>
    </div>

    <template id="formation-template">
        <div id="formations-cards-container">
            <div id="modal-open-add-formation" class="add-card">
                <img src="assets/img/plus-solid.svg" alt="Ajouter une formation">
                <p>Ajouter une formation</p>
            </div>
            <?php if (!empty($formations)) : ?>
                <?php foreach ($formations as $indice => $formationsCard) : ?>
                    <div class="card">
                        <div class="header">
                            <h4><?= $formationsCard['formation_name'] ?></h4>
                        </div>

                        <div class="main">
                            <?= $formationsCard['sector_name'] ?? '' ?>
                        </div>

                        <div class="footer">
                            <a href="/?page=formations-details&formations_details_id=<?= $formationsCard['formation_id'] ?>"><img src="assets/img/chevron-right-solid.svg" alt="Voir plus">Voir plus</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </template>

    <template id="sector-template">
        <div id="sectors-cards-container">
            <div id="modal-open-add-sector" class="add-card">
                <img src="assets/img/plus-solid.svg" alt="Ajouter un secteur">
                <p>Ajouter un secteur</p>
            </div>
            <?php if (!empty($sectors)) : ?>
                <?php foreach ($sectors as $indice => $sectorsCard) : ?>
                    <div class="card" data-id="<?= $sectorsCard['sector_id'] ?>">
                        <div class="header">
                            <h4><?= $sectorsCard['sector_name'] ?></h4>
                        </div>
                        <button class="edit-card">Modifier</button>
                        <button class="delete-card">Supprimer</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </template>

    <template id="subject-template">
        <div id="subjects-cards-container">
            <div id="modal-open-add-subject" class="add-card">
                <img src="assets/img/plus-solid.svg" alt="Ajouter une matière">
                <p>Ajouter une matière</p>
            </div>
            <?php if (!empty($subjects)) : ?>
                <?php foreach ($subjects as $indice => $subjectsCard) : ?>
                    <div class="card" data-id="<?= $subjectsCard['subject_id'] ?>">
                        <div class="header">
                            <h4><?= $subjectsCard['subject_name'] ?></h4>
                        </div>
                        <button class="edit-card">Modifier</button>
                        <button class="delete-card">Supprimer</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </template>

    <div id="display">

    </div>
    
    <template id="add-formation">
        <div class="modal-container-add-formation">
            <div class="overlay modal-close-add-formation"></div>
            <div class="modal">
                <div class="modal-header">
                    <p>Ajouter une formation</p>
                    <button class="modal-close-add-formation"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
                </div>
                <form method="POST">
                    <label for="name"><img src="assets/img/black-envelope-solid.svg" alt="Nom de la formation">Nom de la formation</label>
                    <input type="text" name="add_name" placeholder="ex: Développeur web">

                    <label for="level"><img src="assets/img/black-user-solid.svg" alt="Niveau de formation">Niveau de la formation</label>
                    <input type="text" name="add_level" placeholder="ex: Bac +2">

                    <label for="duration"><img src="assets/img/black-user-solid.svg" alt="Durée de la formation">Durée de la formation</label>
                    <input type="text" name="add_duration" placeholder="ex: 9 mois">

                    <label for="sector"><img src="assets/img/user-status-solid.svg" alt="Secteur" class="add-sector-img">Secteur</label>
                    <select name="add_sector" class="add-sector">
                        <option value="" disabled selected>Sélectionner un secteur</option>
                        <?php foreach ($sectors as $index) {
                            echo '<option value="' . $index['sector_id'] . '">' . $index['sector_name'] . '</option>';
                        } ?>
                    </select>

                    <button type="submit" name="add_formation_submit" id="add-formation-button">
                        <div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Ajouter" class="add-check-img"></div>Ajouter
                    </button>
                </form>
            </div>
        </div>
    </template>

    <template id="add-sector">
        <div class="modal-container-add-sector">
            <div class="overlay modal-close-add-sector"></div>
            <div class="modal">
                <div class="modal-header">
                    <p>Ajouter un secteur</p>
                    <button class="modal-close-add-sector"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
                </div>
                <form method="POST">
                    <label for="name"><img src="assets/img/black-envelope-solid.svg" alt="Nom de la formation">Nom du secteur</label>
                    <input type="text" name="sector_name" placeholder="ex: Développeur web">
                    <button type="submit" name="add_sector_submit" id="add-sector-button">
                        <div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Ajouter" class="add-check-img"></div>Ajouter
                    </button>
                </form>
            </div>
        </div>
    </template>

    <template id="add-subject">
        <div class="modal-container-add-subject">
            <div class="overlay modal-close-add-subject"></div>
            <div class="modal">
                <div class="modal-header">
                    <p>Ajouter une matière</p>
                    <button class="modal-close-add-subject"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
                </div>
                <form method="POST">
                    <label for="name"><img src="assets/img/black-envelope-solid.svg" alt="Nom de la matière">Nom de la matière</label>
                    <input type="text" name="subject_name" placeholder="ex: PHP">
                    <button type="submit" name="add_subject_submit" id="add-subject-button">
                        <div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Ajouter" class="add-check-img"></div>Ajouter
                    </button>
                </form>
            </div>
        </div>
    </template>

</div>
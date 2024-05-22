<div class="my-account">
    <div class="my-account-left">
        <div class="page-title">
            <h1><?=$title?></h1>
        </div>
        <div class="account-page-containt">
            <div class="account-section">
                <p class="account-label"><img src="assets/img/black-envelope-solid.svg" alt="Email" class="img-label">Email</p>
                <p><?= $userDetails['user_mail'] ?? ''?><button class="modal-trigger-mail"><img src="assets/img/black-edit.svg" alt="Modifier email" class="icon-edit"></button></p>
                <?php if (!empty($_SESSION['edit_mail_user_details'])) : ?>
                    <script type="text/javascript">
                         messageModal("succès","<?= $_SESSION['edit_mail_user_details'] ?>")   
                    </script>
                    <?php unset($_SESSION['edit_mail_user_details']);?>
                <?php endif; ?>
            </div>
            <div class="account-section">
                <p class="account-label"><img src="assets/img/phone-solid.svg" alt="Téléphone" class="img-label">Téléphone</p>
                <p><?= $userDetails['user_phone'] ?? ''?><button class="modal-trigger-phone"><img src="assets/img/black-edit.svg" alt="Modifier téléphone"></button></p>
                <?php if (!empty($_SESSION['edit_phone_user_details'])) : ?>
                    <script type="text/javascript">
                        messageModal("succès","<?= $_SESSION['edit_phone_user_details'] ?>")   
                    </script>
                    <?php unset($_SESSION['edit_phone_user_details']);?>
                <?php endif; ?>
            </div>
            <div class="account-section">
                <p class="account-label"><img src="assets/img/house-solid.svg" alt="Adresse" class="img-label">Adresse</p>
                <p><?= ($userDetails['user_address_number'] . ' ' . $userDetails['user_street'] . ', ' . $userDetails['user_zip_code'] . ' ' . $userDetails['user_city'] . ', ' . $userDetails['user_country']) ?? ''?><button class="modal-trigger-location"><img src="assets/img/black-edit.svg" alt="Modifier adresse" class="icon-edit"></button></p>
                <?php if (isset($_SESSION['edit_location_user_details'])) : ?>
                    <script type="text/javascript">
                        messageModal("succès","<?= $_SESSION['edit_location_user_details'] ?>")   
                    </script>
                    <?php unset($_SESSION['edit_location_user_details']);?>
                <?php endif; ?>
            </div>
            <div>
                <p class="account-label"><img src="assets/img/gender-solid.svg" alt="Genre" class="img-label">Genre</p>
                <div id="edit-gender">
                    <?php if ($userDetails['user_gender'] == 1): ?>
                        <div id="feminine-gender">
                            <input type="radio" id="feminine" name="gender" value="2" disabled />
                            <label for="feminine">Féminin</label>
                        </div>
                        <div id="male-gender">
                          <input type="radio" id="male" name="gender" value="1" checked/>
                          <label for="male">Masculin</label>
                        </div>
                    <?php else:?>
                        <div id="feminine-gender">
                            <input type="radio" id="feminine" name="gender" value="2" checked />
                            <label for="feminine">Féminin</label>
                        </div>
                        <div id="male-gender">
                          <input type="radio" id="male" name="gender" value="1" disabled/>
                          <label for="male">Masculin</label>
                        </div>
                    <?php endif;?>
                    <button class="modal-trigger-gender"><img src="assets/img/black-edit.svg" alt="Modifier genre" class="icon-edit"></button>
                </div>
                <?php if (isset($_SESSION['edit_gender_user_details'])) : ?>
                    <script type="text/javascript">
                        messageModal("succès","<?= $_SESSION['edit_gender_user_details'] ?>")   
                    </script>
                    <?php unset($_SESSION['edit_gender_user_details']);?>
                <?php endif; ?>
            </div>
            <?php if (!empty($errors)) : ?>
                <script type="text/javascript">
                    console.log($errors);
                    messageModal("erreur","<?= $errors?>")   
                </script>
            <?php endif;?>
        </div>
    </div>
    <div class="my-account-right">
        <div class="my-account-right-header">
            <div class="profil-picture">
                <p id="initials"><?= $initials ?></p>
            </div>
            <div id="name-user-details">
                <p id="name"><?= $userDetails['user_firstname'] . ' ' . $userDetails['user_lastname'] ?><button class="modal-trigger-name"><img src="assets/img/black-edit.svg"     alt="Modifier nom"></button></p>
                <?php if (!empty($_SESSION['edit_name_user_details'])) :?>
                    <script type="text/javascript">
                        messageModal("succès","<?= $_SESSION['edit_name_user_details'] ?>")   
                    </script>
                    <?php unset($_SESSION['edit_name_user_details']);?>
                <?php endif; ?>
                <p><?= ($userDetails['user_gender'] == 1) ? $userDetails['status_male_name'] : $userDetails['status_female_name']?><button class="modal-trigger-status"><img src="assets/img/black-edit.svg" alt="Modifier statut"></button></p>
                <?php if (!empty($_SESSION['edit_status_user_details'])) :?>
                    <script type="text/javascript">
                        messageModal("succès","<?= $_SESSION['edit_status_user_details'] ?>")   
                    </script>
                    <?php unset($_SESSION['edit_status_user_details']);?>
                <?php endif; ?>
            </div>
        </div>

        <div class="my-account-right-footer">
            <div class="user-details-link">
                <a href=""><img src="assets/img/calendar-solid.svg" alt="Planning">Planning</a>
            </div>
            <div class="user-details-link">
                <a href=""><img src="assets/img/clock-solid.svg" alt="Retards">Retards</a>
            </div>
            <div class="user-details-link">
                <a href=""><img src="assets/img/square-xmark-solid.svg" alt="Absences">Absences</a>
            </div>
            
            <div class="modal-trigger-archive" id="archive">
                <p><img src="assets/img/box-archive-solid.svg" alt="Archiver">Archiver</p>
            </div>
        </div>
    </div>

<!--------------------------------------------------------------------------------------------------------------------------->

<!--Edit mail-->
    <div class="modal-container-mail">
        <div class="overlay modal-trigger-mail"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Email</p>
                <button class="modal-trigger-mail"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="email"><img src="assets/img/black-envelope-solid.svg" alt="Nouveau numéro">Nouvel Email</label>
                <input type="mail" name="edit_mail_user_details" value="<?= $userDetails['user_mail']?>">
                <button type="submit" name="edit_mail_user_details_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit phone-->
    <div class="modal-container-phone">
        <div class="overlay modal-trigger-phone"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Téléphone</p>
                <button class="modal-trigger-phone"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="phone"><img src="assets/img/phone-solid.svg" alt="Nouveau numéro">Nouveau numéro</label>
                <input type="text" name="edit_phone_user_details" value="<?= $userDetails['user_phone']?>">
                <button type="submit" name="edit_phone_user_details_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit location-->
    <div class="modal-container-location">
        <div class="overlay modal-trigger-location"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Adresse</p>
                <button class="modal-trigger-location"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="location"><img src="assets/img/house-solid.svg" alt="Nouveau numéro">Nouvelle adresse</label>
                <div class="edit-location">
                    <input type="text" id="number" name="edit_address_number_user_details" value="<?= $userDetails['user_address_number']?>">
                    <input type="text" id="street" name="edit_street_user_details" value="<?= $userDetails['user_street']?>">
                    <input type="text" id="zip-code" name="edit_zip_code_user_details" value="<?= $userDetails['user_zip_code']?>">
                    <input type="text" id="city" name="edit_city_user_details" value="<?= $userDetails['user_city']?>">
                    <input type="text" id="country" name="edit_country_user_details" value="<?= $userDetails['user_country']?>">
                </div>
                <button type="submit" name="edit_location_user_details_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit gender-->
    <div class="modal-container-gender">
        <div class="overlay modal-trigger-gender"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Genre</p>
                <button class="modal-trigger-gender"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <div class="modal-edit-gender">
                    <?php if ($userDetails['user_gender'] == 1): ?>
                            <div id="feminine-gender">
                                <input type="radio" id="feminine" name="edit_gender_user_details" value="2" />
                                <label for="feminine">Féminin</label>
                            </div>
                            <div id="male-gender">
                              <input type="radio" id="male" name="edit_gender_user_details" value="1" checked/>
                              <label for="male">Masculin</label>
                            </div>
                    <?php elseif ($userDetails['user_gender'] == 2):?>
                        <div id="feminine-gender">
                            <input type="radio" id="feminine" name="edit_gender_user_details" value="2" checked />
                            <label for="feminine">Féminin</label>
                        </div>
                        <div id="male-gender">
                          <input type="radio" id="male" name="edit_gender_user_details" value="1"/>
                          <label for="male">Masculin</label>
                        </div>
                    <?php endif;?>
                </div>
                <button type="submit" name="edit_gender_user_details_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit name-->
    <div class="modal-container-name">
        <div class="overlay modal-trigger-name"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Nom</p>
                <button class="modal-trigger-name"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                
                <label for="lastname"><img src="assets/img/black-user-solid.svg" alt="Nom">Nom</label>
                <input type="text" name="edit_lastname" value="<?= $userDetails['user_lastname']?>">
            
                <label for="firstname"><img src="assets/img/black-user-solid.svg" alt="Prénom">Prénom</label>
                <input type="text" name="edit_firstname" value="<?= $userDetails['user_firstname']?>">
    
                <button type="submit" name="edit_name_user_details_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit status-->
    <div class="modal-container-status">
        <div class="overlay modal-trigger-status"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Statut</p>
                <button class="modal-trigger-status"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="status"><img src="assets/img/user-status-solid.svg" alt="Statut" id="add-status-img">Statut</label>
                <select name="edit_status" id="add-status">
                    <option value="" disabled selected>Sélectionner un statut</option>
                    <option value="1">Candidat</option>
                    <option value="2">Stagiaire</option>
                    <option value="3">Intervenant</option>
                    <option value="4">Assistant administratif</option>
                    <option value="5">Responsable formation</option>
                    <option value="6">Responsable vie scolaire</option>
                    <option value="7">Responsable d'établissement</option>
                </select>
                <button type="submit" name="edit_status_user_details_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--confirm archive-->
    <div class="modal-container-archive">
        <div class="overlay modal-trigger-archive"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Archiver</p>
                <button class="modal-trigger-archive"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <p>Etes-vous sûre de vouloir archiver l'utilisateur?</p>
                <button type="submit" name="archive_user_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="archiver" class="update-user-check-img"></div>Archiver</button>
            </form>
        </div>
    </div>
</div>
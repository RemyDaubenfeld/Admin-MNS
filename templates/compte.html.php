<div class="my-account">
    <div class="my-account-left">
        <div class="page-title">
            <h1>Mon compte</h1>
        </div>
        <div class="account-page-containt">
            <div class="account-section">
                <p class="account-label"><img src="assets/img/black-envelope-solid.svg" alt="Email" class="img-label">Email</p>
                <p><?php echo $user['user_mail'] ?? ''?><button class="modal-trigger-mail"><img src="assets/img/black-edit.svg" alt="Modifier email" class="icon-edit"></button></p>
            </div>
            <div class="account-section">
                <p class="account-label"><img src="assets/img/phone-solid.svg" alt="Téléphone" class="img-label">Téléphone</p>
                <p><?php echo $user['user_phone'] ?? ''?><button class="modal-trigger-phone"><img src="assets/img/black-edit.svg" alt="Modifier téléphone"></button></p>
            </div>
            <div class="account-section">
                <p class="account-label"><img src="assets/img/house-solid.svg" alt="Adresse" class="img-label">Adresse</p>
                <p><?php echo ($user['user_address_number'] . ' ' . $user['user_street'] . ', ' . $user['user_zip_code'] . ' ' . $user['user_city'] . ', ' . $user['user_country']) ?? ''?><button class="modal-trigger-location"><img src="assets/img/black-edit.svg" alt="Modifier adresse" class="icon-edit"></button></p>
            </div>
            <div>
                <p class="account-label"><img src="assets/img/black-lock-solid.svg" alt="Adresse" class="img-label">Mot de passe</p>
                <p>**********<button class="modal-trigger-password"><img src="assets/img/black-edit.svg" alt="Modifier mot de passe" class="icon-edit"></button></p>
            </div>
        </div>
    </div>
    <div class="my-account-right">
        <div class="my-account-right-header">
            <div class="profil-picture">
                <p id="initials"><?php echo $initials ?></p>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="edit-profil-picture" id="edit-profil-picture">
                    <div id="icon-edit">
                        <img src="assets/img/edit.svg" alt="Modifier photo de profil">
                    </div>
                </div>
                <input type="file" name="profil_picture" id="file-input" accept=".jpg, .png, .jpeg">
                <input type="submit" name="edit_picture_submit" id="edit-picture-submit">
            </form>
            <?php if (!empty($error['profil_picture'])) : ?>
                <script>
                    openMessageModal('<?php echo $error['profil_picture'] ?>')   
                </script>
            <?php endif; ?>
            
            <p id="name"><?php echo $user['user_firstname'] . ' ' . $user['user_lastname'] ?></p>
            <p><?php echo $user['status_name']?></p>
        </div>

        <div class="my-account-right-footer">
            <form method="POST">
                <button type="submit" name="disconnection_submit" id="disconnect"><img src="assets/img/disconnect-solid.svg" alt="Deconnection">Déconnexion</button>
            </form>
        </div>
    </div>

<!--------------------------------------------------------------------------------------------------------------------------->

<!--Edit mail-->
    <div class="modal-container-mail">
        <div class="overlay modal-trigger-mail"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Email</p>
                <button class="modal-trigger-mail"><img src="assets/img/xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="email"><img src="assets/img/black-envelope-solid.svg" alt="Nouveau numéro">Nouvelle Email</label>
                <input type="mail" name="edit_mail" value="<?php echo $user['user_mail']?>">
                <button type="submit" name="edit_mail_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit phone-->
    <div class="modal-container-phone">
        <div class="overlay modal-trigger-phone"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Téléphone</p>
                <button class="modal-trigger-phone"><img src="assets/img/xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="phone"><img src="assets/img/phone-solid.svg" alt="Nouveau numéro">Nouveau numéro</label>
                <input type="text" name="edit_phone" value="<?php echo $user['user_phone']?>">
                <button type="submit" name="edit_phone_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit location-->
    <div class="modal-container-location">
        <div class="overlay modal-trigger-location"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Adresse</p>
                <button class="modal-trigger-location"><img src="assets/img/xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="location"><img src="assets/img/house-solid.svg" alt="Nouveau numéro">Nouvelle adresse</label>
                <div class="edit-location">
                    <input type="text" id="number" name="edit_address_number" value="<?php echo $user['user_address_number']?>">
                    <input type="text" id="street" name="edit_street" value="<?php echo $user['user_street']?>">
                    <input type="text" id="zip-code" name="edit_zip_code" value="<?php echo $user['user_zip_code']?>">
                    <input type="text" id="city" name="edit_city" value="<?php echo $user['user_city']?>">
                    <input type="text" id="country" name="edit_country" value="<?php echo $user['user_country']?>">
                </div>
                <button type="submit" name="edit_location_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit password-->
    <div class="modal-container-password">
        <div class="overlay modal-trigger-password"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Mot de passe</p>
                <button class="modal-trigger-password"><img src="assets/img/xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="password"><img src="assets/img/black-lock-solid.svg" alt="Ancien mot de passe">Ancien mot de passe</label>
                <input type="password" name="old_password">
                <label for="password"><img src="assets/img/black-lock-solid.svg" alt="Nouveau mot de passe">Nouveau mot de passe</label>
                <input type="password" name="new_password">
                <button type="submit" name="edit_password_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour"></div>Mettre à jour</button>
            </form>
        </div>
    </div>
</div>


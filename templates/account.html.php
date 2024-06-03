<div class="my-account">
    <div class="my-account-left">
        <div class="page-containt">
            <div class="page-header">
                <h1 class="page-title"><?=$title?></h1>
            </div>
            <div class="account-page-containt">
                <div class="account-section">
                    <div class="account-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone Mail -->
                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                        </svg>
                        <p>Email</p>
                    </div>
                    <div class="account-info">
                        <p><?= $userMail ?? 'Aucune adresse mail renseignée.'?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="MailEdit"> <!-- Icone Modifier -->
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                        </svg>
                    </div>
                </div>

                <div class="account-section">
                    <div class="account-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone Téléphone-->
                            <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                        </svg>
                        <p>Téléphone</p>
                    </div>
                    <div class="account-info">
                        <p><?= $userPhone ?? 'Aucun numéro de téléphone renseigné.'?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="PhoneEdit"> <!-- Icone Modifier -->
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                        </svg>
                    </div>
                </div>

                <div class="account-section">
                    <div class="account-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!-- Icone Adresse -->
                            <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/>
                        </svg>
                        <p>Adresse</p>
                    </div>
                    <div class="account-info">
                        <p><?= $userFullAdress ?? 'Aucune adresse renseignée.'?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="AddressEdit"> <!-- Icone Modifier -->
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                        </svg>
                    </div>
                </div>

                <div>
                    <div class="account-label">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Icone Mot de passe -->
                            <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                        </svg>
                        <p>Mot de passe</p>
                    </div>
                    <div class="account-info">
                        <p>●●●●●●●●</p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="AddressEdit"> <!-- Icone Modifier -->
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-account-right">
        <div class="my-account-right-header">
            <div class="profil-picture">
                <?php if(!empty($userImage) && file_exists('assets/uploads/'.$userImage)): ?>
                    <img src="assets/uploads/<?= $userImage ?>" alt="Photo de profil">
                <?php else: ?>
                    <p><?= strtoupper(substr($user['user_firstname'], 0, 1) . substr($user['user_lastname'], 0, 1)) ?></p>
                <?php endif; ?>
            </div>
            <form method="POST" enctype="multipart/form-data" class="edit-form">
                <div class="edit-profil-picture" id="EditProfilPicture">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!--Icone Modifier-->
                        <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                    </svg>
                </div>
                <input type="file" name="profil_picture" id="FileInput" accept=".jpg, .png, .jpeg">
                <input type="submit" name="edit_picture_submit" id="EditPictureSubmit">
            </form>
            
            <p class="name"><?= $userFullname ?></p>
            <p><?= $userStatus ?></p>
        </div>

        <a href="scripts.php?script=disconnection" class="button button-gray">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icone déconnexion -->
                <path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/>
            </svg>
            Déconnexion
        </a>
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
                <input type="mail" name="edit_mail" value="<?php echo $user['user_mail']?>">
                <button type="submit" name="edit_mail_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
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
                <input type="text" name="edit_phone" value="<?php echo $user['user_phone']?>">
                <button type="submit" name="edit_phone_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
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
                    <input type="text" id="number" name="edit_address_number" value="<?php echo $user['user_address_number']?>">
                    <input type="text" id="street" name="edit_street" value="<?php echo $user['user_street']?>">
                    <input type="text" id="zip-code" name="edit_zip_code" value="<?php echo $user['user_zip_code']?>">
                    <input type="text" id="city" name="edit_city" value="<?php echo $user['user_city']?>">
                    <input type="text" id="country" name="edit_country" value="<?php echo $user['user_country']?>">
                </div>
                <button type="submit" name="edit_location_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
            </form>
        </div>
    </div>

<!--Edit password-->
    <div class="modal-container-password">
        <div class="overlay modal-trigger-password"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Mot de passe</p>
                <button class="modal-trigger-password"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="password"><img src="assets/img/black-lock-solid.svg" alt="Ancien mot de passe">Ancien mot de passe</label>
                <input type="password" name="old_password">
                <label for="password"><img src="assets/img/black-lock-solid.svg" alt="Nouveau mot de passe">Nouveau mot de passe</label>
                <input type="password" name="new_password">
                <label for="password"><img src="assets/img/black-lock-solid.svg" alt="Nouveau mot de passe">Confirmer nouveau mot de passe</label>
                <input type="password" name="confirm_new_password">
                <button type="submit" name="edit_password_submit"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Mettre à jour" class="update-user-check-img"></div>Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
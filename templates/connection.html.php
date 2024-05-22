<div class="login-picture">
    <img src="assets/img/connection.gif" alt="Illustration de la page 'Connexion'.">
</div>
<div class="login-fields">
    <h1>Bienvenue sur Admax</h1>

    <form method="POST">
        <div class="field" id="emailField">
            <div class="field-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone email -->
                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                </svg>
                <label for="email">Adresse mail</label>
            </div>
            <input type="email" name="user_mail" id="userMail" value="<?= $_POST['user_mail'] ?? '' ?>" placeholder="Entrez votre adresse mail" required>
            <div id="mailAlertBox">
                <?php if (!empty($errors['user_mail'])) : ?>
                    <?php foreach ($errors['user_mail'] as $error) : ?>
                        <div id="<?= $error['alert_id'] ?>" class="alert alert-error">
                            <p><span>Erreur :</span> <?= $error['message'] ?></p>
                            <span id="<?= $error['alert_id'] ?>Close">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"> <!-- Icone fermer -->
                                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                </svg>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
            
        <div class="field" id="passwordField">
            <div class="field-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone mot de passe -->
                    <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                </svg>
                <label for="password">Mot de passe</label>
            </div>
            <div class="password-input">
                <input type="password" name="user_password" id="userPassword" placeholder="Entrez votre mot de passe" required>
                <span id="visibilityPassword" class="visibility-password">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"> <!-- Icone visibilité -->
                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                    </svg>
                </span>
            </div>
            <div id="passwordAlertBox">
                <?php if (!empty($errors['user_password'])) : ?>
                    <?php foreach ($errors['user_password'] as $error) : ?>
                        <div id="<?= $error['alert_id'] ?>" class="alert alert-error">
                            <p><span>Erreur :</span> <?= $error['message'] ?></p>
                            <span id="<?= $error['alert_id'] ?>Close">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"> <!-- Icone fermer -->
                                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                </svg>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="forgotten-pwd">
            <a href="/?page=forgotten-pwd">Mot de passe oublié ?</a>
        </div>
            
        <div class="field" id="submitButton">
            <button type="submit" name="connect_submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone se connecter -->
                    <path d="M352 96l64 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0c53 0 96-43 96-96l0-256c0-53-43-96-96-96l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-9.4 182.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L242.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/>
                </svg>
                Se connecter
            </button>
        </div>
    </form>
</div>
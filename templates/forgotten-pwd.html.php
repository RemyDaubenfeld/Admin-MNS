<div class="login-fields background-dark">
    <h1>Mot de passe oublié ?</h1>

    <form method="POST">
        <div class="field">
            <div class="field-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone mail -->
                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                </svg>
                <label for="user_mail">Adresse mail</label>
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
        <div class="field">
            <button type="submit" name="reset_pwd_submit" class="button button-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone envoyer un mail -->
                    <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/>
                </svg>
                Réinitialiser
            </button>
        </div>
    </form>
        
    <div class="back">
        <a href="/?page=connection">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone retour -->
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
            </svg>
            Retour à la page de connexion
        </a>
    </div>
    
</div>
<div class="login-picture">
    <img src="assets/img/forgot-password.gif" alt="Illustration de la page 'Mot de passe oublié'.">
</div>
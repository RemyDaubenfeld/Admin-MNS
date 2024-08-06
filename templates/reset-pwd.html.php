    <div class="login-fields background-dark">
        <h1>Réinitialiser mon mot de passe</h1>

        <form method="POST" id="resetPasswordForm">
            <div class="field">
                <div class="field-label">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone mot de passe -->
                        <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                    </svg>
                    <label for="new_password">Nouveau mot de passe</label>
                    <span id="newPasswordInfo" class="info" title="Le nouveau mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone info -->
                            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                        </svg>
                    </span>
                </div>
                <div class="password-input">
                    <input type="password" name="new_password" id="newPassword" placeholder="Entrez votre nouveau mot de passe" required>
                    <span id="newPasswordVisibility" class="visibility-password">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"> <!-- Icone visibilité -->
                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                        </svg>
                    </span>
                </div>
                <div class="password-strength-box">
                    <p>Force du mot de passe : <span id="newPasswordStrengthLabel" class="password-empty">Vide</span></p>
                    <div class="password-progressbar">
                        <div id="newPasswordStrength" class="password-strength password-empty"></div>
                    </div>
                </div>
                <div id="newPasswordAlertBox">
                    <?php if (!empty($errors['new_password'])) : ?>
                        <?php foreach ($errors['new_password'] as $error) : ?>
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
                <div class="field-label">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone mot de passe -->
                        <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                    </svg>
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <span id="confirmPasswordInfo" class="info" title="Les deux mots de passe doivent correspondre.">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone info -->
                            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                        </svg>
                    </span>
                </div>
                <div class="password-input">
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirmez votre mot de passe" required>
                    <span id="confirmPasswordVisibility" class="visibility-password">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"> <!-- Icone visibilité -->
                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                        </svg>
                    </span>
                </div>
                <div id="confirmPasswordAlertBox">
                    <?php if (!empty($errors['confirm_password'])) : ?>
                        <?php foreach ($errors['confirm_password'] as $error) : ?>
                            <div id="<?= $error['alert_id'] ?>"  class="alert alert-error">
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

            <input type="hidden" name="new_pwd_hidden_submit" required/>
            <input type="hidden" name="token" value="<?= $_POST['token'] ?>" required/>

            <div class="field">
                <button type="submit" name="new_pwd_submit" id="resetPasswordFormSubmit" class="button button-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone valider -->
                        <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                    </svg>
                    Valider
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
        <img src="assets/img/reset-password.gif" alt="Illustration de la page 'Réinitialiser mon mot de passe'.">
    </div>
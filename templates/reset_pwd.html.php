<div class="container">
    <div class="login-fields">
        <div id="content-login-fields">
            <div class="title">
                <h1>Réinitialiser mon mot de passe</h1>
            </div>

            <form method="POST">
                <div class="field">
                    <label for="password"><img src="assets/img/lock-solid.svg" alt="Nouveau mot de passe">Nouveau mot de passe</label><br>
                    <input type="password" name="user_password" id="user_password" value="<?= $_POST['user']['user_password'] ?? '' ?>" placeholder="Entrez votre nouveau mot de passe" required><br>
                    <?php if (!empty($errors['user_password'])) : ?>
                        <p class="connection-error"><?= $errors['user_password'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="field">
                    <label for="password"><img src="assets/img/lock-solid.svg" alt="Confirmer mot de passe">Confirmer le mot de passe</label><br>
                    <input type="password" name="new_password" id="new_password" placeholder="Confirmez votre mot de passe" required><br>
                    <?php if (!empty($errors['new_password'])) : ?>
                        <p class="connection-error"><?= $errors['new_password'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="field">
                    <button type="submit" name="validate_pwd_submit"><img src="assets/img/black-check-solid.svg" alt="Valider nouveau mot de passe">Valider</button>
                </div>
            </form>
        </div>
    </div>
    <div class="login-picture">
        <img src="assets/img/reset-password.gif" alt="Réinitialiser mot de passe">
    </div>
</div>
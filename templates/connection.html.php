<div class="container">
    <div class="login-picture">
        <img src="assets/img/connection.gif" alt="Connection">
    </div>
    <div class="login-fields">
        <div id="content-login-fields">
            <?php if (!empty($reset_pwd_success)) : ?>
                <div id="pwd-success">
                    <?= $reset_pwd_success?>
                </div>
            <?php endif; ?>
            <div class="title">
                <h1>Bienvenue sur Admax</h1>
            </div>

            <form method="POST">
                <div class="field">
                    <label for="email"><img src="assets/img/envelope-solid.svg" alt="Adresse mail">Adresse mail</label><br>
                    <input type="email" name="user_mail" id="user_mail" value="<?= $_POST['user']['user_mail'] ?? '' ?>" placeholder="Entrez votre adresse mail" required><br>
                    <?php if (!empty($errors['user_mail'])) : ?>
                        <p class="connection-error"><?= $errors['user_mail'] ?></p>
                    <?php endif; ?>
                </div>
                    
                <div class="field">
                    <label for="password"><img src="assets/img/lock-solid.svg" alt="Mot de passe">Mot de passe</label><br>
                    <input type="password" name="user_password" id="user_password" value="<?= $_POST['user']['user_password'] ?? '' ?>" placeholder="Entrez votre mot de passe" required><br>
                    <?php if (!empty($errors['user_password'])) : ?>
                        <p class="connection-error"><?= $errors['user_password'] ?></p>
                    <?php endif; ?>
                    <div id="forgottenPwd">
                        <a href="/?page=forgotten_pwd">Mot de passe oublié?</a><br>
                    </div>
                    
                </div>
                    
                <div class="field">
                    <button type="submit" name="connect_submit"><img src="assets/img/right-to-bracket-solid.svg" alt="Se connecter">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</div>
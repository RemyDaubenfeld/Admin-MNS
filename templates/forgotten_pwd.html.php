<div class="container">
    <div class="login-fields">
        <div id="content-login-fields">
            <div class="title">
                <h1>Mot de passe oublié ?</h1>
            </div>

            <form method="POST">
                <div class="field">
                    <label for="email"><img src="assets/img/envelope-solid.svg" alt="Adresse mail">Adresse mail</label><br>
                    <input type="email" name="user_mail" id="user_mail" value="<?= $_POST['user']['user_mail'] ?? '' ?>" placeholder="Entrez votre adresse mail" required><br>
                    <?php if (!empty($error['user_mail'])): ?>
                        <script>
                            messageModal("erreur", "<?=$error['user_mail']?>")
                        </script>
                    <?php endif; ?>
                </div>
                <div class="field">
                    <button type="submit" name="reset_pwd_submit"><img src="assets/img/black-check-solid.svg" alt="Réinitialiser mot de passe">Réinitialiser</button>
                </div>
            </form>
            
        </div>
        <div id="back">
            <a href="/?page='connexion'"><img src="assets/img/arrow-back.svg" alt="Retour">Retour à la page de connexion</a>
        </div>
        
    </div>
    <div class="login-picture">
        <img src="assets/img/forgot-password.gif" alt="Mot de passe oublié">
    </div>
</div>
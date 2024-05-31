<div class="page-containt">
    <div class="page-header">
        <h1 class="page-title"><?=$title?></h1>
    </div>
    <form method="POST" id="contactForm">
        <div class="field" id="categoryField">
            <div class="field-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-black"> <!-- Icone Catégorie -->
                    <path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/>
                </svg>
                <label for="contact_category">Catégorie</label>
            </div>
            <select name="contact_category" id="contactCategory">
                <option value="">-- Choisissez une catégorie --</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['category_name'] ?>" <?= !empty($_POST['contact_category']) && ($_POST['contact_category'] == $category['category_name']) ? 'selected' : '' ?>><?= $category['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div id="contactCategoryAlertBox">
                <?php if (!empty($errors['contact_category'])) : ?>
                    <?php foreach ($errors['contact_category'] as $error) : ?>
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

        <div class="field" id="objectField">
            <div class="field-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-black"> <!-- Icone Objet -->
                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                </svg>
                <label for="contact_object">Objet</label>
            </div>
            <input type="text" name="contact_object" id="contactObject" value="<?= $_POST['contact_object'] ?? '' ?>" placeholder="Saisissez l'objet de votre message" minlength="1" maxlength="255" required>
            <div id="contactObjectAlertBox">
                <?php if (!empty($errors['contact_object'])) : ?>
                    <?php foreach ($errors['contact_object'] as $error) : ?>
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

        <div class="field" id="bodyField">
            <div class="field-label">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-black"> <!-- Icone Message -->
                    <path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64h96v80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64z"/>
                </svg>
                <label for="contact_body">Message</label>
            </div>
            <textarea name="contact_body" id="contactBody" cols="30" rows="10" placeholder="Saisissez le contenu de votre body" minlength="1" required><?= $_POST['contact_body'] ?? '' ?></textarea>
            <div id="contactBodyAlertBox">
                <?php if (!empty($errors['contact_body'])) : ?>
                    <?php foreach ($errors['contact_body'] as $error) : ?>
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

        <input type="hidden" name="contact_form_hidden_submit" required>

        <div class="field" id="contactFormSubmit">
                <button type="submit" name="contact_form_submit" class="button button-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone Envoyer -->
                        <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/>
                    </svg>
                    Envoyer
                </button>
            </div>
    </form>
</div>
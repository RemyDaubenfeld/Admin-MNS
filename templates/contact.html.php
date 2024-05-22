<div class="page-container">
    <div class="page-title">
        <h1><?=$title?></h1>
    </div>
    <div class="page-containt">
        <form method="POST" id="contact-form">
            <label for="subject"><h2>Objet</h2></label>
            <input type="text" name="subject" placeholder="Saisissez l’objet de votre message">
            <label for="message"><h2>Message</h2></label>
            <textarea name="message" cols="30" rows="10" placeholder="Saisissez le contenu de votre message"></textarea>
            <button type="submit" name="contact_form_submit"><img src="assets/img/check-solid.svg" alt="Envoyer">Envoyer</button>
        </form>
    </div>
</div>


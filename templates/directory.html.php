<div class="page-containt">
    <div class="page-header">
        <h1 class="page-title"><?=$title?></h1>
    </div>
    
    <div class="search">
        <form method="GET" id="search-form">
            <input type="text" placeholder="Rechercher" name="search"/>
            <button type="submit" name="submit_search"><img src="assets/img/search.svg" alt="Rechercher"></button>
        </form>
    </div>
    

            
        <div class="cards-container">
            <div class="modal-trigger-add-user" id="add-user-card">
                <img src="assets/img/plus-solid.svg" alt="Ajouter un utilisateur">
                <p>Ajouter un utilisateur</p>
            </div>

            <?php foreach($users as $indice => $userCard): ?>
                <div class="user-card">
                    <div class="card-header">
                    <?php echo isset($userCard['user_image']) && !empty($userCard['user_image']) ? "<img src='assets/uploads/" . $userCard['user_image'] . "' alt='Photo de profil'>" : "<h4>" . strtoupper(substr($userCard['user_firstname'], 0, 1) . substr($userCard['user_lastname'], 0, 1)) . "</h4>"?>
                    </div>
                    
                    <div class="card-main">
                        <p class="user-name"><?= $userCard['user_firstname'] . ' ' . $userCard['user_lastname'] ?></p>
                        <p><?php echo ($userCard['user_gender'] == 1) ? $userCard['status_male_name'] : $userCard['status_female_name']?></p>
                    </div>
                    <div class="card-footer">
                        <a href="/?page=account&user-id=<?= $userCard['user_id'] ?>"><img src="assets/img/chevron-right-solid.svg" alt="Voir plus">Voir plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <div class="modal-container-add-user">
        <div class="overlay modal-trigger-add-user"></div>
        <div class="modal">
            <div class="modal-header">
                <p>Ajouter un utilisateur</p>
                <button class="modal-trigger-add-user"><img src="assets/img/black-xmark-solid.svg" alt="Fermer la fenêtre"></button>
            </div>
            <form method="POST">
                <label for="email"><img src="assets/img/black-envelope-solid.svg" alt="Email">Email</label>
                <input type="mail" name="add_mail" placeholder="john.doe@email.fr">
                <div class="add-name">
                    <div class="add-lastname">
                        <label for="lastname"><img src="assets/img/black-user-solid.svg" alt="Nom">Nom</label>
                        <input type="text" name="add_lastname" placeholder="DOE">
                    </div>
                    <div class="add-firstname">
                        <label for="firstname"><img src="assets/img/black-user-solid.svg" alt="Prénom">Prénom</label>
                        <input type="text" name="add_firstname" placeholder="John">
                    </div>
                </div>
                <div class="add-phone-and-gender">
                    <div class="add-phone">
                        <label for="phone"><img src="assets/img/phone-solid.svg" alt="Numéro">Numéro de téléphone</label>
                        <input type="text" name="add_phone" placeholder="0607080910">
                    </div>
                    <div class="add-gender">
                        <label for="gender"><img src="assets/img/gender-solid.svg" alt="Genre">Genre</label>
                        <div class="gender">
                            <div class="feminine-gender">
                                <input type="radio" id="feminine" name="gender" value="2" />
                                <label for="feminine">Féminin</label>
                            </div>
                            <div class="male-gender">
                              <input type="radio" id="male" name="gender" value="1" />
                              <label for="male">Masculin</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <label for="location"><img src="assets/img/house-solid.svg" alt="Nouveau numéro">Adresse</label>
                <div class="edit-location">
                    <input type="text" class="number" name="add_address_number" placeholder="86">
                    <input type="text" class="street" name="add_street" placeholder="rue aux Arènes">
                    <input type="text" class="zip-code" name="add_zip_code" placeholder="57000">
                    <input type="text" class="city" name="add_city" placeholder="Metz">
                    <input type="text" class="country" name="add_country" placeholder="France">
                </div>
                <label for="status"><img src="assets/img/user-status-solid.svg" alt="Statut" class="add-status-img">Statut</label>
                <select name="add_status" class="add-status">
                    <option value="" disabled selected>Sélectionner un statut</option>
                    <?php foreach($status as $index) {
                        echo '<option value="' . $index['status_id'] . '">' . $index['status_male_name'] . '</option>';
                    } ?>
                </select>
                <button type="submit" name="add_user_submit" class="add-user-button"><div class="check-update"><img src="assets/img/green-check-solid.svg" alt="Ajouter" class="add-check-img"></div>Ajouter</button>
            </form>
        </div>
    </div>

</div>
<div class="page-containt">
    <div class="page-header">
        <h1 class="page-title"><?= $title ?></h1>
    </div>
    
    <!-- <div class="search">
        <form method="GET" id="search-form">
            <input type="text" placeholder="Rechercher" name="search"/>
            <button type="submit" name="submit_search"><img src="assets/img/search.svg" alt="Rechercher"></button>
        </form>
    </div> -->
            
    <div class="cards-container">
        <div class="card card-add" id="addUser">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Icone Ajouter -->
                <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
            </svg>
            <p>Ajouter un utilisateur</p>
        </div>

        <?php foreach($users as $indice => $userCard): ?>
            <div class="card">
                <div class="card-header">
                    <?php if (!empty($userCard['user_image']) && file_exists('assets/uploads/'.$userCard['user_image'])): ?>
                        <img src="assets/uploads/<?= $userCard['user_image'] ?>" alt="Photo de profil de <?= $userCard['user_firstname'].' '.$userCard['user_lastname'] ?>"/>
                    <?php else: ?>
                        <p><?= strtoupper(substr($userCard['user_firstname'], 0, 1) . substr($userCard['user_lastname'], 0, 1)) ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="card-main">
                    <h3 class="card-title"><?= $userCard['user_firstname'] . ' ' . $userCard['user_lastname'] ?></h3>
                    <p><?= ($userCard['user_gender'] == 2) && !empty($userCard['status_female_name']) ? $userCard['status_female_name'] : $userCard['status_male_name']?></p>
                </div>
                <div class="card-footer">
                    <a href="/?page=account&user-id=<?= $userCard['user_id'] ?>" class="button button-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Voir plus-->
                            <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                        </svg>
                        Voir plus
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

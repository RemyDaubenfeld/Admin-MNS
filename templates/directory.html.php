<div class="page-containt">
    <div class="page-header">
        <h1 class="page-title"><?= $title ?></h1>
        <form method="GET" class="search-bar">
            <input type="hidden" name="page" value="directory"/>
            <input type="text" value="<?= $search ?>" placeholder="Rechercher" name="search"/>
            <button class="button button-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icone recherche -->
                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                </svg>
            </button>
        </form>
    </div>

    <?php if(!empty($search)): ?>
        <div class="search-result">
            <a href="/?page=directory" class="button button-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!-- Icone Annuler-->
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                </svg>
                Annuler la recherche
            </a>
            <p><?= count($users) ?> résultat<?= count($users) > 1 ? 's' : '' ?> correspond<?= count($users) > 1 ? 'ent' : '' ?> à la recherche : <span><?= $search ?></span></p>
        </div>
    <?php endif; ?>
            
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

    <?php if ($totalPages > 1): ?>
        <div class="paging">
            <?php if ($numPage > 1): ?>
                <a href="/?page=directory&num-page=1<?= !empty($search) ? "&search=$search" : '' ?>" class="button button-primary-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Premier -->
                        <path d="M267.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160L64 241V96c0-17.7-14.3-32-32-32S0 78.3 0 96V416c0 17.7 14.3 32 32 32s32-14.3 32-32V271l11.5 9.6 192 160z"/>
                    </svg>
                </a>
            <?php else: ?>
                <div class="button button-disable">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Premier -->
                        <path d="M267.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160L64 241V96c0-17.7-14.3-32-32-32S0 78.3 0 96V416c0 17.7 14.3 32 32 32s32-14.3 32-32V271l11.5 9.6 192 160z"/>
                    </svg>
                </div>
            <?php endif; ?>

            <?php if ($numPage > 1): ?>
                <a href="/?page=directory&num-page=<?= $numPage - 1 ?><?= !empty($search) ? "&search=$search" : '' ?>" class="button button-primary-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Précédent -->
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                    </svg>
                </a>
            <?php else: ?>
                <div class="button button-disable">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Suivant -->
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                    </svg>
                </div>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i == $numPage): ?>
                    <p class="button button-primary-dark"><?= $i ?></p>
                <?php else: ?>
                    <a href="/?page=directory&num-page=<?= $i ?><?= !empty($search) ? "&search=$search" : '' ?>" class="button button-primary">
                        <?= $i ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($numPage < $totalPages): ?>
            <a href="/?page=directory&num-page=<?= $numPage + 1 ?><?= !empty($search) ? "&search=$search" : '' ?>" class="button button-primary-dark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Suivant -->
                    <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                </svg>
            </a>
            <?php else: ?>
                <div class="button button-disable">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Suivant -->
                        <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                    </svg>
                </div>
            <?php endif; ?>

            <?php if ($numPage < $totalPages): ?>
            <a href="/?page=directory&num-page=<?= $totalPages ?><?= !empty($search) ? "&search=$search" : '' ?>" class="button button-primary-dark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Dernier -->
                    <path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416V96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4l192 160L256 241V96c0-17.7 14.3-32 32-32s32 14.3 32 32V416c0 17.7-14.3 32-32 32s-32-14.3-32-32V271l-11.5 9.6-192 160z"/>
                </svg>
            </a>
            <?php else: ?>
                <div class="button button-disable">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Dernier -->
                        <path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416V96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4l192 160L256 241V96c0-17.7 14.3-32 32-32s32 14.3 32 32V416c0 17.7-14.3 32-32 32s-32-14.3-32-32V271l-11.5 9.6-192 160z"/>
                    </svg>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

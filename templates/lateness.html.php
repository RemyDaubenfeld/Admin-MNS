<div class="page-containt">
    <div class="page-header">
        <?php if ($isMyAccount): ?>
            <h1 class="page-title">Mes retards</h1>
        <?php else: ?>
            <a href="/?page=account&user-id=<?= $currentUserId ?>" class="page-title">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone retour -->
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
                </svg>
                <h1>Retards de '<?= $currentUserFullName ?>'</h1>
            </a>
        <?php endif; ?>
        <form method="GET" class="filters-form" id=filtersForm>
                <input type="hidden" name="page" value="lateness" required/>
                <input type="hidden" name="user-id" value="<?= $currentUserId != $connectedUserId ? $currentUserId : '' ?>" required/>
                <div class="last-filter">
                    <select name="period" id="period" class="filter select-gray">
                        <option value="">Total : <?= $allLateness['nb_lateness'] ?></option>
                        <option value="anticipated" <?= $period == 'anticipated' ? 'selected' : '' ?>>Anticipés : <?= $anticipatedLateness['nb_lateness'] ?></option>
                        <option value="year" <?= $period == 'year' ? 'selected' : '' ?>>Année : <?= $yearLateness['nb_lateness'] ?></option>
                        <option value="month" <?= $period == 'month' ? 'selected' : '' ?>>Mois : <?= $monthLateness['nb_lateness'] ?></option>
                        <option value="week" <?= $period == 'week' ? 'selected' : '' ?>>Semaine : <?= $weekLateness['nb_lateness'] ?></option>
                        <option value="day" <?= $period == 'day' ? 'selected' : '' ?>>Jour : <?= $dayLateness['nb_lateness'] ?></option>
                    </select>
                    <button class="button button-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icone recherche -->
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                        </svg>
                    </button>
                </div>
        </form>
    </div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th class="text-right">Durée</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" class="add-table" id="addLateness">
                        <div>
                            <span class="icon-container">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone Modifier -->
                                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                                </svg>
                            </span>
                            <p>Déclarer un retard</p>
                        </div>
                    </td>
                </tr>
                <?php foreach($lateness as $iLateness): ?>
                    <tr>
                        <td class="table-row" id="lateness<?= $iLateness['lateness_id'] ?>">
                            <div>
                                <?php if ($isEditable || $iLateness['lateness_anticipated']): ?>
                                    <span class="icon-container update-icon" id="archiveLateness<?= $iLateness['lateness_id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone Supprimer -->
                                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                        </svg>
                                    </span>
                                <?php endif; ?>
                                <p>
                                    <?= $iLateness['lateness_date'] ?>
                                    <span class="time"> - <?= substr($iLateness['lateness_start'], 11, 5) ?> / <?= substr($iLateness['lateness_end'], 11, 5) ?></span>
                                    <?php if ($isEditable || $iLateness['lateness_anticipated']): ?>
                                        <span class="icon-container update-icon" id="updateLateness<?= $iLateness['lateness_id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone Modifier -->
                                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/>
                                            </svg>
                                        </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </td>
                        <td class="table-row text-right"><?= $iLateness['lateness_difference'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($lateness)): ?>
                    <tr>
                        <td colspan="2" class="table-row">
                            <p>
                                <span class="icon-container">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone Sourir -->
                                        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM96.8 314.1c-3.8-13.7 7.4-26.1 21.6-26.1H393.6c14.2 0 25.5 12.4 21.6 26.1C396.2 382 332.1 432 256 432s-140.2-50-159.2-117.9zM217.6 212.8l0 0 0 0-.2-.2c-.2-.2-.4-.5-.7-.9c-.6-.8-1.6-2-2.8-3.4c-2.5-2.8-6-6.6-10.2-10.3c-8.8-7.8-18.8-14-27.7-14s-18.9 6.2-27.7 14c-4.2 3.7-7.7 7.5-10.2 10.3c-1.2 1.4-2.2 2.6-2.8 3.4c-.3 .4-.6 .7-.7 .9l-.2 .2 0 0 0 0 0 0c-2.1 2.8-5.7 3.9-8.9 2.8s-5.5-4.1-5.5-7.6c0-17.9 6.7-35.6 16.6-48.8c9.8-13 23.9-23.2 39.4-23.2s29.6 10.2 39.4 23.2c9.9 13.2 16.6 30.9 16.6 48.8c0 3.4-2.2 6.5-5.5 7.6s-6.9 0-8.9-2.8l0 0 0 0zm160 0l0 0-.2-.2c-.2-.2-.4-.5-.7-.9c-.6-.8-1.6-2-2.8-3.4c-2.5-2.8-6-6.6-10.2-10.3c-8.8-7.8-18.8-14-27.7-14s-18.9 6.2-27.7 14c-4.2 3.7-7.7 7.5-10.2 10.3c-1.2 1.4-2.2 2.6-2.8 3.4c-.3 .4-.6 .7-.7 .9l-.2 .2 0 0 0 0 0 0c-2.1 2.8-5.7 3.9-8.9 2.8s-5.5-4.1-5.5-7.6c0-17.9 6.7-35.6 16.6-48.8c9.8-13 23.9-23.2 39.4-23.2s29.6 10.2 39.4 23.2c9.9 13.2 16.6 30.9 16.6 48.8c0 3.4-2.2 6.5-5.5 7.6s-6.9 0-8.9-2.8l0 0 0 0 0 0z"/>
                                    </svg>
                                </span>
                                Aucun retard
                            </p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <?php if ($totalPages > 1): ?>
                <tfoot>
                    <tr>
                        <td colspan="2">
                        <div class="paging">
                            <?php if ($numPage > 1): ?>
                                <a href="/?page=lateness<?= $currentUserId != $connectedUserId ? "&user-id=$currentUserId" : '' ?><?= !empty($period) ? "&period=$period" : '' ?>" class="button button-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icone Premier -->
                                        <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z"/>
                                    </svg>
                                </a>
                            <?php else: ?>
                                <div class="button button-disable button-gray">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icone Premier -->
                                        <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>

                            <?php if ($numPage > 1): ?>
                                <a href="/?page=lateness<?= $currentUserId != $connectedUserId ? "&user-id=$currentUserId" : '' ?><?= !empty($period) ? "&period=$period" : '' ?><?= $numPage - 1 > 1 ? '&num-page='.($numPage - 1) : '' ?>" class="button button-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Précédent -->
                                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                                    </svg>
                                </a>
                            <?php else: ?>
                                <div class="button button-disable button-gray">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Suivant -->
                                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <?php if ($i == $numPage): ?>
                                    <p class="button button-disable button-secondary"><?= $i ?></p>
                                <?php else: ?>
                                    <a href="/?page=lateness<?= $currentUserId != $connectedUserId ? "&user-id=$currentUserId" : '' ?><?= !empty($period) ? "&period=$period" : '' ?><?= $i > 1 ? "&num-page=$i" : '' ?>" class="button button-secondary-light">
                                        <?= $i ?>
                                    </a>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($numPage < $totalPages): ?>
                            <a href="/?page=lateness<?= $currentUserId != $connectedUserId ? "&user-id=$currentUserId" : '' ?><?= !empty($period) ? "&period=$period" : '' ?>&num-page=<?= $numPage + 1 ?>" class="button button-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Suivant -->
                                    <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                                </svg>
                            </a>
                            <?php else: ?>
                                <div class="button button-disable button-gray">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Icone Suivant -->
                                        <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>

                            <?php if ($numPage < $totalPages): ?>
                                <a href="/?page=lateness<?= $currentUserId != $connectedUserId ? "&user-id=$currentUserId" : '' ?><?= !empty($period) ? "&period=$period" : '' ?>&num-page=<?= $totalPages ?>" class="button button-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icone Dernier -->
                                        <path d="M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z"/>
                                    </svg>
                                </a>
                            <?php else: ?>
                                <div class="button button-disable button-gray">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Icone Dernier -->
                                        <path d="M470.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 256 265.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160zm-352 160l160-160c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L210.7 256 73.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0z"/>
                                    </svg>
                                </div>
                            <?php endif; ?>
                        </div>
                        </td>
                    </tr>
                </tfoot>
            <?php endif; ?>
        </table>
    </div>
            
</div>
<div id="containerModalMessage" class="modal-message-container">
    <?php if (!empty($_SESSION['modal_messages'])): ?>
        <?php foreach ($_SESSION['modal_messages'] as $index => $modalMessage): 
            if ($modalMessage['type'] == "success") {
                $label = "Succès";
                $path = "M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"; // Icone Succès
            } else if ($modalMessage['type'] == "info") {
                $label = "Information";
                $path = "M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"; // Icone Info
            } else if ($modalMessage['type'] == "warning") {
                $label = "Attention";
                $path = "M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"; // Icone Attention
            } else if ($modalMessage['type'] == "error") {
                $label = "Erreur";
                $path = "M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"; // Icone Erreur
            } ?>
            <div id="modalMessage<?= $index ?>" class="modal-message-box modal-message-<?= $modalMessage['type'] ?>" data-start="<?= $modalMessage['start'] ?>">
                <div class="modal-message-header">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="modal-message-icon">
                        <path d="<?= $path ?>"/>
                    </svg>
                    <h4><?= $label ?></h4>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" id="closeModalMessage<?= $index ?>" class="modal-message-close"> <!-- Icone fermer -->
                        <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                    </svg>
                </div>
                <p class="modal-message"><?= $modalMessage['message'] ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
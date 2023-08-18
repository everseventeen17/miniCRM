<?php ob_start(); ?>
    <!-- CONFIRM modal window -->
    <div class="popup popup_type_confirm">
        <div class="popup__container popup__container_type_confirm">
            <button type="button" aria-label="Закрыть" class="popup__close-btn popup__close-btn_type_confirm"></button>
            <h2 class="popup__title">Роль успешно добавлена</h2>
        </div>
    </div>

<?php $successPopup = ob_get_clean();

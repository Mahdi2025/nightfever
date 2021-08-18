<?php require 'views/layouts/head.view.php' ?>
    <?php if (isLoggedInAsSuperAdmin()) : ?>
        <?php require 'views/admin/partials/header.view.php' ?>
    <?php else : ?>
        <?php require 'views/partials/header.view.php' ?>
    <?php endif ?>

    <div class="overlay">
        <div class="center-box">
            <h2 class="error-message">403 GEEN TOEGANG voor jou <?= getNameFromSession() ?></h2>
            <h4><?= isset($vars['message']) ? $vars['message'] : '' ?></h4>
        </div>
    </div>

    <?php require 'views/partials/footer.view.php' ?>
<?php require 'views/layouts/bottom.view.php' ?>

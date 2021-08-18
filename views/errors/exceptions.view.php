<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>

<div class="overlay">
    <div class="center-box">
        <h2 class="error-message">FOUTMELDING ...</h2>
        <h4><?= $message ?></h4>
    </div>
</div>

<?php require 'views/partials/footer.view.php' ?>
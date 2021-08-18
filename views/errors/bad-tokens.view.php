<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>

<div class="overlay">
    <div class="center-box">
        <h2 class="error-message">GEEN TOEGANG ...</h2>
        <h4>Formulier verlopen</h4>
    </div>
</div>

<?php require 'views/partials/footer.view.php' ?>
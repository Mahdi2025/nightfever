<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>
<?php require 'views/users/partials/form.view.php' ?>
<?php require 'views/partials/footer.view.php' ?>
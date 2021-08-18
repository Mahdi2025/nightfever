<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>

<div class="main container-fluid">
<h1>Personal info</h1>
    <p>First name: 
        <?= $vars['user']->first_name ?>
    </p>
    <p>Last name:
        <?= $vars['user']->last_name ?>
    </p>
    <p>Email:     
        <?= $vars['user']->email ?>
    </p>
    <p>City: 
        <?= $vars['user']->city ?>
    </p>
    <p>Date of birth: 
        <?= $vars['user']->birthday ?>
    </p>

    <button><a href="/user/<?= $vars['user']->id ?>/edit">Edit</a></button>
    <?php if (isLoggedInAsSuperAdmin()) : ?>
        <button><a href="/user/<?= $vars['user']->id ?>/destroy">Delete</a></button>
    <?php endif ?>
</div>

<?php require 'views/partials/footer.view.php' ?>
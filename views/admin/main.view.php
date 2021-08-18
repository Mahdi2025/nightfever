<?php require 'views/admin/partials/header.view.php' ?>

<div class="container-fluid main">
    <h1>Alle Users</h1>
    <?php foreach($vars['users'] as $user) : ?>
        <div class="row">
            <div class="col-2">
                    <?= $user->first_name ?>
                    <?= $user->last_name ?>
            </div>
            <div class="col-1">
                <button><a href="/profile/<?= $user->id ?>">Profile</a></button>
            </div>
            <div class="col-1">
                <button><a href="/user/<?= $user->id ?>">Show user</a></button>
            </div>
            <div class="col-1">
                <button><a href="/user/<?= $user->id ?>/edit">Edit user</a></button>
            </div>
            <div class="col-2">
                <button><a href="/user/<?= $user->id ?>/destroy">Delete user</a></button>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php require 'views/partials/footer.view.php' ?>
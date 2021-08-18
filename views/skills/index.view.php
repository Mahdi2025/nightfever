<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>

<div class="container-fluid main">
    <h1>Vaardigheden van 
        <?= $_SESSION['user']['full_name'] ?>
    </h1>

    <?php foreach($vars['skills'] as $skill) :?>
        <div class="row">
            <div class="col-2">
                <p>
                    <?= $skill->name ?>  
                </p>
            </div>
            <div class="col-3">
                <p>
                    <?= $skill->info ?>  
                </p>
            </div>
            <div class="col-1">
                <button><a href="/skill/<?= $skill->id ?>">Show</a></button>
            </div>
            <div class="col-1">
                <button><a href="/skill/<?= $skill->id ?>/edit">Edit</a></button>
            </div>
            <div class="col-1">
                <button><a href="/skill/<?= $skill->id ?>/destroy">Delete</a></button>
            </div>
        </div>
    <?php endforeach ?>
    <div class="row">
        <div class="col">
            <button><a href="/skill/create">Insert new skill</a></button>
        </div>
    </div>
</div>


<?php require 'views/partials/footer.view.php' ?>
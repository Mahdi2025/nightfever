<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>

<div class="container-fluid main">
    <h1>Opleidingen van 
       <?= getNameFromSession() ?>
    </h1>

    <?php foreach($vars['educations'] as $education) :?>
        <div class="row">
            <div class="col-1">
                <p>
                    <?= $education->start_year ?> -
                    <?php if($education->end_year === NULL) : ?>
                        heden
                    <?php else : ?> 
                        <?= $education->end_year ?>
                    <?php endif ?> 
                </p>
            </div>
            <div class="col-2">
                <p>
                    <?= $education->name ?>  
                </p>
            </div>
            <div class="col-3">
                <p>
                    <?= $education->info ?>  
                </p>
            </div>
            <div class="col-1">
                <button><a href="/education/<?= $education->id ?>">Show</a></button>
            </div>
            <div class="col-1">
                <button><a href="/education/<?= $education->id ?>/edit">Edit</a></button>
            </div>
            <div class="col-1">
                <button><a href="/education/<?= $education->id ?>/destroy">Delete</a></button>
            </div>
        </div>
    <?php endforeach ?>
    <div class="row">
        <div class="col">
            <button><a href="/education/create">Insert new education</a></button>
        </div>
    </div>
</div>

<?php require 'views/partials/footer.view.php' ?>
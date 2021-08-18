<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>

<div class="container-fluid main">
    <h1>Werkervaring van 
        <?= getNameFromSession() ?>
    </h1>

    <?php foreach($vars['jobs'] as $job) :?>
        <div class="row">
            <div class="col-1">
                <p>
                    <?= $job->start_year ?> -
                    <?php if($job->end_year === NULL) : ?>
                        heden
                    <?php else : ?> 
                        <?= $job->end_year ?>
                    <?php endif ?> 
                </p>
            </div>
            <div class="col-2">
                <p>
                    <?= $job->name ?>  
                </p>
            </div>
            <div class="col-3">
                <p>
                    <?= $job->info ?>  
                </p>
            </div>
            <div class="col-1">
                <button><a href="/job/<?= $job->id ?>">Show</a></button>
            </div>
            <div class="col-1">
                <button><a href="/job/<?= $job->id ?>/edit">Edit</a></button>
            </div>
            <div class="col-1">
                <button><a href="/job/<?= $job->id ?>/destroy">Delete</a></button>
            </div>
        </div>
    <?php endforeach ?>
    <div class="row">
        <div class="col">
            <button><a href="/job/create">Insert new job</a></button>
        </div>
    </div>
</div>


<?php require 'views/partials/footer.view.php' ?>
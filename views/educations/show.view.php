<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>

<div class="container-fluid main">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?= $vars['education']->name ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">
                <?= $vars['education']->start_year ?> -
                    <?php if($vars['education']->end_year === NULL) : ?>
                        heden
                    <?php else : ?> 
                        <?= $vars['education']->end_year ?>
                    <?php endif ?> 
            </h6>
            <p class="card-text"><?= $vars['education']->info ?></p>
            <button><a href="/education/<?= $vars['education']->id ?>/edit" class="card-link">Edit</a></button>
            <button><a href="/education/<?= $vars['education']->id ?>/destroy" class="card-link">Delete</a></button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <button><a href="/education">Back to overview</a></button>
        </div>
    </div>
</div>

<?php require 'views/partials/footer.view.php' ?>
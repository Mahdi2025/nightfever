<?php if (isLoggedInAsSuperAdmin()) : ?>
    <?php require 'views/admin/partials/header.view.php' ?>
<?php else : ?>
    <?php require 'views/partials/header.view.php' ?>
<?php endif ?>

<div class="main container-fluid">
    <h1>CV van 
        <?= $vars['user']->first_name ?>
        <?= $vars['user']->last_name ?>
    </h1>
    <h2>Personal information</h2>
    <p>Email:     
        <?= $vars['user']->email ?>
    </p>
    <p>City: 
        <?= $vars['user']->city ?>
    </p>
    <p>Date of birth: 
        <?= $vars['user']->birthday ?>
    </p>
  
    <h2>Educations</h2>
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
    <br>
    <h2>Jobs</h2>
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
    <br>
    <h2>Skills</h2>
    <?php foreach($vars['skills'] as $skill) :?>
        <div class="row">
            <div class="col-2">
                <p>
                    <?= $skill->name ?>  
                </p>
            </div>
            <div class="col-4">
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
    <br>
    <h2>Hobbies</h2>
    <?php foreach($vars['hobbies'] as $hobby) :?>
        <div class="row">
            <div class="col-2">
                <p>
                    <?= $hobby->name ?>  
                </p>
            </div>
            <div class="col-4">
                <p>
                    <?= $hobby->info ?>  
                </p>
            </div>
            <div class="col-1">
                <button><a href="/hobby/<?= $hobby->id ?>">Show</a></button>
            </div>
            <div class="col-1">
                <button><a href="/hobby/<?= $hobby->id ?>/edit">Edit</a></button>
            </div>
            <div class="col-1">
                <button><a href="/hobby/<?= $hobby->id ?>/destroy">Delete</a></button>
            </div>
        </div>
    <?php endforeach ?>
    <div class="row">
        <div class="col">
            <button><a href="/hobby/create">Insert new hobby</a></button>
        </div>
    </div>
</div>


<?php require 'views/partials/footer.view.php' ?>
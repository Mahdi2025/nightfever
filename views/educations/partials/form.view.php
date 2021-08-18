<div class="main container-fluid">
    <form method="<?= $vars['method'] ?>" action="<?= $vars['action'] ?> ">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" name="name" placeholder="Opleiding" value="<?= isset($vars['education']) ? $vars['education']->name : '' ?>">
                </div>
            </div>  
            <div class="row mb-3">
                <div class="col">
                    <input id="info" type="text" name="info" placeholder="Informatie" value="<?= isset($vars['education']) ? $vars['education']->info : '' ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>Startjaar:</label>
                    <input type="number" name="start_year" min="1950" max="2030" value="<?= isset($vars['education']) ? $vars['education']->start_year : '' ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label>Eindjaar:</label>
                    <input type="number" name="end_year" min="1950" max="2030" value="<?= isset($vars['education']) ? $vars['education']->end_year : '' ?>">
                </div>
            </div>
            <?php if (isLoggedInAsSuperAdmin()) : ?>
                <div class="row mb-3">
                    <div class="col">
                        <select name="user_id">
                            <option value="0">Kies een user</option>
                            <?php foreach($vars['users'] as $user) : ?>
                                <option value="<?= $user->id ?>"
                                    <?php if (isset($vars['education']) && $user->id === $vars['education']->user_id) : ?>
                                        <?= 'selected' ?>>
                                    <?php else : ?> 
                                        <?= '' ?>>
                                    <?php endif ?>
                                    <?= $user->first_name ?> <?= $user->last_name ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                </div>
            </div>
            <?php endif ?>

            <input type="hidden" name="f_token" value="<?= createToken() ?>">

            <input type="submit" value="Opslaan">
    </form>
    <div class="row mt-4">
        <div class="col">
            <?php if (isLoggedInAsSuperAdmin()) : ?>
                <button><a href="/admin">Back to overview</a></button>
            <?php else : ?>
                <button><a href="/education">Back to overview</a></button>
            <?php endif ?>
        </div>
    </div>
</div>
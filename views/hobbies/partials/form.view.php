<div class="main container-fluid">
    <form method="<?= $vars['method'] ?>" action="<?= $vars['action'] ?> ">
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" name="name" placeholder="Hobby" value="<?= isset($vars['hobby']) ? $vars['hobby']->name : '' ?>">
                </div>
            </div>  
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" name="info" placeholder="Informatie" value="<?= isset($vars['hobby']) ? $vars['hobby']->info : '' ?>">
                </div>
            </div>
            <?php if (isLoggedInAsSuperAdmin()) : ?>
                <div class="row mb-3">
                    <div class="col">
                        <select name="user_id">
                            <option value="0">Kies een user</option>
                            <?php foreach($vars['users'] as $user) : ?>
                                <option value="<?= $user->id ?>"
                                    <?php if (isset($vars['hobby']) && $user->id === $vars['hobby']->user_id) : ?>
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
                <button><a href="/hobby">Back to overview</a></button>
            <?php endif ?>
        </div>
    </div>
</div>
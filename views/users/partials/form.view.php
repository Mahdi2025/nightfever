<div class="main container-fluid">
    <form method="<?= $vars['method'] ?>" action="<?= $vars['action'] ?> ">
            <div class="row mb-3">
                <div class="col">
                    <input type="text" name="first_name" placeholder="Voornaam" value="<?= isset($vars['user']) ? $vars['user']->first_name : '' ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="text" name="last_name" placeholder="Achternaam" value="<?= isset($vars['user']) ? $vars['user']->last_name : '' ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="email" name="email" placeholder="E-mail" value="<?= isset($vars['user']) ? $vars['user']->email : '' ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <input type="text" name="city" placeholder="Woonplaats" value="<?= isset($vars['user']) ? $vars['user']->city : '' ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <select name="role">
                        <option value="0">Kies een rol...</option>
                        <?php foreach($vars['roles'] as $role) : ?>
                            <option value="<?= $role->id ?>"<?= isset($vars['user']) && $vars['user']->role == $role->id ? 'selected' : '' ?>><?= $role->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>Geboortedatum</label><br/>
                    <input type="date" name="birthday" value="<?= isset($vars['user']) ? $vars['user']->birthday : '' ?>">
                </div>
            </div>

            <input type="hidden" name="f_token" value="<?= createToken() ?>">

            <input type="submit" value="Opslaan">
        
    </form>
    <div class="row mt-4">
        <div class="col">
            <?php if (isset($vars['user']->id)) : ?>
                <button><a href="/user/<?= $vars['user']->id ?>">Back to overview</a></button>
            <?php endif ?>
       
            <?php if (isLoggedInAsSuperAdmin()) : ?>
                <button><a href="/admin">Back to overview</a></button>
            <?php endif ?>
        </div>
    </div>
</div>
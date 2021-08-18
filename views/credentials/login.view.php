<?php require 'views/partials/header.view.php' ?>

<div class="main login-overlay">
    <div class="center-box login-form">
        <div class="mb-3">
            <div><h3>Login page</h3></div>
        </div>

        <form method="POST" name="frmLogin" onsubmit="return false;">
            <?= generateFormTokenHTML() ?>
            <div class="mb-3">
                <label for="email" class="form-label">Your email address</label>
                <input type="email" class="form-control" name="email" id="email" required />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required />
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-2">
                        <input type="submit" class="btn btn-dark" value="Login" />
                    </div>
                    <div class="col-3">
                        <button class="btn btn-dark">
                            <a id="btn-link" href="/register">New User?</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="public/js/partials/login.js"></script>

<?php require 'views/partials/footer.view.php' ?>
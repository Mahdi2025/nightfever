<?php require 'views/partials/header.view.php' ?>

<div class="main login-overlay">
    <div class="center-box register-form">
        <div class="mb-3">
            <span class="guitar-icon">
                <img src="/public/images/codegorilla-logo.png">
                <div>
                    <h3>Register</h3>
                </div>
            </span>
        </div>

        <div class="alert alert-danger" id="register-message" role="alert"></div>

        <form method="POST" onsubmit="return false;" name="frmRegister" class="row g-3">
            <div class="col-md-6">
                <label for="first_name" class="form-label">First name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" maxlength="80" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last_name" class="form-label">Last name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" maxlength="80" required>
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" maxlength="255" required>
            </div>

            <div class="col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" maxlength="50" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="password_2">Repeat password</label>
                <input type="password" class="form-control" name="password_2" id="password_2" maxlength="50" required>
            </div>

            <input type="hidden" name="f_token" value="<?= createToken() ?>">

            <div class="col-1 mb-3">
                <input type="submit" class="btn btn-dark" value="Submit">
            </div>
            <div class="col-6">
                <button class="btn btn-dark">
                    <a id="btn-link" href="/login">Already have an account?</a>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="public/js/partials/register.js"></script>

<?php require 'views/partials/footer.view.php' ?>
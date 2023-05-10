<?php session_start() ?>
<?php include '../config/flasher.php' ?>
<?php include 'template/header.php' ?>
<?php ($_SESSION['login']) ? header('Location: dashboard.php') : ""; ?>
<section class="section pt-5">
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand circle">
                    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop" colors="primary:#121331,secondary:#6777ef" style="width:100px;height:100px">
                    </lord-icon>
                </div>
                <div class="card card-primary mt-5">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form id="login" method="POST" class="needs-validation" novalidate="" action="controllers/ControllerUser.php">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your username
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    <?= Flash() ?>
</script>
<?php include 'template/footer.php' ?>
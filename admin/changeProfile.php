<?php
include 'init.php';
$title = 'Change Profile';
include 'template/header.php';
?>
<section class="section">
    <div class="container mt-5">
        <div class="row mt-5 pt-5">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand circle">
                    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/rqqkvjqf.json" trigger="loop" delay="500" colors="primary:#121331,secondary:#6777ef" style="width:100px;height:100px">
                    </lord-icon>
                </div>

                <div class="card card-primary mt-4">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form id="changeProfile" method="POST" action="controllers/ControllerUser.php">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
                                <input id="name" type="text" maxlength="25" class="form-control" name="name" value="<?= $data['nama_user'] ?>" tabindex="1" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" maxlength="20" class="form-control" name="username" value="<?= $data['username'] ?>" tabindex="1" required autofocus>
                            </div>
                            <div class="form-group mb-1">
                                <label for="no">Phone Number</label>
                                <input id="no" type="number" min="0" class="form-control" name="no" value="<?= $data['no_user'] ?>" tabindex="1" required autofocus>
                            </div>
                            <div class="form-group">
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="wpswd" id="wpswd" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Change Password?</span>
                                </label>
                            </div>
                            <span id="pswd" class="d-none">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password" max="25" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2">
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" maxlength="25" type="password" class="form-control" tabindex="2">
                                    <div id="pwindicator" class="pwindicator">
                                        <div id="pwindicate" class="label text-danger"></div>
                                    </div>
                                </div>
                            </span>
                            <div class="form-group">
                                <button id="change" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Change Profile
                                </button>
                                <a href="dashboard.php" class="btn btn-danger btn-lg btn-block" tabindex="4">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        function confirmation() {
            if ($('#password-confirm').val() != $('#password').val()) {
                $('#change').attr("disabled", true)
                $('#pwindicate').html("Password not match");
            } else {
                $('#change').attr("disabled", false)
                $('#pwindicate').html(' ')
            }
        }

        $('#wpswd').change(function() {
            if (this.checked) {
                $('#pswd').removeClass('d-none')
                $('#pswd').addClass('d-block')
                $('#password').attr('required', true)
                $('#password-confirm').attr('required', true)
            } else {
                $('#pswd').removeClass('d-block')
                $('#pswd').addClass('d-none')
                $('#password').removeAttr('required');
                $('#password-confirm').removeAttr('required');
            }
        });

        $('#password-confirm').change(function() {
            confirmation()
        });
    })
</script>
<?php include 'template/footer.php' ?>
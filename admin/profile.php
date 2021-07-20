<?php
include './_header.php';
?>
<style>
    .image {
        position: relative;
        height: 70px;
        width: 70px;
        border-radius: 4em;
        background-color: #ACDFFB;
        background: linear-gradient(to bottom, #eecda3, #ef629f);
    }

    .image .initial {
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 3em;
        font-weight: 900;
        color: #fff;
        transform: translate(-50%, -50%);
    }
</style>
<div class="container mt-3">
    <h2 class="my-4">Account Settings</h2>
    <div class="row g-3">
        <div class="col-12">
            <div class="card p-5">
                <div class="d-flex align-items-center">
                    <div class="image me-4">
                        <span class="initial"><?php echo substr($_SESSION['name'], 0, 1); ?></span>
                    </div>
                    <h4><?php echo  $_SESSION['name']; ?></h4>
                </div>
                <form class="row g-3 mt-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-badge "></i></span>
                        <input type="text" class="form-control" value="<?php echo  $_SESSION['name'];  ?>">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-envelope "></i></span>
                        <input type="text" class="form-control" value="anu.deo.rt17@rait.ac.in">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-telephone "></i></span>
                        <input type="text" class="form-control" value="9876543210">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-outline-primary float-end" name="login" value="Login" type="submit">Update Info</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="card p-5">
                <h4>Change password</h4>
                <form class="row g-3 needs-validation">
                    <div class="col-12">
                        <label for="usernameValidation" class="form-label">Current Password</label>
                        <input type="password" name="username" class="form-control" id="usernameValidation" required>
                        <div class="invalid-feedback">Cannot be empty</div>
                    </div>
                    <div class="col-12">
                        <label for="passwordValidation" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" id="passwordValidation" required>
                        <div class="invalid-feedback">Cannot be empty</div>
                    </div>
                    <div class="col-12">
                        <label for="passwordValidation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password" class="form-control" id="passwordValidation" required>
                        <div class="invalid-feedback">Cannot be empty</div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-outline-primary float-end" name="login" value="Login" type="submit">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
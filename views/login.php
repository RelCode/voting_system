<div class="container" id="main-container">
    <form action="" method="post" class="row pt-5" id="form">
        <?= isset($_SESSION['validation']['email']) ? '<div class="col-xs-12 col-md-4 offset-md-4">
            <span class="text text-danger">'.$_SESSION['validation']['email'].'</span>
        </div>' : ''; ?>
        <div class="col-xs-12 col-md-4 offset-md-4 input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="text" name="email" id="" class="form-control must-fill" placeholder="Enter Email" value="<?= isset($_SESSION['old']['email']) ? $_SESSION['old']['email'] : '' ?>" autocomplete="off">
        </div>
        <div class="col-xs-12 col-md-4 offset-md-4 input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" name="pword" class="form-control must-fill" placeholder="Enter Password">
        </div>
        <div class="col-xs-12 col-md-4 offset-md-4 input-group mb-3">
            <button type="submit" class="form-control btn btn-primary">Login</button>
        </div>
        <?= isset($_SESSION['error']['login']) ? '<div class="col-xs-12 col-md-4 offset-md-4 text-center">
            <h5 class="text text-danger">'.$_SESSION['error']['login'].'</h5>
        </div>' : ''; ?>
    </form>
</div>
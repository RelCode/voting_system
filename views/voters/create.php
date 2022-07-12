<div class="container-fluid" id="main-container">
    <div class="row">
        <?php require('./views/layouts/sidebar.php') ?>
        <!-- sidebar == div.col-xs-12.col-md-3 -->
        <div class="col-xs-12 col-md-9">
            <h4 class="alert text-center">Voters<a onclick="history.back()" class="btn btn-primary add-btn"><i class="fa fa-arrow-left"></i> Go Back</a></h4>
            <form action="" method="post" class="row" id="form">
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="text" name="names" class="form-control must-fill" placeholder="Voter's Full Names" value="<?= isset($_SESSION['old']['names']) ? $_SESSION['old']['names'] : ''; ?>">
                </div>
                <?= isset($_SESSION['validation']['names']) ? '<div class="col-xs-12 col-md-5 mb-3"><i class="text text-danger">' . $_SESSION['validation']['names'] . '</i></div>' : ''; ?>
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="text" name="id_number" maxlength="13" class="form-control must-fill" placeholder="Voter's ID Number" value="<?= isset($_SESSION['old']['id_number']) ? $_SESSION['old']['id_number'] : ''; ?>">
                </div>
                <?= isset($_SESSION['validation']['id_number']) ? '<div class="col-xs-12 col-md-5 mb-3"><i class="text text-danger">' . $_SESSION['validation']['id_number'] . '</i></div>' : ''; ?>
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="text" name="age" class="form-control must-fill" placeholder="Voter's Age" value="<?= isset($_SESSION['old']['age']) ? $_SESSION['old']['age'] : ''; ?>">
                </div>
                <?= isset($_SESSION['validation']['age']) ? '<div class="col-xs-12 col-md-5 mb-3"><i class="text text-danger">' . $_SESSION['validation']['age'] . '</i></div>' : ''; ?>
                <div class="col-xs-12 col-md-7 mb-3">
                    <select name="area" class="form-control must-fill">
                        <?php
                        $areaList = '<option value="">Select Area</option>';
                        foreach ($data as $area) {
                            $areaList .= '<option value="' . $area['id'] . '">' . $area['area'] . ' - ' . $area['district'] . ' (' . $area['code'] . ')</option>';
                        }
                        $areaList .= '<option value="new_area"><i class="fa fa-plus"></i> Add New Area</option>';
                        echo $areaList;
                        ?>
                    </select>
                </div>
                <?= isset($_SESSION['validation']['area']) ? '<div class="col-xs-12 col-md-5 mb-3"><i class="text text-danger">' . $_SESSION['validation']['area'] . '</i></div>' : ''; ?>
                <div class="col-xs-12 col-md-7 mb-3">
                    <select name="gender" class="form-control must-fill">
                        <option value="">Select Gender</option>
                        <option value="f">Female</option>
                        <option value="m">Male</option>
                    </select>
                </div>
                <?= isset($_SESSION['validation']['gender']) ? '<div class="col-xs-12 col-md-5 mb-3"><i class="text text-danger">' . $_SESSION['validation']['gender'] . '</i></div>' : ''; ?>
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="submit" name="create" value="Submit" class="btn btn-primary form-control">
                </div>
                <?php
                    if(isset($_SESSION['alert'])){
                        ?>
                            <div class="col-xs-12 col-md-7 mb-3">
                                <h class="alert <?= $_SESSION['alert']['class'] ?> w-100"><?= $_SESSION['alert']['message'] ?></h>
                            </div>
                        <?php
                    }
                ?>
            </form>
        </div>
    </div>
</div>
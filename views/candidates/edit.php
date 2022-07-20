<div class="container-fluid" id="main-container">
    <div class="row">
        <?php 
            require('./views/layouts/sidebar.php') ;
            $candidacy = [];
            $options = [];
        ?>
        <!-- sidebar == div.col-xs-12.col-md-3 -->
        <div class="col-xs-12 col-md-9">
            <h4 class="alert text-center">Voters<a onclick="history.back()" class="btn btn-primary add-btn"><i class="fa fa-arrow-left"></i> Go Back</a></h4>
            <form action="" method="post" class="row" id="form">
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="text" name="names" class="form-control must-fill" placeholder="Candidate's Names" value="<?= $data[0]['names'] ?>">
                </div>
                <div class="col-xs-12 col-md-5 mb-3">
                    <span class="text text-danger"><?= isset($_SESSION['error']['names']) ? $_SESSION['error']['names'] : ''; ?></span>
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="text" name="political_group" class="form-control must-fill" placeholder="Candidate's Political Group" value="<?= $data[0]['political_group'] ?>">
                </div>
                <div class="col-xs-12 col-md-5 mb-3">
                    <span class="text text-danger"><?= isset($_SESSION['error']['political_group']) ? $_SESSION['error']['political_group'] : '' ?></span>
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <span>Areas Campaigning For: <i class="text text-<?= isset($currentValues['area']) ? 'success' : 'secondary' ?>"><?= isset($currentValues['area']) ? $currentValues['area'][0]['area'] : 'N/A' ?></i></span><br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php
                        if(isset($currentValues['area'])){
                            array_push($candidacy,'area');
                            array_push($options,$currentValues['area'][0]['id']);
                        }
                        $areaRadio = '';
                        for ($i = 0; $i < count($data['areas']); $i++) {
                            $checked = isset($currentValues['area']) ? ($currentValues['area'][0]['area'] == $data['areas'][$i]['area'] ? 'checked' : '') : '';
                            $areaRadio .= '<label class="btn btn-secondary">';
                            $areaRadio .= '<input type="radio" class="selected-radio" name="options" id="' . $data['areas'][$i]['id'] . '-area" '.$checked.'> ' . $data['areas'][$i]['area'];
                            $areaRadio .= '</label>';
                        }
                        echo $areaRadio;
                        ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <span>District Campaigning For: <i class="text text-<?= isset($currentValues['district']) ? 'success' : 'secondary' ?>"><?= isset($currentValues['district']) ? $currentValues['district'][0]['district'] : 'N/A' ?></i></span><br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php
                        $districts[0] = !empty($data['areas']) ? $data['areas'][0] : null;
                        if ($districts) {
                            for ($i = 0; $i < count($data['areas']); $i++) { //this will be done for every data array element
                                for ($j = 0; $j < count($districts); $j++) { //this will be to every district array element
                                    if ($districts[$j]['district'] != $data['areas'][$i]['district']) {
                                        array_push($districts, $data['areas'][$i]);
                                    }
                                }
                            }
                            if (isset($currentValues['district'])) {
                                array_push($candidacy, 'district');
                                array_push($options, $currentValues['district'][0]['id']);
                            }
                            $districtRadio = '';
                            for ($i = 0; $i < count($districts); $i++) {
                                $checked = isset($currentValues['district']) ? ($currentValues['district'][0]['district'] == $districts[$i]['district'] ? 'checked' : '') : '';
                                $districtRadio .= '<label class="btn btn-secondary">';
                                $districtRadio .= '<input type="radio" class="selected-radio" name="options" id="' . $districts[$i]['id'] . '-district" '.$checked.'> ' . $districts[$i]['district'];
                                $districtRadio .= '</label>';
                            }
                            echo $districtRadio;
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <span>Ward Campaigning For: <i class="text text-<?= isset($currentValues['ward']) ? 'success' : 'secondary' ?>"><?= isset($currentValues['ward']) ? $currentValues['ward'][0]['ward'] : 'N/A' ?></i></span><br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php
                        $wards[0] = !empty($data['areas']) ? $data['areas'][0] : null;
                        if ($wards) {
                            for ($i = 0; $i < count($data['areas']); $i++) { //this will be done for every data array element
                                for ($j = 0; $j < count($wards); $j++) { //this will be to every district array element
                                    if ($wards[$j]['ward'] != $data['areas'][$i]['ward']) {
                                        array_push($wards, $data['areas'][$i]);
                                    }
                                }
                            }
                            if (isset($currentValues['ward'])) {
                                array_push($candidacy, 'ward');
                                array_push($options, $currentValues['ward'][0]['id']);
                            }
                            $districtRadio = '';
                            for ($i = 0; $i < count($wards); $i++) {
                                $checked = isset($currentValues['ward']) ? ($currentValues['ward'][0]['ward'] == $wards[$i]['ward'] ? 'checked' : '') : '';
                                $districtRadio .= '<label class="btn btn-secondary">';
                                $districtRadio .= '<input type="radio" class="selected-radio" name="options" id="' . $wards[$i]['id'] . '-ward" '.$checked.'> ' . $wards[$i]['ward'];
                                $districtRadio .= '</label>';
                            }
                            echo $districtRadio;
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7">
                    <input type="hidden" name="running_for" id="for" value="<?= implode('%20',$candidacy) ?>">
                    <input type="hidden" name="running_in" id="in" value="<?= implode('%20',$options) ?>">
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="submit" name="update" value="Submit" class="btn btn-primary form-control" <?= !isset($_SESSION['old']) ? 'disabled' : '' ?>>
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <?= isset($_SESSION['alert']) ? //if error is set ? render the following  h4 alert element
                        '<h5 class="alert ' . $_SESSION['alert']['class'] . ' w-100">' . $_SESSION['alert']['message'] . '</h5>' : "" //else, nothing
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
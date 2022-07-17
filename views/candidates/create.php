<div class="container-fluid" id="main-container">
    <div class="row">
        <?php require('./views/layouts/sidebar.php') ?>
        <!-- sidebar == div.col-xs-12.col-md-3 -->
        <div class="col-xs-12 col-md-9">
            <h4 class="alert text-center">Voters<a onclick="history.back()" class="btn btn-primary add-btn"><i class="fa fa-arrow-left"></i> Go Back</a></h4>
            <form action="" method="post" class="row" id="form">
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="text" name="names" class="form-control must-fill" placeholder="Candidate's Names">
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <input type="text" name="political_group" class="form-control must-fill" placeholder="Candidate's Political Group">
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <span>Areas Campaigning For: <i class="text text-secondary">N/A</i></span><br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php
                        $areaRadio = '';
                        for ($i = 0; $i < count($data); $i++) {
                            $areaRadio .= '<label class="btn btn-secondary">';
                            $areaRadio .= '<input type="radio" class="selected-radio" name="options" id="' . $data[$i]['id'] . '-' . $data[$i]['area'] . '"> ' . $data[$i]['area'];
                            $areaRadio .= '</label>';
                        }
                        echo $areaRadio;
                        ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <span>District Campaigning For: <i class="text text-secondary">N/A</i></span><br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php
                        $districts[0] = !empty($data) ? $data[0] : null;
                        if ($districts) {
                            for ($i = 0; $i < count($data); $i++) { //this will be done for every data array element
                                for ($j = 0; $j < count($districts); $j++) { //this will be to every district array element
                                    if ($districts[$j]['district'] != $data[$i]['district']) {
                                        array_push($districts, $data[$i]);
                                    }
                                }
                            }
                            $districtRadio = '';
                            for ($i = 0; $i < count($districts); $i++) {
                                $districtRadio .= '<label class="btn btn-secondary">';
                                $districtRadio .= '<input type="radio" class="selected-radio" name="options" id="' . $districts[$i]['id'] . '-' . $districts[$i]['district'] . '"> ' . $districts[$i]['district'];
                                $districtRadio .= '</label>';
                            }
                            echo $districtRadio;
                        }
                        ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-7 mb-3">
                    <span>District Campaigning For: <i class="text text-secondary">N/A</i></span><br />
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php
                        $wards[0] = !empty($data) ? $data[0] : null;
                        if ($wards) {
                            for ($i = 0; $i < count($data); $i++) { //this will be done for every data array element
                                for ($j = 0; $j < count($wards); $j++) { //this will be to every district array element
                                    if ($wards[$j]['ward'] != $data[$i]['ward']) {
                                        array_push($wards, $data[$i]);
                                    }
                                }
                            }
                            $districtRadio = '';
                            for ($i = 0; $i < count($wards); $i++) {
                                $districtRadio .= '<label class="btn btn-secondary">';
                                $districtRadio .= '<input type="radio" class="selected-radio" name="options" id="' . $wards[$i]['id'] . '-' . $wards[$i]['ward'] . '"> ' . $wards[$i]['ward'];
                                $districtRadio .= '</label>';
                            }
                            echo $districtRadio;
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid" id="main-container">
    <div class="row">
        <?php require('./views/layouts/sidebar.php') ?>
        <!-- sidebar == div.col-xs-12.col-md-3 -->
        <div class="col-xs-12 col-md-9">
            <h4 class="alert text-center">Voters<a href="?page=voters&subpage=create" class="btn btn-primary add-btn"><i class="fa fa-plus"></i> Add Voter</a></h4>
            <div class="table-responsive">
                <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th>Names</th>
                            <th>ID Number</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Area</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tr = '';
                        foreach ($data as $voter) {
                            $tr .= '<tr>';
                            $tr .= '<td>' . $voter['names'] . '</td>';
                            $tr .= '<td>'.$voter['id_number'].'</td>';
                            $tr .= '<td>'.$voter['age'].'</td>';
                            $tr .= '<td>'.ucfirst($voter['gender']).'</td>';
                            $tr .= '<td>'.ucwords($voter['area'] . ' - ' .$voter['district'] .' ('.$voter['code'].') ').'</td>';
                            $tr .= '<td><a href="?page=voters&subpage=edit&id='.$voter['id'].'" class="btn btn-warning">Edit</a> <button class="btn btn-danger">Delete</button></td>';
                            $tr .= '</tr>';
                        }
                        echo $tr;
                        ?>
                    </tbody>
                </table>
                <?php
                $page_url = '?page=voters&subpage=view&';
                $total_rows = $count;
                include_once './views/layouts/pagination.php';
                ?>
            </div>
        </div>
    </div>
</div>
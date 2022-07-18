<div class="container-fluid" id="main-container">
    <div class="row">
        <?php require('./views/layouts/sidebar.php') ?>
        <!-- sidebar == div.col-xs-12.col-md-3 -->
        <div class="col-xs-12 col-md-9">
            <h4 class="alert text-center">Candidates<a href="?page=candidates&subpage=create" class="btn btn-primary add-btn"><i class="fa fa-plus"></i> Add Candidate</a></h4>
            <div class="table-responsive">
                <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th>Names</th>
                            <th>Political Group</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tr = '';
                        for ($i = 0; $i < count($data); $i++) {
                            $tr .= '<tr>';
                            $tr .= '<td>' . $data[$i]['names'] . '</td>';
                            $tr .= '<td>' . $data[$i]['political_group'] . '</td>';
                            $tr .= '<td><a href="?page=candidates&subpage=edit&id=' . $data[$i]['id'] . '" class="btn btn-warning">Edit</a> <a onclick="confirmDelete(this)" data-action="candidate" class="btn btn-danger">Delete</a></td>';
                            $tr .= '</tr>';
                        }
                        echo $tr;
                        ?>
                    </tbody>
                </table>
                <?php
                $page_url = '?page=candidates&subpage=view&';
                $total_rows = $count;
                include_once './views/layouts/pagination.php';
                ?>
            </div>
        </div>
    </div>
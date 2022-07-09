<div class="col-xs-12 col-md-3 sidebar">
    <h4 class="alert text-light">Admin Menu</h4>
    <ul class="navbar-nav">
        <li class="nav-item <?= $_SESSION['url']['page'] == 'home' ? 'active' : '' ?>">
            <a href="?page=home" class="nav-link">Overview</a>
        </li>
        <li class="nav-item <?= $_SESSION['url']['page'] == 'voters' ? 'active' : '' ?>">
            <a href="?page=voters" class="nav-link">Manage Voters</a>
        </li>
        <li class="nav-item <?= $_SESSION['url']['page'] == 'candidates' ? 'active' : '' ?>">
            <a href="?page=candidates" class="nav-link">Manage Candidates</a>
        </li>
        <li class="nav-item <?= $_SESSION['url']['page'] == 'reports' ? 'active' : '' ?>">
            <a href="?page=reports" class="nav-link">Reports</a>
        </li>
        <li class="nav-item <?= $_SESSION['url']['page'] == 'accounts' ? 'active' : '' ?>">
            <a href="?page=accounts" class="nav-link">Manage Accounts</a>
        </li>
        <li class="nav-item <?= $_SESSION['url']['page'] == 'profile' ? 'active' : '' ?>">
            <a href="?page=home" class="nav-link">Profile</a>
        </li>
    </ul>
</div>
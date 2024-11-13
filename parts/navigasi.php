<?php
    $_username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Username';
?>
<div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=berita">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=user">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=testing">Testing</a>
                    </li>
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            <?php echo $_username;?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?page=change-password">Profile</a>
                            <a class="dropdown-item" href="index.php?page=logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
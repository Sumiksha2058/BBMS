<nav class="navbar navbar-expand px-3 border-bottom" style="background-color: #B97272; position: fixed; top: 0; width: 100%; z-index: 1000;">
    <button class="btn" id="sidebar-toggle" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse navbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                    <h5>Hello, <?php echo htmlspecialchars($user['fullname']); ?></h5>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Setting</a>
                    <a href="#" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

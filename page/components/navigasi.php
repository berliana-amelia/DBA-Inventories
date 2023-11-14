        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DBA Inventory</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">
                    <i class=" fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Halaman
            </div>
            <li class="nav-item">
                <a class="nav-link" href="oracle-prod.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>DB Oracle-Prod</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="oracle-nonprod.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>DB Oracle-Non Prod</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dbnonoracle.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>DB Non-Oracle</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                General Information
            </div>
            <?php if ($isAdmin) : ?>

                <li class="nav-item">
                    <a class="nav-link" href="users.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Users</span></a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Profile</span></a>
            </li>
            <hr class="sidebar-divider">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <script>
            function redirectToIndex() {
                // Use JavaScript to redirect to the desired location
                window.location.href = "/index.php";
            }
        </script>
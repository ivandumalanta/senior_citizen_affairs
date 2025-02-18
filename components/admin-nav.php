<?php
$current_page = basename($_SERVER['PHP_SELF']); // Get current file name
?>

<div class="sidebar">
    <img src="../admin/assets/logo2.png" alt="senior citizen affairs logo" class="logoposition">
    <p>OSCA <br> Malasiqui</p>
    <ul class="nav navbar-nav">
        <li class="<?= ($current_page == 'index.php') ? 'active' : ''; ?>">
            <a href="././index.php"><i class="bi bi-house-door"></i> Dashboard</a>
        </li>
        <li class="<?= ($current_page == 'chat.php') ? 'active' : ''; ?>">
            <a href="././chat.php"><i class="bi bi-envelope"></i> Message</a>
        </li>
        <li class="<?= ($current_page == 'applicants.php') ? 'active' : ''; ?>">
            <a href="././applicants.php"><i class="bi bi-person"></i> Applicants</a>
        </li>
        <li class="<?= ($current_page == 'appointments.php') ? 'active' : ''; ?>">
            <a href="././appointments.php"><i class="bi bi-person"></i> Appointments</a>
        </li>
        <li class="<?= ($current_page == 'ids_distribution.php') ? 'active' : ''; ?>">
            <a href="././ids_distribution.php"><i class="bi bi-person"></i> IDs Distribution</a>
        </li>
        <li class="<?= ($current_page == 'notifications.php') ? 'active' : ''; ?>">
            <a href="././notifications.php"><i class="bi bi-bell"></i> Notifications</a>
        </li>
        <li class="<?= ($current_page == 'activity_index.php') ? 'active' : ''; ?>">
            <a href="././activity_index.php"><i class="bi bi-calendar-event"></i> Activities</a>
        </li>
        <li class="<?= ($current_page == 'news.php') ? 'active' : ''; ?>">
            <a href="././news.php"><i class="bi bi-newspaper"></i> News</a>
        </li>
        <li>
            <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </li>
    </ul>
</div>

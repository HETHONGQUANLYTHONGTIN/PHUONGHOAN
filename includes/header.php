<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/responsive.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <a href="<?php echo SITE_URL; ?>/index.php">HTTTQL</a>
            </div>
            <nav class="navbar-menu">
                <ul>
                    <li><a href="<?php echo SITE_URL; ?>/index.php">Trang chủ</a></li>
                    <li><span class="user-info">Chào, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Khách'); ?></span></li>
                    <li><a href="<?php echo SITE_URL; ?>/logout.php" class="logout-btn">Đăng xuất</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container">

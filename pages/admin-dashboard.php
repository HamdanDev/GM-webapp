<?php
require_once __DIR__ . '/../includes/session.php';
require_permission('admin.dashboard');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Profile-Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Lato:wght@300;400;700&amp;display=swap" rel="stylesheet" />
    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/admin/dashboard.css" rel="stylesheet" />
    <link href="../assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <?php require __DIR__ . '/admin/navbar.php'; ?>
    <div class="container py-4">
        <div class="row g-4">
            <?php require __DIR__ . '/admin/sidebar.php'; ?>
            <div class="col-12 col-md-9">
                <?php require __DIR__ . '/admin/sections.php'; ?>
            </div>
        </div>
    </div>
    <?php require __DIR__ . '/admin/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/components/table-pagination.js"></script>
    <script src="../assets/js/admin/dashboard.js"></script>
</body>

</html>

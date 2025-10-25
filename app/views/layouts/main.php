<!-- app/views/layouts/main.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'My Portfolio' ?></title>
    <link rel="stylesheet" href="/public/assets/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <?php require $viewPath; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>

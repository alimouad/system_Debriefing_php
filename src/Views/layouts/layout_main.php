<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Blog - Web App</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            lightMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#0a0f1c',
                    },
                    fontFamily: {
                        "sans": ["poppins", "sans-serif"],
                        "display": ["poppins", "sans-serif"],
                        "body": ["poppins", "sans-serif"],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50  min-h-screen">
    <?php require_once __DIR__ . '/header.php' ?>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex gap-8">
            <!-- Sidebar -->

            
            <!-- Main Content -->
            <main class="flex-1 min-w-0">
                <?= $content ?>
            </main>
</body>

</html>
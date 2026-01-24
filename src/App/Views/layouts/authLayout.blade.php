<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debriefing System | @yield('title', 'Welcome')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff4f7a',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .pink-gradient {
            background: linear-gradient(90deg, #ff6b8b 0%, #ff4f7a 100%);
        }
        /* Glassmorphism utility */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 font-sans min-h-screen flex flex-col">
   
    <div class="flex-grow flex items-center justify-center px-6 py-8">
        <div class="flex flex-col md:flex-row gap-8 w-full justify-center">
            
            <main class="flex-none w-full max-w-[400px] animate-in fade-in slide-in-from-bottom-4 duration-700">

                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>
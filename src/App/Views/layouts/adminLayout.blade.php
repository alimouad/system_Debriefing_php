<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debriefing System | @yield('title', 'Dashboard')</title>
    
    {{-- Google Fonts & Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Libraries --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#ff4f7a' },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                }
            }
        }
    </script>
    
    <style>
        .pink-gradient { background: linear-gradient(90deg, #ff6b8b 0%, #ff4f7a 100%); }
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>

    {{-- Allows specific pages to inject custom CSS/styles --}}
    @stack('styles')
</head>

<body class="bg-slate-50 font-sans h-screen overflow-hidden">
    
    <div class="flex h-full w-full">
        
        {{-- SideBar Component --}}
        @include('partials.sideBar')

        <main class="ml-64 flex-1 h-full overflow-y-auto relative scroll-smooth p-8 lg:p-12">

            @include('partials.flashMessage') 

            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>

    @stack('scripts')
</body>
</html>
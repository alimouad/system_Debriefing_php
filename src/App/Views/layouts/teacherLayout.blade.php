<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal | @yield('title', 'Dashboard')</title>
    
    {{-- Core Assets --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#ff4f7a', teacher: '#6366f1' },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                }
            }
        }
    </script>
    
    <style>
        .pink-gradient { background: linear-gradient(90deg, #ff6b8b 0%, #ff4f7a 100%); }
        .indigo-gradient { background: linear-gradient(90deg, #818cf8 0%, #6366f1 100%); }
        .glass { background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(12px); }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>

<body class="bg-[#f8fafc] font-sans h-screen overflow-hidden text-slate-900">
    
    <div class="flex h-full w-full">
        
        {{-- Teacher Sidebar --}}
        @include ('partials.sidebarTeacher') 
        {{-- Main Content Area --}}
        <main class="flex-1 h-full overflow-y-auto relative scroll-smooth bg-slate-50/50">
            {{-- Top Navbar --}}
        @include('partials.headerTeacher')   
 <main class=" flex-1 h-full overflow-y-auto relative scroll-smooth p-12">

            @include('partials.flashMessage') 

            <div class="max-w-full mx-auto">
                @yield('content')
            </div>
        </main>
        </main>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | @yield('title', 'My Progress')</title>
    
    {{-- Core Assets --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        primary: '#ff4f7a', 
                        student: '#10b981', // Emerald 500
                        accent: '#14b8a6'    // Teal 500
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                }
            }
        }
    </script>
    
    <style>
        .emerald-gradient { background: linear-gradient(90deg, #34d399 0%, #10b981 100%); }
        .glass { background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(12px); }
        .skill-bar-glow { box-shadow: 0 0 15px rgba(16, 185, 129, 0.3); }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: #ecfdf5; border-radius: 10px; }
    </style>
</head>

<body class="bg-[#f0f9f6] font-sans h-screen overflow-hidden text-slate-900">
    
    <div class="flex h-full w-full">
        
        {{-- Student Sidebar --}}
        <aside class="w-72 h-full bg-white border-r border-emerald-50 flex flex-col p-8 z-50">
            <div class="flex items-center gap-3 mb-12 px-2">
                <div class="w-10 h-10 emerald-gradient rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                    <span class="material-symbols-outlined text-2xl font-bold">rocket_launch</span>
                </div>
                <span class="text-xl font-black tracking-tighter italic">Student.<span class="text-emerald-600">Hub</span></span>
            </div>


            {{-- Experience Points / Level Card (Gamification) --}}
            <div class="mt-auto p-6 rounded-[2.5rem] bg-emerald-900 text-white relative overflow-hidden mb-6">
                <div class="absolute -top-4 -right-4 w-16 h-16 bg-white/10 rounded-full blur-xl"></div>
                <p class="text-[9px] font-black uppercase tracking-[0.2em] text-emerald-400 mb-1">Pedagogical Level</p>
                <p class="text-lg font-black tracking-tight mb-4">Autonomous <span class="text-emerald-400">Lvl 2</span></p>
                <div class="h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-400 w-2/3"></div>
                </div>
            </div>

            {{-- Logout --}}
            <a href="/logout" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition-all duration-300">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm font-bold">Sign Out</span>
            </a>
        </aside>

        {{-- Main Content Area --}}
        <main class="flex-1 h-full overflow-y-auto relative scroll-smooth">
            {{-- Floating Top Navbar --}}
            <header class="sticky top-0 z-40 glass border-b border-emerald-100/50 px-12 py-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Active Sprint: {{ $_SESSION['sprint_title'] ?? 'Global Cycle' }}</span>
                </div>
                
                <div class="flex items-center gap-6">
                    {{-- Student Notifications --}}
                    <button class="relative w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-slate-100 text-slate-400 hover:text-emerald-500 transition-colors">
                        <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                        <span class="material-symbols-outlined text-xl">notifications</span>
                    </button>
                    
                    <div class="flex items-center gap-3 pl-4 border-l border-slate-100">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-black text-slate-800">{{ $_SESSION['user_name'] }}</p>
                            <p class="text-[9px] font-bold text-emerald-500 uppercase tracking-widest">Student</p>
                        </div>
                        <div class="w-11 h-11 rounded-2xl bg-emerald-100 border-2 border-white shadow-sm flex items-center justify-center text-emerald-700 font-black">
                            {{ substr($_SESSION['user_name'], 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8">
                @include('partials.flashMessage')
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
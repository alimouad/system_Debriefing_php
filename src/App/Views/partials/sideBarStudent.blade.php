    {{-- Student Sidebar --}}
    <aside class="w-72 h-full bg-white border-r border-emerald-50 flex flex-col p-8 z-50">
        <div class="flex items-center gap-3 mb-12 px-2">
            <div class="w-10 h-10 emerald-gradient rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                <span class="material-symbols-outlined text-2xl font-bold">rocket_launch</span>
            </div>
            <span class="text-xl font-black tracking-tighter italic">Student.<span class="text-emerald-600">Hub</span></span>
        </div>


        <nav class="space-y-3 flex-1 px-4">
            @php
            $currentPath = $_SERVER['REQUEST_URI'];
            @endphp

            {{-- Home Link --}}
            <a href="/student/home"
                class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
        {{ str_contains($currentPath, '/student/home') ? 'bg-student text-white shadow-lg' : 'text-slate-400 hover:text-student hover:bg-slate-50' }}">
                <div class="flex items-center gap-4">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-bold text-sm tracking-tight">My Dashboard</span>
                </div>
                {{-- Only show the dot if NOT active, or change color to white if active --}}
                @if(str_contains($currentPath, '/student/home'))
                <div class="w-1.5 h-1.5 rounded-full bg-white/40"></div>
                @endif
            </a>


            {{-- Briefs Link --}}
            <a href="/student/briefs"
                class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
        {{ str_contains($currentPath, '/student/briefs') ? 'bg-student text-white shadow-lg' : 'text-slate-400 hover:text-student hover:bg-slate-50' }}">
                <div class="flex items-center gap-4">
                    <i data-lucide="scroll-text" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-bold text-sm tracking-tight">My Briefs</span>
                </div>
                @if(str_contains($currentPath, '/student/briefs'))
                <div class="w-1.5 h-1.5 rounded-full bg-white/40"></div>
                @endif
            </a>

            {{-- Rendus (Submissions) Link --}}
            <a href="/student/evaluations"
                class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
        {{ str_contains($currentPath, '/student/evaluations') ? 'bg-student text-white shadow-lg' : 'text-slate-400 hover:text-student hover:bg-slate-50' }}">
                <div class="flex items-center gap-4">
                    <i data-lucide="send" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                    <span class="font-bold text-sm tracking-tight">My Evaluations</span>
                </div>
                @if(str_contains($currentPath, '/student/evaluations'))
                <div class="w-1.5 h-1.5 rounded-full bg-white/40"></div>
                @endif
            </a>
        </nav>

        {{-- Logout --}}
        <a href="/logout" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:text-white hover:bg-student transition-all duration-300">
            <span class="material-symbols-outlined">logout</span>
            <span class="text-sm font-bold">Sign Out</span>
        </a>
    </aside>
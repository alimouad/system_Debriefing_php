<aside class="w-72 glass border-r border-white/40 p-8 flex flex-col fixed h-full z-50 shadow-[20px_0_40px_rgba(0,0,0,0.02)]">

    <div class="flex items-center gap-4 mb-12 px-2">
        <div class="w-12 h-12 pink-gradient rounded-2xl flex items-center justify-center text-white shadow-lg shadow-pink-200/50">
            <i data-lucide="graduation-cap" class="w-7 h-7"></i>
        </div>
        <div>
            <span class="text-xl font-black text-slate-800 tracking-tighter block leading-none">Debrief.me</span>
            <span class="text-[9px] font-bold text-primary uppercase tracking-[0.2em]">Management</span>
        </div>
    </div>

    <nav class="space-y-3 flex-1 px-4">
        @php
        $currentPath = $_SERVER['REQUEST_URI'];
        @endphp

        {{-- Dashboard --}}
        <a href="/admin/home"
            class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
       {{ str_contains($currentPath, '/admin/home') ? 'pink-gradient text-white shadow-xl shadow-pink-500/20' : 'text-slate-400 hover:text-pink-500 hover:bg-pink-50/50' }}">
            <div class="flex items-center gap-4">
                <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-sm tracking-tight">Dashboard</span>
            </div>
            @if(str_contains($currentPath, '/admin/dashboard'))
            <i data-lucide="chevron-right" class="w-4 h-4 opacity-50"></i>
            @endif
        </a>

        {{-- Users --}}
        <a href="/admin/users"
            class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
       {{ str_contains($currentPath, '/admin/users') ? 'pink-gradient text-white shadow-xl shadow-pink-500/20' : 'text-slate-400 hover:text-pink-500 hover:bg-pink-50/50' }}">
            <div class="flex items-center gap-4">
                <i data-lucide="users" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-sm tracking-tight">Users</span>
            </div>
            @if(str_contains($currentPath, '/admin/users'))
            <i data-lucide="chevron-right" class="w-4 h-4 opacity-50"></i>
            @endif
        </a>

        {{-- Classrooms --}}
        <a href="/admin/classroom"
            class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
       {{ str_contains($currentPath, '/admin/classroom') ? 'pink-gradient text-white shadow-xl shadow-pink-500/20' : 'text-slate-400 hover:text-pink-500 hover:bg-pink-50/50' }}">
            <div class="flex items-center gap-4">
                <i data-lucide="book-open" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-sm tracking-tight">Classrooms</span>
            </div>
            @if(str_contains($currentPath, '/admin/classroom'))
            <i data-lucide="chevron-right" class="w-4 h-4 opacity-50"></i>
            @endif
        </a>

        {{-- Skills --}}
        <a href="/admin/skills"
            class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
       {{ str_contains($currentPath, '/admin/skills') ? 'pink-gradient text-white shadow-xl shadow-pink-500/20' : 'text-slate-400 hover:text-pink-500 hover:bg-pink-50/50' }}">
            <div class="flex items-center gap-4">
                <i data-lucide="target" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-sm tracking-tight">Skills</span>
            </div>
            @if(str_contains($currentPath, '/admin/skills'))
            <i data-lucide="chevron-right" class="w-4 h-4 opacity-50"></i>
            @endif
        </a>

        {{-- Sprints --}}
        <a href="/admin/sprints"
            class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
       {{ str_contains($currentPath, '/admin/sprints') ? 'pink-gradient text-white shadow-xl shadow-pink-500/20' : 'text-slate-400 hover:text-pink-500 hover:bg-pink-50/50' }}">
            <div class="flex items-center gap-4">
                <i data-lucide="zap" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                <span class="font-bold text-sm tracking-tight">Sprints</span>
            </div>
            @if(str_contains($currentPath, '/admin/sprints'))
            <i data-lucide="chevron-right" class="w-4 h-4 opacity-50"></i>
            @endif
        </a>
    </nav>

    <div class="pt-8 mt-auto border-t border-slate-100">
        <div class="bg-slate-50/50 p-4 rounded-3xl mb-4 flex items-center gap-3 border border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-primary">
                <i data-lucide="user-cog" class="w-5 h-5"></i>
            </div>
            <div class="overflow-hidden">
                <p class="text-[11px] font-black text-slate-800 truncate">Admin Profile</p>
                <p class="text-[9px] font-bold text-slate-400 uppercase truncate">Super Admin</p>
            </div>
        </div>

        <a href="/logout" class="flex items-center gap-4 p-4 rounded-[1.5rem] text-rose-400 hover:bg-rose-50 transition-all group">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center group-hover:bg-rose-100 transition-colors">
                <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
            </div>
            <span class="font-bold text-sm">Logout</span>
        </a>
    </div>
</aside>
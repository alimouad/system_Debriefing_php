    {{-- Breadcrumbs & Header --}}
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-6">
            <a href="/student/home" class="w-14 h-14 rounded-2xl bg-white shadow-sm border border-emerald-100 flex items-center justify-center text-slate-400 hover:text-emerald-500 transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-1">
                    <span>Assignments</span>
                    <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                    <span class="text-emerald-600">Project Details</span>
                </nav>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight leading-none">{{ $brief['title'] }}</h1>
            </div>
        </div>


    </header>
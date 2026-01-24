 <header class="sticky top-0 z-40 glass border-b border-slate-100 px-12 py-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-slate-400">calendar_today</span>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">{{ date('l, F jS') }}</span>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 border-2 border-white rounded-full"></span>
                        <span class="material-symbols-outlined text-slate-400">notifications</span>
                    </div>
                    <div class="h-8 w-[1px] bg-slate-200"></div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full border border-indigo-100">
                        {{ $_SESSION['classroom_name'] ?? 'Active Session' }}
                    </p>
                </div>
            </header>
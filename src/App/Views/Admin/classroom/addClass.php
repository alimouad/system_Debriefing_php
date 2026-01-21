<div class="w-full min-h-[calc(100vh-120px)] space-y-8 animate-in fade-in slide-in-from-bottom-8 duration-1000 ease-out">
   <?php if (isset($data["errors"]["db"])): ?>
    <div class="flex items-center gap-4 p-5 rounded-[2rem] bg-rose-50/60 backdrop-blur-md text-rose-600 border border-rose-100 shadow-[0_10px_30px_-10px_rgba(244,63,94,0.2)] animate-in fade-in slide-in-from-top-4 duration-500 mb-6">

        
        <div class="flex-1">
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70">Database Error</h4>
            <p class="text-sm font-bold leading-relaxed">
                <?= htmlspecialchars($data["errors"]["db"]); ?>
            </p>
        </div>

        <button onclick="this.parentElement.remove()" class="text-rose-300 hover:text-rose-500 transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
<?php endif; ?>


    <div class="flex items-center justify-between mb-2 px-2">
        <div class="flex items-center gap-6">
            <a href="/admin/classroom" class="group w-14 h-14 rounded-[1.8rem] bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-primary transition-all hover:shadow-md border border-slate-100">
                <span class="material-symbols-outlined text-3xl group-hover:-translate-x-1 transition-transform">arrow_back</span>
            </a>
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Add New <span class="text-transparent bg-clip-text pink-gradient">Classroom</span></h1>
                <p class="text-slate-400 font-medium">Register a new academic group for the debriefing cycle</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <section class="lg:col-span-2 bg-white/70 backdrop-blur-3xl rounded-[3.5rem] p-10 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.06)] border border-white/80 ring-1 ring-black/[0.01]">
            <form action="" method="POST" class="space-y-8" novalidate>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6">Classroom Name</label>
                        <div class="relative group">
                            <input type="text" name="name" placeholder="e.g. Full Stack Development" required
                                class="w-full px-8 py-5 bg-slate-50/50 border-2 border-transparent rounded-[2rem] text-slate-700 placeholder-slate-400
                                       focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-200 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.04)]">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6">Academic Year</label>
                        <div class="relative group">
                            <input type="text" name="year" placeholder="e.g. 2025/2026" required
                                class="w-full px-8 py-5 bg-slate-50/50 border-2 border-transparent rounded-[2rem] text-slate-700 placeholder-slate-400
                                       focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-200 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.04)]">
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6">Additional Notes (Optional)</label>
                    <textarea name="description" placeholder="Describe the focus or specific details of this group..."
                        class="w-full px-8 py-5 bg-slate-50/50 border-2 border-transparent rounded-[2.5rem] text-slate-700 placeholder-slate-400
                               focus:bg-white focus:ring-4 focus:ring-pink-100 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.04)] min-h-[120px] resize-none"></textarea>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit" 
                        class="px-12 py-5 pink-gradient text-white font-black rounded-[2rem] shadow-2xl shadow-pink-500/30 hover:-translate-y-2 hover:shadow-pink-500/50 active:scale-95 transition-all duration-500 text-lg flex items-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        Create Classroom
                    </button>
                </div>
            </form>
        </section>

        <aside class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden flex flex-col justify-between h-full">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-8 border border-white/10">
                    <span class="material-symbols-outlined text-3xl text-primary">info</span>
                </div>
                <h3 class="text-2xl font-black mb-6 tracking-tight">Setup Tips</h3>
                
                <ul class="space-y-8">
                    <li class="flex gap-4">
                        <div class="w-6 h-6 rounded-full bg-primary flex-shrink-0 flex items-center justify-center text-[10px] font-black">01</div>
                        <p class="text-slate-400 text-sm leading-relaxed italic">The <span class="text-white font-bold">Classroom Name</span> will be used in student profiles and sprint assignments.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="w-6 h-6 rounded-full bg-primary flex-shrink-0 flex items-center justify-center text-[10px] font-black">02</div>
                        <p class="text-slate-400 text-sm leading-relaxed italic">Specify the <span class="text-white font-bold">Academic Year</span> to keep historical data organized across sessions.</p>
                    </li>
                </ul>
            </div>
            
            <div class="relative z-10 mt-12 p-6 bg-white/5 rounded-[2.2rem] border border-white/10 backdrop-blur-sm">
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-300">Database Connection</span>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Verified: All classrooms are linked to the <span class="text-primary font-bold">debri_db</span> master table.
                </p>
            </div>
        </aside>
    </div>
</div>
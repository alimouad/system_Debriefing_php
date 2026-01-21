<div class="space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-2">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">
                <a href="/admin/dashboard" class="hover:text-primary transition-colors">Admin</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-slate-900">Classrooms</span>
            </nav>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Active <span class="text-transparent bg-clip-text pink-gradient">Classrooms</span></h1>
            <p class="text-slate-400 font-medium mt-1">Manage student groups and academic years.</p>
        </div>
        
        <a href="/admin/classroom/create" class="flex items-center gap-3 px-8 py-5 pink-gradient text-white font-black rounded-[2rem] shadow-2xl shadow-pink-500/40 hover:-translate-y-1 transition-all duration-300 group">
            <span class="material-symbols-outlined group-hover:rotate-90 transition-transform duration-500">add_circle</span>
            <span>Add Classroom</span>
        </a>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        
        <?php if (empty($classrooms)): ?>
            <div class="col-span-full py-20 text-center bg-white/50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold uppercase tracking-widest">No classrooms found</p>
                <a href="/admin/classroom/create" class="text-primary font-black text-sm mt-2 inline-block">Create your first one →</a>
            </div>
        <?php else: ?>
            <?php foreach ($classrooms as $class): ?>
                <div class="bg-white/80 backdrop-blur-2xl rounded-[3.5rem] p-8 border border-white shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] group hover:shadow-xl transition-all duration-500 relative overflow-hidden">
                    
                    <div class="w-16 h-16 rounded-[2rem] bg-slate-50 text-primary flex items-center justify-center mb-8 group-hover:pink-gradient group-hover:text-pink  transition-all duration-500 shadow-sm">
                        <span class="material-symbols-outlined text-4xl">groups</span>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-2xl font-black text-slate-900 mb-1"><?= htmlspecialchars($class['name']) ?></h3>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 bg-pink-50 text-primary text-[10px] font-black rounded-full uppercase tracking-tighter">
                                Year: <?= htmlspecialchars($class['year'] ?? 'N/A') ?>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Created On</span>
                            <span class="text-xs font-bold text-slate-700"><?= date('M d, Y', strtotime($class['created_at'])) ?></span>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="/admin/classroom/edit?id=<?= $class['id'] ?>" class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white hover:shadow-xl transition-all">
                                <span class="material-symbols-outlined">edit_square</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>
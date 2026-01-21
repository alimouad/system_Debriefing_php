<div class="space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000 ease-out">

    <header class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 px-4">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">
                <a href="/admin/dashboard" class="hover:text-primary transition-colors">Admin</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-slate-900">User Directory</span>
            </nav>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight leading-none">Global <span class="text-transparent bg-clip-text pink-gradient">Community</span></h1>
            <p class="text-slate-400 font-medium mt-3">Overview of all active mentors and student participants.</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-4">
            <div class="relative group hidden md:block">
                <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">search</span>
                <input type="text" placeholder="Search members..." 
                    class="pl-14 pr-8 py-4 bg-white/50 border border-transparent rounded-2xl outline-none focus:bg-white focus:ring-4 focus:ring-pink-100 transition-all w-64 shadow-sm text-sm font-medium">
            </div>

            <a href="/admin/users/create" class="flex items-center gap-3 px-8 py-5 pink-gradient text-white font-black rounded-[2rem] shadow-2xl shadow-pink-500/40 hover:-translate-y-1 hover:shadow-pink-500/60 transition-all duration-300 group">
                <span class="material-symbols-outlined group-hover:rotate-90 transition-transform">person_add</span>
                <span>Add Member</span>
            </a>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8 px-2">
        
        <?php if (empty($users)): ?>
            <div class="col-span-full py-32 flex flex-col items-center justify-center text-center space-y-6 bg-white/30 backdrop-blur-xl rounded-[4rem] border-2 border-dashed border-slate-200">
                <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center text-slate-300">
                    <span class="material-symbols-outlined text-5xl">group_off</span>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-800">No members found</h3>
                    <p class="text-slate-400 font-medium">Start building your community by adding users.</p>
                </div>
                <a href="/admin/users/create" class="text-primary font-black uppercase tracking-widest text-xs hover:underline decoration-2 underline-offset-8">
                    Create the first account →
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <?php 
                    $isTeacher = ($user['role'] === 'TEACHER'); 
                    $accentClass = $isTeacher ? 'indigo' : 'pink';
                ?>
                <div class="bg-white/80 backdrop-blur-3xl rounded-[3.5rem] p-8 border border-white shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] relative overflow-hidden group hover:shadow-2xl hover:shadow-<?= $accentClass ?>-500/10 transition-all duration-700 hover:-translate-y-2">
                    
                    <div class="absolute top-0 right-0 p-8">
                        <div class="flex items-center gap-2 bg-<?= $accentClass ?>-50/80 px-4 py-1.5 rounded-full border border-<?= $accentClass ?>-100/50 backdrop-blur-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-<?= $isTeacher ? 'indigo' : 'primary' ?> animate-pulse"></span>
                            <span class="text-[10px] font-black text-<?= $isTeacher ? 'indigo-600' : 'primary' ?> uppercase tracking-widest">
                                <?= $user['role'] ?>
                            </span>
                        </div>
                    </div>

                    <div class="w-16 h-16 rounded-[2rem] bg-<?= $accentClass ?>-50 text-<?= $isTeacher ? 'indigo-500' : 'primary' ?> flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 shadow-sm border border-white">
                        <span class="material-symbols-outlined text-4xl">
                            <?= $isTeacher ? 'co_present' : 'person' ?>
                        </span>
                    </div>

                    <div class="mb-10">
                        <h3 class="text-xl font-black text-slate-900 mb-1 tracking-tight leading-tight">
                            <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
                        </h3>
                        <p class="text-slate-400 text-xs font-bold mb-6 truncate"><?= htmlspecialchars($user['email']) ?></p>
                        
                        <div class="p-4 rounded-3xl bg-slate-50/50 border border-slate-100/50">
                            <?php if (!$isTeacher): ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-primary shadow-sm">
                                        <span class="material-symbols-outlined text-lg">school</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Classroom</span>
                                        <span class="text-xs font-bold text-slate-700 leading-none">
                                            <?= htmlspecialchars($user['classroom_name'] ?? 'Not Enrolled') ?>
                                        </span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center text-indigo-500 shadow-sm">
                                        <span class="material-symbols-outlined text-lg">verified_user</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Authority</span>
                                        <span class="text-xs font-bold text-slate-700 leading-none">Full Faculty Access</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Member Since</span>
                            <span class="text-xs font-bold text-slate-500 italic"><?= date('M Y', strtotime($user['created_at'])) ?></span>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="/admin/users/edit?id=<?= $user['id'] ?>" class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-slate-400 hover:text-primary hover:shadow-xl hover:border-pink-100 border border-transparent transition-all duration-300 shadow-sm">
                                <span class="material-symbols-outlined text-xl">edit_note</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>
<div class="w-full min-h-[calc(100vh-120px)] space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000 ease-out">
    
    <?php if (isset($data["errors"]["db"])): ?>
        <div class="flex items-center gap-4 p-5 rounded-[2.5rem] bg-rose-50/60 backdrop-blur-xl text-rose-600 border border-rose-100 shadow-[0_20px_40px_-15px_rgba(225,29,72,0.1)] animate-in fade-in zoom-in-95 duration-500 mb-6">
            <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-rose-500 shadow-sm">
                <span class="material-symbols-outlined">database_off</span>
            </div>
            <div class="flex-1 px-2">
                <h4 class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70">Execution Failed</h4>
                <p class="text-sm font-bold leading-relaxed"><?= htmlspecialchars($data["errors"]["db"]); ?></p>
            </div>
            <button onclick="this.parentElement.remove()" class="w-10 h-10 rounded-xl hover:bg-rose-100 transition-colors flex items-center justify-center">
                <span class="material-symbols-outlined text-rose-300">close</span>
            </button>
        </div>
    <?php endif; ?>

    <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 px-4">
        <div class="flex items-center gap-8">
            <a href="/admin/users" class="group w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-primary transition-all border border-slate-100 hover:shadow-xl hover:-translate-y-1">
                <span class="material-symbols-outlined text-3xl group-hover:-translate-x-1 transition-transform">arrow_back</span>
            </a>
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight leading-none">New <span class="text-transparent bg-clip-text pink-gradient">Member</span></h1>
                <p class="text-slate-400 font-medium mt-2">Expand your academic community</p>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-8">
            <section class="bg-white/80 backdrop-blur-3xl rounded-[4rem] p-12 shadow-[0_40px_80px_-20px_rgba(0,0,0,0.04)] border border-white ring-1 ring-black/[0.01]">
                <form action="" method="POST" class="space-y-10">
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 ml-4">
                            <span class="w-1.5 h-6 pink-gradient rounded-full"></span>
                            <h2 class="text-sm font-black uppercase tracking-widest text-slate-800">Personal Identity</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 mb-2 block">First Name</label>
                                <input type="text" name="first_name" placeholder="John" required
                                    class="w-full px-8 py-5 bg-slate-100/50 border-2 border-transparent rounded-[2rem] text-slate-700 focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-200 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                            </div>
                            <div class="group">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 mb-2 block">Last Name</label>
                                <input type="text" name="last_name" placeholder="Doe" required
                                    class="w-full px-8 py-5 bg-slate-100/50 border-2 border-transparent rounded-[2rem] text-slate-700 focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-200 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                            </div>
                        </div>

                        <div class="group">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 mb-2 block">Corporate Email</label>
                            <input type="email" name="email" placeholder="john.doe@debrief.me" required
                                class="w-full px-8 py-5 bg-slate-100/50 border-2 border-transparent rounded-[2rem] text-slate-700 focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-200 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3 ml-4">
                            <span class="w-1.5 h-6 pink-gradient rounded-full"></span>
                            <h2 class="text-sm font-black uppercase tracking-widest text-slate-800">Account Configuration</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 block">Role Designation</label>
                                <div class="relative group">
                                    <select name="role" id="roleSelect" onchange="toggleTeacherStudent(this.value)" required
                                        class="w-full px-8 py-5 bg-slate-100/50 border-2 border-transparent rounded-[2rem] text-slate-700 appearance-none focus:bg-white focus:ring-4 focus:ring-pink-100 focus:border-pink-200 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                                        <option value="STUDENT">Student Participant</option>
                                        <option value="TEACHER">Academic Teacher</option>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within:text-primary">expand_more</span>
                                </div>
                            </div>

                            <div class="space-y-3 transition-all duration-500" id="classroomField">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 block">Assigned Classroom</label>
                                <div class="relative group">
                                    <select name="classroom_id"
                                        class="w-full px-8 py-5 bg-slate-100/50 border-2 border-transparent rounded-[2rem] text-slate-700 appearance-none focus:bg-white focus:ring-4 focus:ring-pink-100 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                                        <option value="">Select current class...</option>
                                        <?php foreach($classrooms as $class): ?>
                                            <option value="<?= $class['id'] ?>"><?= htmlspecialchars($class['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">school</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 block">Security Password</label>
                            <input type="password" name="password" placeholder="••••••••••••" required
                                class="w-full px-8 py-5 bg-slate-100/50 border-2 border-transparent rounded-[2rem] text-slate-700 focus:bg-white focus:ring-4 focus:ring-pink-100 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                        </div>
                    </div>

                    <div class="pt-10 flex flex-col md:flex-row items-center gap-6">
                        <button type="submit" 
                            class="w-full md:w-auto px-16 py-6 pink-gradient text-white font-black rounded-[2.5rem] shadow-2xl shadow-pink-500/40 hover:-translate-y-2 hover:shadow-pink-500/60 active:scale-95 transition-all duration-500 text-lg flex items-center justify-center gap-4">
                            <span class="material-symbols-outlined">how_to_reg</span>
                            Generate Account
                        </button>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest max-w-[200px]">By clicking, you grant this user immediate platform access.</p>
                    </div>
                </form>
            </section>
        </div>

        <aside class="lg:col-span-4 space-y-8">
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-[4rem] p-12 text-white shadow-2xl relative overflow-hidden h-full border border-white/5">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary/20 rounded-full blur-[100px]"></div>
                
                <div class="relative z-10 space-y-12">
                    <div class="w-20 h-20 rounded-[2rem] bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/10 shadow-inner">
                        <span class="material-symbols-outlined text-4xl text-primary">verified_user</span>
                    </div>
                    
                    <div class="space-y-4">
                        <h3 class="text-3xl font-black tracking-tight leading-tight">Permission Management</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            Assigning roles correctly ensures the integrity of the <span class="text-white font-bold">Debrief.me</span> data ecosystem.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="p-6 rounded-[2.5rem] bg-white/5 border border-white/5 hover:bg-white/[0.08] transition-colors group">
                            <div class="flex items-center gap-4 mb-3">
                                <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">school</span>
                                <span class="font-black text-xs uppercase tracking-widest text-primary">Student</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Access to personal debriefings, sprint goals, and performance metrics.</p>
                        </div>

                        <div class="p-6 rounded-[2.5rem] bg-white/5 border border-white/5 hover:bg-white/[0.08] transition-colors group">
                            <div class="flex items-center gap-4 mb-3">
                                <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">auto_stories</span>
                                <span class="font-black text-xs uppercase tracking-widest text-primary">Teacher</span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">Authority to initiate sprints, manage classrooms, and submit evaluations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<script>
function toggleTeacherStudent(role) {
    const classroomField = document.getElementById('classroomField');
    if (role === 'TEACHER') {
        classroomField.classList.add('opacity-30', 'grayscale', 'pointer-events-none');
        classroomField.querySelector('select').value = '';
    } else {
        classroomField.classList.remove('opacity-30', 'grayscale', 'pointer-events-none');
    }
}
</script>
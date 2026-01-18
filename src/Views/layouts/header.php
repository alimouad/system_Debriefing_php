<header class="sticky top-0 z-50 bg-primary/100 backdrop-blur-xl border-b border-slate-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between gap-6">

            <div class="flex items-center gap-6">
                <button class="lg:hidden p-2 hover:bg-slate-50 rounded-xl transition-colors text-slate-600">
                    <span class="material-symbols-outlined">menu_open</span>
                </button>
                <a href="/" class="flex items-center gap-2 group">
                    <div class="size-9 bg-slate-900 rounded-xl flex items-center justify-center text-white group-hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-xl">edit_square</span>
                    </div>
                    <h1 class="text-xl font-white tracking-tighter text-white">DailyBlog</h1>
                </a>
            </div>

            <div class="flex items-center gap-4">

                <div class="h-8 w-px bg-slate-100 hidden md:block mx-1"></div>
                <?php if (isset($_SESSION['user_name'])) : ?>
                    <div class="flex items-center gap-3 pl-1">
                        <div class="hidden md:flex flex-col items-end">
                            <span class="text-xs font-black text-white leading-none"><?= $_SESSION['user_name'] ?></span>
                            <a href="/logout" class="text-[10px] font-bold text-slate-400 hover:text-red-500 transition-colors uppercase tracking-wider mt-1">Logout</a>
                        </div>
                        <div class="relative group cursor-pointer">
                            <img
                                src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user_name']) ?>&background=random"
                                alt="Profile"
                                class="size-10 rounded-2xl border-2 border-white shadow-sm object-cover group-hover:ring-2 group-hover:ring-primary/20 transition-all" />
                            <div class="absolute -bottom-1 -right-1 size-4 bg-green-500 border-2 border-white rounded-full"></div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex items-center gap-3 pl-1">
                        <div class="hidden md:flex flex-col items-end">
                            <a href="/login" class="text-[10px] font-bold text-white hover:text-red-500 transition-colors uppercase tracking-wider mt-1">Login</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</header>
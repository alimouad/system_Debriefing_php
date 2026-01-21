<div class="relative">
    
    <!-- soft background glow -->
    <div class="absolute inset-0 blur-3xl opacity-30 bg-gradient-to-br from-pink-200 via-white to-pink-100 rounded-full scale-110"></div>

    <div class="relative bg-white/80 backdrop-blur-xl w-full max-w-[400px] rounded-[3rem] overflow-hidden shadow-[0_25px_60px_rgba(0,0,0,0.06)] border border-white/60 ring-1 ring-black/[0.03]">
        
    <?php if (isset($_SESSION['ERROR_MESSAGE'])): ?>
    <div id="flash-message" class="fixed top-5 right-5 bg-white border-l-4 border-green-500 p-4 rounded-lg shadow-2xl z-[100] flex items-center gap-4 min-w-[320px] animate-slide-in">
        <div class="bg-green-100 p-2 rounded-full">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
        </div>
        <div class="flex-1">
            <p class="text-sm font-bold text-slate-900">Success</p>
            <p class="text-xs text-slate-600"><?= htmlspecialchars($_SESSION['ERROR_MESSAGE']); ?></p>
        </div>
        <button onclick="closeFlash()" class="text-slate-400 hover:text-slate-900">
            <span class="material-symbols-outlined text-xl">close</span>
        </button>
    </div>
    <?php unset($_SESSION['ERROR_MESSAGE']); ?>
<?php endif; ?>
        <!-- HEADER -->
        <div class="px-10 pt-10 pb-6 flex justify-between items-center">
            <span class="text-gray-400 text-[11px] uppercase tracking-[0.2em] font-bold">Debriefing System</span>
            <div class="group cursor-pointer">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-pink-100 to-white flex items-center justify-center border border-gray-100 shadow-sm group-hover:scale-105 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- BODY -->
        <div class="px-10 pb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Welcome Back</h1>
            <p class="text-gray-400 text-sm mt-1 mb-10">Login to your account</p>

            <form method="POST" class="space-y-6" action="">

                <!-- EMAIL -->
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-300">
                        ✉️
                    </span>
                    <input type="email" name="email" placeholder="Email Address"
                        class="w-full pl-12 pr-6 py-4 bg-gray-100/60 rounded-[1.5rem] text-gray-700 placeholder-gray-400
                               focus:bg-white focus:ring-4 focus:ring-pink-100 focus:outline-none transition-all shadow-inner">
                               <?php if (isset($data['errors']['EmailErr'])): ?>
                    <p class="text-red-500 text-[10px] font-bold mt-2 flex items-center gap-1 ml-1">
                        <span class="material-symbols-outlined text-xs">warning</span> <?= htmlspecialchars($data['errors']['EmailErr']) ?>
                    </p>
                <?php endif; ?>
                </div>

                <!-- PASSWORD -->
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-300">
                        🔒
                    </span>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full pl-12 pr-6 py-4 bg-gray-100/60 rounded-[1.5rem] text-gray-700 placeholder-gray-400
                               focus:bg-white focus:ring-4 focus:ring-pink-100 focus:outline-none transition-all shadow-inner">
                                <?php if (isset($data['errors']['PasswordErr'])): ?>
                    <p class="text-red-500 text-[10px] font-bold mt-2 flex items-center gap-1 ml-1">
                        <span class="material-symbols-outlined text-xs">warning</span> <?= htmlspecialchars($data['errors']['PasswordErr']) ?>
                    </p>
                <?php endif; ?>
                </div>


                <!-- BUTTON -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-pink-500 to-pink-400 text-white font-bold py-5 rounded-[1.6rem]
                           shadow-[0_12px_30px_-5px_rgba(255,80,120,0.45)]
                           hover:shadow-[0_18px_35px_-5px_rgba(255,80,120,0.55)]
                           hover:-translate-y-0.5 active:scale-[0.98]
                           transition-all duration-300 text-lg">
                    Log In
                </button>

            </form>
        </div>
    </div>
</div>

<main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-6 lg:p-10">
    <div class="mx-auto max-w-7xl flex flex-col gap-8">
        <!-- Page Heading & Stats -->
        <div class="flex flex-col gap-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-3xl font-bold tracking-tight text-[#101912] dark:text-white">Article
                        Management</h1>
                    <p class="text-gray-500 dark:text-gray-400">Create, edit, and manage content across your
                        platform.</p>
                </div>
            </div>
        </div>
        <!-- Filters & Search -->
        <div
            class="bg-white dark:bg-[#1a261d] rounded-xl border border-[#e9f1eb] dark:border-gray-800 shadow-sm p-4 flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="relative w-full md:max-w-md">
                <span
                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                <input
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 rounded-lg text-sm text-[#101912] dark:text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                    placeholder="Search by title, author, or category..." type="text" />
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <button
                    class="flex-1 md:flex-none items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors bg-white dark:bg-[#1a261d]">
                    <span class="material-symbols-outlined text-[20px]">filter_list</span>
                    Filters
                </button>
                <button
                    class="flex-1 md:flex-none items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 dark:border-gray-700 rounded-lg text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors bg-white dark:bg-[#1a261d]">
                    <span class="material-symbols-outlined text-[20px]">sort</span>
                    Sort
                </button>
            </div>
        </div>
        <!-- Articles Table -->
    </div>
</main>


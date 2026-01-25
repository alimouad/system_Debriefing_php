<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        .soft-shadow { box-shadow: 0 20px 50px rgba(79, 70, 229, 0.1); }
        .indigo-gradient { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full text-center space-y-8 animate-in fade-in zoom-in duration-700">
        
        {{-- Visual Element --}}
        <div class="relative">
            <h1 class="text-[12rem] font-black text-slate-200 leading-none select-none">404</h1>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-32 h-32 bg-white rounded-[2.5rem] shadow-xl flex items-center justify-center rotate-12 group hover:rotate-0 transition-transform duration-500">
                    <span class="material-symbols-outlined text-6xl text-indigo-600">explore_off</span>
                </div>
            </div>
        </div>

        {{-- Text Content --}}
        <div class="space-y-4">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Lost in the <span class="text-indigo-600">Cloud?</span></h2>
            <p class="text-slate-400 font-medium leading-relaxed">
                The page you're looking for has moved to a different classroom or simply doesn't exist anymore.
            </p>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col gap-4 pt-4">
            <a href="/student/home" class="w-full py-5 indigo-gradient text-white rounded-[2rem] font-black text-xs uppercase tracking-widest shadow-xl shadow-indigo-200 hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-3">
                <span class="material-symbols-outlined text-sm">home</span>
                Back to Dashboard
            </a>
            
            <button onclick="history.back()" class="w-full py-5 bg-white text-slate-500 border border-slate-100 rounded-[2rem] font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all flex items-center justify-center gap-3">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Go Back
            </button>
        </div>

        {{-- Footer --}}
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">
            Error Code: HTTP_NOT_FOUND_REQ
        </p>
    </div>

</body>
</html>
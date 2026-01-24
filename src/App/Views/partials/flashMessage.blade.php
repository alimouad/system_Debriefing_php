{{-- Alerts Container --}}
<div class="space-y-2 mb-6">

    {{-- 1. Database/Specific Errors --}}
    @if(isset($errors['db']))
    <div class="flex items-center gap-4 p-5 rounded-[2rem] bg-rose-50/60 backdrop-blur-md text-rose-600 border border-rose-100 shadow-[0_10px_30px_-10px_rgba(244,63,94,0.2)] animate-in fade-in slide-in-from-top-4 duration-500">
        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-rose-500 shadow-sm">
            <span class="material-symbols-outlined">database_off</span>
        </div>
        <div class="flex-1">
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70">Execution Failed</h4>
            <p class="text-sm font-bold leading-relaxed">{{ $errors['db'] }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-rose-300 hover:text-rose-500 transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    @endif

    {{-- 2. General Validation Errors (The "Attention Required" Box) --}}
    @if(isset($data['errors']) && !empty($data['errors']))
    <div class="flex items-center gap-5 p-6 rounded-[2.5rem] bg-rose-50/60 backdrop-blur-2xl border border-rose-100 shadow-[0_20px_50px_-15px_rgba(225,29,72,0.15)] animate-in zoom-in-95 duration-500 mb-8">
        <div class="w-14 h-14 rounded-2xl bg-rose-500 flex items-center justify-center text-white shadow-lg shadow-rose-500/30">
            <span class="material-symbols-outlined text-3xl">report</span>
        </div>
        <div class="flex-1">
            <h4 class="text-[11px] font-black uppercase tracking-[0.3em] text-rose-600 mb-1">Attention Required</h4>
            <div class="text-sm font-bold text-slate-700 leading-relaxed">
                @if(is_array($data['errors']))
                <ul class="list-none space-y-1">
                    @foreach($data['errors'] as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
                @else
                {{ $data['errors'] }}
                @endif
            </div>
        </div>
        <button onclick="this.parentElement.remove()" class="group w-10 h-10 rounded-xl hover:bg-rose-100 transition-all flex items-center justify-center">
            <span class="material-symbols-outlined text-rose-300 group-hover:text-rose-500 transition-colors">close</span>
        </button>
    </div>
    @endif

    {{-- 3. Success Alert (Flash Session) --}}
    @if(isset($_SESSION['success']))
    <div class="flex items-center gap-4 p-5 rounded-[2rem] bg-emerald-50/60 backdrop-blur-md text-emerald-600 border border-emerald-100 shadow-[0_10px_30px_-10px_rgba(16,185,129,0.2)] animate-in fade-in slide-in-from-top-4 duration-500">
        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-emerald-500 shadow-sm">
            <span class="material-symbols-outlined">check_circle</span>
        </div>
        <div class="flex-1">
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70">Success</h4>
            <p class="text-sm font-bold leading-relaxed">{{ $_SESSION['success'] }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-300 hover:text-emerald-500 transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>
    @php unset($_SESSION['success']) @endphp
    @endif
</div>
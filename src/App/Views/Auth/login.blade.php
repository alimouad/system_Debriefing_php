@extends('layouts.authLayout')

@section('title', 'Create New Brief')

@section('content')
<div class="relative">
    
    {{-- Soft background glow --}}
    <div class="absolute inset-0 blur-3xl opacity-30 bg-gradient-to-br from-pink-200 via-white to-pink-100 rounded-full scale-110"></div>

    <div class="relative bg-white/80 backdrop-blur-xl w-full max-w-[400px] rounded-[3rem] overflow-hidden shadow-[0_25px_60px_rgba(0,0,0,0.06)] border border-white/60 ring-1 ring-black/[0.03]">
        
        {{-- Flash Messages (Refined to show Error or Success correctly) --}}
        @if(isset($_SESSION['ERROR_MESSAGE']))
            <div id="flash-message" class="fixed top-5 right-5 bg-white border-l-4 border-rose-500 p-4 rounded-lg shadow-2xl z-[100] flex items-center gap-4 min-w-[320px] animate-slide-in">
                <div class="bg-rose-100 p-2 rounded-full">
                    <span class="material-symbols-outlined text-rose-600">error</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-bold text-slate-900">Login Failed</p>
                    <p class="text-xs text-slate-600">{{ $_SESSION['ERROR_MESSAGE'] }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-900">
                    <span class="material-symbols-outlined text-xl">close</span>
                </button>
            </div>
            @php unset($_SESSION['ERROR_MESSAGE']) @endphp
        @endif

        {{-- HEADER --}}
        <div class="px-10 pt-10 pb-6 flex justify-between items-center">
            <span class="text-gray-400 text-[11px] uppercase tracking-[0.2em] font-bold">Debriefing System</span>
            <div class="group cursor-pointer">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-pink-100 to-white flex items-center justify-center border border-gray-100 shadow-sm group-hover:scale-105 transition">
                    <span class="material-symbols-outlined text-pink-400 text-lg">person</span>
                </div>
            </div>
        </div>

        {{-- BODY --}}
        <div class="px-10 pb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Welcome Back</h1>
            <p class="text-gray-400 text-sm mt-1 mb-10">Login to your account</p>

            <form method="POST" class="space-y-6" action="/login">

                {{-- EMAIL --}}
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 text-xl">mail</span>
                    <input type="email" name="email" placeholder="Email Address"
                        value="{{ $data['email'] ?? '' }}"
                        class="w-full pl-14 pr-6 py-4 bg-gray-100/60 rounded-[1.5rem] text-gray-700 placeholder-gray-400
                               focus:bg-white focus:ring-4 focus:ring-pink-100 focus:outline-none transition-all shadow-inner">
                    
                    @if(isset($errors['EmailErr']))
                        <p class="text-red-500 text-[10px] font-bold mt-2 flex items-center gap-1 ml-1 animate-in fade-in slide-in-from-left-2">
                            <span class="material-symbols-outlined text-xs">warning</span> {{ $errors['EmailErr'] }}
                        </p>
                    @endif
                </div>

                {{-- PASSWORD --}}
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 text-xl">lock</span>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full pl-14 pr-6 py-4 bg-gray-100/60 rounded-[1.5rem] text-gray-700 placeholder-gray-400
                               focus:bg-white focus:ring-4 focus:ring-pink-100 focus:outline-none transition-all shadow-inner">
                    
                    @if(isset($errors['PasswordErr']))
                        <p class="text-red-500 text-[10px] font-bold mt-2 flex items-center gap-1 ml-1 animate-in fade-in slide-in-from-left-2">
                            <span class="material-symbols-outlined text-xs">warning</span> {{ $errors['PasswordErr'] }}
                        </p>
                    @endif
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="w-full bg-gradient-to-r from-pink-500 to-pink-400 text-white font-black py-5 rounded-[1.6rem]
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

@endsection
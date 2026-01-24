@extends('layouts.adminLayout')

@section('title', 'Skill Directory')

@section('content')
<div class="space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    {{-- Header Section --}}
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-4">
        <div>
            {{-- Breadcrumbs --}}
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">
                <a href="/admin/dashboard" class="hover:text-primary transition-colors">Admin</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-slate-900 font-black tracking-widest">Skills</span>
            </nav>

            {{-- Title Section --}}
            <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-none">
                Active <span class="text-transparent bg-clip-text pink-gradient">Skills</span>
            </h1>
            <p class="text-slate-400 font-medium mt-3 text-sm">
                Manage student groups and academic years for the current cycle.
            </p>
        </div>
        
        {{-- Primary Action --}}
        <a href="/admin/skills/create" class="flex items-center gap-3 px-8 py-5 pink-gradient text-white font-black rounded-[2.2rem] shadow-2xl shadow-pink-500/40 hover:-translate-y-1 hover:shadow-pink-500/60 transition-all duration-300 group">
            <span class="material-symbols-outlined group-hover:rotate-90 transition-transform duration-500">add_circle</span>
            <span>Add Skill</span>
        </a>
    </header>

  {{-- Skills Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 px-2">
    
    @forelse ($skills as $skill)
        <div class="bg-white/90 backdrop-blur-3xl rounded-[3rem] p-7 border border-white shadow-[0_20px_50px_-12px_rgba(0,0,0,0.02)] group hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-700 relative overflow-hidden flex flex-col justify-between hover:-translate-y-2">
            
            {{-- Decorative Background Element --}}
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50/50 rounded-full blur-3xl group-hover:bg-indigo-100/50 transition-colors duration-700"></div>

            <div class="relative flex items-start gap-5">
                {{-- Dynamic Skill Code Badge --}}
                <div class="w-20 h-20 rounded-[2rem] bg-indigo-50 border border-indigo-100 flex flex-col items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:bg-primary group-hover:text-white group-hover:rotate-3 transition-all duration-500 shadow-sm ring-4 ring-white">
                    <span class="text-[9px] font-black uppercase tracking-tighter opacity-60 group-hover:text-indigo-100">Code</span>
                    <span class="text-base font-black tracking-widest">{{ $skill['code'] }}</span>
                </div>

                {{-- Skill Label & Category Placeholder --}}
                <div class="flex-1 pr-12">
                    <div class="flex items-center gap-2 mb-2">
                         <span class="text-[9px] font-black px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 uppercase tracking-widest group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-colors">Core Skill</span>
                    </div>
                    <h3 class="text-xl font-black text-slate-800 leading-tight group-hover:text-primary transition-colors line-clamp-2">
                        {{ $skill['label'] }}
                    </h3>
                </div>
            </div>

            {{-- Action Menu --}}
            <div class="absolute top-7 right-7 flex flex-col gap-2 translate-x-12 group-hover:translate-x-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
                <a href="/admin/skills/edit?id={{ $skill['id'] }}" class="w-11 h-11 rounded-2xl bg-white shadow-lg border border-slate-100 flex items-center justify-center text-slate-400 hover:text-primary  hover:scale-110 transition-all">
                    <span class="material-symbols-outlined text-xl">edit_square</span>
                </a>
                <button onclick="confirmDelete($skill['id'] )" class="w-11 h-11 rounded-2xl bg-white shadow-lg border border-slate-100 flex items-center justify-center text-slate-300 hover:text-primary hover:scale-110 transition-all">
                    <span class="material-symbols-outlined text-xl">delete</span>
                </button>
            </div>

            {{-- Footer Meta Info --}}
            <div class="mt-8 pt-6 border-t border-slate-50 flex items-center justify-between relative z-10">
                <div class="flex items-center gap-3">
                    <div class="flex -space-x-2">
                        {{-- Future: Avatars of students mastering this --}}
                        <div class="w-7 h-7 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center">
                            <span class="material-symbols-outlined text-[12px] text-slate-400">group</span>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Linked to Briefs</span>
                </div>
                
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100/50">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Active</span>
                </div>
            </div>
        </div>
    @empty
        {{-- Empty State (Keep your existing one, it's great) --}}
    @endforelse
</div>
@endsection
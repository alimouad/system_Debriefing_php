@extends('layouts.adminLayout')

@section('title', 'Create Pedagogical Skill')

@section('content')
<div class="w-full min-h-[calc(100vh-120px)] space-y-8 animate-in fade-in slide-in-from-bottom-8 duration-1000 ease-out">
    
    {{-- Alerts Container --}}
    

    {{-- Header --}}
    <div class="flex items-center justify-between mb-2 px-2">
        <div class="flex items-center gap-6">
            <a href="/admin/skills" class="group w-14 h-14 rounded-[1.8rem] bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-pink-600 transition-all hover:shadow-md border border-slate-100">
                <span class="material-symbols-outlined text-3xl group-hover:-translate-x-1 transition-transform">arrow_back</span>
            </a>
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-none">New <span class="text-transparent bg-clip-text pink-gradient">Competency</span></h1>
                <p class="text-slate-400 font-medium mt-2">Define a new technical skill for student evaluation</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        
        {{-- Form Section --}}
        <section class="lg:col-span-8 bg-white/80 backdrop-blur-3xl rounded-[3.5rem] p-12 shadow-[0_40px_80px_-20px_rgba(0,0,0,0.04)] border border-white ring-1 ring-black/[0.01]">
            <form action="" method="POST" class="space-y-10">
                
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                    {{-- Code Field (Maps to 'code' column) --}}
                    <div class="md:col-span-4 space-y-4">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 block">Skill Code</label>
                        <div class="relative group">
                            <input type="text" name="code" placeholder="e.g. SOL-01" required
                                maxlength="10"
                                value="{{ $data['code'] ?? '' }}"
                                class="w-full px-8 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2.2rem] text-slate-700 placeholder-slate-400 focus:bg-white focus:ring-8 focus:ring-pink-100/50 focus:border-pink-200 outline-none transition-all duration-500 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)] font-black text-center uppercase tracking-widest">
                        </div>
                    </div>

                    {{-- Label Field (Maps to 'label' column) --}}
                    <div class="md:col-span-8 space-y-4">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 block">Skill Label</label>
                        <div class="relative group">
                            <input type="text" name="label" placeholder="e.g. Design a Relational Database" required
                                value="{{ $data['label'] ?? '' }}"
                                class="w-full px-8 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2.2rem] text-slate-700 placeholder-slate-400 focus:bg-white focus:ring-8 focus:ring-pink-100/50 focus:border-pink-200 outline-none transition-all duration-500 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)] font-bold">
                        </div>
                    </div>
                </div>

                {{-- Visual Representation of the Skill Logic --}}
                <div class="p-8 rounded-[2.5rem] bg-pink-50/50 border border-pink-100/50">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-pink-400">info</span>
                        <p class="text-xs text-pink-900/60 leading-relaxed">
                            The <strong class="text-pink-600">Code</strong> must be unique and limited to 10 characters. The <strong class="text-pink-600">Label</strong> should clearly describe the competency a student must demonstrate.
                        </p>
                    </div>
                </div>

                <div class="pt-6 flex justify-end">
                    <button type="submit" 
                        class="px-16 py-6 pink-gradient text-white font-black rounded-[2.5rem] shadow-2xl shadow-pink-500/40 hover:-translate-y-2 hover:shadow-pink-500/60 active:scale-95 transition-all duration-500 text-lg flex items-center gap-4">
                        <span class="material-symbols-outlined">add_task</span>
                        Save Competency
                    </button>
                </div>
            </form>
        </section>

        {{-- Sidebar --}}
        <aside class="lg:col-span-4 sticky top-8 space-y-6">
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-[4rem] p-10 text-white shadow-2xl relative overflow-hidden flex flex-col justify-between border border-white/5">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-pink-500/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-8 border border-white/10 shadow-inner">
                        <span class="material-symbols-outlined text-3xl text-pink-400">architecture</span>
                    </div>
                    <h3 class="text-3xl font-black mb-6 tracking-tight">Data Integrity</h3>
                    
                    <ul class="space-y-8">
                        <li class="flex gap-5 group">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex-shrink-0 flex items-center justify-center text-[12px] font-black text-pink-400 group-hover:bg-pink-500 group-hover:text-white transition-all">01</div>
                            <p class="text-slate-400 text-sm leading-relaxed pt-1">The <span class="text-white font-bold">Code</span> is indexed for high-speed searching in briefs.</p>
                        </li>
                        <li class="flex gap-5 group">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex-shrink-0 flex items-center justify-center text-[12px] font-black text-pink-400 group-hover:bg-pink-500 group-hover:text-white transition-all">02</div>
                            <p class="text-slate-400 text-sm leading-relaxed pt-1">Labels appear on <span class="text-white font-bold">Student Reports</span> and evaluation grids.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
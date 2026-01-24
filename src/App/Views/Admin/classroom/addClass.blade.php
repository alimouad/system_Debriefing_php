@extends('layouts.adminLayout')

@section('title', 'Add New Classroom')

@section('content')
<div class="w-full min-h-[calc(100vh-120px)] space-y-8 animate-in fade-in slide-in-from-bottom-8 duration-1000 ease-out">
    


    {{-- Header --}}
    <div class="flex items-center justify-between mb-2 px-2">
        <div class="flex items-center gap-6">
            <a href="/admin/classroom" class="group w-14 h-14 rounded-[1.8rem] bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-primary transition-all hover:shadow-md border border-slate-100">
                <span class="material-symbols-outlined text-3xl group-hover:-translate-x-1 transition-transform">arrow_back</span>
            </a>
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-none">Add New <span class="text-transparent bg-clip-text pink-gradient">Classroom</span></h1>
                <p class="text-slate-400 font-medium mt-2">Register a new academic group for the debriefing cycle</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        
        {{-- Form Section --}}
        <section class="lg:col-span-8 bg-white/80 backdrop-blur-3xl rounded-[3.5rem] p-12 shadow-[0_40px_80px_-20px_rgba(0,0,0,0.04)] border border-white ring-1 ring-black/[0.01]">
            <form action="" method="POST" class="space-y-10">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 block">Classroom Name</label>
                        <div class="relative group">
                            <input type="text" name="name" placeholder="e.g. Full Stack Development" required
                                value="{{ $data['name'] ?? '' }}"
                                class="w-full px-8 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2.2rem] text-slate-700 placeholder-slate-400 focus:bg-white focus:ring-8 focus:ring-pink-100/50 focus:border-pink-200 outline-none transition-all duration-500 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 block">Academic Year</label>
                        <div class="relative group">
                            <input type="text" name="year" placeholder="e.g. 2025/2026" required
                                value="{{ $data['year'] ?? '' }}"
                                class="w-full px-8 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2.2rem] text-slate-700 placeholder-slate-400 focus:bg-white focus:ring-8 focus:ring-pink-100/50 focus:border-pink-200 outline-none transition-all duration-500 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6 block">Additional Notes (Optional)</label>
                    <textarea name="description" placeholder="Describe the focus or specific details of this group..."
                        class="w-full px-8 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2.5rem] text-slate-700 placeholder-slate-400 focus:bg-white focus:ring-8 focus:ring-pink-100/50 outline-none transition-all duration-500 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)] min-h-[160px] resize-none">{{ $data['description'] ?? '' }}</textarea>
                </div>

                <div class="pt-6 flex justify-end items-center gap-6">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hidden md:block">All fields except notes are required.</p>
                    <button type="submit" 
                        class="px-16 py-6 pink-gradient text-white font-black rounded-[2.5rem] shadow-2xl shadow-pink-500/40 hover:-translate-y-2 hover:shadow-pink-500/60 active:scale-95 transition-all duration-500 text-lg flex items-center gap-4">
                        <span class="material-symbols-outlined">rocket_launch</span>
                        Create Classroom
                    </button>
                </div>
            </form>
        </section>

        {{-- Sticky Sidebar Section --}}
        <aside class="lg:col-span-4 sticky top-8 space-y-6">
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden flex flex-col justify-between border border-white/5">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-pink-500/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-8 border border-white/10 shadow-inner">
                        <span class="material-symbols-outlined text-3xl text-primary">auto_awesome</span>
                    </div>
                    <h3 class="text-3xl font-black mb-6 tracking-tight">Setup Tips</h3>
                    
                    <ul class="space-y-8">
                        <li class="flex gap-5 group">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex-shrink-0 flex items-center justify-center text-[12px] font-black text-primary group-hover:bg-primary group-hover:text-white transition-all">01</div>
                            <p class="text-slate-400 text-sm leading-relaxed pt-1">The <span class="text-white font-bold">Classroom Name</span> acts as the primary identifier in student portfolios.</p>
                        </li>
                        <li class="flex gap-5 group">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex-shrink-0 flex items-center justify-center text-[12px] font-black text-primary group-hover:bg-primary group-hover:text-white transition-all">02</div>
                            <p class="text-slate-400 text-sm leading-relaxed pt-1">The <span class="text-white font-bold">Academic Year</span> helps filter data for historical reporting.</p>
                        </li>
                    </ul>
                </div>
                
                <div class="relative z-10 mt-12 p-8 bg-white/5 rounded-[2.5rem] border border-white/5 backdrop-blur-md">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-300">Sync Status</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed italic">
                        Real-time synchronization with <span class="text-primary font-bold tracking-tighter">DEBRI_CORE</span> is active.
                    </p>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
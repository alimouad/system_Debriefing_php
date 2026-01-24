@extends('layouts.adminLayout')

@section('title', 'Launch New Sprint')

@section('content')
<div class="w-full space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000 ease-out">
    


    {{-- Header Section --}}
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 px-4">
        <div class="flex items-center gap-8">
            <a href="/admin/sprints" class="group w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-slate-400 hover:text-primary transition-all border border-slate-100 hover:shadow-xl hover:-translate-y-1">
                <span class="material-symbols-outlined text-4xl group-hover:-translate-x-1 transition-transform">arrow_back</span>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight leading-none">Launch <span class="text-transparent bg-clip-text pink-gradient">Sprint</span></h1>
                <p class="text-slate-400 font-medium mt-3">Initiate a new milestone for classroom evaluation</p>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        {{-- Main Form Section --}}
        <div class="lg:col-span-8">
            <section class="bg-white/80 backdrop-blur-3xl rounded-[4rem] p-12 shadow-[0_40px_80px_-20px_rgba(0,0,0,0.04)] border border-white ring-1 ring-black/[0.01]">
                <form action="" method="POST" class="space-y-10" novalidate>
                    
                    <div class="space-y-8">
                        <div class="flex items-center gap-3 ml-4">
                            <span class="w-1.5 h-6 pink-gradient rounded-full"></span>
                            <h2 class="text-xs font-black uppercase tracking-[0.2em] text-slate-800">Sprint Identity</h2>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6">Sprint Title</label>
                            <div class="relative group">
                                <input type="text" name="title" placeholder="e.g. Q1 Final Evaluation" required
                                    value="{{ $data['title'] ?? '' }}"
                                    class="w-full px-8 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2.2rem] text-slate-700 placeholder-slate-400
                                           focus:bg-white focus:ring-8 focus:ring-pink-100/50 focus:border-pink-200 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)] text-sm font-bold">
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6">Strategic Description</label>
                            <div class="relative">
                                <textarea name="description" placeholder="What are the core objectives for this sprint?" required
                                    class="w-full px-8 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2.5rem] text-slate-700 placeholder-slate-400
                                           focus:bg-white focus:ring-8 focus:ring-pink-100/50 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)] min-h-[150px] font-medium leading-relaxed">{{ $data['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-center gap-3 ml-4">
                            <span class="w-1.5 h-6 pink-gradient rounded-full"></span>
                            <h2 class="text-xs font-black uppercase tracking-[0.2em] text-slate-800">Logistics & Timeline</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-4">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6">Target Classroom</label>
                                <div class="relative group">
                                    <select name="classroom_id" required
                                        class="w-full px-8 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2.2rem] text-slate-700 appearance-none focus:bg-white focus:ring-8 focus:ring-pink-100/50 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)] font-bold">
                                        <option value="" disabled selected>Identify the group...</option>
                                        @foreach($classrooms as $classroom)
                                            <option value="{{ $classroom['id'] }}" {{ (isset($data['classroom_id']) && $data['classroom_id'] == $classroom['id']) ? 'selected' : '' }}>
                                                {{ $classroom['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-8 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within:text-primary transition-colors">expand_more</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6">Commence</label>
                                    <input type="date" name="start_date" required value="{{ $data['start_date'] ?? '' }}"
                                        class="w-full px-6 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2rem] text-sm font-bold text-slate-700 focus:bg-white focus:ring-8 focus:ring-pink-100/50 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                                </div>
                                <div class="space-y-4">
                                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-6">Conclude</label>
                                    <input type="date" name="end_date" required value="{{ $data['end_date'] ?? '' }}"
                                        class="w-full px-6 py-6 bg-slate-100/50 border-2 border-transparent rounded-[2rem] text-sm font-bold text-slate-700 focus:bg-white focus:ring-8 focus:ring-pink-100/50 outline-none transition-all duration-300 shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8">
                        <button type="submit" 
                            class="w-full md:w-auto px-20 py-7 pink-gradient text-white font-black rounded-[2.5rem] shadow-[0_25px_50px_-12px_rgba(255,79,122,0.4)] hover:-translate-y-2 hover:shadow-[0_35px_60px_-12px_rgba(255,79,122,0.6)] active:scale-95 transition-all duration-500 text-xl flex items-center justify-center gap-6 group">
                            <span class="material-symbols-outlined text-3xl group-hover:rotate-12 transition-transform">bolt</span>
                            Activate Sprint
                        </button>
                    </div>
                </form>
            </section>
        </div>

        {{-- Sidebar --}}
        <aside class="lg:col-span-4 space-y-8">
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-[4rem] p-12 text-white shadow-2xl relative overflow-hidden h-full border border-white/5">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary/20 rounded-full blur-[100px]"></div>
                
                <div class="relative z-10 space-y-12">
                    <div class="w-20 h-20 rounded-[2rem] bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/10 shadow-inner">
                        <span class="material-symbols-outlined text-4xl text-primary">auto_awesome</span>
                    </div>
                    
                    <div class="space-y-4">
                        <h3 class="text-3xl font-black tracking-tight leading-tight">Sprint Intelligence</h3>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            Sprints act as the <span class="text-white font-bold italic">heartbeat</span> of the debriefing system.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start gap-6 group">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0 group-hover:bg-primary/20 transition-colors">
                                <span class="text-primary font-black text-sm">01</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed pt-2">Link classrooms to ensure participants are automatically enrolled.</p>
                        </div>
                        <div class="flex items-start gap-6 group">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center flex-shrink-0 group-hover:bg-primary/20 transition-colors">
                                <span class="text-primary font-black text-sm">02</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed pt-2">Dates are strictly enforced.</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

    </div>
</div>
@endsection
@extends('layouts.adminLayout')

@section('title', 'Manage Sprints')

@section('content')
<div class="space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    {{-- Header Section --}}
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-4">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">
                <a href="/admin/dashboard" class="hover:text-primary transition-colors">Admin</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-slate-900 font-black tracking-widest">Sprints</span>
            </nav>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-none">Manage <span class="text-transparent bg-clip-text pink-gradient">Sprints</span></h1>
            <p class="text-slate-400 font-medium mt-3 text-sm">Track academic cycles and student debriefing progress.</p>
        </div>
        
        <a href="/admin/sprints/create" class="flex items-center gap-3 px-8 py-5 pink-gradient text-white font-black rounded-[2.2rem] shadow-2xl shadow-pink-500/40 hover:-translate-y-1 hover:shadow-pink-500/60 transition-all duration-300 active:scale-95 group">
            <span class="material-symbols-outlined group-hover:rotate-90 transition-transform duration-500">add_circle</span>
            <span>Create New Sprint</span>
        </a>
    </header>

    {{-- Grid Container --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 px-2">
        
        @forelse ($sprints as $sprint)
            @php 
                $today = new DateTime();
                $start = new DateTime($sprint['start_date']);
                $end = new DateTime($sprint['end_date']);
                $isActive = ($today >= $start && $today <= $end);

                // Calculate visual progress percentage
                $totalDays = $start->diff($end)->days ?: 1;
                $elapsedDays = $start->diff($today)->days;
                $progress = $isActive ? min(100, max(0, round(($elapsedDays / $totalDays) * 100))) : 100;
            @endphp
            
            <div class="{{ $isActive ? 'bg-white/80 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] border-white' : 'bg-white/40 opacity-80 border-white/50' }} backdrop-blur-3xl rounded-[3.5rem] p-9 border relative overflow-hidden group shadow-xl transition-all duration-700 hover:-translate-y-1">
                
                {{-- Status Badge --}}
                <div class="absolute top-0 right-0 p-8">
                    <div class="flex items-center gap-2 {{ $isActive ? 'bg-green-50 border-green-100 text-green-600' : 'bg-slate-100 border-slate-200 text-slate-500' }} px-4 py-1.5 rounded-full border backdrop-blur-md">
                        <span class="w-1.5 h-1.5 rounded-full {{ $isActive ? 'bg-green-500 animate-pulse' : 'bg-slate-400' }}"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.15em]">{{ $isActive ? 'Active' : 'Archived' }}</span>
                    </div>
                </div>

                {{-- Icon --}}
                <div class="w-16 h-16 rounded-[1.8rem] {{ $isActive ? 'bg-pink-50 text-primary shadow-pink-100' : 'bg-slate-100 text-slate-400 shadow-slate-200' }} flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500 shadow-xl border border-white">
                    <span class="material-symbols-outlined text-3xl">{{ $isActive ? 'bolt' : 'history_toggle_off' }}</span>
                </div>

                {{-- Title & Class --}}
                <div class="mb-8">
                    <h3 class="text-2xl font-black text-slate-900 mb-1 group-hover:text-primary transition-colors leading-tight">
                        {{ $sprint['title'] }}
                    </h3>
                    <div class="flex items-center gap-2">
                         <span class="w-2 h-2 rounded-full pink-gradient opacity-60"></span>
                         <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">
                            {{ $sprint['classroom_name'] ?? 'Unassigned Class' }}
                        </p>
                    </div>
                </div>

                {{-- Progress Bar --}}
                @if ($isActive)
                <div class="mb-8 space-y-2">
                    <div class="flex justify-between text-[9px] font-black uppercase tracking-tighter text-slate-400">
                        <span>Time Elapsed</span>
                        <span class="text-primary">{{ $progress }}%</span>
                    </div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden p-[2px] shadow-inner">
                        <div class="h-full pink-gradient rounded-full shadow-lg transition-all duration-1000" style="width: {{ $progress }}%"></div>
                    </div>
                </div>
                @endif

                {{-- Footer Actions --}}
                <div class="flex items-center justify-between pt-8 border-t border-slate-100/60">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center group-hover:bg-white group-hover:shadow-md transition-all">
                            <span class="material-symbols-outlined text-xl">event</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">
                                {{ $isActive ? 'Expiring' : 'Completed' }}
                            </span>
                            <span class="text-xs font-bold text-slate-700">
                                {{ date('M d, Y', strtotime($sprint['end_date'])) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="/admin/sprints/edit?id={{ $sprint['id'] }}" class="w-12 h-12 rounded-2xl bg-white text-slate-300 hover:text-primary hover:shadow-xl hover:border-pink-100 border border-transparent flex items-center justify-center transition-all duration-300 shadow-sm">
                            <span class="material-symbols-outlined text-xl">edit_square</span>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            {{-- This replaces the "Create New Sprint" placeholder if list is empty --}}
            <div class="col-span-full py-20 flex flex-col items-center justify-center border-4 border-dashed border-slate-200 rounded-[3.5rem] opacity-50">
                <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">calendar_today</span>
                <p class="font-black text-slate-400 uppercase tracking-widest">No Sprints Found</p>
            </div>
        @endforelse

        {{-- Always show the "Add" card at the end --}}
        <a href="/admin/sprints/create" class="border-4 border-dashed border-slate-200 rounded-[3.5rem] p-8 flex flex-col items-center justify-center text-center opacity-40 hover:opacity-100 hover:border-primary/40 hover:bg-pink-50/20 transition-all duration-500 cursor-pointer group h-full min-h-[350px]">
            <div class="w-20 h-20 rounded-[2rem] bg-slate-100 flex items-center justify-center text-slate-300 group-hover:scale-110 group-hover:bg-white group-hover:text-primary transition-all duration-500 shadow-sm">
                <span class="material-symbols-outlined text-5xl">add_task</span>
            </div>
            <p class="mt-6 font-black text-slate-500 uppercase tracking-[0.25em] text-[10px] group-hover:text-primary transition-colors">Launch New Sprint</p>
        </a>

    </div>
</div>
@endsection
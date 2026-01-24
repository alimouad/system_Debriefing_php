@extends('layouts.teacherLayout')

@section('title', 'My Project Briefs')

@section('content')
<div class="space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    {{-- Header Section --}}
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight leading-none">
                My <span class="text-transparent bg-clip-text indigo-gradient">Briefs</span>
            </h1>
            <p class="text-slate-400 font-medium mt-3 text-sm">
                Managing projects for your assigned classrooms and tracking student milestones.
            </p>
        </div>

        <a href="/teacher/briefs/create" class="flex items-center gap-3 px-8 py-5 indigo-gradient text-white font-black rounded-[2.2rem] shadow-2xl shadow-indigo-500/40 hover:-translate-y-1 transition-all duration-300 group">
            <span class="material-symbols-outlined group-hover:rotate-90 transition-transform duration-500">add_circle</span>
            <span>Create New Brief</span>
        </a>
    </header>

    {{-- Briefs Content Grid --}}
    <div class="grid grid-cols-1 gap-6">
        @forelse($teacherBriefs as $brief)
        <div class="bg-white/80 backdrop-blur-3xl rounded-[3rem] p-8 border border-white shadow-[0_20px_50px_-15px_rgba(0,0,0,0.03)] group hover:shadow-xl transition-all duration-500 flex flex-col lg:flex-row items-center gap-8">

            {{-- Status Icon --}}
            <div class="w-20 h-20 rounded-[2.5rem] bg-indigo-50 flex items-center justify-center text-indigo-600 flex-shrink-0 group-hover:scale-110 transition-transform duration-500">
                <span class="material-symbols-outlined text-4xl">
                    {{ $brief['brief_type'] === 'COLLECTIVE' ? 'group' : 'person' }}
                </span>
            </div>

            {{-- Primary Info --}}
            <div class="flex-1 space-y-2 text-center lg:text-left">
                <div class="flex flex-wrap justify-center lg:justify-start gap-2">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-[9px] font-black rounded-full uppercase tracking-widest border border-indigo-100">
                        {{ $brief['classroom_name'] }}
                    </span>
                    <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[9px] font-black rounded-full uppercase tracking-widest border border-slate-200">
                        {{ $brief['brief_type'] }}
                    </span>
                </div>
                <h3 class="text-2xl font-black text-slate-800 leading-tight">{{ $brief['title'] }}</h3>
                <p class="text-slate-400 text-sm font-medium line-clamp-1 italic">"{{ $brief['description'] }}"</p>
            </div>

            {{-- Metrics Table (Soft Style) --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-8 px-8 border-l border-r border-slate-100 hidden md:grid">
                <div class="text-center">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Duration</p>
                    <p class="text-sm font-bold text-slate-700">{{ $brief['estimated_duration'] }}</p>
                </div>
                <div class="text-center">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Linked Sprint</p>
                    <p class="text-sm font-bold text-slate-700 truncate max-w-[120px]">{{ $brief['sprint_title'] }}</p>
                </div>
                <div class="text-center">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Competencies</p>
                    <p class="text-sm font-bold text-indigo-600">
                        <span class="bg-indigo-50 px-2 py-0.5 rounded-lg">{{ $brief['skill_count'] }} Skills</span>
                    </p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3">
                <a href="/teacher/briefs/evaluate?id={{ $brief['id'] }}" class="px-6 py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-indigo-600 transition-colors shadow-lg shadow-slate-200">
                    Evaluate Students
                </a>
                <div class="flex flex-col gap-2">
                    <a href="/teacher/briefs/edit?id={{ $brief['id'] }}" class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 hover:shadow-md transition-all">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="py-32 flex flex-col items-center justify-center text-center space-y-6 bg-white/30 backdrop-blur-xl rounded-[4rem] border-2 border-dashed border-slate-200">
            <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center text-slate-300">
                <span class="material-symbols-outlined text-5xl">folder_off</span>
            </div>
            <div>
                <h3 class="text-2xl font-black text-slate-800">You haven't created any briefs yet</h3>
                <p class="text-slate-400 font-medium max-w-sm">Start by creating a brief and assigning it to a sprint and classroom.</p>
            </div>
            <a href="/teacher/briefs/create" class="px-10 py-4 indigo-gradient text-white font-black rounded-full text-xs uppercase tracking-widest shadow-xl shadow-indigo-500/20 hover:scale-105 transition-all">
                Create your first brief
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
@extends('layouts.studentLayout')

@section('title', 'My Evaluations')

@section('content')
<div class="max-w-7xl mx-auto space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    {{-- Header Section --}}
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Skills & <span class="text-student">Evaluations</span></h1>
            <p class="text-slate-400 font-medium mt-2">Track your progress and mastery levels across all briefs.</p>
        </div>
        
        <div class="bg-white p-2 rounded-[2rem] border border-slate-100 shadow-sm flex items-center">
            <div class="px-6 py-3 bg-indigo-50 rounded-[1.5rem] text-center min-w-[120px]">
                <p class="text-[9px] font-black text-student uppercase tracking-widest">Total Skills</p>
                <span class="text-xl font-black text-student">{{ count($evaluations) }}</span>
            </div>
        </div>
    </header>

    {{-- Evaluations Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($evaluations as $eval)
            <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-500 overflow-hidden flex flex-col">
                
                {{-- Top Section --}}
                <div class="p-8 space-y-5 flex-1">
                    <div class="flex justify-between items-start">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-student group-hover:text-white transition-all duration-500">
                            <i data-lucide="award" class="w-6 h-6"></i>
                        </div>
                        
                        @php
                            $levelColor = match($eval['mastery_level']) {
                                'TRANSPOSE' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                'ADAPT'     => 'bg-amber-50 text-amber-600 border-amber-100',
                                'IMITATE'   => 'bg-blue-50 text-blue-600 border-blue-100',
                                default     => 'bg-slate-50 text-slate-500 border-slate-100',
                            };
                        @endphp
                        <span class="px-4 py-1.5 rounded-full border {{ $levelColor }} text-[9px] font-black uppercase tracking-widest shadow-sm">
                            {{ $eval['mastery_level'] }}
                        </span>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                             <i data-lucide="book-open" class="w-3 h-3 text-student"></i>
                             <p class="text-[10px] font-black text-student uppercase tracking-widest">{{ $eval['brief_title'] }}</p>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 leading-tight">
                            {{ $eval['skill_label'] }}
                        </h3>
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50/80 border border-slate-100 group-hover:bg-white transition-colors duration-500">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-1">
                            <i data-lucide="message-square" class="w-3 h-3"></i> Teacher's Comment
                        </p>
                        <p class="text-xs text-slate-600 leading-relaxed italic">
                            {{ $eval['comment'] ? '"'.$eval['comment'].'"' : 'No written feedback provided.' }}
                        </p>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-8 py-5 bg-slate-50/30 border-t border-slate-50 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-indigo-100 flex items-center justify-center text-[10px] font-black text-student">
                            {{ strtoupper(substr($eval['teacher_name'] ?? 'T', 0, 1)) }}
                        </div>
                        <span class="text-[10px] font-bold text-slate-500">{{ $eval['teacher_name'] ?? 'Instructor' }}</span>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                        <i data-lucide="calendar" class="w-3 h-3"></i>
                        {{ !empty($eval['evaluation_date']) ? date('d M Y', strtotime($eval['evaluation_date'])) : 'Pending' }}
                    </span>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="col-span-full py-24 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="clipboard-list" class="w-10 h-10 text-indigo-200"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800">Your skill tree is empty</h3>
                <p class="text-slate-400 mt-2 max-w-sm mx-auto">Once you submit a brief and your teacher evaluates your work, your mastered skills will appear here.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
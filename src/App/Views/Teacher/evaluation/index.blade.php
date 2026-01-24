@extends('layouts.teacherLayout')

@section('title', 'Project Evaluations')

@section('content')
<div class="max-w-7xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-6 duration-700">

    {{-- Header Section --}}
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 bg-white p-10 rounded-[3rem] border border-slate-100 shadow-sm">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-indigo-400 mb-2">
                <span>Evaluation Center</span>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-slate-900">Student Submissions</span>
            </nav>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Review <span class="text-indigo-600">Briefs</span></h1>
            <p class="text-slate-400 font-medium mt-2 text-sm">Monitor progress and grade technical competencies for your assigned briefs.</p>
        </div>

        <div class="flex items-center gap-3 px-6 py-4 bg-indigo-50 rounded-[2rem] border border-indigo-100">
            <span class="material-symbols-outlined text-indigo-500">group</span>
            <div class="flex flex-col">
                <span class="text-[9px] font-black text-indigo-400 uppercase tracking-widest leading-none">Total Students</span>
                <span class="text-lg font-black text-indigo-700">{{ count($submission) }}</span>
            </div>
        </div>
    </header>

    {{-- Main Table Section --}}
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Student Info</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Project Brief</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Repository</th>
                        <th class="px-8 py-6 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Submission Date</th>
                        <th class="px-8 py-6 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($submission as $item)
                    <tr class="group hover:bg-indigo-50/30 transition-all duration-300">
                        {{-- Student Column --}}
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-black text-xs group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                    {{ strtoupper(substr($item['first_name'], 0, 1) . substr($item['last_name'], 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">{{ $item['first_name'] }} {{ $item['last_name'] }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Student ID #{{ $item['student_id'] }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Brief Title --}}
                        <td class="px-8 py-6">
                            <span class="text-xs font-bold text-slate-700 block max-w-[200px] truncate">{{ $item['brief_title'] }}</span>
                            <span class="text-[9px] font-black text-indigo-400 uppercase tracking-widest">Sprint Assignment</span>
                        </td>

                        {{-- Repo Link --}}
                        <td class="px-8 py-6">
                            @if(!empty($item['repository_url']))
                            <a href="{{ $item['repository_url'] }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all">
                                <span class="material-symbols-outlined text-sm">link</span>
                                View Code
                            </a>
                            @else
                            <span class="text-[10px] font-bold text-slate-300 italic">Not Submitted</span>
                            @endif
                        </td>

                        {{-- Date --}}
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-slate-600">
                                    {{ $item['submitted_at'] ? date('M d, Y', strtotime($item['submitted_at'])) : '---' }}
                                </span>
                                <span class="text-[9px] font-black text-slate-400 uppercase">{{ $item['submitted_at'] ? date('H:i', strtotime($item['submitted_at'])) : '' }}</span>
                            </div>
                        </td>

                        {{-- Action --}}
                        <td class="px-8 py-6 text-center">
                            {{-- Use '?' for the first param and '&' for the second --}}
                            <a href="/teacher/evaluate?brief_id={{ $item['brief_id'] }}&student_id={{ $item['student_id'] }}"
                                class="px-6 py-3 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-200 transition-all active:scale-95">
                                Evaluate
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <span class="material-symbols-outlined text-5xl text-slate-200 mb-4">move_to_inbox</span>
                                <p class="text-slate-400 font-bold">No submissions found for the selected briefs.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
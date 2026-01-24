@extends('layouts.teacherLayout')

@section('title', 'Skill Evaluation')

@section('content')
<div class="max-w-7xl mx-auto space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    {{-- Header: Student & Brief Context --}}
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-6">
            <a href="/teacher/evaluations" class="w-14 h-14 rounded-2xl bg-white shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-indigo-400 mb-1">
                    <span>Evaluation</span>
                    <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                    <span class="text-slate-900">Grading Session</span>
                </nav>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                    Evaluating <span class="text-indigo-600">{{ $student['first_name'] }} {{ $student['last_name'] }}</span>
                </h1>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        {{-- Left: Student Submission Review --}}
        <div class="lg:col-span-4 space-y-6">
            <section class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm sticky top-10">
                <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-indigo-500">description</span>
                    Submission Details
                </h3>

                <div class="space-y-6">
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Repository Link</p>
                        <a href="{{ $submission['repository_url'] }}" target="_blank" class="text-sm font-bold text-indigo-600 flex items-center gap-2 hover:underline">
                            <span class="material-symbols-outlined text-sm">link</span>
                            Open Project Code
                        </a>
                    </div>

                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Student Notes</p>
                        <p class="text-xs text-slate-600 leading-relaxed italic whitespace-pre-line">
                            "{{ $submission['description'] ?? 'No notes provided.' }}"
                        </p>
                    </div>
                </div>
            </section>
        </div>

        {{-- Right: Evaluation Form --}}
        <div class="lg:col-span-8">
            <form action="" method="POST" class="space-y-8">
                {{-- Hidden context for the database --}}
                <input type="hidden" name="student_id" value="{{ $student['id'] }}">
                <input type="hidden" name="brief_id" value="{{ $brief['id'] }}">
                <input type="hidden" name="teacher_id" value="{{ $_SESSION['user_id'] }}">

                <div class="space-y-6">
                    @foreach($skills as $index => $skill)
                    <section class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-xs">
                                    {{ $skill['code'] }}
                                </span>
                                <h4 class="font-black text-slate-800">{{ $skill['label'] }}</h4>
                            </div>
                        </div>

                        {{-- Mastery Levels Radio Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach(['IMITATE', 'ADAPT', 'TRANSPOSE'] as $level)
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="evaluations[{{ $skill['id'] }}][mastery_level]" value="{{ $level }}" class="peer sr-only" required>
                                <div class="p-5 rounded-2xl border-2 border-slate-50 bg-slate-50 text-center transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-50 group-hover:bg-slate-100">
                                    <p class="text-[10px] font-black tracking-widest uppercase mb-1 {{ $level === 'TRANSPOSE' ? 'text-amber-600' : 'text-slate-400' }}">
                                        {{ $level }}
                                    </p>
                                    <span class="text-[9px] font-medium text-slate-400 peer-checked:text-indigo-600">Level {{ $loop->iteration }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>

                        {{-- Individual Skill Comment --}}
                        <textarea name="evaluations[{{ $skill['id'] }}][comment]" rows="2" 
                            placeholder="Add a specific comment for this skill..."
                            class="w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-indigo-100 outline-none transition-all text-xs font-medium"></textarea>
                    </section>
                    @endforeach
                </div>

                <div class="flex items-center justify-end pt-6">
                    <button type="submit" class="px-12 py-5 bg-slate-900 text-white font-black rounded-3xl shadow-xl shadow-slate-200 hover:bg-indigo-600 hover:-translate-y-1 transition-all flex items-center gap-3">
                        <span class="material-symbols-outlined">verified</span>
                        Save All Evaluations
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
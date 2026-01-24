@extends('layouts.teacherLayout')

@section('title', 'Teacher Workspace')

@section('content')
<div class="space-y-10 animate-in fade-in duration-1000">
    
    {{-- Top Stats: Quick Overview --}}
    <header class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 px-4">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Teacher <span class=" bg-clip-text text-teacher">Portal</span></h1>
            <p class="text-slate-400 font-medium mt-2">Manage briefs, evaluate competencies, and provide student feedback.</p>
        </div>
        
        <div class="flex gap-4">
            <div class="bg-white p-4 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 px-6">
                <div class="w-10 h-10 rounded-xl bg-pink-50 text-teacher flex items-center justify-center">
                    <span class="material-symbols-outlined">pending_actions</span>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Pending Briefs</p>
                    <p class="text-xl font-bold text-slate-800">12</p>
                </div>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- Left Column: Manage Briefs & Evaluations --}}
        <div class="lg:col-span-8 space-y-8">
            
            <section class="bg-white/80 backdrop-blur-3xl rounded-[3rem] p-8 border border-white shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-teacher rounded-full"></span>
                        <h2 class="text-xl font-black text-slate-800">Active Briefs</h2>
                    </div>
                    <button class="text-xs font-black uppercase tracking-widest text-teacher hover:underline">View All</button>
                </div>

                <div class="space-y-4">
                    @forelse($briefs as $brief)
                    <div class="group p-6 rounded-[2rem] bg-slate-50/50 border border-transparent hover:border-pink-100 hover:bg-white hover:shadow-xl transition-all duration-500">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-teacher">
                                    <span class="material-symbols-outlined">assignment</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800">{{ $brief['title'] }}</h4>
                                    <p class="text-xs text-slate-400">{{ $brief['classroom_name'] }} • {{ $brief['student_count'] }} Students</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="/teacher/evaluate/{{ $brief['id'] }}" class="px-6 py-3 rounded-2xl bg-white text-teacher text-xs font-black uppercase tracking-widest border border-pink-100 hover:pink-gradient hover:text-white transition-all shadow-sm">
                                    Evaluate
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center py-10 text-slate-400 italic">No briefs assigned yet.</p>
                    @endforelse
                </div>
            </section>

            {{-- Skills Matrix Preview --}}
            <section class="bg-slate-900 rounded-[3rem] p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 p-10 opacity-10">
                    <span class="material-symbols-outlined text-[120px]">insights</span>
                </div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-black mb-2">Skill Analytics</h3>
                    <p class="text-slate-400 text-sm mb-8">Global competency levels across your classrooms.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(['Frontend Dev', 'Backend Logic', 'UI/UX Design'] as $skill)
                        <div class="space-y-3">
                            <div class="flex justify-between text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <span>{{ $skill }}</span>
                                <span class="text-teacher">75%</span>
                            </div>
                            <div class="h-1.5 w-full bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-teacher  w-[75%] rounded-full shadow-[0_0_15px_rgba(255,79,122,0.5)]"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        {{-- Right Column: Debriefing Queue --}}
        <aside class="lg:col-span-4 space-y-8">
            <section class="bg-white/80 backdrop-blur-3xl rounded-[3rem] p-8 border border-white shadow-sm flex flex-col h-full">
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-teacher">forum</span>
                    <h2 class="text-xl font-black text-slate-800">Debriefing Queue</h2>
                </div>

                <div class="space-y-6 flex-1">
                    @foreach($debriefings as $item)
                    <div class="flex items-start gap-4 p-4 rounded-3xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100 group">
                        <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden flex-shrink-0 border-2 border-white shadow-sm">
                            <img src="https://ui-avatars.com/api/?name={{ $item['student_name'] }}&background=random" alt="">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 truncate">{{ $item['student_name'] }}</p>
                            <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Waiting for feedback...</p>
                        </div>
                        <button class="w-8 h-8 rounded-xl bg-white text-slate-400 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:text-teacher shadow-sm border border-slate-100">
                            <span class="material-symbols-outlined text-sm">send</span>
                        </button>
                    </div>
                    @endforeach
                </div>


            </section>
        </aside>
    </div>
</div>
@endsection
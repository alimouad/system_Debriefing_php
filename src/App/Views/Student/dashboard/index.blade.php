@extends('layouts.studentLayout')

@section('title', 'My Learning Journey')

@section('content')
<div class="space-y-10 animate-in fade-in duration-1000">

    {{-- Welcome Header --}}
    <header class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 px-2">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                Hello, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-400">{{ explode(' ', $_SESSION['user_name'])[0] }}</span> 👋
            </h1>
            <p class="text-slate-400 font-medium mt-2">
                You are currently in <span class="text-emerald-600 font-bold">{{ $student['classroom_name'] }}</span>.
            </p>
        </div>

        <div class="flex items-center gap-4 bg-white p-2 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="px-6 py-3 bg-emerald-50 rounded-[1.5rem] border border-emerald-100">
                <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest leading-tight">Academic Year</p>
                <p class="text-sm font-bold text-slate-700">{{ $student['year'] }}</p>
            </div>
        </div>
    </header>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- Left: Progress & Announcements --}}
        <div class="lg:col-span-8 space-y-8">

            {{-- 1. Dynamic Quick Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Acquired Skills</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-slate-900">{{ count($student['skills'] ?? []) }}</span>
                        <span class="text-xs font-bold text-emerald-500">Mastered</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Projects Done</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-black text-slate-900">{{ $student['projects_done'] ?? 0 }}</span>
                        <span class="text-xs font-bold text-slate-400">Submissions</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Current Classroom</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-sm font-black text-slate-900 truncate">{{ $student['classroom_name'] }}</span>
                    </div>
                </div>
            </div>

            {{-- 2. Dynamic Classroom Feed --}}
            <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-slate-800">Classroom <span class="text-emerald-500">Updates</span></h3>
                    <span class="material-symbols-outlined text-slate-200 text-3xl">campaign</span>
                </div>

                <div class="space-y-8 relative">
                    @php $totalNews = count($student['announcements'] ?? []); @endphp

                    @forelse($student['announcements'] ?? [] as $index => $news)
                    <div class="flex gap-6 relative group">

                        {{-- Timeline Connector: Fixed using $index and $totalNews --}}
                        @if($index < ($totalNews - 1))
                            <div class="absolute left-6 top-12 bottom-[-2rem] w-[2px] bg-slate-50">
                    </div>
                    @endif

                    {{-- Status Icon: Fixed using $index --}}
                    <div class="w-12 h-12 rounded-2xl flex-shrink-0 flex items-center justify-center z-10 transition-colors
                    {{ $index === 0 ? 'bg-emerald-50 text-emerald-500 shadow-sm' : 'bg-slate-50 text-slate-300' }}">
                        <span class="material-symbols-outlined text-xl">
                            {{ $index === 0 ? 'notifications_active' : 'history' }}
                        </span>
                    </div>

                    <div class="pb-2">
                        <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest leading-none mb-2">
                            {{ date('M d • H:i', strtotime($news['created_at'])) }}
                        </p>
                        <h4 class="text-sm font-black text-slate-800 leading-tight group-hover:text-emerald-600 transition-colors">
                            New Brief: {{ $news['title'] }}
                        </h4>
                        <p class="text-[11px] text-slate-400 mt-1.5 leading-relaxed line-clamp-2">
                            A new project has been published. Review the details to stay on track.
                        </p>
                    </div>
                </div>
                @empty
                <div class="py-12 text-center bg-slate-50 rounded-[2rem] border border-dashed border-slate-100">
                    <span class="material-symbols-outlined text-slate-300 text-4xl mb-2">auto_awesome</span>
                    <p class="text-xs font-bold text-slate-400">All caught up! No new updates.</p>
                </div>
                @endforelse
            </div>

            <a href="/student/briefs" class="mt-10 block w-full py-4 text-center border-2 border-dashed border-slate-100 rounded-2xl text-[10px] font-black text-slate-400 uppercase tracking-widest hover:border-emerald-200 hover:text-emerald-500 hover:bg-emerald-50/50 transition-all">
                Explore All Projects
            </a>
        </div>
    </div>

    {{-- Right: Skill Mastery (Keep this as it's the core identity) --}}
    <aside class="lg:col-span-4">
        <section class="bg-slate-900 rounded-[3rem] p-8 text-white shadow-2xl relative overflow-hidden h-full">
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-emerald-500/20 rounded-full blur-3xl"></div>

            <h3 class="text-xl font-black mb-8 flex items-center gap-3 relative z-10">
                <span class="material-symbols-outlined text-emerald-400">military_tech</span>
                Competency Map
            </h3>

            <div class="space-y-8 relative z-10">
                @forelse(($student['skills'] ?? []) as $skill)
                <div class="group">
                    <div class="flex justify-between items-end mb-3">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500">{{ $skill['code'] }}</p>
                            <p class="text-sm font-bold text-slate-200 group-hover:text-white transition-colors">{{ $skill['label'] }}</p>
                        </div>
                    </div>
                    <div class="flex gap-1.5">
                        @for($i=1; $i<=3; $i++)
                            <div class="h-1.5 flex-1 rounded-full {{ $i <= 2 ? 'bg-emerald-400 shadow-[0_0_10px_rgba(52,211,153,0.4)]' : 'bg-white/10' }}">
                    </div>
                    @endfor
                </div>
            </div>
            @empty
            <p class="text-slate-500 text-xs italic">Skills will appear here once evaluated.</p>
            @endforelse
</div>
</section>
</aside>
</div>
</div>
@endsection
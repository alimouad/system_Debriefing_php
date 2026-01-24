@extends('layouts.studentLayout')

@section('title', 'My Assignments')

@section('content')
<div class="space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    @include('partials.headerStudent')

    <div class="flex items-center justify-between px-2">
        <h2 class="text-xl font-black text-slate-800 flex items-center gap-3">
            <span class="w-2 h-6 bg-emerald-400 rounded-full"></span>
            Your Active Projects
        </h2>
    </div>
    {{-- The Loop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @forelse($briefs as $b)
        <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-emerald-500/10 hover:-translate-y-2 transition-all duration-500 group flex flex-col justify-between h-full relative overflow-hidden">

            {{-- Mode Badge --}}
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500">
                    <span class="material-symbols-outlined">
                        {{ $b['brief_type'] === 'COLLECTIVE' ? 'groups' : 'person' }}
                    </span>
                </div>
                <span class="px-3 py-1 bg-slate-50 text-slate-400 text-[9px] font-black rounded-full uppercase tracking-widest border border-slate-100">
                    {{ $b['brief_type'] }}
                </span>
            </div>

            {{-- Content --}}
            <div class="space-y-3">
                <h3 class="text-xl font-black text-slate-800 leading-tight group-hover:text-emerald-600 transition-colors">
                    {{ $b['title'] }}
                </h3>
                <p class="text-slate-400 text-xs font-medium line-clamp-2 leading-relaxed">
                    {{ $b['description'] }}
                </p>
            </div>
            {{-- Metadata Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-8 pt-6 border-t border-slate-50">

                {{-- Duration --}}
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-emerald-500 text-base">schedule</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Duration</span>
                        <span class="text-[10px] font-bold text-slate-700 whitespace-nowrap">{{ $b['estimated_duration'] ?? 'N/A' }}</span>
                    </div>
                </div>

                {{-- Created At --}}
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-slate-400 text-base">calendar_add_on</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Assigned</span>
                        <span class="text-[10px] font-bold text-slate-700">{{ date('M d', strtotime($b['created_at'])) }}</span>
                    </div>
                </div>

                {{-- Due Date --}}
                <div class="flex items-center gap-2 md:col-span-1 col-span-2">
                    <div class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-rose-500 text-base">alarm</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[8px] font-black text-rose-400 uppercase tracking-tighter">Due Date</span>
                        <span class="text-[10px] font-bold text-rose-600">{{ date('M d', strtotime($b['sprint_deadline'])) }}</span>
                    </div>
                </div>
            </div>

            {{-- Action Button --}}
            <div class="mt-8">
                <a href="/student/briefs/rendu?id={{ $b['id'] }}" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] flex items-center justify-center gap-2 hover:bg-emerald-500 transition-all shadow-lg shadow-slate-200 hover:shadow-emerald-500/30">
                    Add Rendu
                    <span class="material-symbols-outlined text-sm">arrow_right_alt</span>
                </a>
            </div>
        </div>
        @empty
        {{-- Empty State --}}
        <div class="col-span-full py-32 flex flex-col items-center justify-center text-center space-y-4 bg-white/50 rounded-[4rem] border-2 border-dashed border-slate-200">
            <span class="material-symbols-outlined text-6xl text-slate-200">folder_off</span>
            <p class="text-slate-400 font-bold">No briefs assigned to your classroom yet.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
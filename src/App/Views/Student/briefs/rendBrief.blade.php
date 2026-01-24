@extends('layouts.studentLayout')

@section('title', 'Submit Rendu')

@section('content')
<div class="max-w-5xl mx-auto space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    {{-- Header --}}
    <header class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-6">
            <a href="/student/briefs" class="w-14 h-14 rounded-2xl bg-white shadow-sm border border-emerald-100 flex items-center justify-center text-slate-400 hover:text-emerald-500 transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight leading-none">
                    Submit <span class="text-transparent bg-clip-text emerald-gradient">Rendu</span>
                </h1>
                <p class="text-slate-400 text-sm font-medium mt-2 italic">
                    {{ $student['brief_title'] ?? 'Project Assignment' }}
                </p>
            </div>
        </div>

        {{-- Dynamic Status Notification --}}
        @if(!empty($student['repository_url']))
            <div class="flex items-center gap-3 px-6 py-3 bg-emerald-50 border border-emerald-100 rounded-2xl animate-bounce">
                <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                <div class="flex flex-col">
                    <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest leading-none">Status</span>
                    <span class="text-xs font-bold text-slate-700">Already Submitted</span>
                </div>
            </div>
        @else
            <div class="flex items-center gap-3 px-6 py-3 bg-amber-50 border border-amber-100 rounded-2xl">
                <span class="material-symbols-outlined text-amber-500">pending</span>
                <div class="flex flex-col">
                    <span class="text-[9px] font-black text-amber-600 uppercase tracking-widest leading-none">Status</span>
                    <span class="text-xs font-bold text-slate-700">Awaiting Submission</span>
                </div>
            </div>
        @endif
    </header>

    {{-- Alert for existing submission --}}
    @if(!empty($student['repository_url']))
    <div class="bg-emerald-500 p-6 rounded-[2.5rem] text-white flex items-center justify-between shadow-lg shadow-emerald-500/20">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                <span class="material-symbols-outlined">info</span>
            </div>
            <div>
                <h4 class="font-black text-sm">You have already submitted this project.</h4>
                <p class="text-white/80 text-xs">Submitting again will update your existing work.</p>
            </div>
        </div>
        <div class="hidden md:block text-right">
            <p class="text-[10px] font-black uppercase opacity-60">Submitted on</p>
            <p class="text-xs font-bold">{{ date('M d, Y • H:i', strtotime($student['submitted_at'])) }}</p>
        </div>
    </div>
    @endif

    <section class="bg-white rounded-[3rem] p-10 border border-emerald-50 shadow-sm relative overflow-hidden">
        <form action="/student/briefs/rendu?id={{ $data['brief_id'] }}" method="POST" class="space-y-8 relative z-10">
            
            <input type="hidden" name="brief_id" value="{{ $data['brief_id'] }}">
            
            {{-- URL Input --}}
            <div class="space-y-4">
                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-6 block">Repository URL</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-6 top-1/2 -translate-y-1/2 {{ isset($data['errors']['repository_url']) ? 'text-rose-400' : 'text-slate-300' }}">link</span>
                    <input type="url" name="repository_url" required 
                        placeholder="https://github.com/..."
                        value="{{ $data['repository_url'] ?: ($student['repository_url'] ?? '') }}"
                        class="w-full pl-16 pr-8 py-6 bg-slate-50 border-2 {{ isset($data['errors']['repository_url']) ? 'border-rose-200 focus:border-rose-400' : 'border-transparent focus:border-emerald-200' }} rounded-[2rem] focus:bg-white focus:ring-4 focus:ring-emerald-50 transition-all outline-none font-bold text-slate-700 shadow-inner">
                </div>
                @if(isset($data['errors']['repository_url']))
                    <p class="text-rose-500 text-[10px] font-bold ml-6">{{ $data['errors']['repository_url'] }}</p>
                @endif
            </div>

            {{-- Description Input --}}
            <div class="space-y-4">
                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-6 block">Submission Notes</label>
                <textarea name="description" rows="5" 
                    placeholder="Describe your technical stack or specific instructions for the teacher..."
                    class="w-full px-8 py-6 bg-slate-50 border-2 {{ isset($data['errors']['description']) ? 'border-rose-200 focus:border-rose-400' : 'border-transparent focus:border-emerald-200' }} rounded-[2.5rem] focus:bg-white focus:ring-4 focus:ring-emerald-50 transition-all outline-none font-medium text-slate-600 leading-relaxed shadow-inner">{{ $data['description'] ?: ($student['description'] ?? '') }}</textarea>
                @if(isset($data['errors']['description']))
                    <p class="text-rose-500 text-[10px] font-bold ml-6">{{ $data['errors']['description'] }}</p>
                @endif
            </div>

            <div class="flex items-center justify-end pt-4">
                <button type="submit" class="px-12 py-5 emerald-gradient text-white font-black rounded-3xl shadow-xl shadow-emerald-500/30 hover:-translate-y-1 transition-all flex items-center gap-3 active:scale-95">
                    <span class="material-symbols-outlined">{{ !empty($student['repository_url']) ? 'update' : 'publish' }}</span>
                    {{ !empty($student['repository_url']) ? 'Update Submission' : 'Finalize Submission' }}
                </button>
            </div>
        </form>
    </section>
</div>
@endsection
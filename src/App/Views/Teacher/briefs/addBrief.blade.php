@extends('layouts.teacherLayout')

@section('title', 'Create New Brief')

@section('content')
<div class="max-w-full mx-auto space-y-10 animate-in fade-in zoom-in-95 duration-700">

    <header class="flex items-center gap-6">
        <a href="/teacher/briefs" class="w-14 h-14 rounded-2xl bg-white shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Design <span class="text-transparent bg-clip-text indigo-gradient">Brief</span></h1>
            <p class="text-slate-400 text-sm font-medium">Define project objectives, timeline, and collaboration type.</p>
        </div>
    </header>

    <form action="" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-10" novalidate>

        {{-- Left: Main Details --}}
        <div class="lg:col-span-8 space-y-8">
            <section class="bg-white rounded-[3rem] p-10 shadow-sm border border-slate-100 space-y-8">

                {{-- Title --}}
                <div class="space-y-4">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-6">Project Title</label>
                    <input type="text" name="title" required value="{{ $data['title'] ?? '' }}" placeholder="e.g. E-Commerce Platform API"
                        class="w-full px-8 py-6 bg-slate-50 border-2 border-transparent rounded-[2rem] focus:bg-white focus:border-indigo-200 focus:ring-4 focus:ring-indigo-50 transition-all outline-none font-bold text-slate-700">
                </div>

                {{-- Type & Duration Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-6">Brief Type</label>
                        <div class="flex p-1 bg-slate-100 rounded-[1.5rem] w-full">
                            <label class="flex-1">
                                <input type="radio" name="brief_type" value="INDIVIDUAL" class="hidden peer" checked>
                                <div class="text-center py-3 rounded-2xl cursor-pointer transition-all peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm text-slate-400 font-bold text-xs uppercase tracking-widest">
                                    Individual
                                </div>
                            </label>
                            <label class="flex-1">
                                <input type="radio" name="brief_type" value="COLLECTIVE" class="hidden peer">
                                <div class="text-center py-3 rounded-2xl cursor-pointer transition-all peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm text-slate-400 font-bold text-xs uppercase tracking-widest">
                                    Collective
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-6">Estimated Duration</label>
                        <input type="text" name="estimated_duration" value="{{ $data['estimated_duration'] ?? '' }}" placeholder="e.g. 5 Days, 2 Weeks"
                            class="w-full px-8 py-4 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:bg-white focus:border-indigo-200 outline-none transition-all font-bold text-slate-700">
                    </div>
                </div>

                {{-- Description --}}
                <div class="space-y-4">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-6">Project Description</label>
                    <textarea name="description" rows="6" placeholder="Describe core objectives and constraints..."
                        class="w-full px-8 py-6 bg-slate-50 border-2 border-transparent rounded-[2.5rem] focus:bg-white focus:border-indigo-200 focus:ring-4 focus:ring-indigo-50 transition-all outline-none font-medium text-slate-600 leading-relaxed">{{ $data['description'] ?? '' }}</textarea>
                </div>

                <div class="pt-4">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-6 mb-4 block">Attachment (PDF/Image)</label>
                    <div class="border-2 border-dashed border-slate-100 rounded-[2rem] p-8 flex flex-col items-center justify-center bg-slate-50/50 hover:bg-slate-50 transition-colors cursor-pointer group">
                        <span class="material-symbols-outlined text-4xl text-slate-300 group-hover:text-indigo-400 transition-colors mb-2">upload_file</span>
                        <p class="text-xs font-bold text-slate-400">Click to upload project resources</p>
                    </div>
                </div>
            </section>
        </div>

        {{-- Right: Sidebar Config --}}
        <div class="lg:col-span-4 space-y-8">
            <section class="bg-white rounded-[3rem] p-8 shadow-sm border border-slate-100 space-y-8">

                {{-- Sprint Selection (Required by Schema) --}}
                <div class="space-y-4">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-2">Active Sprint</label>
                    <div class="relative group">
                        <select name="sprint_id" required class="w-full px-6 py-4 bg-slate-50 rounded-2xl border-none font-bold text-slate-700 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">
                            <option value="" disabled selected>Select Target Sprint</option>
                            @foreach($sprints as $sprint)
                            <option value="{{ $sprint['id'] }}">{{ $sprint['title'] }}</option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none">expand_more</span>
                    </div>
                </div>

                {{-- Skills Checklist --}}
                <div class="space-y-4">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-2">Linked Skills</label>
                    <div class="space-y-3 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($skills as $skill)
                        <label class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-white border border-transparent hover:border-indigo-100 transition-all cursor-pointer group">
                            <input type="checkbox" name="skills[]" value="{{ $skill['id'] }}" class="w-5 h-5 rounded-lg border-slate-200 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-xs font-bold text-slate-600 group-hover:text-indigo-600 transition-colors">{{ $skill['code'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full py-5 indigo-gradient text-white font-black rounded-[2rem] shadow-xl shadow-indigo-500/30 hover:-translate-y-1 transition-all flex items-center justify-center gap-3 group">
                    <span class="material-symbols-outlined group-hover:rotate-12 transition-transform">bolt</span>
                    Publish Brief
                </button>
            </section>
        </div>
    </form>
</div>
@endsection
@extends('layouts.adminLayout')

@section('title', 'Assign Teacher')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-8 duration-700">
    
    {{-- Header --}}
    <header class="flex items-center gap-6">
        <a href="/admin/classroom" class="w-14 h-14 rounded-2xl bg-white shadow-sm border border-slate-100 flex items-center justify-center text-slate-400 hover:text-indigo-600 transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Assign <span class="text-indigo-600">Teacher</span></h1>
            <p class="text-slate-400 text-sm font-medium mt-1">Management for <strong>{{ $classroom['name'] }}</strong> ({{ $classroom['year'] }})</p>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Current Status Card --}}
        <div class="md:col-span-1">
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-500">
                    <span class="material-symbols-outlined text-3xl">badge</span>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Current Mentor</p>
                    <h4 class="text-lg font-black text-slate-800">
                        {{ $classroom['name'] ?? 'Unassigned' }}
                    </h4>
                </div>
            </div>
        </div>

        {{-- Assignment Form --}}
        <div class="md:col-span-2">
            <section class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm relative overflow-hidden">
                <form action="/admin/classroom/assign-teacher" method="POST" class="space-y-8">
                    <input type="hidden" name="classroom_id" value="{{ $classroom['id'] }}">

                    <div class="space-y-4">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-6 block">Select New Teacher</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-6 top-1/2 -translate-y-1/2 text-slate-300">person_search</span>
                            <select name="teacher_id" required 
                                class="w-full pl-16 pr-8 py-6 bg-slate-50 border-2 border-transparent rounded-[2rem] focus:bg-white focus:border-indigo-200 focus:ring-4 focus:ring-indigo-50 transition-all outline-none font-bold text-slate-700 appearance-none">
                                <option value="" disabled selected>Choose from available staff...</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher['id'] }}" {{ $teacher['id'] ? 'selected' : '' }}>
                                        {{ $teacher['first_name'] }} {{ $teacher['last_name'] }} ({{ $teacher['email'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="p-6 rounded-[2rem] bg-amber-50 border border-amber-100 flex gap-4">
                        <span class="material-symbols-outlined text-amber-500">info</span>
                        <p class="text-[11px] text-amber-700 leading-relaxed font-medium">
                            Assigning a new teacher will give them full access to manage students, briefs, and evaluations for this specific classroom.
                        </p>
                    </div>

                    <div class="flex items-center justify-end pt-4">
                        <button type="submit" class="px-10 py-5 bg-indigo-600 text-white font-black rounded-3xl shadow-xl shadow-indigo-200 hover:-translate-y-1 transition-all flex items-center gap-3 active:scale-95">
                            <span class="material-symbols-outlined">save</span>
                            Confirm Assignment
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection
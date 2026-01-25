@extends('layouts.teacherLayout')

@section('title', 'My Classroom')

@section('content')
<div class="max-w-7xl mx-auto space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    {{-- 1. Classroom Header & Stats --}}
    <header class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-sm overflow-hidden relative">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
            {{-- Check the variable name passed from Controller: 'class' --}}
            @forelse($class as $item)
            <div class="animate-in fade-in duration-500">
                <span class="text-[10px] font-black text-indigo-400 uppercase tracking-widest px-4 py-1 bg-indigo-50 rounded-full">
                    Active Classroom
                </span>
                <h1 class="text-3xl font-black text-slate-900 mt-4 tracking-tight">
                    {{ $item['name'] }}
                    <span class="text-indigo-600">({{ $item['year'] }})</span>
                </h1>
                <p class="text-slate-400 font-medium mt-2">
                    Managing your student roster and academic progress for this group.
                </p>
            </div>
            @empty
            <div class="p-10 text-center bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                <span class="material-symbols-outlined text-4xl text-slate-300">domain_disabled</span>
                <h1 class="text-xl font-black text-slate-900 mt-4">No Classroom Assigned</h1>
                <p class="text-slate-400 text-sm mt-2">You haven't been linked to a classroom yet. Please contact the administrator.</p>
            </div>
            @endforelse

            <div class="flex gap-4">
                <div class="px-8 py-6 bg-slate-50 rounded-[2rem] border border-slate-100 text-center">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Students</p>
                    <span class="text-2xl font-black text-slate-800">{{ count($studens) }}</span>
                </div>
                <div class="px-8 py-6 bg-indigo-600 rounded-[2rem] shadow-xl shadow-indigo-200 text-center">
                    <p class="text-[10px] font-black text-white/60 uppercase tracking-widest mb-1">Status</p>
                    <span class="text-sm font-black text-white uppercase tracking-tight">In Progress</span>
                </div>
            </div>
        </div>

        {{-- Soft Decorative Background Element --}}
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-indigo-50/50 rounded-full blur-3xl"></div>
    </header>

    {{-- 2. Student Directory --}}
    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xl font-black text-slate-800">Student <span class="text-indigo-500">Directory</span></h3>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-sm">search</span>
                <input type="text" placeholder="Search students..." class="pl-10 pr-6 py-3 bg-slate-50 border-none rounded-2xl text-xs font-bold focus:ring-2 focus:ring-indigo-100 transition-all outline-none">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Student</th>
                        <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Address</th>
                        <th class="px-10 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Account Status</th>
                        <th class="px-10 py-5 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($studens as $student)
                    <tr class="group hover:bg-indigo-50/20 transition-all duration-300">
                        <td class="px-10 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">{{ $student['first_name'] }} {{ $student['last_name'] }}</p>
                                    <p class="text-[9px] font-black text-indigo-400 uppercase tracking-widest">ID: #{{ $student['id'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-6">
                            <span class="text-xs font-bold text-slate-500">{{ $student['email'] }}</span>
                        </td>
                        <td class="px-10 py-6">
                            <span class="px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase tracking-widest">Active</span>
                        </td>
                        <td class="px-10 py-6 text-right">
                            <button class="p-3 bg-slate-50 text-slate-400 rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-300">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-10 py-20 text-center">
                            <p class="text-slate-400 font-bold italic">No students enrolled in this classroom yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
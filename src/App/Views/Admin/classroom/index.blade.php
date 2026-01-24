@extends('layouts.adminLayout')

@section('title', 'Manage Classrooms')

@section('content')
<div class="space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    {{-- Header Section --}}
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-2">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">
                <a href="/admin/dashboard" class="hover:text-primary transition-colors">Admin</a>
                <span class="material-symbols-outlined text-[12px]">chevron_right</span>
                <span class="text-slate-900">Classrooms</span>
            </nav>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Active <span class="text-transparent bg-clip-text pink-gradient">Classrooms</span></h1>
            <p class="text-slate-400 font-medium mt-1">Manage student groups and academic years.</p>
        </div>
        
        <a href="/admin/classroom/create" class="flex items-center gap-3 px-8 py-5 pink-gradient text-white font-black rounded-[2rem] shadow-2xl shadow-pink-500/40 hover:-translate-y-1 transition-all duration-300 group">
            <span class="material-symbols-outlined group-hover:rotate-90 transition-transform duration-500">add_circle</span>
            <span>Add Classroom</span>
        </a>
    </header>

    {{-- Grid Container --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        
        @forelse($classrooms as $class)
            <div class="bg-white/80 backdrop-blur-2xl rounded-[3.5rem] p-8 border border-white shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] group hover:shadow-xl transition-all duration-500 relative overflow-hidden">
                
                {{-- Icon Visual --}}
                <div class="w-16 h-16 rounded-[2rem] bg-slate-50 text-primary flex items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-all duration-500 shadow-sm">
                    <span class="material-symbols-outlined text-4xl">groups</span>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-black text-slate-900 mb-1 leading-tight">{{ $class['name'] }}</h3>
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 bg-pink-50 text-primary text-[10px] font-black rounded-full uppercase tracking-tighter">
                            Year: {{ $class['year'] ?? 'N/A' }}
                        </span>
                    </div>
                </div>

                {{-- Card Footer --}}
                <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Created On</span>
                        <span class="text-xs font-bold text-slate-700">
                            {{ date('M d, Y', strtotime($class['created_at'])) }}
                        </span>
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="/admin/classroom/edit?id={{ $class['id'] }}" class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-primary hover:bg-white hover:shadow-xl transition-all border border-transparent hover:border-pink-100">
                            <span class="material-symbols-outlined">edit_square</span>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="col-span-full py-32 flex flex-col items-center justify-center text-center space-y-6 bg-white/30 backdrop-blur-xl rounded-[4rem] border-2 border-dashed border-slate-200">
                <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center text-slate-300 shadow-inner">
                    <span class="material-symbols-outlined text-5xl">domain_disabled</span>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-800">No classrooms found</h3>
                    <p class="text-slate-400 font-medium">Register a new academic group to get started.</p>
                </div>
                <a href="/admin/classroom/create" class="px-8 py-4 pink-gradient text-white font-black rounded-full text-xs uppercase tracking-widest shadow-xl shadow-pink-500/20 hover:scale-105 transition-transform">
                    Create your first classroom
                </a>
            </div>
        @endforelse

    </div>
</div>
@endsection

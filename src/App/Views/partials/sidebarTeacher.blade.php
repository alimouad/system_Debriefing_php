  <aside class="w-72 h-full bg-white border-r border-slate-100 flex flex-col p-8 z-50">
      <div class="flex items-center gap-3 mb-12 px-2">
          <div class="w-10 h-10 indigo-gradient rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
              <span class="material-symbols-outlined text-2xl font-bold">school</span>
          </div>
          <span class="text-xl font-black tracking-tighter">Debrief.<span class="text-indigo-600">Pro</span></span>
      </div>


      <nav class="space-y-3 flex-1 px-4">
          @php
          // Get the current path to determine which link is active
          $currentPath = $_SERVER['REQUEST_URI'];
          @endphp

          {{-- Home Link --}}
          <a href="/teacher/home"
              class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
       {{ str_contains($currentPath, '/teacher/home') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-slate-400 hover:text-indigo-600 hover:bg-slate-50' }}">
              <div class="flex items-center gap-4">
                  <i data-lucide="layout-dashboard" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                  <span class="font-bold text-sm tracking-tight">Dashboard</span>
              </div>
              @if(str_contains($currentPath, '/teacher/home'))
              <div class="w-1.5 h-1.5 rounded-full bg-indigo-600"></div>
              @endif
          </a>

          {{-- Classroom Link --}}
          <a href="/teacher/classroom"
              class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
       {{ str_contains($currentPath, '/teacher/classroom') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-slate-400 hover:text-indigo-600 hover:bg-slate-50' }}">
              <div class="flex items-center gap-4">
                  <i data-lucide="users" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                  <span class="font-bold text-sm tracking-tight">Classroom</span>
              </div>
              @if(str_contains($currentPath, '/teacher/classroom'))
              <div class="w-1.5 h-1.5 rounded-full bg-indigo-600"></div>
              @endif
          </a>

          {{-- Briefs Link --}}
          <a href="/teacher/briefs"
              class="flex items-center justify-between group p-4 rounded-[1.5rem] transition-all duration-300 
       {{ str_contains($currentPath, '/teacher/briefs') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-slate-400 hover:text-indigo-600 hover:bg-slate-50' }}">
              <div class="flex items-center gap-4">
                  <i data-lucide="scroll-text" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                  <span class="font-bold text-sm tracking-tight">Briefs & Projects</span>
              </div>
              @if(str_contains($currentPath, '/teacher/briefs'))
              <div class="w-1.5 h-1.5 rounded-full bg-indigo-600"></div>
              @endif
          </a>
      </nav>

      {{-- User Profile Card --}}
      <div class="mt-auto p-5 rounded-[2rem] bg-slate-50 border border-slate-100">
          <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                  {{ substr($_SESSION['user_name'] ?? 'T', 0, 1) }}
              </div>
              <div class="flex-1 truncate">
                  <p class="text-xs font-black truncate">{{ $_SESSION['user_name'] ?? 'Instructor' }}</p>
                  <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Faculty Member</p>
              </div>
              <a href="/logout" class="text-slate-300 hover:text-rose-500 transition-colors">
                  <span class="material-symbols-outlined text-xl">logout</span>
              </a>
          </div>
      </div>
  </aside>
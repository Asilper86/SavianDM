<div class="relative overflow-hidden group">
    <div class="flex flex-col items-center justify-center p-12 rounded-[2rem] bg-white border border-slate-100 shadow-sm relative z-10">
        
        <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
            <div class="w-12 h-12 rounded-2xl bg-[#E4F4F3] text-[#07CBBB] flex items-center justify-center shadow-inner">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <h4 class="text-slate-800 font-black text-lg mb-2 tracking-tight">
            Búsqueda sin resultados
        </h4>

        <p class="text-slate-400 text-sm font-medium max-w-[250px] leading-relaxed">
            {{ $slot }}
        </p>

        <div class="mt-8 flex gap-1">
            <div class="w-8 h-1 rounded-full bg-[#07CBBB]/20"></div>
            <div class="w-2 h-1 rounded-full bg-[#07CBBB]/40"></div>
            <div class="w-1 h-1 rounded-full bg-[#07CBBB]"></div>
        </div>
    </div>

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-[#07CBBB]/5 blur-[60px] rounded-full"></div>
</div>
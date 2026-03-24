<div class="w-full min-h-screen bg-[#F3F4F6] p-2 sm:p-4 md:p-8 flex flex-col">
    <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] sm:rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-4 sm:p-10 flex-1 flex flex-col overflow-hidden">

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4 px-2">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="hidden sm:block w-8 h-1 bg-[#07CBBB] rounded-full"></span>
                    <h3 class="text-2xl sm:text-4xl font-black text-slate-800 tracking-tighter">Listado de Fincas</h3>
                </div>
                <p class="text-slate-400 text-xs sm:text-sm font-medium sm:ml-11">Gestiona tus activos en tiempo real.</p>
            </div>
            
            <div class="w-full lg:w-auto">
                @livewire('empresas.create-empresas')
            </div>
        </div>

        <div class="flex-1 overflow-auto rounded-3xl custom-scrollbar">
            <table class="w-full border-separate border-spacing-y-3">
                <thead class="sticky top-0 bg-white/10 backdrop-blur-md z-10">
                    <tr class="text-slate-400">
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left">ID</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left">Empresa</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-center">Hectáreas</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $item)
                        <tr class="group">
                            <td class="bg-slate-50/50 px-6 py-4 rounded-l-3xl border-y border-l border-transparent text-xs font-bold text-slate-400">#{{ $item->id }}</td>
                            <td class="bg-slate-50/50 px-6 py-4 border-y border-transparent font-black text-slate-700 text-sm sm:text-base">{{ $item->nombre }}</td>
                            <td class="bg-slate-50/50 px-6 py-4 border-y border-transparent text-center">
                                <span class="px-3 py-1 bg-white rounded-xl text-[#07CBBB] text-xs font-black shadow-sm border border-slate-100">
                                    {{ $item->hectarea }} ha
                                </span>
                            </td>
                            <td class="bg-slate-50/50 px-6 py-4 rounded-r-3xl border-y border-r border-transparent text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="p-2 bg-white text-slate-400 hover:text-[#07CBBB] rounded-lg transition-colors border border-slate-50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="2"/></svg></button>
                                    <button class="p-2 bg-white text-slate-400 hover:text-red-500 rounded-lg transition-colors border border-slate-50"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mb-4">
                {{ $empresas->links() }}
            </div>
        </div>
    </div>
</div>
<div class="w-full min-h-screen bg-[#F3F4F6] p-4 md:p-8 flex flex-col">
    <div class="bg-white/80 backdrop-blur-xl rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-6 sm:p-10 flex-1 flex flex-col">
        
        <div class="flex flex-col gap-8 mb-10 px-4">
            <div class="flex justify-between items-end">
                <div>
                    <div class="flex items-center gap-4 mb-2">
                        <span class="w-10 h-1.5 bg-[#07CBBB] rounded-full"></span>
                        <h3 class="text-4xl font-black text-slate-800 tracking-tighter">Gestión de Móviles</h3>
                    </div>
                    <p class="text-slate-400 text-base font-medium ml-14">Control de inventario y estado de dispositivos.</p>
                </div>
                @livewire('movil.create-movil')
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-slate-50/50 p-4 rounded-[2rem] border border-slate-100">
                <div class="relative">
                    <input type="text" placeholder="Buscar SN..." class="w-full bg-white border-none rounded-2xl py-3 px-5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-cyan-100 outline-none">
                </div>
                <select class="bg-white border-none rounded-2xl py-3 px-5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-cyan-100 outline-none appearance-none">
                    <option>Empresa</option>
                </select>
                <select class="bg-white border-none rounded-2xl py-3 px-5 text-sm font-bold shadow-sm focus:ring-2 focus:ring-cyan-100 outline-none appearance-none">
                    <option>Centro</option>
                </select>
                <button class="bg-slate-800 text-white rounded-2xl font-bold text-sm hover:bg-black transition-all">Limpiar Filtros</button>
            </div>
        </div>

        <div class="overflow-x-auto flex-1">
            <table class="w-full border-separate border-spacing-y-4">
                <thead>
                    <tr class="text-slate-400">
                        <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">SN</th>
                        <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">Tipo Compra</th>
                        <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">Modelo</th>
                        <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">Empresa</th>
                        <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-center">Estado</th>
                        <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-left">Proveedor</th>
                        <th class="px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($moviles as $item)
                        <tr class="group">
                            <td class="bg-slate-50/50 group-hover:bg-white px-6 py-5 rounded-l-[2rem] transition-all border-y border-l border-transparent group-hover:border-slate-100 text-sm font-black text-slate-700">
                                {{ $item->sn }}
                            </td>
                            <td class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100">
                                <span class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase {{ $item->tipo_compra == 'Propio' ? 'bg-blue-50 text-blue-500' : 'bg-indigo-50 text-indigo-500' }}">
                                    {{ $item->tipo_compra }}
                                </span>
                            </td>
                            <td class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100 font-bold text-slate-600">
                                {{ $item->modelo }}
                            </td>
                            <td class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100 font-bold text-slate-500">
                                {{ $item->empresa }}
                            </td>
                            <td class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase {{ $item->estado == 'Stock' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $item->estado == 'Stock' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                    {{ $item->estado }}
                                </span>
                            </td>
                            <td class="bg-slate-50/50 group-hover:bg-white px-6 py-5 transition-all border-y border-transparent group-hover:border-slate-100 text-xs font-medium text-slate-400">
                                {{ $item->proveedor }}
                            </td>
                            <td class="bg-slate-50/50 group-hover:bg-white px-6 py-5 rounded-r-[2rem] transition-all border-y border-r border-transparent group-hover:border-slate-100 text-right">
                                <div class="flex justify-end gap-2 opacity-30 group-hover:opacity-100 transition-all">
                                    <button class="p-2.5 bg-white text-slate-400 hover:text-[#07CBBB] rounded-xl shadow-sm border border-slate-50 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </button>
                                    <button class="p-2.5 bg-white text-slate-400 hover:text-red-500 rounded-xl shadow-sm border border-slate-50 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
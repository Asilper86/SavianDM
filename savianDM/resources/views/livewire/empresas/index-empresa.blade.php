<div class="max-w-7xl mx-auto py-12 px-6">
    <div
        class="bg-white/80 backdrop-blur-md rounded-[3.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-white p-8">

        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6 px-4">
            <div>
                <h3 class="text-3xl font-black text-slate-800 tracking-tight mb-2">Listado de Fincas</h3>
                <p class="text-slate-400 text-sm font-medium">Gestiona y visualiza el estado de tus proyectos en tiempo
                    real.</p>
            </div>
            @livewire('empresas.create-empresas')
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-separate border-spacing-y-4">
                <thead>
                    <tr class="text-slate-400">
                        <th class="px-8 py-2 text-[11px] font-black uppercase tracking-[0.2em]">ID</th>
                        <th class="px-8 py-2 text-[11px] font-black uppercase tracking-[0.2em]">Nombre de la empresa</th>
                        <th class="px-8 py-2 text-[11px] font-black uppercase tracking-[0.2em] text-center">Superficie
                        </th>
                        <th class="px-8 py-2 text-[11px] font-black uppercase tracking-[0.2em]">Centro de Trabajo</th>
                        <th class="px-8 py-2 text-[11px] font-black uppercase tracking-[0.2em] text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $item)
                        <tr class="group">
                            <td
                                class="bg-slate-50/50 group-hover:bg-white px-8 py-7 rounded-l-[2rem] transition-all duration-300 border-y border-l border-transparent group-hover:border-slate-100 group-hover:shadow-sm">
                                <span class="text-sm font-bold text-slate-400">#{{ $item->id }}</span>
                            </td>
                            <td
                                class="bg-slate-50/50 group-hover:bg-white px-8 py-7 transition-all duration-300 border-y border-transparent group-hover:border-slate-100 group-hover:shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-base font-black text-slate-700">{{ $item->nombre }}</span>
                                    </div>
                                </div>
                            </td>
                            <td
                                class="bg-slate-50/50 group-hover:bg-white px-8 py-7 text-center transition-all duration-300 border-y border-transparent group-hover:border-slate-100 group-hover:shadow-sm">
                                <span
                                    class="inline-flex items-center px-4 py-2 bg-white text-[#07CBBB] rounded-xl text-sm font-black border border-slate-100 shadow-sm">
                                    {{ $item->hectarea }} ha
                                </span>
                            </td>
                            <td
                                class="bg-slate-50/50 group-hover:bg-white px-8 py-7 transition-all duration-300 border-y border-transparent group-hover:border-slate-100 group-hover:shadow-sm">
                                <div class="flex items-center gap-3">
                                    <span class="relative flex h-3 w-3">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-[#07CBBB]"></span>
                                    </span>
                                    <span class="text-sm font-bold text-slate-600"> {{ $item->centroTrabajo->nombre }}  </span>
                                </div>
                            </td>
                            <td
                                class="bg-slate-50/50 group-hover:bg-white px-8 py-7 rounded-r-[2rem] text-right transition-all duration-300 border-y border-r border-transparent group-hover:border-slate-100 group-hover:shadow-sm">
                                <div class="flex justify-end gap-3">
                                    <button
                                        class="w-10 h-10 flex items-center justify-center bg-white text-slate-400 hover:text-[#07CBBB] hover:shadow-md rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button
                                        class="w-10 h-10 flex items-center justify-center bg-white text-slate-400 hover:text-red-500 hover:shadow-md rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="mt-10 flex flex-col md:flex-row justify-between items-center gap-4 px-4">
            <div class="flex gap-3">

            </div>
        </div>
    </div>
</div>

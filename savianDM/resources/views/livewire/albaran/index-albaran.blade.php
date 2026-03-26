<div class="w-full min-h-screen bg-[#F3F4F6] p-2 sm:p-4 md:p-8 flex flex-col font-sans">
    <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] sm:rounded-[3.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.03)] border border-white p-4 sm:p-10 flex-1 flex flex-col overflow-hidden">

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8 gap-4 px-2">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="hidden sm:block w-8 h-1 bg-slate-800 rounded-full"></span>
                    <h3 class="text-2xl sm:text-4xl font-black text-slate-800 tracking-tighter">Registro de Albaranes</h3>
                </div>
                <p class="text-slate-400 text-xs sm:text-sm font-medium sm:ml-11">Control de entradas y salidas de mercancía.</p>
            </div>

            <div class="relative w-full lg:w-96 group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400 group-focus-within:text-slate-800 transition-colors"></i>
                </div>
                <input type="text" placeholder="Buscar por número o fecha..."
                    class="block w-full pl-11 pr-4 py-4 bg-slate-50/50 border-2 border-transparent rounded-2xl text-sm font-bold text-slate-700 outline-none focus:bg-white focus:border-slate-800 focus:ring-4 focus:ring-slate-800/5 transition-all shadow-sm">
            </div>

            <div class="w-full lg:w-auto">
                <button class="w-full lg:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-lg hover:bg-slate-800 transition-all flex items-center justify-center gap-3 active:scale-95">
                    <i class="fas fa-plus"></i>
                    Nuevo Albarán
                </button>
            </div>
        </div>

        <div class="flex-1 overflow-auto rounded-3xl custom-scrollbar">
            <table class="w-full border-separate border-spacing-y-3">
                <thead class="sticky top-0 bg-white/10 backdrop-blur-md z-10">
                    <tr class="text-slate-400">
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left w-24">Nº Albarán</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-left">Fecha de Emisión</th>
                        <th class="px-6 py-3 text-[10px] font-black uppercase tracking-widest text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="group">
                        <td class="bg-slate-50/50 px-6 py-5 rounded-l-3xl border-y border-l border-transparent text-xs font-black text-slate-500 italic">
                            ALB-2024-001
                        </td>
                        <td class="bg-slate-50/50 px-6 py-5 border-y border-transparent font-bold text-slate-700">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm border border-slate-100 text-slate-400">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <span class="text-sm sm:text-base">26 de Marzo, 2024</span>
                            </div>
                        </td>
                        <td class="bg-slate-50/50 px-6 py-5 rounded-r-3xl border-y border-r border-transparent text-right">
                            <div class="flex justify-end gap-2">
                                <button title="Descargar PDF" class="p-3 bg-white text-emerald-500 hover:bg-emerald-500 hover:text-white rounded-xl transition-all border border-slate-100 shadow-sm">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                                <button title="Editar" class="p-3 bg-white text-blue-500 hover:bg-blue-500 hover:text-white rounded-xl transition-all border border-slate-100 shadow-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button title="Eliminar" class="p-3 bg-white text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all border border-slate-100 shadow-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                   
                </tbody>
            </table>
        </div>

        
    </div>
</div>
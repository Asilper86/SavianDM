<div>
    <div class="min-h-screen bg-green-50/50 p-4">

        <div class="bg-green-600 rounded-xl shadow-md p-4 mb-6 flex flex-wrap gap-3 items-center justify-between">
            <div class="flex flex-wrap gap-3 flex-grow">
                <input type="text" placeholder="Buscar SN..."
                    class="rounded-lg border-none focus:ring-2 focus:ring-green-400 text-sm w-40"
                    wire:model.live="buscar">

                <select class="rounded-lg border-none focus:ring-2 focus:ring-green-400 text-sm w-48"
                    wire:model.live="idEmpresa">
                    <option value="">Empresa</option>
                    @foreach ($empresa as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>

                <select class="rounded-lg border-none focus:ring-2 focus:ring-green-400 text-sm w-48"
                    wire:model.live="idCentro">
                    <option value="">Centro</option>
                    @foreach ($centroTrabajo as $item)
                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                    @endforeach
                </select>
            </div>

            @livewire('movil.create-movil')
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-green-100 overflow-hidden">
            <table class="w-full table-fixed divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="w-[10%] px-3 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider cursor-pointer"
                            wire:click="ordenar('codigo')">
                            <i class="fas fa-sort mr-1"></i>SN
                        </th>
                        <th class="w-[12%] px-3 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider cursor-pointer"
                            wire:click="ordenar('tipoCompra')">
                            <i class="fas fa-sort mr-1"></i>Tipo Compra
                        </th>
                        <th class="w-[16%] px-3 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider cursor-pointer"
                            wire:click="ordenar('modelo')">
                            <i class="fas fa-sort mr-1"></i>Modelo
                        </th>
                        <th
                            class="w-[18%] px-3 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">
                            Empresa
                        </th>
                        <th
                            class="w-[18%] px-3 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">
                            Estado
                        </th>
                        <th
                            class="w-[16%] px-3 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">
                            Proveedor
                        </th>
                        <th
                            class="w-[10%] px-3 py-3 text-center text-xs font-semibold text-green-800 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($moviles as $item)
                        <tr class="hover:bg-green-50/30 transition">
                            <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item->codigo }}
                            </td>

                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">
                                    {{ $item->tipoCompra }}
                                </span>
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-600 leading-5 break-words">
                                {{ $item->modelo->nombre }}
                            </td>

                            <td class="px-3 py-3 text-sm text-gray-600 leading-5 break-words">
                                {{ $item->empresa->nombre }}
                            </td>

                            <td class="px-3 py-3 text-sm leading-5">
                                @php
                                    $color = match ($item->estado) {
                                        'Stock' => 'bg-green-100 text-green-800 border-green-200',
                                        'Roto' => 'bg-red-100 text-red-800 border-red-200',
                                        'Campo' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'Preparado' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        default => 'bg-gray-100 text-gray-800 border-gray-200',
                                    };
                                @endphp

                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $color }}">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 {{ str_replace('bg-', 'text-', explode(' ', $color)[0]) }}"
                                        fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    {{ $item->estado }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-sm text-gray-600 leading-5 break-words">
                                {{ $item->proveedor->nombre }}
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
    </div>
</div>
<div>

    <div class="min-h-screen bg-green-50/50 p-6">
    
    

    <div class="bg-green-600 rounded-xl shadow-md p-4 mb-6 flex flex-wrap gap-4 items-center justify-between">
        <div class="flex flex-wrap gap-3 flex-grow">
            <input type="text" placeholder="Buscar SN..." class="rounded-lg border-none focus:ring-2 focus:ring-green-400 text-sm w-full md:w-48" wire:model.live="buscar">
            
            <select class="rounded-lg border-none focus:ring-2 focus:ring-green-400 text-sm">
                <option>Empresa</option>
            </select>
            
            <select class="rounded-lg border-none focus:ring-2 focus:ring-green-400 text-sm">
                <option>Centro</option>
            </select>
            
            <input type="date" class="rounded-lg border-none focus:ring-2 focus:ring-green-400 text-sm text-gray-500">
        </div>
        
        <button class="bg-white text-green-700 hover:bg-green-50 font-bold py-2 px-4 rounded-lg transition flex items-center gap-2 shadow-sm">
            <span class="text-lg">+</span> Nuevo Registro
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-green-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">SN</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Tipo Compra</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Modelo</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Empresa</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Centro Trabajo</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Proveedor</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Fecha UTC</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-green-800 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ( $moviles as $item)
                    <tr class="hover:bg-green-50/30 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->codigo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">{{ $item->tipoCompra }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item->modelo->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item->empresa->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item->empresa->centroTrabajo->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $item->proveedor->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">2024-05-20 10:30</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button class="text-green-600 hover:text-green-900 mx-2">Editar</button>
                            <button class="text-red-400 hover:text-red-600 mx-2">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
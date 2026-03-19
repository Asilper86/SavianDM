<div>

    <div class="min-h-screen bg-green-50/50 p-6">
    
    <nav class="bg-white shadow-sm border-b border-green-100 rounded-xl mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-green-600 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    </div>
                    <span class="font-bold text-xl text-green-900 tracking-tight">Savian<span class="text-green-600">Robotics</span></span>
                </div>

                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-green-700 border-b-2 border-green-500 px-1 pt-1 text-sm font-medium">Inicio</a>
                    <a href="#" class="text-gray-500 hover:text-green-600 px-1 pt-1 text-sm font-medium transition">Móvil</a>
                    <a href="#" class="text-gray-500 hover:text-green-600 px-1 pt-1 text-sm font-medium transition">Historial</a>
                    <a href="#" class="text-gray-500 hover:text-green-600 px-1 pt-1 text-sm font-medium transition">Empresas</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-green-600 rounded-xl shadow-md p-4 mb-6 flex flex-wrap gap-4 items-center justify-between">
        <div class="flex flex-wrap gap-3 flex-grow">
            <input type="text" placeholder="Buscar IMEI..." class="rounded-lg border-none focus:ring-2 focus:ring-green-400 text-sm w-full md:w-48">
            
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
                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Imei</th>
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
                    <tr class="hover:bg-green-50/30 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">352617100023456</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-medium">Directa</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Industrial Bot-X2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Savian Robotics SL</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Planta Norte</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">TechSupply Co.</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">2024-05-20 10:30</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button class="text-green-600 hover:text-green-900 mx-2">Editar</button>
                            <button class="text-red-400 hover:text-red-600 mx-2">Eliminar</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-green-50/30 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">864221055598122</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700 font-medium">Leasing</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Sensor Hub Pro</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">BioTech Labs</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Almacén Central</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Global Mobiles</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">2024-05-21 08:15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button class="text-green-600 hover:text-green-900 mx-2">Editar</button>
                            <button class="text-red-400 hover:text-red-600 mx-2">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
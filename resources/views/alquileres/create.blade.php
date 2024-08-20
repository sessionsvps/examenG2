<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('alquileres.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Fecha -->
                <div>
                    <label for="fecha_venta" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="datetime-local" id="fecha_venta" name="fecha_venta" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Nro Ficha -->
                <div>
                    <label for="nro_ficha" class="block text-sm font-medium text-gray-700">Nro Ficha</label>
                    <input type="text" id="nro_ficha" name="nro_ficha" value="{{ $nroFicha }}" readonly
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm sm:text-sm">
                </div>

                <div class="flex items-end space-x-4">
                    <div class="flex-1">
                        <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                        <input type="text" id="dni" name="dni" maxlength="8"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <button type="button" id="buscarCliente"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Buscar
                        </button>
                    </div>
                </div>
                
                <!-- Nombres y Apellidos -->
                <div>
                    <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres y Apellidos</label>
                    <input type="text" id="nombres" name="nombres" readonly
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm sm:text-sm">
                </div>
                
                <!-- Dirección -->
                <div>
                    <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" id="direccion" name="direccion" readonly
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm sm:text-sm">
                </div>

                <!-- Select para Videos -->
                <div>
                    <label for="video_id" class="block text-sm font-medium text-gray-700">Video</label>
                    <select id="video_id" name="video_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="" selected disabled>Selecciona un video</option>
                        @foreach ($videos as $video)
                        <option value="{{ $video->id }}" data-price="{{ $video->precio }}">{{ $video->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Cantidad -->
                <div>
                    <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" min="1"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                
                <!-- Precio -->
                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                    <input type="text" id="precio" name="precio" readonly
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm sm:text-sm">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Registrar Alquiler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('video_id').addEventListener('change', function() {
            var selectedVideo = this.options[this.selectedIndex];
            var price = selectedVideo.getAttribute('data-price');
            document.getElementById('precio').value = price;
        });
    </script>
    <script>
        document.getElementById('buscarCliente').addEventListener('click', function () {
            let dni = document.getElementById('dni').value;
            
            if (dni) {
                fetch(`/api/clientes/${dni}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        document.getElementById('nombres').value = `${data.cliente.nombres} ${data.cliente.apellidos}`;
                        document.getElementById('direccion').value = data.cliente.direccion;
                    } else {
                        alert(data.message);
                        document.getElementById('nombres').value = ''; // Limpiar el campo si no se encuentra el cliente
                        document.getElementById('direccion').value = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al buscar el cliente.');
                });
            } else {
                alert('Por favor, ingrese un DNI.');
            }
        });
    </script>
</x-app-layout>
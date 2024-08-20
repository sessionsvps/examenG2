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

                <!-- DNI y Buscar Cliente -->
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
                        <option value="{{ $video->id }}" data-price="{{ $video->precio }}"
                            data-stock="{{ $video->stock }}">{{ $video->nombre }}</option>
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

                <!-- Campo oculto para los videos seleccionados -->
    <input type="hidden" id="videos_input" name="videos">

                <!-- Botón para agregar video a la tabla -->
                <div>
                    <button type="button" id="agregarVideo"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Agregar Video
                    </button>
                </div>

                <!-- Tabla de videos seleccionados -->
                <div class="mt-6">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Cantidad</th>
                                <th class="px-4 py-2">Precio</th>
                                <th class="px-4 py-2">Importe</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaVideos">
                            <!-- Aquí se insertarán las filas con los videos seleccionados -->
                        </tbody>
                    </table>
                </div>

                <!-- Total -->
                <div class="mt-4">
                    <label for="total" class="block text-sm font-medium text-gray-700">Total</label>
                    <input type="text" id="total" name="total" readonly
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

    <!-- Script para actualizar precio según selección -->
    
    <script>
        var videosArray = [];
        
        document.getElementById('video_id').addEventListener('change', function () {
        var selectedVideo = this.options[this.selectedIndex];
        var price = selectedVideo.getAttribute('data-price');
        document.getElementById('precio').value = price;
        });
        
        document.getElementById('agregarVideo').addEventListener('click', function () {
        var videoSelect = document.getElementById('video_id');
        var videoId = videoSelect.value;
        var videoNombre = videoSelect.options[videoSelect.selectedIndex].text;
        var cantidad = document.getElementById('cantidad').value;
        var precio = document.getElementById('precio').value;
        var stock = videoSelect.options[videoSelect.selectedIndex].getAttribute('data-stock');
        
        // Validar que el video no esté duplicado
        var existeVideo = false;
        document.querySelectorAll('#tablaVideos tr').forEach(function (row) {
        var idVideoTabla = row.children[0].textContent;
        if (idVideoTabla === videoId) {
        existeVideo = true;
        }
        });
        
        if (existeVideo) {
        alert('Este video ya ha sido agregado.');
        return;
        }
        
        // Validar que la cantidad no supere el stock
        if (parseInt(cantidad) > parseInt(stock)) {
        alert('La cantidad ingresada supera el stock disponible.');
        return;
        }
        
        if (videoId && cantidad > 0 && precio) {
        var importe = cantidad * precio;
        
        // Crear el objeto del video
        var videoData = {
        id_video: videoId,
        nombre: videoNombre,
        cantidad: cantidad,
        precio: precio
        };
        
        // Añadir el video al array de videos
        videosArray.push(videoData);
        
        // Actualizar el campo oculto con los datos JSON
        document.getElementById('videos_input').value = JSON.stringify(videosArray);
        
        // Crear una nueva fila en la tabla
        var newRow = document.createElement('tr');
        newRow.innerHTML = `
        <td class="border px-4 py-2">${videoId}</td>
        <td class="border px-4 py-2">${videoNombre}</td>
        <td class="border px-4 py-2">${cantidad}</td>
        <td class="border px-4 py-2">${precio}</td>
        <td class="border px-4 py-2">${importe}</td>
        <td class="border px-4 py-2">
            <button type="button" class="text-red-600 remove-video">Eliminar</button>
        </td>
        `;
        
        // Agregar la nueva fila a la tabla
        document.getElementById('tablaVideos').appendChild(newRow);
        
        // Actualizar el total
        actualizarTotal();
        
        // Limpiar los campos después de agregar el video
        videoSelect.selectedIndex = 0;
        document.getElementById('cantidad').value = '';
        document.getElementById('precio').value = '';
        } else {
        alert('Por favor, seleccione un video y una cantidad válida.');
        }
        });
        
        function actualizarTotal() {
        var total = 0;
        document.querySelectorAll('#tablaVideos tr').forEach(function (row) {
        var importe = parseFloat(row.children[4].textContent);
        total += importe;
        });
        document.getElementById('total').value = total.toFixed(2);
        }
        
        document.getElementById('tablaVideos').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-video')) {
        var videoIdToRemove = e.target.parentElement.parentElement.children[0].textContent;
        videosArray = videosArray.filter(function (video) {
        return video.id_video != videoIdToRemove;
        });
        
        document.getElementById('videos_input').value = JSON.stringify(videosArray);
        
        e.target.parentElement.parentElement.remove();
        actualizarTotal();
        }
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
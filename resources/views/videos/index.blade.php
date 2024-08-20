<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NOMBRE
                            </th>
                            <th scope="col" class="px-6 py-3">
                                STOCK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                PRECIO
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($videos as $video)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$video->id}}
                            </th>
                            <td class="px-6 py-4">
                                {{$video->nombre}}
                            </td>
                            <td class="px-6 py-4">
                                {{$video->stock}}
                            </td>
                            <td class="px-6 py-4">
                                {{$video->precio}}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center">
                                No hay registros
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
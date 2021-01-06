<div>
    <div class="w-full max-w-5xl flex flex-col space-y-4 container mx-auto">
        <div class="space-y-4">
            <!-- SEARCH e QUANTIDADE POR PÁGINA -->
            <div class="flex">
                <div class="w-2/3">
                    <div class="flex">
                        <input wire:model="filters.search" class="border text-light text-grey-700 pl-2" placeholder="Search products...">
                        <p wire:click="$set('openAdvancedFilters', {{ !$openAdvancedFilters }})" class="ml-2 text-gray-500 cursor-pointer">Filtros avançados</p>
                    </div>
                </div>
                <div class="w-1/3 flex flex-row justify-center items-center">
                    <label for="location" class="block text-sm mr-4 leading-5 font-medium text-gray-700">
                        Mostrar
                    </label>
                    <select wire:model="perPage" class="w-full border bg-white rounded px-3 py-2 outline-none">
                        <option class="py-1">10</option>
                        <option class="py-1">25</option>
                        <option class="py-1">50</option>
                        <option class="py-1">100</option>
                    </select>
                </div>
            </div>

            <div>
                @if($openAdvancedFilters)
                <div class="w-full p-8 bg-gray-200">
                    <div class="flex flex-column">
                        <div class="w-1/3 space-y-2">
                            <div class="px-2">
                                <label for="">Estoque mínimo</label>
                                <input wire:model="filters.minStock" class="w-full p-1" type="number">
                            </div>
                        </div>
                        <div class="w-1/3 space-y-2">
                            <div class="px-2">
                                <label for="">Estoque máximo</label>
                                <input wire:model="filters.maxStock" class="w-full p-1" type="number">
                            </div>
                        </div>
                        <div class="w-1/3">
                            <label for="Status">Status</label>
                            <select wire:model="filters.status" class="w-full p-2" name="" id="">
                                <option value="">Selecione</option>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full flex items-end justify-end mt-2">
                        <span wire:click="clearFilters" class="cursor-pointer">Limpar filtros</span>
                    </div>
                </div>
                @endif
            </div>

            <!-- TABELA -->
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table wire:loading.class.delay="opacity-40" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th wire:click="sortBy('id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        #
                                    </th>
                                    <th wire:click="sortBy('name')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        Produto
                                    </th>
                                    <th wire:click="sortBy('stock')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        Estoque
                                    </th>
                                    <th wire:click="sortBy('status')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $product->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $product->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $product->stock }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $product->status ? "Ativo" : "Inativo" }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            No products found.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGINAÇÃO -->
        <div>
            {{ $products->links() }}
        </div>
    </div>
</div>

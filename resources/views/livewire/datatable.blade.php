<div>
    <div class="w-full max-w-5xl flex flex-col space-y-4 container mx-auto">
        <div class="space-y-4">
            <div class="w-1/4">
                <input wire:model="filters.search" class="border text-light text-grey-700 pl-2" placeholder="Search products...">
            </div>
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
        <div>
            {{ $products->links() }}
        </div>
    </div>
</div>

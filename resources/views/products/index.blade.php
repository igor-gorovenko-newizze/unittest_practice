<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('products.create') }}" class="btn btn-dark">Create new product</a>
                    @endif

                    <div class="mt-4">
                        @if ($products->count() > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Price USD</th>
                                    <th>Price EUR</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr style="vertical-align: middle">
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->getPriceInEurAttribute() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No products found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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

                            <a href="{{ route('products.create') }}">
                                CREATE NEW PRODUCT
                            </a>

                    @endif

                    <ul>
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <li>{{ $product->title }} - {{ $product->price }}</li>
                            @endforeach
                        @else
                            <p>No products found</p>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

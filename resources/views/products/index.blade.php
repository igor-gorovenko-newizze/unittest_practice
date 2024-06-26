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
                                    @if(auth()->user()->is_admin)
                                        <th>Actions</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr style="vertical-align: middle">
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->getPriceInEurAttribute() }}</td>
                                        @if(auth()->user()->is_admin)
                                            <td class="flex">
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark mr-2">Edit</a>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        @endif
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

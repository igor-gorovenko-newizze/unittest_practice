<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Product
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf

                        <div>
                            <label for="title" :value="__('Title')" />

                            <input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="price" :value="__('Price')" />

                            <input id="price" class="block mt-1 w-full" type="number" name="price" required />
                        </div>

                        <div class="flex items-center mt-4">
                            <button class="ml-4">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

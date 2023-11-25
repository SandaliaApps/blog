<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mr-5 ml-5 mt-5 mb-5">
                    <h2 class="text-4xl font-extrabold dark:text-white">{{ $blog->name }}</h2>
                    <p class="my-4 text-lg text-gray-500">{{ $blog->body }}</p>
                    <small class="ms-2 font-semibold text-gray-500 dark:text-gray-400">{{ $blog->tags }}</small>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
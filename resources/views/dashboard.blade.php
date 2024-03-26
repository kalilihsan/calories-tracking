<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    </head>

    <body>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    </body>

    </html>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                        {{ __("Today's Meals") }}
                    </h3>
                    <table class="table-fixed w-full border-separate border-spacing-2 mt-4 mb-4">
                        <thead>
                            <tr>
                                <th class="border border-slate-300 w-1/3 text-center">{{ __("Meal") }}</th>
                                <th class="border border-slate-300 w-1/3 text-center">{{ __("Calories") }}</th>
                                <th class="border border-slate-300 w-1/3 text-center">{{ __("Action") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($meals as $meal)
                            <tr>
                                <td class="border border-slate-300 w-1/3 text-center">{{ $meal->meal }}</td>
                                <td class="border border-slate-300 w-1/3 text-center">{{ $meal->calories }}</td>
                                <td class="border border-slate-300 w-1/3 text-center">
                                    <!-- Modal toggle -->
                                    <button data-modal-target="crud-modal{{$meal->id}}" data-modal-toggle="crud-modal{{$meal->id}}" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                        Edit
                                    </button>

                                    <!-- Main modal -->
                                    <div id="crud-modal{{$meal->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Edit meals #{{$meal->id}} {{$meal->meal}}
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal{{$meal->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form class="p-4 md:p-5" action="meals/{{ $meal->id }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                                        <div class="col-span-2">
                                                            <x-input-label for="meal" :value="__('Meal')" />
                                                            <x-text-input id="meal" class="block mt-1 w-full" type="text" name="meal" value="{{$meal->meal}}" required autofocus />
                                                        </div>
                                                        <div class="col-span-2">
                                                            <x-input-label for="calories" :value="__('Calories')" />
                                                            <x-text-input id="calories" class="block mt-1 w-full" type="text" name="calories" value="{{$meal->calories}}" required autofocus />
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                        Edit meal
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <form style="display: inline;" action="/meals/{{ $meal->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal toggle -->
                    <button data-modal-target="crud-modal-create" data-modal-toggle="crud-modal-create" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                        Add New Meal
                    </button>

                    <!-- Main modal -->
                    <div id="crud-modal-create" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        New Meal
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal-create">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form class="p-4 md:p-5" action="meals/store" method="POST">
                                    @csrf
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2">
                                            <x-input-label for="meal" :value="__('Meal')" />
                                            <x-text-input id="meal" class="block mt-1 w-full" type="text" name="meal" placeholder="Enter meal" required autofocus />
                                        </div>
                                        <div class="col-span-2">
                                            <x-input-label for="calories" :value="__('Calories')" />
                                            <x-text-input id="calories" class="block mt-1 w-full" type="text" name="calories" placeholder="Enter calories" required autofocus />
                                        </div>
                                    </div>
                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- 
                    <a href="#meal-form">
                        <x-secondary-button>
                            {{ __("Add new meal") }}
                        </x-secondary-button>
                    </a> -->
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Add new meal") }}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/meals/store" method="POST" id="meal-form">
                        @csrf
                        <div class="grid grid-cols-4 gap-6">
                            <div class="col-start-2 col-end-3">
                                <div class="grid grid-rows-4 gap-6">
                                    <div>
                                        Meal
                                        <x-input-label for="meal" :value="__('Meal')" />
                                        <x-text-input id="meal" class="block mt-1 w-full" type="text" name="meal" :value="old('meal')" required autofocus />
                                    </div>
                                    <div>
                                        Calories (Kcal)
                                        <x-input-label for="calories" :value="__('Calories')" />
                                        <x-text-input id="calories" class="block mt-1 w-full" type="text" name="calories" :value="old('calories')" required autofocus />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-primary-button class="mt-4">Submit</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
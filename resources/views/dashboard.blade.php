<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                                            <a href="" style="display: inline;">
                                                <x-secondary-button>
                                                    {{ __("Edit") }}
                                                </x-secondary-button>
                                            </a>
                                            <form style="display: inline;" action="/meals/{{ $meal->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>
                                                    {{ __("Delete") }}
                                                </x-danger-button>
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#meal-form">
                        <x-secondary-button >
                            {{ __("Add new meal") }}
                        </x-secondary-button>
                    </a>                
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
                                        <x-input-label for ="meal" :value="__('Meal')"/>
                                        <x-text-input id="meal" class="block mt-1 w-full" type="text" name="meal" :value="old('meal')" required autofocus/>     
                                    </div>
                                    <div>
                                       Calories (Kcal)
                                       <x-input-label for ="calories" :value="__('Calories')"/>
                                       <x-text-input id="calories" class="block mt-1 w-full" type="text" name="calories" :value="old('calories')" required autofocus/>
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


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Page A') }}
        </h2>
    </x-slot>
    <div class="ml-4">
        <a @class(['disabled-link' => !$user->is_active]) id="link"
           href="{{ !$user->is_active ? '#' : $user->link_page_a }}"
           class=" text-success transition duration-150 ease-in-out hover:text-success-600 focus:text-success-600 active:text-success-700 dark:text-gray-200 leading-tight">
            Link Page A ({{ $user->link_page_a ?? '' }})
        </a>

        <div class="row grid gap-4 grid-cols-2 grid-rows-1">
            <div class="col">
                <button id="button-generate"
                        class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Generate
                </button>
            </div>
            <div class="col ml-3">
                <button id="button-deactivate"
                        type="submit"
                        class="deactivate-button bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Deactivate
                </button>
            </div>
        </div>

        <div class="grid gap-4 grid-cols-2 grid-rows-1 pt-5">
            <div>
                <button id="button-lucky"
                        class="common-button bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Imfeelinglucky
                </button>
                <div class="lucky"></div>
            </div>
            <div class="ml-3">
                <button id="button-history"
                        class="common-button bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    History
                </button>
                <div class="history"></div>
            </div>
        </div>
    </div>
</x-app-layout>


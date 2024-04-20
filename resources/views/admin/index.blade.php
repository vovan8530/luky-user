<?php
/** @var App\Models\User[] $users */
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin panel') }}
        </h2>
    </x-slot>

    <div class="flex flex-col mt-6">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                        <tr>
                            <th scope="col" class="px-6 py-4">#</th>
                            <th scope="col" class="px-6 py-4">Name</th>
                            <th scope="col" class="px-6 py-4">Phone</th>
                            <th scope="col" class="px-6 py-4">Link page A</th>
                            <th scope="col" class="px-6 py-4">Action</th>
                        </tr>
                        </thead>
                        <tbody id="user-list">
                        @foreach($users as $user)
                            <tr class="border-b border-neutral-200 transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-white/10 dark:hover:bg-neutral-600">
                                <td class="px-6 py-4 font-medium">{{ $user->id }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->phone }}</td>
                                <td class="px-6 py-4">{{ $user->link_page_a }}</td>
                                <td class="px-6 py-4">
                                    <!-- Add your action buttons or links here -->
                                    <a href="#" class="text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('lumki::ui.manage_users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="space-y-10">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <div class="space-y-6">
                        @foreach ($users as $user)

                                <div class="flex items-center justify-between">
                                    <div>
                                        {{ $user->name }}
                                    </div>
                                    <div>
                                        {{ $user->getRoleNames()->join(", ") }}
                                    </div>
                                    <div class="flex items-center">
                                        <button class="cursor-pointer ml-6 text-sm text-blue-500 focus:outline-none">
                                            <a href="{{ route('lumki.users.edit', $user) }}">{{ __('lumki::ui.edit_roles') }}</a>
                                        </button>
                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none">
                                            <a href="{{ route('impersonate', $user->id) }}">{{ __('lumki::ui.impersonate') }}</a>
                                        </button>
                                    </div>
                                </div>

                        @endforeach
                        </div>

                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

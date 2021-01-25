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
                            <div class="px-3 py-4 flex justify-center">
                                <table class="w-full text-md rounded mb-4">
                                    <tbody>
                                        <tr class="border-b">
                                            <th class="text-left p-3 px-5">{{ __('lumki::ui.table_name') }}</th>
                                            <th class="text-left p-3 px-5">{{ __('lumki::ui.table_roles') }}</th>
                                            <th></th>
                                        </tr>
                                        @foreach ($users as $user)
                                        <tr class="border-b hover:bg-orange-100 {{ $loop->odd ? 'bg-gray-100':"" }}">
                                            <td class="p-3 px-5">{{ $user->name }}</td>
                                            <td class="p-3 px-5">{{ $user->getRoleNames()->join(", ") }}</td>
                                            <td class="p-3 px-5 flex justify-end">
                                                <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 mr-2"
                                                    href="{{ route('lumki.users.edit', $user) }}">
                                                    {{ __('lumki::ui.edit_roles') }}
                                                </a>
                                                <a class="inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm transition ease-in-out duration-150 mt-2 mr-2 bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 text-white"
                                                    href="{{ route('impersonate', $user->id) }}">
                                                    {{ __('lumki::ui.impersonate') }}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
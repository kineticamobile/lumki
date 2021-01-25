<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('lumki::ui.manage_users') }} - {{ $user->name }}
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('lumki.users.update', $user) }}">
        @csrf
        @method("PUT")
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="space-y-10">
                        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                            <div class="space-y-6">
                            @foreach ($roles as $role)
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center">
                                        <input name="roles[]" type="checkbox" class="form-checkbox" value="{{ $role->name }}" {{ $user->getRoleNames()->contains($role->name) ? "checked='checked'":"" }}>
                                        <span class="ml-2 text-sm text-gray-600">{{ $role->name }}</span>
                                    </label>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('lumki::ui.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>

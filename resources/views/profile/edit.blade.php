<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-2xl text-slate-900 dark:text-white tracking-tight">
                Pengaturan Profil
            </h2>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Kelola informasi akun administrator dan preferensi keamanan
            </p>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <!-- Information Profile Card -->
        <div class="p-6 sm:p-8 bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-200/80 dark:border-slate-700/80">
            <div class="max-w-xl text-slate-800 dark:text-slate-100">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password Card -->
        <div class="p-6 sm:p-8 bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-200/80 dark:border-slate-700/80">
            <div class="max-w-xl text-slate-800 dark:text-slate-100">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User Card -->
        <div class="p-6 sm:p-8 bg-white dark:bg-slate-800 shadow-sm rounded-2xl border border-slate-200/80 dark:border-slate-700/80">
            <div class="max-w-xl text-slate-800 dark:text-slate-100">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
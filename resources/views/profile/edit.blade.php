<x-layout>
    <!-- Header Section -->
    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Mon <span style="color: #00aff0;">Profil</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Gérez vos informations personnelles et paramètres de compte
                </p>
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Update Profile Information -->
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account -->
            <div class="bg-white p-8 rounded-lg border border-red-200 shadow-sm">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </section>
</x-layout>
<!-- resources/views/layouts/app.blade.php -->

<header class="bg-white dark:bg-gray-800 shadow-md py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-xl font-bold text-green-600 dark:text-green-400">
            GhirLaffaire
        </a>

        <!-- Menu -->
        <nav class="hidden md:flex space-x-6">
            <a href="{{ route('catalog') }}" class="text-gray-700 dark:text-gray-200 hover:text-green-600">
                Catalog
            </a>
            <a href="{{ route('delivery.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-green-600">
                Delivery Prices
            </a>
            <a href="{{ route('contact.create') }}" class="text-gray-700 dark:text-gray-200 hover:text-green-600">
                Contact
            </a>
        </nav>

        <!-- Dark Mode Toggle -->
        @livewire('dark-mode-toggle')
    </div>
</header>
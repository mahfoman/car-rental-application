<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-black shadow-md text-white">
            <nav class="p-4">
                <h2 class="text-lg font-bold">Admin Panel</h2>
                <ul class="mt-4">
                    <li>
                        <Link 
                            href="/admin/dashboard" 
                            :class="navClass('/admin/dashboard')"
                        >
                            Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/admin/cars" 
                            :class="navClass('/admin/cars')"
                        >
                            Cars
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/admin/customers" 
                            :class="navClass('/admin/customers')"
                        >
                            Customers
                        </Link>
                    </li>
                    <li>
                        <Link 
                            href="/admin/rentals" 
                            :class="navClass('/admin/rentals')"
                        >
                            Rentals
                        </Link>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <header class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold"></h2>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, {{ user.name }}</span>
                    <button @click="logout" class="text-red-500 hover:underline">Logout</button>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { Link, usePage, router } from '@inertiajs/vue3'
import { computed } from 'vue'

const user =  usePage().props.user

const currentUrl = computed(() => usePage().url)

const navClass = (path) => {
    return currentUrl.value.startsWith(path)
        ? 'block py-2 bg-gray-700 text-white rounded-md px-2'
        : 'block py-2 hover:bg-gray-800 rounded-md'
}


const logout = () => {
    router.get('/logout')
}
</script>

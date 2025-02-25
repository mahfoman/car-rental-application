<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from "../../Layouts/AdminLayout.vue";
defineProps({ stats: Object });
</script>

<template>
    <Head title="Admin Dashboard" />
    <AdminLayout>
        <div class="grid grid-cols-4 gap-4">
            <div class="p-4 bg-white shadow rounded-lg">
                <h2 class="mt-3 text-lg font-bold">Total Cars</h2>
                <p class="text-2xl">{{ stats.totalCars }}</p>
            </div>
            <div class="p-4 bg-white shadow rounded-lg">
                <h2 class="text-lg font-bold">Available Cars</h2>
                <p class="text-2xl">{{ stats.availableCars }}</p>
            </div>
            <div class="p-4 bg-white shadow rounded-lg">
                <h2 class="text-lg font-bold">Total Rentals</h2>
                <p class="text-2xl">{{ stats.totalRentals }}</p>
            </div>
            <div class="p-4 bg-white shadow rounded-lg">
                <h2 class="text-lg font-bold">Total Revenue</h2>
                <p class="text-2xl">{{ stats.totalProfit || 0 }}</p>
            </div>
        </div>
    </AdminLayout>
</template>

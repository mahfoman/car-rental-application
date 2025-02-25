<template>
    <FrontendLayout>

        <div class="py-3 px-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
                <div class="">
                    <h1 class="text-2xl font-bold text-gray-600">Welcome to Car Rental</h1>
                    <p class="mt-2">Find your perfect ride today!</p>
                    <Link :href="`/cars`" class="mt-4 inline-block px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded">
                        Browse Cars
                    </Link>
                </div>
                <div class="">
                    <h1 class="text-2xl font-bold mt-8 text-gray-600">Top Rented Cars</h1>

                    <div v-if="cars.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                        <div v-for="car in cars" class="max-w-sm py-6">
                            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                                <div class="bg-cover bg-center h-56 p-4" :style="{ backgroundImage: car.image ? `url('/storage/${car.image}')` : `url('/empty.png')` }">
                                </div>
                                <div class="p-4">
                                    <p class="uppercase tracking-wide text-sm font-bold text-gray-700 hover:text-gray-400">
                                        <Link :href="`/cars/${car.id}`">{{car.name}}</Link>
                                    </p>
                                    <p class="mt-1 tracking-wide text-sm font-bold text-gray-700">{{ car.car_type }} - {{ car.brand }} - {{ car.model }} ({{ car.year }})</p>
                                    <p class="mt-2 text-2xl text-gray-700">TK {{ car.daily_rent_price }} / day</p><p class="text-3xl text-gray-900"></p>
                                    <p class="text-gray-700 hover:text-gray-400 mt-2 font-bold inline-block">
                                        <Link :href="`/cars/${car.id}`">view details</Link>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else class="mt-6 text-center">
                        <p>No top rented cars found.</p>
                    </div>
                </div>
            </div>
        </div>

    </FrontendLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const page = usePage();
// Reactive variable to store top rented cars
const cars = ref(page.props.cars)

</script>

<style scoped>
.card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.card img {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
</style>

<template>
    <FrontendLayout>

        <div class="py-3 px-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
                <div class="mb-7">
                    <h1 class="text-2xl font-bold text-gray-600">Available Cars</h1>
                    <div class="mt-4 flex space-x-2">
                        <input v-model="filters.type" placeholder="Filter by type" class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-100" @input="applyFilters">
                        <input v-model="filters.brand" placeholder="Filter by brand" class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-100" @input="applyFilters">
                        <!-- Rent Price Range Filter -->
                        <select v-model="filters.rent_price_range" @change="applyFilters" class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-gray-100">
                            <option value="">Filter by daily rent price</option>
                            <option value="100-below">TK100 below</option>
                            <option value="100-500">Tk100 - TK500</option>
                            <option value="500-1000">TK500 - TK1000</option>
                            <option value="1000-above">TK1000 above</option>
                        </select>
                    </div>
                </div>

                <div class="">
                    <div class="mt-3 grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div v-for="car in cars" :key="car.id" class="bg-white rounded-lg shadow-sm mb-2">
                            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            <div class="bg-cover bg-center h-56 p-4" :style="{ backgroundImage: car.image ? `url('/storage/${car.image}')` : `url('/empty.png')` }">
                            </div>
                            <div class="p-2">
                                    <p class="uppercase tracking-wide text-sm font-bold text-gray-700 hover:text-gray-400">
                                        <Link :href="`/cars/${car.id}`">{{car.name}}</Link>
                                    </p>
                                    <p class="mt-1 tracking-wide text-sm font-bold text-gray-700">{{ car.car_type }} - {{ car.brand }} - {{ car.model }} ({{ car.year }})</p>
                                    <p class="mt-1 text-2xl text-gray-700">TK {{ car.daily_rent_price }} / day</p><p class="text-3xl text-gray-900"></p>
                                    <p class="text-gray-700 hover:text-gray-400 mt-2 font-bold inline-block"><Link :href="`/cars/${car.id}`">view details</Link></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!cars || cars.length === 0" class="">No Cars Found</div>
            </div>
        </div>

    </FrontendLayout>
</template>

<script setup>
import { ref, watch } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const page = usePage()
const cars = ref(page.props.cars)
const filters = ref({
    type: page.props.filters?.type || '',
    brand: page.props.filters?.brand || '',
    rent_price_range: page.props.filters?.rent_price_range || ''
})

const applyFilters = () => {
    router.get('/cars', filters.value, { preserveState: true, replace: true })
}

// Watching for changes in the page props and update the cars list
watch(() => page.props.cars, (newCars) => {
    cars.value = newCars
}, { immediate: true })


</script>

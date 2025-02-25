<template>
    <AdminLayout>
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold">Manage Cars</h1>
            <Link href="/admin/cars/create" class="bg-gray-600 text-white px-3 py-2 font-semibold text-sm rounded hover:bg-gray-700">
                <i class="fas fa-plus mr-2"></i>Add Car
            </Link>
        </div>
        <table class="min-w-full bg-white">
            <thead class="bg-black text-white text-xs rounded-2xl">
            <tr>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Id</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Image</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Name</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Brand</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Model</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Year</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Daily Rent Price</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Availability</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800"d>
            <tr v-for="car in cars" :key="car.id">
                <td class="p-2">{{ car.id }}</td>
                <td class="p-2">
                    <img class="w-16 h-16 object-cover rounded-lg" :src="car.image ? `/storage/${car.image}` : '/empty.png'" alt="car image">
                </td>
                <td class="p-2">{{ car.name }}</td>
                <td class="p-2">{{ car.brand }}</td>
                <td class="p-2">{{ car.model }}</td>
                <td class="p-2">{{ car.year }}</td>
                <td class="p-2">TK{{ car.daily_rent_price }}</td>
                <td class="p-2" v-html="car.availability ? `<span class='text-green-700'>Available</span>` : `<span class='text-red-700'>Not Available</span>`"></td>
                <td class="p-2">
                    <Link :href="`/admin/cars/${car.id}/edit`" class="text-gray-500 mr-4"><i class="fas fa-edit"></i></Link>
                    <button @click="deleteResource(car.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Confirm Dialog Component -->
        <ConfirmDialog
            :isOpen="showDeleteModal"
            title="Delete Car"
            message="Are you sure you want to delete this car?"
            @close="showDeleteModal = false"
            @confirm="confirmDelete"
        />
    </AdminLayout>
</template>

<script setup>
import {Link, router, usePage, useForm } from '@inertiajs/vue3';
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import ConfirmDialog from "@/Components/ConfirmDialog.vue";
import { createToaster } from "@meforma/vue-toaster";
import {ref} from "vue";


const page = usePage();
const toaster = createToaster();
const form = useForm({});

const cars = page.props.cars; //console.log(cars);

const showDeleteModal = ref(false)
const resourceToDelete = ref(null)

const deleteResource = (id) => {
    resourceToDelete.value = id
    showDeleteModal.value = true
};

const confirmDelete = () => {
    form.delete(`/admin/cars/${resourceToDelete.value}`,{
        onSuccess:()=>{
            if(page.props.flash.status===true){
                toaster.success(page.props.flash.message);
                router.get("/admin/cars")
            }
            else {
                toaster.error(page.props.flash.message);
            }
        }
    })
}
</script>

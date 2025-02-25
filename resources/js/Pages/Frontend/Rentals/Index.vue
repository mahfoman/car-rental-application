<template>
    <FrontendLayout>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <h1 class="text-xl font-bold mb-3">All Your Rentals</h1>

                    <table class="min-w-full bg-white">
            <thead class="bg-black text-white text-xs rounded-2xl">
            <tr>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Rent ID</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Car</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Start Date</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">End Date</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Day/s</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Daily Cost</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Total Rent</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Status</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            <tr v-for="rental in rentals" :key="rental.id">
                <td class="px-5 py-4 sm:px-6">{{ rental.id }}</td>
                <td class="px-5 py-4 sm:px-6">{{ rental.car.name }} ({{ rental.car.brand }})</td>
                <td class="px-5 py-4 sm:px-6">{{ formatDate(rental.start_date) }}</td>
                <td class="px-5 py-4 sm:px-6">{{ formatDate(rental.end_date) }}</td>
                <td class="px-5 py-4 sm:px-6">{{ getDateDiff(rental.start_date, rental.end_date) }}</td>
                <td class="px-5 py-4 sm:px-6">TK{{ rental.car.daily_rent_price }}</td>
                <td class="px-5 py-4 sm:px-6">TK{{ rental.total_cost }}</td>
                <td class="px-5 py-4 sm:px-6">
                    <span
                        v-if="rental.status === 'Ongoing'"
                        class="bg-yellow-100 text-yellow-700 font-semibold px-2 py-1 rounded border border-yellow-300"
                    >Ongoing</span>
                    <span
                        v-else-if="rental.status === 'Completed'"
                        class="bg-green-100 text-green-700 font-semibold px-2 py-1 rounded border border-green-300"
                    >Completed</span>
                    <span
                        v-else
                        class="bg-red-100 text-red-700 font-semibold px-2 py-1 rounded border border-red-300"
                    >Canceled</span>
                </td>
                <td class="py-2 px-4">
                    <button
                        v-if="rental.status !== 'Canceled' && rental.status !== 'Completed'"
                        @click="deleteResource(rental.id)"
                        class="bg-red-600 hover:bg-red-400 p-2 text-white rounded text-sm"
                    >
                        Cancel Booking
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Empty state if no rentals -->
        <div v-if="rentals.length === 0" class="mt-6 text-center">
            <p class="text-gray-500">You don't have any active rentals. <br>To rent a car please click below</p>
            <Link :href="`/cars`" class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">
                Browse Cars
            </Link>
        </div>

        <!-- Confirm Dialog Component -->
        <ConfirmDialog
            :isOpen="showDeleteModal"
            title="Cancel Rental"
            message="Are you sure you want to Cancel this rental?"
            @close="showDeleteModal = false"
            @confirm="confirmDelete"
            ok = "Cancel"
            cancel = "No"
        />


                </div>
            </div>
        </div>

    </FrontendLayout>
</template>

<script setup>
import {Link, router, usePage, useForm } from '@inertiajs/vue3';
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import ConfirmDialog from "@/Components/ConfirmDialog.vue";
import { createToaster } from "@meforma/vue-toaster";
import {ref} from "vue";
import { format } from 'date-fns';
import FrontendLayout from "@/Layouts/FrontendLayout.vue";


const page = usePage();
const toaster = createToaster();
const form = useForm({});

const rentals = page.props.rentals; //console.log(cars);

if (page.props.share_data) {
    toaster.error(page.props.share_data);
}

const showDeleteModal = ref(false)
const resourceToDelete = ref(null)

const deleteResource = (id) => {
    resourceToDelete.value = id
    showDeleteModal.value = true
};

const confirmDelete = () => {
    //console.log(resourceToDelete.value); return false;
    form.delete(`/rentals/${resourceToDelete.value}`,{
        onSuccess:()=>{
            if(page.props.flash.status===true){
                toaster.success(page.props.flash.message);
                router.get("/rentals")
            }
            else {
                toaster.error(page.props.flash.message);
            }
        }
    })
}


const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    const day = date.getDate();
    const suffix = ['th', 'st', 'nd', 'rd'][(day % 10) > 3 || (day % 100 - day % 10) === 10 ? 0 : day % 10];
    return `${day}${suffix} ${format(date, 'MMM, yyyy')}`;
};

// Function to calculate difference in days
const getDateDiff = (startDate, endDate) => {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const diffTime = (end - start) < 1 ? 1 : (end - start) + 1;
    return Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Convert milliseconds to days
};


</script>

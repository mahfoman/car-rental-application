<template>
    <AdminLayout>
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold">Manage Rentals</h1>
            <Link href="/admin/rentals/create" class="bg-gray-600 text-white px-3 py-2 font-semibold text-sm rounded hover:bg-gray-700">
                <i class="fas fa-plus mr-2"></i>Add Rental
            </Link>
        </div>
        <table class="min-w-full bg-white">
            <thead class="bg-black text-white text-xs rounded-2xl">
            <tr>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">ID</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Customer</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Car</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Start Date</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">End Date</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Day/s</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Daily Cost</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Total Cost</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Status</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            <tr v-for="rental in rentals" :key="rental.id">
                <td class="px-5 py-4 sm:px-6">{{ rental.id }}</td>
                <td class="px-5 py-4 sm:px-6">{{ rental.user?.name }}</td>
                <td class="px-5 py-4 sm:px-6">{{ rental.car?.name }}</td>
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
                <td class="p-2">
                    <Link :href="`/admin/rentals/${rental.id}/edit`" class="text-gray-500 mr-4"><i class="fas fa-edit"></i></Link>
<!--                    <button @click="deleteResource(rental.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>-->
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Confirm Dialog Component -->
        <ConfirmDialog
            :isOpen="showDeleteModal"
            title="Delete Rental"
            message="Are you sure you want to delete this Rental?"
            @close="showDeleteModal = false"
            @confirm="confirmDelete"
        />
    </AdminLayout>
</template>

<script setup>
import {Link, router, useForm, usePage} from '@inertiajs/vue3';
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import ConfirmDialog from "@/Components/ConfirmDialog.vue";
import {createToaster} from "@meforma/vue-toaster";
import {ref} from "vue";
import {format} from "date-fns";

const page = usePage();
const toaster = createToaster();
const form = useForm({});

const rentals = page.props.rentals; //console.log(cars);

const showDeleteModal = ref(false)
const resourceToDelete = ref(null)

if (page.props.share_data) {
    toaster.error(page.props.share_data);
}

const deleteResource = (id) => {
    resourceToDelete.value = id
    showDeleteModal.value = true
};

const confirmDelete = () => {
    form.delete(`/admin/rentals/${resourceToDelete.value}`,{
        onSuccess:()=>{
            if(page.props.flash.status){
                toaster.success(page.props.flash.message);
                router.get("/admin/rentals");
            } else {
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

const getDateDiff = (startDate, endDate) => {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const diffTime = (end - start) < 1 ? 1 : (end - start) + 1;
    return Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Convert milliseconds to days
};

</script>

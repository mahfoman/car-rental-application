<template>
    <AdminLayout>
        <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold">Manage Customers</h1>
            <Link href="/admin/customers/create" class="bg-gray-600 text-white px-3 py-2 font-semibold text-sm rounded hover:bg-gray-700">
                <i class="fas fa-plus mr-2"></i>Add Customer
            </Link>
        </div>
        <table class="min-w-full bg-white">
            <thead class="bg-black text-white text-xs rounded-2xl">
            <tr>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">ID</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Name</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Email</th>
                <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
            <tr v-for="customer in customers" :key="customer.id">
                <td class="px-5 py-4 sm:px-6">{{ customer.id }}</td>
                <td class="px-5 py-4 sm:px-6">{{ customer.name }}</td>
                <td class="px-5 py-4 sm:px-6">{{ customer.email }}</td>
                <td class="px-5 py-4 sm:px-6">
                    <Link :href="`/admin/customers/${customer.id}/edit`" class="text-gray-500 mr-4"><i class="fas fa-edit"></i></Link>
                    <button @click="deleteResource(customer.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            </tbody>
        </table>
        <!-- Confirm Dialog Component -->
        <ConfirmDialog
            :isOpen="showDeleteModal"
            title="Delete User"
            message="Are you sure you want to delete this user?"
            @close="showDeleteModal = false"
            @confirm="confirmDelete"
        />
    </AdminLayout>
</template>

<script setup>
import { Link, usePage, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue'
import AdminLayout from "../../../Layouts/AdminLayout.vue";
import { createToaster } from "@meforma/vue-toaster";
import ConfirmDialog from "../../../Components/ConfirmDialog.vue";

const toaster = createToaster();
const form = useForm({});
const page = usePage();

const showDeleteModal = ref(false)
const resourceToDelete = ref(null)

const customers = usePage().props.customers; //console.log(cars);

const deleteResource = (id) => {
    resourceToDelete.value = id
    showDeleteModal.value = true
};

const confirmDelete = () => {
    form.delete(`/admin/customers/${resourceToDelete.value}`,{
        onSuccess:()=>{
            if(page.props.flash.status===true){
                toaster.success(page.props.flash.message);
                router.get("/admin/customers")
            }
            else {
                toaster.error(page.props.flash.message);
            }
        }
    })
}

</script>

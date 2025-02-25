<template>
    <AdminLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">
                {{ isUpdating ? "Edit Rental" : "Add New Rental" }}
            </h1>

            <form @submit.prevent="submit" class="space-y-4">
                <!-- User Selection -->
                <div>
                    <label class="block">Customer</label>
                    <select v-model="form.user_id" class="w-full p-2 border" :class="{ 'border-red-500': errors.user_id }">
                        <option value="">Select a customer</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                    </select>
                    <p v-if="errors.user_id" class="text-red-500 text-sm">{{ errors.user_id }}</p>
                </div>

                <!-- Car Selection -->
                <div>
                    <label class="block">Car</label>
                    <select v-model="form.car_id" class="w-full p-2 border" :class="{ 'border-red-500': errors.car_id }">
                        <option value="">Select a car</option>
                        <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.name }}</option>
                    </select>
                    <p v-if="errors.car_id" class="text-red-500 text-sm">{{ errors.car_id }}</p>
                </div>

                <!-- Start Date -->
                <div>
                    <label class="block">Start Date</label>
                    <DatePicker
                        v-model="form.start_date"
                        :format="dateFormat"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.start_date }"
                        auto-apply
                        :min-date="new Date()"
                        position="left"
                    />
                    <p v-if="errors.start_date" class="text-red-500 text-sm">{{ errors.start_date }}</p>
                </div>

                <!-- End Date -->
                <div>
                    <label class="block">End Date</label>
                    <DatePicker
                        v-model="form.end_date"
                        :format="dateFormat"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.start_date }"
                        auto-apply
                        :min-date="new Date()"
                        position="left"
                    />
                    <p v-if="errors.end_date" class="text-red-500 text-sm">{{ errors.end_date }}</p>
                </div>

                <div>
                    <label class="block">Status</label>
                    <select v-model="form.status" class="w-full p-2 border" :class="{ 'border-red-500': errors.status }">
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>
                        <option value="Canceled">Canceled</option>
                    </select>
                    <p v-if="errors.status" class="text-red-500 text-sm">{{ errors.status }}</p>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded">
                    {{ isUpdating ? "Update Rental" : "Save Rental" }}
                </button>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { useForm, usePage, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { createToaster } from "@meforma/vue-toaster";
import DatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const dateFormat = 'yyyy-MM-dd';

const toaster = createToaster();
const page = usePage();
const isUpdating = page.props.isUpdating;
const rental = page.props.rental || {};
const users = page.props.users || [];
const cars = page.props.cars || [];

// Form State
const form = useForm({
    id: rental.id || "",
    user_id: rental.user_id || "",
    car_id: rental.car_id || "",
    start_date: rental.start_date || "",
    end_date: rental.end_date || "",
    status: rental.status || "",
    _method: isUpdating ? "PUT" : "POST",
});

// Validation Errors
const errors = ref({});

// Validation Logic
const validateForm = () => {
    errors.value = {}; // Reset errors

    if (!form.user_id) {
        errors.value.user_id = "Customer is required.";
    }

    if (!form.car_id) {
        errors.value.car_id = "Car is required.";
    }

    if (!form.start_date) {
        errors.value.start_date = "Start date is required.";
    }

    if (!form.end_date) {
        errors.value.end_date = "End date is required.";
    } else if (form.start_date && form.end_date < form.start_date) {
        errors.value.end_date = "End date must be after start date.";
    }

    if (!form.status) {
        errors.value.status = "Status is required.";
    }

    return Object.keys(errors.value).length === 0;
};

// Submit Handler
const submit = () => {
    if (!validateForm()) return;

    if (isUpdating) {
        updateRental();
    } else {
        createRental();
    }
};

// Create New Rental
const createRental = () => {

    form.start_date = form.start_date ? form.start_date.toISOString().split("T")[0] : "";
    form.end_date = form.end_date ? form.end_date.toISOString().split("T")[0] : "";

    form.post("/admin/rentals", {
        onSuccess: () => {
            if(page.props.flash.status){
                toaster.success(page.props.flash.message);
                router.get("/admin/rentals");
            } else {
                toaster.error(page.props.flash.message);
            }
        },
        onError: (backendErrors) => {
            errors.value = backendErrors;
        },
    });
};

// Update Existing Rental
const updateRental = () => {
    form.post(`/admin/rentals/${rental.id}`, {
        onSuccess: () => {
            toaster.success(page.props.flash.message || "Rental updated successfully.");
            router.get("/admin/rentals");
        },
        onError: (backendErrors) => {
            errors.value = backendErrors;
        },
    });
};
</script>

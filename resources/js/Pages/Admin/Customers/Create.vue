<template>
    <AdminLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">
                {{ isUpdating ? "Edit Customer" : "Add New Customer" }}
            </h1>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="block">Name</label>
                    <input
                        type="text"
                        v-model="form.name"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.name }"
                    />
                    <p v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</p>
                </div>

                <div>
                    <label class="block">Email</label>
                    <input
                        type="email"
                        v-model="form.email"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.email }"
                    />
                    <p v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</p>
                </div>

                <div v-if="!isUpdating">
                    <label class="block">Password</label>
                    <input
                        type="password"
                        v-model="form.password"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.password }"
                    />
                    <p v-if="errors.password" class="text-red-500 text-sm">{{ errors.password }}</p>
                </div>

                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded">
                    {{ isUpdating ? "Update" : "Save" }}
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

const toaster = createToaster();

const page = usePage();
const isUpdating = page.props.isUpdating;
const customer = page.props.customer || {};

// Form State
const form = useForm({
    id: customer.id || "",
    name: customer.name || "",
    email: customer.email || "",
    password: "",
    _method: isUpdating ? "PUT" : "POST",
});

// Validation Errors
const errors = ref({});

// Validation Logic
const validateForm = () => {
    errors.value = {}; // Reset errors

    if (!form.name.trim()) {
        errors.value.name = "Name is required.";
    } else if (form.name.length < 3) {
        errors.value.name = "Name must be at least 3 characters.";
    }

    if (!form.email.trim()) {
        errors.value.email = "Email is required.";
    } else if (!/^\S+@\S+\.\S+$/.test(form.email)) {
        errors.value.email = "Invalid email format.";
    }

    if (!isUpdating && !form.password.trim()) {
        errors.value.password = "Password is required.";
    } else if (!isUpdating && form.password.length < 6) {
        errors.value.password = "Password must be at least 6 characters.";
    }

    return Object.keys(errors.value).length === 0;
};

// Submit Handler
const submit = () => {
    if (!validateForm()) return;

    if (isUpdating) {
        updateCustomer();
    } else {
        createCustomer();
    }
};

// Create New Customer
const createCustomer = () => {
    form.post("/admin/customers", {
        onSuccess: () => {
            if (page.props.flash.status === true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/customers");
            } else {
                toaster.error(page.props.flash.message);
            }
        },
        onError: (backendErrors) => {
            errors.value = backendErrors; // Capture backend validation errors
        },
    });
};

// Update Existing Customer
const updateCustomer = () => {
    form.post(`/admin/customers/${customer.id}`, {
        onSuccess: () => {
            if (page.props.flash.status === true) {
                toaster.success(page.props.flash.message);
                router.get("/admin/customers");
            } else {
                toaster.error(page.props.flash.message);
            }
        },
        onError: (backendErrors) => {
            errors.value = backendErrors; // Capture backend validation errors
        },
    });
};
</script>

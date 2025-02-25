<template>
    <AdminLayout>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">
                {{ isUpdating ? "Edit Car" : "Add New Car" }}
            </h1>

            <form @submit.prevent="submit" class="space-y-4" enctype="multipart/form-data">
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
                    <label class="block">Brand</label>
                    <input
                        type="text"
                        v-model="form.brand"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.brand }"
                    />
                    <p v-if="errors.brand" class="text-red-500 text-sm">{{ errors.brand }}</p>
                </div>

                <div>
                    <label class="block">Model</label>
                    <input
                        type="text"
                        v-model="form.model"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.model }"
                    />
                    <p v-if="errors.model" class="text-red-500 text-sm">{{ errors.model }}</p>
                </div>

                <div>
                    <label class="block">Year</label>
                    <input
                        type="number"
                        v-model="form.year"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.year }"
                    />
                    <p v-if="errors.year" class="text-red-500 text-sm">{{ errors.year }}</p>
                </div>

                <div>
                    <label class="block">Car Type</label>
                    <input
                        type="text"
                        v-model="form.car_type"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.car_type }"
                    />
                    <p v-if="errors.car_type" class="text-red-500 text-sm">{{ errors.car_type }}</p>
                </div>

                <div>
                    <label class="block">Daily Rent Price</label>
                    <input
                        type="number"
                        v-model="form.daily_rent_price"
                        class="w-full p-2 border"
                        :class="{ 'border-red-500': errors.daily_rent_price }"
                    />
                    <p v-if="errors.daily_rent_price" class="text-red-500 text-sm">{{ errors.daily_rent_price }}</p>
                </div>

                <div>
                    <label class="block">Availability</label>
                    <input
                        type="checkbox"
                        v-model="form.availability"
                        class="p-2 border"
                        :true-value="1"
                        :false-value="0"
                    />
                    <p v-if="errors.availability" class="text-red-500 text-sm">{{ errors.availability }}</p>
                </div>

                <div>
                    <label class="block">Image</label>
                    <input
                        type="file"
                        @change="handleImageUpload"
                        class="w-full p-2 border"
                    />
                    <img
                        v-if="imageUrl"
                        :src="imageUrl"
                        alt="Car Image"
                        class="mt-4 w-32 h-32 object-cover"
                    />
                    <p v-if="errors.image" class="text-red-500 text-sm">{{ errors.image }}</p>
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
const car = page.props.car || {};

// Form State
const form = useForm({
    id: car.id || "",
    name: car.name || "",
    brand: car.brand || "",
    model: car.model || "",
    year: car.year || "",
    car_type: car.car_type || "",
    daily_rent_price: car.daily_rent_price || "",
    availability: car.availability !== undefined ? car.availability : true,
    image: car.image || null,
    _method: isUpdating ? "PUT" : "POST",
}); console.log(form.availability);

// Validation Errors
const errors = ref({});

// Image Upload
const imageUrl = ref(car.image ? `/storage/${car.image}` : "/empty.png");

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    //console.log(file)
    if (file) {
        form.image = file;
        imageUrl.value = URL.createObjectURL(file);
        //console.log(form)
    }
};

// Validation Logic
const validateForm = () => {
    errors.value = {}; // Reset errors

    if (!form.name.trim()) {
        errors.value.name = "Name is required.";
    } else if (form.name.length < 3) {
        errors.value.name = "Name must be at least 3 characters.";
    }

    if (!form.brand.trim()) {
        errors.value.brand = "Brand is required.";
    }

    if (!form.model.trim()) {
        errors.value.model = "Model is required.";
    }

    if (!form.year || form.year < 1886 || form.year > new Date().getFullYear()) {
        errors.value.year = "Year is invalid.";
    }

    if (!form.car_type.trim()) {
        errors.value.car_type = "Car type is required.";
    }

    if (!form.daily_rent_price || form.daily_rent_price <= 0) {
        errors.value.daily_rent_price = "Daily rent price must be greater than 0.";
    }

    if (!form.image && !car.image) {
        errors.value.image = "Car image is required.";
    }

    return Object.keys(errors.value).length === 0;
};

// Submit Handler
const submit = () => {
    if (!validateForm()) return;
    //console.log(form);
    //return false;
    const formData = new FormData();
    formData.append("name", form.name);
    formData.append("brand", form.brand);
    formData.append("model", form.model);
    formData.append("year", form.year);
    formData.append("car_type", form.car_type);
    formData.append("daily_rent_price", form.daily_rent_price);
    formData.append("availability", form.availability);

    if (form.image) {
        formData.append("image", form.image);
    }
    //console.log(formData); return false;
    if (isUpdating) {
        updateCar(formData);
    } else {
        createCar(formData);
    }
};

// Create New Car
const createCar = (formData) => {
    form.post("/admin/cars", {
        data: formData,
        onSuccess: () => {
            toaster.success(page.props.flash.message);
            router.get("/admin/cars");
        },
        onError: (backendErrors) => {
            errors.value = backendErrors; // Capture backend validation errors
        },
    });
};

// Update Existing Car
const updateCar = (formData) => {
    //console.log(formData); return false;
    form.post(`/admin/cars/${car.id}`, {
        data: formData,
        onSuccess: () => {
            toaster.success(page.props.flash.message);
            router.get("/admin/cars");
        },
        onError: (backendErrors) => {
            errors.value = backendErrors; // Capture backend validation errors
        },
    });

};
</script>

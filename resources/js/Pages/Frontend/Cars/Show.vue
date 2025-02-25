<template>

  <FrontendLayout>

  <div class="mt-7">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
      <div class="flex flex-col md:flex-row">
        <div class="md:flex-1 px-4">
            <div class="h-64 md:h-80 bg-gray-100 rounded-lg  mb-4 flex items-center justify-center overflow-hidden">
                <img
                    v-if="car.image"
                    :src="`/storage/${car.image}`"
                    alt="{{ car.name }}"
                    class="w-full h-full object-cover rounded"
                />
                <img
                    v-else
                    src="../../../Assets/img/empty-car.jpg"
                    alt="Empty image"
                    class="w-full h-40 object-cover rounded"
                />
              </div>
        </div>
        <div class="md:flex-1 px-4">
          <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
            {{ car.name }}
            </h2>
          <p class="text-gray-500 text-sm">{{ car.brand }} - {{ car.model }} - {{ car.year }}</p>

          <div class="flex items-center space-x-4 my-4">
            <div>
              <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                <span class="text-gray-400 mr-1 mt-1">TK</span>
                <span class="font-bold text-gray-600 text-2xl">{{ car.daily_rent_price }}/day</span>
              </div>
            </div>
          </div>

          <div class="flex py-4 space-x-4">
            <button type="button"
                class="h-12 px-6 py-2 font-semibold rounded-xl bg-gray-600 hover:bg-gray-400 text-white"
                v-if="car.availability"
                @click.prevent="openModal()"
            >
              Book Now
            </button>
            <p v-else class="bg-red-600 px-4 py-2 text-white rounded">Not Available</p>
            <BookingModal v-if="showModal" @close="showModal = false" :car="car" />
          </div>
        </div>
      </div>

    </div>


  </div>


</FrontendLayout>


</template>

<script setup>
import { ref } from 'vue'
import { Link, usePage, router } from '@inertiajs/vue3'
import BookingModal from "@/Components/Rental/BookingModal.vue";
import { createToaster } from "@meforma/vue-toaster";
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const toaster = createToaster();

const page = usePage();
const car = page.props.car;

const showModal = ref(false);

const openModal = () => {
    console.log(page.props.user)
    if(!page.props.user.name){
        toaster.error("You need to be logged in to book a car");
       router.get("/login");
    } else {
        showModal.value = true;
    }

};

</script>

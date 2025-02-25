<template>
    <FrontendLayout>

        <div class="py-3">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="-mx-4">
                    <h1 class="text-2xl font-bold text-gray-600">Contact Us</h1>
                    <p class="mt-4 text-lg text-gray-700">We are here to help! Reach out to us</p>
                </div>
                <div class="-mx-4">

                <!-- Guidelines Section -->
                <div class="">

                <!-- Browse Cars Section -->
                <section class="bg-white mt-5 rounded-lg ">
                    <form @submit.prevent="submit">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700">Your Name</label>
                                <input id="name" v-model="form.name" placeholder="Name" type="text"
                                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-100"/>
                            </div>

                            <div>
                                <label class="block text-gray-700">Your Email</label>
                                <input id="email" v-model="form.email" placeholder="User Email" type="email"
                                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-100"/>
                            </div>

                            <div>
                                <label class="block text-gray-700">Your Say</label>
                                <textarea id="description" v-model="form.description" placeholder="Your Say" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-100"></textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                    class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-500 transition">
                                Send
                            </button>
                        </div>
                    </form>
                </section>

                </div>

                <br>

                </div>
            </div>
        </div>


    </FrontendLayout>
</template>

<script setup>
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import {Link, router, useForm, usePage} from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";


const form = useForm({ email: '', name: '', description: '' });
const toaster = createToaster();
const page = usePage();

function submit() {

    if (form.name.length === 0) {
        toaster.error("Name Required");
    }

    if (form.email.length === 0) {
        toaster.error("Email Required");
    }

    if (form.description.length === 0) {
        toaster.error("Description Required");
    }
    else {
        form.post("/contact", {
            onSuccess: () => {
                if (page.props.flash.status === true) {
                    toaster.success(page.props.flash.message);
                    //form.reset();
                    //router.get("/contact");
                } else {
                    toaster.error(page.props.flash.message);
                }
            }
        });
    }
}


</script>

<style scoped>

</style>

<template>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
            <form @submit.prevent="submit">
                <div class="mb-6">
                    <h4 class="text-xl font-semibold">Sign Up</h4>
                    <hr class="my-2 border-gray-300"/>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Name</label>
                        <input id="name" v-model="form.name" placeholder="Name" type="text"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-100"/>
                    </div>

                    <div>
                        <label class="block text-gray-700">Email Address</label>
                        <input id="email" v-model="form.email" placeholder="User Email" type="email"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-100"/>
                    </div>

                    <div>
                        <label class="block text-gray-700">Password</label>
                        <input id="password" v-model="form.password" placeholder="User Password" type="password"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-100"/>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                            class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-500 transition">
                        Complete
                    </button>
                </div>
                <hr class="my-4 border-gray-300"/>

                <div class="text-center text-gray-700 text-sm mt-2">
                    If you already have an account go to <Link class="text-center font-semibold h6" href="/login">Login</Link>
                </div>
            </form>
        </div>
    </div>
</template>


<script setup>
import {useForm, router, usePage, Link} from '@inertiajs/vue3';
import { createToaster } from "@meforma/vue-toaster";

const form = useForm({ email: '', name: '', mobile: '', password: '' });
const toaster = createToaster();
const page = usePage();

function submit() {

    if (form.name.length === 0) {
        toaster.error("Name Required");
    }

    if (form.email.length === 0) {
        toaster.error("Email Required");
    }

    if (form.password.length === 0) {
        toaster.error("Password Required");
    }
    else {
        form.post("/user-register", {
            onSuccess: () => {
                if (page.props.flash.status === true) {
                    toaster.success(page.props.flash.message);
                    router.get("/login");
                } else {
                    toaster.error(page.props.flash.message);
                }
            }
        });
    }
}
</script>

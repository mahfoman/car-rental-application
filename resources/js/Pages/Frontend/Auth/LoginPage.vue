<template>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
            <form @submit.prevent="submit">
                <div class="mb-6">
                    <h4 class="text-xl font-semibold text-gray-600">Sign In</h4>
                    <hr class="my-2 border-gray-300"/>
                </div>

                <div class="space-y-4">
                    <div>
                        <input id="email" v-model="form.email" placeholder="User Email" type="email"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-100"/>
                    </div>

                    <div>
                        <input id="password" v-model="form.password" placeholder="User Password" type="password"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-gray-100"/>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                            class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-500 transition">
                        Login
                    </button>
                </div>

                <hr class="my-4 border-gray-300"/>

                <div class="text-center text-gray-700 text-sm mt-2">
                    If you don't have an account go to<Link class="text-center ms-3 font-bold" href="/register">Sign Up </Link> <br>
                    Or Go to Home <Link class="text-center ms-3 font-bold" href="/">Home</Link>
<!--                    <span class="ms-1">|</span>-->
<!--                    <Link class="text-center ms-3 h6" href="/send-otp">Forget Password</Link>-->
                </div>
                <div class="text-center text-gray-400 text-sm mt-3">
                    <span>
                        <strong>Admin Login:</strong> mail@laravelcs.com &nbsp;&nbsp;<br> <strong>Password:</strong> 1234
                    </span>
                </div>

            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm, router, usePage, Link } from '@inertiajs/vue3';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster();

const form = useForm({
    email: '',
    password: ''
});

const page = usePage();
//console.log(page.props)
if (page.props.share_data) {
    toaster.error(page.props.share_data);
}

function submit() {
    if (!form.email) {
        toaster.error("Email Required");
    }
    if (!form.password) {
        toaster.error("Password Required");
    } else {
        form.post("/login", {
            onSuccess: () => {
                //console.log(page.props.flash);
                if (page.props.flash.status) {
                    toaster.success(page.props.flash.message);
                } else {
                    //console.log('inside error');
                    toaster.error(page.props.flash.message);
                }
            },
            onError: () => {
                toaster.error("Invalid email or password");
            }
        });
    }
}
</script>

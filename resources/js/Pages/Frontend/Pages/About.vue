<template>
    <FrontendLayout>

        <div class="py-3">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="-mx-4">
                    <h1 class="text-2xl font-bold text-gray-600">About Car Rental Service</h1>
                    <p class="mt-4 text-lg text-gray-700">Explore our cars and book your next rental with ease.</p>
                </div>
                <div class="-mx-4">

                <!-- Guidelines Section -->
                <div class="">

                <!-- Browse Cars Section -->
                <section class="bg-white mt-5 rounded-lg">
                <h2 class="text-2xl font-semibold text-gray-600">1. Browse Cars</h2>
                <p class="mt-4 text-gray-700">Explore our fleet of cars! You can filter the available cars based on:</p>
                <ul class="list-disc pl-5 mt-4 text-gray-600">
                    <li><strong>Car Type:</strong> SUV, Sedan, and more</li>
                    <li><strong>Brand:</strong> Select your favorite brand</li>
                    <li><strong>Price:</strong> Filter based on your budget</li>
                </ul>
                <p class="mt-4">Each car listing includes:</p>
                <ul class="list-disc pl-5 mt-4 text-gray-600">
                    <li>Car Name, Brand, and Model</li>
                    <li>Price per Day</li>
                    <li>Availability Status</li>
                    <li>Car Images to help you make the best choice</li>
                </ul>
                </section>

                <!-- Make a Booking Section -->
                <section class="bg-white mt-5 rounded-lg ">
                <h2 class="text-2xl font-semibold text-gray-600">2. Make a Booking</h2>
                <p class="mt-4 text-gray-700">Ready to book? Here’s how:</p>
                <ul class="list-decimal pl-5 mt-4 text-gray-600">
                    <li>Select a car from our available options</li>
                    <li>Choose your rental start and end dates</li>
                    <li>We’ll ensure the car is available during your selected period</li>
                    <li>Complete your booking to confirm your reservation</li>
                </ul>
                </section>

                <!-- Email Confirmation Section -->
                <section class="bg-white mt-5 rounded-lg ">
                <h2 class="text-2xl font-semibold text-gray-600">3. Email Confirmation</h2>
                <p class="mt-4 text-gray-700">After booking a car, you’ll receive an email confirming your rental details. The admin will also be notified of your rental for processing.</p>
                </section>

                <!-- Manage Your Bookings Section -->
                <section class="bg-white mt-5 rounded-lg ">
                <h2 class="text-2xl font-semibold text-gray-600">4. Manage Your Bookings</h2>
                <p class="mt-4 text-gray-700">Once you're logged in, you can:</p>
                <ul class="list-decimal pl-5 mt-4 text-gray-600">
                    <li>View your current and past bookings</li>
                    <li>Cancel a booking (only if the rental period hasn’t started yet)</li>
                </ul>
                </section>

                <!-- Create an Account Section -->
                <section class="bg-white mt-5 rounded-lg ">
                <h2 class="text-2xl font-semibold text-gray-600">5. Create an Account</h2>
                <p class="mt-4 text-gray-700">To make a booking, simply sign up or log in to your account:</p>
                <ul class="list-decimal pl-5 mt-4 text-gray-600">
                    <li><strong>Sign Up:</strong> Create a new account</li>
                    <li><strong>Log In:</strong> Access your booking history</li>
                    <li><strong>Log Out:</strong> Securely log out when you're done</li>
                </ul>
                <p class="mt-4 text-gray-700">We use secure login methods to protect your personal information.</p>
                </section>

                <!-- User Authentication Section -->
                <section class="bg-white mt-5 rounded-lg ">
                <h2 class="text-2xl font-semibold text-gray-600">6. User Authentication</h2>
                <p class="mt-4 text-gray-700">To book cars, view your booking history, and manage rentals, you'll need to be logged in. This ensures that your information and bookings are secure.</p>
                </section>

                <!-- Customer Support Section -->
                <section class="bg-white mt-5 rounded-lg ">
                <h2 class="text-2xl font-semibold text-gray-600">7. Customer Support</h2>
                <p class="mt-4 text-gray-700">If you need any assistance, we are here to help! Reach out to us for:</p>
                <ul class="list-decimal pl-5 mt-4 text-gray-600">
                    <li>Help with the website</li>
                    <li>Questions about the rental process</li>
                    <li>Assistance with your bookings</li>
                </ul>
                <p class="mt-4 text-gray-700">You can contact us through the <strong><Link :href="`/contact`">Contact</Link></strong> page for support details.</p>
                </section>

                </div>

                <br><br>

                </div>
            </div>
        </div>


    </FrontendLayout>
</template>

<script setup>
import FrontendLayout from "@/Layouts/FrontendLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>

<style scoped>

</style>

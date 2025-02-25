<template>
    <div v-show="isOpen" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
        <transition
            enter-active-class="transition transform ease-out duration-300"
            enter-from-class="opacity-0 -translate-y-10"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition transform ease-in duration-200"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-10"
        >
            <div
                v-show="isOpen"
                class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full"
            >
                <h2 class="text-lg font-semibold text-gray-800 mb-4">{{ title }}</h2>
                <p class="text-gray-600 mb-6">{{ message }}</p>
                <div class="flex justify-end space-x-2">
                    <button
                        @click="close"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
                    >
                        {{ cancel }}
                    </button>
                    <button
                        @click="confirm"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                    >
                        {{ ok }}
                    </button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
    isOpen: Boolean,
    title: {
        type: String,
        default: 'Confirm Delete'
    },
    message: {
        type: String,
        default: 'Are you sure you want to delete this item?'
    },
    ok : {
        type: String,
        default: 'Delete'
    },
    cancel : {
        type: String,
        default: 'Cancel'
    }
})

const emit = defineEmits(['close', 'confirm'])

const close = () => emit('close')
const confirm = () => emit('confirm')
</script>

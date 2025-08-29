<template>
    <div class="container mx-auto p-6">

        <div v-if="provider" class="bg-white border border-gray-300 rounded-lg shadow p-6 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6">
            <img
                :src="provider.logo"
                :alt="provider.name"
                class="w-32 h-32 object-cover rounded-full border border-gray-300"
                loading="eager"
            />

            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ provider.name }}</h1>
                <p class="text-gray-600 mb-2">{{ provider.description }}</p>

                <div class="mt-4">
                    <p class="text-gray-700 text-sm">Some additional details about the provider can go here.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { usePage } from '@inertiajs/vue3';
import { Provider } from '@/types/Provider';
const provider = ref<Provider>()
const providerId = usePage().props.provider_id;

const fetchProvider = async () => {
    const response = await axios.get(`/api/providers/${providerId}`)
    provider.value = response.data
}

onMounted(() => {
    fetchProvider()
})
</script>

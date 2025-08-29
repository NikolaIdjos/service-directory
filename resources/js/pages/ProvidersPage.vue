<template>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Providers</h1>

        <div class="mb-6 flex items-center space-x-3">
            <select
                v-model="categoryId"
                @change="applyFilter"
                class="p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition w-full sm:w-auto"
            >
                <option value="">All Categories</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <ProviderCard
                v-for="provider in providers"
                :key="provider.id"
                :provider="provider"
            />
        </div>

        <div class="mt-6 flex justify-center">
            <Pagination
                v-model:currentPage="page"
                :lastPage="lastPage || 1"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Pagination from '@/components/Pagination.vue';
import ProviderCard from '@/components/ProviderCard.vue';
import { Category } from '@/types/Category';
import { Provider } from '@/types/Provider';

const providers = ref<Provider[]>()
const page = ref(1);
const lastPage = ref(1);
const categories = ref<Category[]>();
const categoryId = ref('');

const fetchCategories = async () => {
    const response = await axios.get('/api/categories');
    categories.value = await response.data;
}

const fetchProviders = async () => {
    const params = {
        page: page.value,
        ...(categoryId.value && { category_id: categoryId.value }),
    };
    const response = await axios.get('/api/providers', { params });
    providers.value = response.data.data;
    lastPage.value = response.data.meta.last_page || 1;
}

const applyFilter = () => {
    fetchProviders()
}

onMounted(async () => {
    await fetchCategories()
    await fetchProviders()
})
</script>

<template>
    <div class="bg-white border border-gray-300 rounded-lg p-6 shadow-sm hover:shadow-md transition-transform transform hover:-translate-y-1">
        <div class="flex flex-col items-center text-center">
            <img
                :src="provider.logo"
                :alt="provider.name"
                class="w-24 h-24 object-cover mb-4 rounded-full border border-gray-300"
                loading="lazy"
            />
            <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ provider.name }}</h2>
            <p class="text-gray-600 text-sm mb-2">{{ provider.description }}</p>
            <span class="text-gray-500 text-xs mb-3 inline-block px-2 py-1 bg-gray-100 rounded-full">
        {{ provider.category.name }}
      </span>
            <a
                @click="goToProvider(provider.id)"
                class="text-blue-500 text-sm hover:underline font-medium cursor-pointer"
            >
                View
            </a>
        </div>
    </div>
</template>

<script setup lang="ts">

defineProps({
    provider: { type: Object, required: true },
})

const goToProvider = (id: number) => {
    window.location.href = `/providers/${id}`;
};
</script>

<script setup>
const props = defineProps({
    user: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <div class="text-center p-6 border-b border-gray-100 dark:border-gray-800">
        <img src="assets/images/client/07.jpg"
             class="size-20 rounded-full shadow dark:shadow-gray-700 mx-auto" alt="">
        <h5 class="mt-3 font-medium text-xl mb-0">{{ user.name }}</h5>
        <p class="text-slate-400 mb-0">{{ user.email }}</p>
    </div>
</template>

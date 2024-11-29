<script setup>
const props = defineProps({
  messages: {
    type: Array,
    required: true
  }
})
</script>

<template>
  <ul class="p-4 list-none mb-0 max-h-[548px] overflow-scroll" data-simplebar>
    <li v-for="message in messages" class="text-end">
      <div class="inline-block">
        <div class="flex mb-3">
          <div class="relative order-2">
            <img src="assets/images/client/07.jpg"
                 class="size-9 min-w-[36px] rounded-full shadow dark:shadow-gray-700"
                 alt="">
            <span
                class="absolute top-0.5 end-0.5 flex items-center justify-center bg-green-600 text-white text-[10px] font-bold rounded-full size-2 after:content-[''] after:absolute after:h-2 after:w-2 after:bg-green-600 after:top-0 after:end-0 after:rounded-full after:animate-ping"></span>
          </div>

          <div class="me-2 max-w-lg">
            <p class="bg-white dark:bg-slate-900 text-slate-400 text-[16px] shadow dark:shadow-gray-700 px-3 py-2 rounded mb-1">
              {{ message.text }}</p>
            <span class="text-slate-400 text-sm"><i
                class="mdi mdi-clock-outline me-1"></i>15 min ago</span>
          </div>
        </div>
      </div>
    </li>
  </ul>
</template>

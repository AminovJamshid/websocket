<script setup>
import {useChatStore} from "../stores/store.js"

const store = useChatStore()

const props = defineProps({
    chats: {
        type: Object,
        required: true
    }
})

const getUserNameFromChat = (chat) => {
    const anotherUsers = chat.users.filter(user => user.id !== store.user.value.id)
    return anotherUsers[0].name;
}

</script>

<template>
    <div class="p-2 max-h-[482px] min-h-[482px]" data-simplebar>
        <a v-for="chat in chats"
           :key="chat.id"
           @click="store.getMessages(chat)"
           class="flex items-center p-2 rounded-md relative bg-gray-50 dark:bg-slate-800">
            <div class="relative">
                <img src="assets/images/client/09.jpg"
                     class="size-11 rounded-full shadow dark:shadow-gray-700" alt="">
                <span
                    class="absolute top-0.5 start-0.5 flex items-center justify-center bg-green-600 text-white text-[10px] font-bold rounded-full size-2 after:content-[''] after:absolute after:h-2 after:w-2 after:bg-green-600 after:top-0 after:end-0 after:rounded-full after:animate-ping"></span>
            </div>
            <div class="overflow-hidden flex-1 ms-2">
                <div class="flex justify-between">
                    <h6 class="font-semibold">{{ getUserNameFromChat(chat) }}</h6>
                    <small class="text-slate-400">10 Min</small>
                </div>
                <div class="text-slate-400 truncate">lastMessage</div>
            </div>
        </a>
    </div>
</template>

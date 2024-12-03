<template>
    <div class="page-wrapper" @keyup.esc="store.hideActiveChat">
        <main class="page-content bg-gray-50 dark:bg-slate-800">
            <div class="container-fluid relative px-3">
                <div class="layout-specing">

                    <div class="grid md:grid-cols-12 grid-cols-1 mt-6 gap-2">
                        <div class="xl:col-span-3 lg:col-span-5 md:col-span-5">
                            <div tabindex="0" class="rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                                <MiniProfile :user="user"/>
                                <ul>
                                    <li v-for="user in store.users"
                                        :key="user.id"
                                        class="pb-2"
                                        @click="store.openNewChat(user)"
                                    >
                                        {{user.name}}
                                    </li>
                                </ul>
                                <hr>
                                <ChatList :chats="store.chats"/>
                            </div>
                        </div>

                        <div class="xl:col-span-9 lg:col-span-7 md:col-span-7">
                            <div class="rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900 h-full">
                                <div v-if="store.activeChat.id">

                                    <ActiveChatHeader/>

                                    <MessageList :messages="store.messages"/>

                                    <Input/>
                                </div>
                                <div v-else class="flex justify-center items-center h-full text-xl">
                                    Select chat to start messaging
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="fixed top-[30%] -end-2 z-50">
    <span class="relative inline-block rotate-90">
        <input type="checkbox" class="checkbox opacity-0 absolute" id="chk"/>
        <label
            class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-700 cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8"
            for="chk">
            <i data-feather="moon" class="size-[18px] text-yellow-500"></i>
            <i data-feather="sun" class="size-[18px] text-yellow-500"></i>
            <span class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[2px] left-[2px] size-7"></span>
        </label>
    </span>
    </div>
</template>

<script setup>

import {onMounted} from "vue";
import {useChatStore} from "../stores/store.js";
import MiniProfile from "./MiniProfile.vue";
import ChatList from "./ChatList.vue";
import MessageList from "./MessageList.vue";
import Input from "./Input.vue";
import ActiveChatHeader from "./ActiveChatHeader.vue";

const store = useChatStore()
const props = defineProps({
    user: {},
    rooms: Array,
})

onMounted(async () => {
    store.user.value = props.user
    await store.getChats(props.user.id)
    await store.getUsers()

    store.chats.map(chat => {
        window.Echo.private(`room.${chat.id}`)
            .listen('GotMessage', (e) => {
                store.getMessages(chat)
            });
    })
})

</script>

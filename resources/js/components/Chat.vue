<template>
    <div class="page-wrapper">
        <main class="page-content bg-gray-50 dark:bg-slate-800">
            <div class="container-fluid relative px-3">
                <div class="layout-specing">

                    <div class="grid md:grid-cols-12 grid-cols-1 mt-6 gap-2">
                        <div class="xl:col-span-3 lg:col-span-5 md:col-span-5">
                            <div class="rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                                <MiniProfile :user="user"/>
                                <ChatList :chats="store.chats"/>
                            </div>
                        </div>

                        <div class="xl:col-span-9 lg:col-span-7 md:col-span-7">
                            <div class="rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                                <div
                                    class="flex justify-between items-center border-b border-gray-100 dark:border-gray-800 p-4">
                                    <div class="flex">
                                        <img src="assets/images/client/01.jpg"
                                             class="size-11 rounded-full shadow dark:shadow-gray-700" alt="">
                                        <div class="overflow-hidden ms-3">
                                            <a href="#" class="block font-semibold text-truncate">Cristino Murfy</a>
                                            <span class="text-slate-400 flex items-center text-sm"><span
                                                class="bg-green-600 text-white text-[10px] font-bold rounded-full size-2 me-1"></span> Online</span>
                                        </div>
                                    </div>

                                    <div class="dropdown relative">
                                        <button data-dropdown-toggle="dropdown" class="dropdown-toggle items-center"
                                                type="button">
                                            <span
                                                class="size-8 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-[20px] text-center bg-green-600/5 hover:bg-green-600 border-green-600/10 hover:border-green-600 text-green-600 hover:text-white rounded-md"><i
                                                class="mdi mdi-dots-vertical"></i></span>
                                        </button>
                                        <!-- Dropdown menu -->
                                        <div
                                            class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-44 rounded-md overflow-hidden bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 hidden"
                                            onclick="event.stopPropagation();">
                                            <ul class="py-2 text-start">
                                                <li>
                                                    <a href="" class="block py-1.5 px-4 hover:text-green-600"><i
                                                        class="mdi mdi-account-outline"></i> Profile</a>
                                                </li>
                                                <li>
                                                    <a href="" class="block py-1.5 px-4 hover:text-green-600"><i
                                                        class="mdi mdi-cog-outline"></i> Profile Settings</a>
                                                </li>
                                                <li>
                                                    <a href="" class="block py-1.5 px-4 hover:text-green-600"><i
                                                        class="mdi mdi-trash-can-outline"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <MessageList :messages="store.messages"/>

                                <div class="p-2 border-t border-gray-100 dark:border-gray-800">
                                    <div class="flex ">
                                        <input v-model="store.textInput"
                                               @keyup.enter="store.sendMessage()"
                                               type="text"
                                               class="form-input w-full py-2 px-3 h-9 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                               placeholder="Enter Message...">

                                        <div class="min-w-[125px] text-end">
                                            <button
                                                @click.prevent="store.sendMessage()"
                                                class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-[16px] text-center bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md">
                                                <i class="mdi mdi-send"></i> send
                                            </button>

                                        </div>
                                    </div>
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

const store = useChatStore()
const props = defineProps({
    user: {},
    rooms: Array,
})

onMounted(async () => {
    store.user.value = props.user
    await store.getChats(props.user.id)

    store.chats.map(chat => {
        window.Echo.private(`room.${chat.id}`)
            .listen('GotMessage', (e) => {
                store.getMessages(chat)
            });
    })
})

</script>

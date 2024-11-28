<template>
    <div class="page-wrapper">
        <main class="page-content bg-gray-50 dark:bg-slate-800">
            <div class="container-fluid relative px-3">
                <div class="layout-specing">

                    <div class="grid md:grid-cols-12 grid-cols-1 mt-6 gap-2">
                        <div class="xl:col-span-3 lg:col-span-5 md:col-span-5">
                            <div class="rounded-md shadow dark:shadow-gray-700 bg-white dark:bg-slate-900">
                                <div class="text-center p-6 border-b border-gray-100 dark:border-gray-800">
                                    <img src="assets/images/client/07.jpg"
                                         class="size-20 rounded-full shadow dark:shadow-gray-700 mx-auto" alt="">
                                    <h5 class="mt-3 font-medium text-xl mb-0">{{ user.name }}</h5>
                                    <p class="text-slate-400 mb-0">{{ user.email }}</p>
                                </div>

                                <div class="p-2 max-h-[482px] min-h-[482px]" data-simplebar>
                                    <a v-for="chat in store.chats"
                                       :key="chat.id"
                                       @click="store.getMessages(chat.id)"
                                       class="flex items-center p-2 rounded-md relative bg-gray-50 dark:bg-slate-800">
                                        <div class="relative">
                                            <img src="assets/images/client/09.jpg"
                                                 class="size-11 rounded-full shadow dark:shadow-gray-700" alt="">
                                            <span
                                                class="absolute top-0.5 start-0.5 flex items-center justify-center bg-green-600 text-white text-[10px] font-bold rounded-full size-2 after:content-[''] after:absolute after:h-2 after:w-2 after:bg-green-600 after:top-0 after:end-0 after:rounded-full after:animate-ping"></span>
                                        </div>
                                        <div class="overflow-hidden flex-1 ms-2">
                                            <div class="flex justify-between">
                                                <h6 class="font-semibold">{{ user.name }}</h6>
                                                <small class="text-slate-400">10 Min</small>
                                            </div>
                                            <div class="text-slate-400 truncate">lastMessage</div>
                                        </div>
                                    </a>
                                </div>
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

                                <ul class="p-4 list-none mb-0 max-h-[548px]" data-simplebar>

                                    <li v-for="message in store.messages" class="text-end">
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
                                                        {{message.text}}</p>
                                                    <span class="text-slate-400 text-sm"><i
                                                        class="mdi mdi-clock-outline me-1"></i>15 min ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                                <div class="p-2 border-t border-gray-100 dark:border-gray-800">
                                    <div class="flex ">
                                        <input type="text"
                                               class="form-input w-full py-2 px-3 h-9 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                                               placeholder="Enter Message...">

                                        <div class="min-w-[125px] text-end">
                                            <a href="#"
                                               class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-[16px] text-center bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md"><i
                                                class="mdi mdi-send"></i></a>
                                            <a href="#"
                                               class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-[16px] text-center bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md"><i
                                                class="mdi mdi-emoticon-happy-outline"></i></a>
                                            <a href="#"
                                               class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-[16px] text-center bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md"><i
                                                class="mdi mdi-paperclip"></i></a>
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
</template>

<script setup>

import axios from "axios";
import {onMounted, reactive, ref} from "vue";
import {useChatStore} from "../stores/store.js";

const store = useChatStore()
const props = defineProps({
    user: {},
    rooms: Array,
})

let users = reactive([])

const getUsers = async () => {
    const response = await axios.get(`http://localhost:9000/users`);
    users = response.data;
}


onMounted(async () => {
    await store.getChats(props.user.id)
})

</script>

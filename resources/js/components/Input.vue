<script setup>

import {useChatStore} from "../stores/store.js";

const store = useChatStore()

const sendMessage = () => {
    store.sendMessage()
        .then(data => {
            // Agar chat yangi bo'lmasa, yangi chatni chats arrayga qo'shmasin
            if (store.activeChat.id !== 'new') {
                return
            }

            const newChat = data.data // get new chat
            const latestChat = store.chats[store.chats.length - 1] // Oxirgi chatni olish   

            // Agar yangi chat oxirgi chatdan farq qilsa, yangi chatni chats arrayga qo'shsin
            if (newChat.id !== latestChat.id) {
                store.chats.push(newChat)
            }

            // Yangi chatni topish
            // Yani yangi chatni idsi bilan topish
            const activeChat = store.chats.filter(chat => {
                return chat.id === newChat.id
            })

            store.activeChat = activeChat[0] // Yangi chatni topish

            store.getMessages(store.activeChat) // Yangi chatni serverdan olish

            // Yangi chatga xabar yuborilganda serverdan yangi xabarlarni olish
            window.Echo.private(`room.${store.activeChat.id}`)
                .listen('GotMessage', (e) => {
                    store.getMessages(store.activeChat)
                });
        })
        .catch(error => console.error(error))
}
</script>

<template>
    <div class="p-2 border-t border-gray-100 dark:border-gray-800">
        <div class="flex ">
            <input v-model="store.textInput"
                   @keyup.enter="sendMessage"
                   type="text"
                   id="textInput"
                   class="form-input w-full py-2 px-3 h-9 bg-transparent dark:bg-slate-900 dark:text-slate-200 rounded outline-none border border-gray-100 dark:border-gray-800 focus:ring-0"
                   placeholder="Enter Message...">

            <div class="min-w-[125px] text-end">
                <button
                    @click.prevent="sendMessage"
                    class="size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-[16px] text-center bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md">
                    <i class="mdi mdi-send"></i> send
                </button>

            </div>
        </div>
    </div>
</template>

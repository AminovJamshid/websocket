<script setup>

import {useChatStore} from "../stores/store.js";

const store = useChatStore()
</script>

<template>
    <div class="p-2 border-t border-gray-100 dark:border-gray-800">
        <div class="flex ">
            <input v-model="store.textInput"
                   @keyup.enter="store.sendMessage()"
                   type="text"
                   id="textInput"
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
</template>

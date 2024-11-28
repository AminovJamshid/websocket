import {defineStore} from "pinia";
import {ref} from "vue";
import axios from "axios";

export const useChatStore = defineStore('chat', () => {
    let chats = ref([])
    let messages = ref([])

    const getChats = async (userId) => {
        const response = await axios.get(`http://localhost:9000/users/${userId}/chats`);
        chats.value = response.data;
    }

    const getMessages = async (chatId) => {
        try {
            const response = await axios.get(`/chats/${chatId}/messages`);
            messages.value = response.data;
        } catch (err) {
            console.log(err.message);
        }
    }

    return {chats, getChats, getMessages, messages}
})

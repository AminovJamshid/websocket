import {defineStore} from "pinia";
import {reactive, ref} from "vue";
import axios from "axios";

export const useChatStore = defineStore('chat', () => {
    const chats = ref([])
    const messages = ref([])
    const textInput = ref('')
    const activeChat = ref({})

    const getChats = async (userId) => {
        const response = await axios.get(`http://localhost:9000/users/${userId}/chats`);
        chats.value = response.data;
    }

    const getMessages = async (chat) => {
        try {
            const response = await axios.get(`/chats/${chat.id}/messages`);
            messages.value = response.data;
            activeChat.value = chat
        } catch (err) {
            console.log(err.message);
        }
    }

    const sendMessage = async () => {
        if (textInput.value.trim() === "") {
            return;
        }

        try {
            const chatId = activeChat.value.id
            const text = textInput.value.trim()
            const data = {text, chatId}

            await axios.post(`/chats/${chatId}/messages`, data)

            textInput.value = ''
        } catch (err) {
            console.log(err.message);
        }
    }
    return {
        chats,
        messages,
        textInput,
        activeChat,
        getChats,
        getMessages,
        sendMessage
    }
})

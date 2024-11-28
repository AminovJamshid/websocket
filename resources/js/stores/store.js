import {defineStore} from "pinia";
import {ref} from "vue";

export const useChatStore = defineStore('chat', () => {
    let chats = ref([])
    let test = 'test message'

    const getChats = async (userId) => {
        const response = await axios.get(`http://localhost:9000/users/${userId}/chats`);
        chats.value = response.data;
    }

    return {chats, getChats, test}
})

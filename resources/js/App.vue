<script>
import axios from 'axios';
import {ref} from 'vue';
import Chat from "./components/Chat.vue";

export default {
    components: {Chat},
    props: {
        user: {},
        rooms: Array,
    },
    data() {
        return {
            messages: ref([]),
            newMessage: "",
            users: ref({}),
            chats: this.rooms,
            activeChat: ref({})
        };
    },
    methods: {
        async postMessage() {
            const text = this.newMessage.trim();
            const chatId = this.chats.value[0].id;
            try {
                await axios.post(`/message`, {
                    chatId: chatId,
                    text: text
                })
                // After posting, retrieve messages to include the new one
                await this.getMessages();
            } catch (err) {
                console.log(err.message);
            }
        },
        async getMessages() {
            try {
                const response = await axios.get('/messages');
                this.messages = response.data;
                // Scroll to the bottom after messages are updated
                this.scrollToBottom();
            } catch (err) {
                console.log(err.message);
            }
        },
        sendMessage() {
            console.log(this.chats.value)
            if (this.newMessage.trim() !== "") {
                this.postMessage();
                this.newMessage = "";
            }
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const messageList = document.getElementById('messagelist');
                if (messageList) {
                    messageList.scrollTop = messageList.scrollHeight;
                }
            });
        },

        async getRooms(userId) {
            const response = await axios.get(`http://localhost:9000/api/users/${userId}/rooms`);
            this.chats.value = response.data;
        },

        async getRoomMessages(id) {
            const response = await axios.get('http://localhost:9000/api/rooms/' + id + '/messages');
            this.messages = response.data;
        },

        async getUsers() {
            const response = await axios.get(`http://localhost:9000/users`);
            this.users.value = response.data;
        },

        startChat() {
            this.chats.value = {
                id: null,
                type: 'private'
            };
        }
    },
    created() {
        this.getRooms(this.user.id)
        this.getUsers()

        this.chats.map(room => {
            window.Echo.private(`room.${room.id}`)
                .listen('GotMessage', (e) => {
                    this.getMessages();
                });
        })
    }
};
</script>

<template>
    <Chat/>
<!--    <div class="container">
        <ul class="users-list">
            <li v-for="user in this.users.value" :key="user.id" class="users">
                <button @click="startChat(user)">{{ user.name }}</button>
            </li>
        </ul>
        <hr>
        <div v-if="!this.chats.length" class="error-message">Sizda chatlar yo'q</div>
        <ul v-else class="rooms-list">
            <li v-for="chat in this.chats"
                class="room">
                <button @click="getRoomMessages(chat.id)">
                    {{ chat.id }} - {{ chat.type }}
                </button>
            </li>
        </ul>
        <hr>
        <div class="chat-box" id="messagelist">
            <div v-for="(message, index) in messages" :key="index" class="message">
                <strong>{{ message.user_id }}:</strong> {{ message.text }}
                <small class="text-muted float-right">{{ message.created_at }}</small>
            </div>
        </div>
        <div class="input-area">
            <input v-model="newMessage" @keyup.enter="sendMessage" type="text"
                   placeholder="Type your message here..."/>
            <button @click="sendMessage">Send</button>
        </div>
    </div>-->
</template>

<style scoped>
.chat-box {
    border: 1px solid #ccc;
    padding: 10px;
    max-height: 300px;
    overflow-y: auto;
}

.message {
    margin-bottom: 10px;
}
</style>

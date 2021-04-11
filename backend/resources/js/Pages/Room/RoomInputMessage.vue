<template>
    <div class="relative h-10 m-1">
        <div class="grid grid-cols-6 border-t-2">
            <input
                type="text"
                v-model="message"
                @keyup.enter="sendHandler"
                placeholder="Say something..."
                class="col-span-5 outline-none p-1"
            />
            <button
                @click="sendHandler"
                class="place-self-end bg-gray-500 hover:bg-blue-700 p-1 mt-1 rounded text-white">
                Send
            </button>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "RoomInputMessage",
    props: ['chatID'],
    data: () => ({
        message: ''
    }),
    methods: {
        ...mapActions([
           'sendMessage'
        ]),
        sendHandler() {
            if( this.message.trim() !== '' ) {
                this.sendMessage({
                    title: this.message,
                    chat_id: this.chatID
                })
                this.message = ''
            }
        }
    }
}
</script>

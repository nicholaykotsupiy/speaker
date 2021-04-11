<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ chat.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <RoomMessagesContainer :messages="messageList" />
                    <RoomInputMessage :chatID="chat.id" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import RoomMessagesContainer from './Room/RoomMessages'
import RoomInputMessage from './Room/RoomInputMessage'
import {mapGetters, mapMutations} from "vuex";

export default {
    components: {
        AppLayout,
        RoomMessagesContainer,
        RoomInputMessage
    },
    props: ['chat', 'messages'],
    methods: {
        ...mapMutations([
            'setMessagesToState'
        ])
    },
    computed: {
        ...mapGetters([
            'messageList'
        ])
    },
    created() {

        this.setMessagesToState(this.messages.data)

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                let payload = {
                    id: e.message.id,
                    title: e.message.title,
                    user: e.user.login
                }
                this.messageList.push(payload)
            });
    },
}
</script>

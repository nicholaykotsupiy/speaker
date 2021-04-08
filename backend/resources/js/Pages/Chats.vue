<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl my-10 mx-auto sm:px-6 lg:px-8">
                <button
                    @click="openChatsModal"
                    class="focus:outline-none bg-blue-400 py-2 px-4 rounded-md"
                >
                    Create chat
                </button>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ChatsList />
                </div>
            </div>
        </div>
        <div>
            <ChatsModal
                name="Create Chat"
                :open="openChatsModalList"
                @close="openChatsModal"
            />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ChatsList from "./Chats/ChatsList"
import ChatsModal from "./Chats/ChatsModal";

export default {
    components: {
        ChatsModal,
        AppLayout,
        ChatsList
    },
    data: () => ({
        openChatsModalList: false,
    }),
    methods: {
        openChatsModal() {
            this.openChatsModalList = !this.openChatsModalList
        }
    }
}
</script>

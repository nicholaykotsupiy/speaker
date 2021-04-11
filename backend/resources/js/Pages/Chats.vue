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
                    <ChatsList @option="setOption" />
                </div>
            </div>
        </div>
        <div>
            <ChatsModal
                v-if="openChatsModalList"
                name="Create Chat"
                :open="openChatsModalList"
                @close="openChatsModal"
            />
            <ChatsEditModal
                v-if="openChatsOption"
                name="Chat Option"
                :open="openChatsOption"
                :optionChat="optionChat"
                @close="openChatsOptionModal"
            />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ChatsList from "./Chats/ChatsList"
import ChatsModal from "./Chats/ChatsModal";
import ChatsEditModal from "./Chats/ChatsEditModal";
import {mapActions, mapGetters} from "vuex";

export default {
    components: {
        ChatsModal,
        ChatsEditModal,
        AppLayout,
        ChatsList
    },
    data: () => ({
        openChatsModalList: false,
        openChatsOption: false,
        optionChat: []
    }),
    methods: {
        ...mapActions([
            'setSubscribersToState'
        ]),
        openChatsModal() {
            this.openChatsModalList = !this.openChatsModalList
        },
        setOption(data) {
            let chatIndex = this.chats.findIndex(item => item.id === data.chatID)
            this.optionChat = this.chats[chatIndex]
            this.openChatsOptionModal()
        },
        openChatsOptionModal() {
            this.openChatsOption = !this.openChatsOption
        }
    },
    computed: {
      ...mapGetters([
          'chats'
      ])
    },
    mounted() {
        this.setSubscribersToState()
    }
}
</script>

<template>
    <ul>
        <ChatsListItem
            v-for="chat in chats"
            :key="chat.id"
            :chat="chat"
            @option="chatHandler"
        />
    </ul>
</template>

<script>
import ChatsListItem from "./ChatsListItem"
import {mapGetters, mapMutations} from "vuex";
export default {
    name: "ChatsLIst",
    components: {
        ChatsListItem,
    },
    methods: {
        ...mapMutations([
            'setAllChatsToState'
        ]),
        chatHandler(data) {
            this.$emit('option', {chatID: data.chatID})
        }
    },
    computed: {
        ...mapGetters([
            'chats'
        ])
    },
    mounted() {
        this.setAllChatsToState()
    }
}
</script>

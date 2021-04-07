<template>
    <ul>
        <ChatsListItem
            v-for="chat in chats"
            :key="chat.id"
            :chat="chat"
        />
    </ul>
</template>

<script>
import ChatsListItem from "./ChatsListItem"
export default {
    name: "ChatsLIst",
    components: {
        ChatsListItem,
    },
    data: () => ({
      chats: []
    }),
    mounted() {
        axios.get('/chatItems').then(response => {
            // console.log(response.data)
            this.chats = response.data

        })
    }
}
</script>

<style scoped>

</style>

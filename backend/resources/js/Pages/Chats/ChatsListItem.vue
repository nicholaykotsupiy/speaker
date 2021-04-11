<template>
    <li class="py-4 px-2 border-b-2 cursor-pointer hover:bg-gray-100">
        <inertia-link :href="route('room')" method="post" :data="{ chat }" class="w-full flex justify-between items-center" @click="openRoom">
            <span>{{ chat.name }}</span>
            <div>
                <button @click.stop.prevent="exitHandle" class="py-1 px-4 bg-yellow-400 rounded-md m-1">Exit</button>
                <button v-if="chat.admin" @click.stop.prevent="optionHandle" class="py-1 px-4 bg-gray-400 rounded-md m-1">Option</button>
                <button v-if="chat.admin" @click.stop.prevent="deleteHandle" class="py-1 px-4 bg-red-400 rounded-md m-1">Delete</button>
            </div>
        </inertia-link>
    </li>
</template>

<script>
import {mapMutations} from "vuex";

export default {
    name: "ChatsListItem",
    props: {
        chat: {
            type: Object,
            required: true
        }
    },
    methods: {
        ...mapMutations([
            'exitUserFromChat',
            'deleteChat'
        ]),
        openRoom() {
            axios.post('/room', this.chat.id)
        },
        optionHandle() {
            this.$emit('option', {chatID: this.chat.id})
        },
        exitHandle() {
            if(confirm('Exit from chat?')) {
                this.exitUserFromChat(this.chat.id)
            }
        },
        deleteHandle() {
            if(confirm('Delete this chat?')) {
                this.deleteChat(this.chat.id)
            }
        },
    }
}
</script>


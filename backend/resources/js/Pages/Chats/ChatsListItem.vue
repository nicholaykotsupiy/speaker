<template>
    <li class="py-4 px-2 border-b-2 cursor-pointer hover:bg-gray-100">
        <inertia-link :href="route('room')" method="post" :data="{ chat }" class="w-full" @click="openRoom">
            <span>{{ chat.name }}</span>
        </inertia-link>
    </li>
</template>

<script>
export default {
    name: "ChatsListItem",
    props: {
        chat: {
            type: Object,
            required: true
        }
    },
    methods: {
        openRoom() {
            axios.post('/room', this.chat.id)
        }
    }
}
</script>


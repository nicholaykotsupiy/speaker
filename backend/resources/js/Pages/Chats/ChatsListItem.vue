<template>
    <li class="py-4 px-2 border-b-2 cursor-pointer hover:bg-gray-100">
        <nav-link :href="route('dashboard')" class="w-full" :active="route().current('dashboard')">
            <span>{{ chat.name }}</span>
        </nav-link>
    </li>
</template>

<script>
import NavLink from '@/Jetstream/NavLink'
export default {
    name: "ChatsListItem",
    components: {
        NavLink,
    },
    props: {
        chat: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>

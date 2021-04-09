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
                    <RoomMessagesContainer />
                    <RoomInputMessage />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import RoomMessagesContainer from './Room/RoomMessages'
import RoomInputMessage from './Room/RoomInputMessage'

export default {
    components: {
        AppLayout,
        RoomMessagesContainer,
        RoomInputMessage
    },
    props: ['chat'],
    mounted() {
        console.log(this.chat.name)
    }
}
</script>

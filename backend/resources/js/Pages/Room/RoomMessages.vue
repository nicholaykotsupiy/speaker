<template>
    <div class="h-96 w-full">
        <div class="h-full p-2 flex flex-col overflow-scroll">
            <ul v-for="message in messages" :key="message.id">
                <RoomMessagesItem :message="message" />
            </ul>
        </div>
    </div>
</template>

<script>
import RoomMessagesItem from "./RoomMessagesItem";
export default {
    name: "RoomMessages",
    components: {RoomMessagesItem},
    data: () => ({
        messages: [
            {
                id: 1,
                user: 'Jon',
                title: 'Hello all'
            },
            {
                id: 2,
                user: 'Alan',
                title: 'Hello all2'
            },
            {
                id: 3,
                user: 'Rin',
                title: 'Hello all3'
            }
        ]
    })
}
</script>


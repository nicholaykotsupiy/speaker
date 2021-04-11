<template>
    <div class="h-96 w-full">
        <div class="h-full p-2 flex flex-col overflow-y-scroll">
            <ul v-for="message in messages" :key="message.id">
                <RoomMessagesItem :message="message" class="p-1"/>
            </ul>
        </div>
    </div>
</template>

<script>
import RoomMessagesItem from "./RoomMessagesItem";
export default {
    name: "RoomMessages",
    components: {RoomMessagesItem},
    props: ['messages'],
}
</script>


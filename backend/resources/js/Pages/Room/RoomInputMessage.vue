<template>
    <div class="relative h-10 m-1">
        <div class="grid grid-cols-6 border-t-2">
            <input
                type="text"
                v-model="message"
                @keyup.enter="sendMessage"
                placeholder="Say something..."
                class="col-span-5 outline-none p-1"
            />
            <button
                @click="sendMessage"
                class="place-self-end bg-gray-500 hover:bg-blue-700 p-1 mt-1 rounded text-white">
                Send
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "RoomInputMessage",
    data: () => ({
        message: ''
    }),
    methods: {
        sendMessage() {
            console.log('Send message')
        }
    }
}
</script>

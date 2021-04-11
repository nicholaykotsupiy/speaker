<template>
    <li class="w-80">
        <div class="userName p-1 text-gray-800 font-bold">{{ message.user }}:</div>
        <div class="pl-2">{{ message.title }}</div>
    </li>
</template>

<script>
export default {
    name: "RoomMessagesItem",
    props: ['message'],
    created() {
        if(this.message.title >= 50) {
            this.message.title.slice(0, 50)
        }
    }
}
</script>

<style scoped>
    .userName:first-letter {
        text-transform:capitalize;
    }
</style>

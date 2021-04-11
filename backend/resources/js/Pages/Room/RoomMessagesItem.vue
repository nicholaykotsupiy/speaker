<template>
    <li>
        {{ message.user }}: {{ message.title }}
    </li>
</template>

<script>
export default {
    name: "RoomMessagesItem",
    props: ['message']
}
</script>

<style scoped>

</style>

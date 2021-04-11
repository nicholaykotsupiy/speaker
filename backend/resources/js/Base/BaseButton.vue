<template>
    <button
        @click="clickHandler"
        class="bg-blue-500 py-1 px-3 cursor-pointer rounded-md focus:outline-none"
        :class="{'gray': isSubscribed}"
    >
        {{ isSubscribed ? 'Unsubscribe' : 'Subscribe' }}
    </button>
</template>

<script>
export default {
    name: "BaseButton",
    props: ['isSubscribed'],
    emits: ['subscribe'],
    methods: {
        clickHandler() {
            this.$emit('subscribe')
        }
    }
}
</script>

<style scoped>
.gray {
    background: #9E9E9E;
}
</style>


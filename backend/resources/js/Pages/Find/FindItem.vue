<template>
    <div class="List">
        <div v-if="Object.keys(user).length">
            <div class="flex justify-between py-4 px-2 border-b-2 hover:bg-gray-100">
                <div>{{ user[0].name }}</div>
                <BaseButton
                    @subscribe="subscribe"
                    :isSubscribed="isSubscribed"
                />
            </div>
        </div>
        <div v-else class="text-center">
            Nothing find
        </div>
    </div>
</template>

<script>
import BaseButton from "@/Base/BaseButton";

export default {
    name: "FindItem",
    components: {BaseButton},
    props: {
        user: {
            type: Array,
            required: true
        },
        isSubscribed: {
            type: Boolean,
            required: true
        }
    },
    methods: {
        subscribe() {
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

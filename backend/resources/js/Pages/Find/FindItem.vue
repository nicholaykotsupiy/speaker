<template>
    <div class="List">
        <div v-if="Object.keys(user).length">
            <div class="flex justify-between py-4 px-2 border-b-2 hover:bg-gray-100">
                <div>{{ user[0].name }}</div>
                <button
                    @click="subscribe"
                    class="bg-blue-500 py-1 px-3 cursor-pointer rounded-md focus:outline-none"
                    :class="{'gray': isSubscribed}"
                >
                    {{ isSubscribed ? 'Unsubscribe' : 'Subscribe' }}
                </button>
            </div>
        </div>
        <div v-else class="text-center">
            Nothing find
        </div>
    </div>
</template>

<script>
import Button from "../../Jetstream/Button";
export default {
    name: "FindItem",
    components: {Button},
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

<template>
    <div class="flex justify-center">
        <input
            type="search"
            name="search"
            placeholder="Search..."
            class="p-1 px-2 text-base rounded-md focus:outline-none"
            v-model="userName"
        >
        <button
            class="px-4 py-2 mx-2 bg-blue-500 rounded-md focus:outline-none"
            @click="clickHandler"
            :disabled="disable"
        >
            Search
        </button>
    </div>
</template>

<script>
export default {
    name: "FindForm",
    data: () => ({
        userName: '',
        disable: true,
    }),
    methods: {
        clickHandler() {
            this.$emit('find', {userLogin: this.userName})
        },
    },
    watch: {
        userName() {
            this.disable = this.userName.trim() === ''
        }
    }
}
</script>

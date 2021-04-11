<template>
    <button @click="clickHandler" class="cursor-pointer mx-6 text-gray-500 border-b-2 border-gray-200 transition duration-500 ease-in-out hover:border-indigo-700 hover:text-gray-800 focus:outline-none">
        {{ title }} <span class="text-black">{{ count }}</span>
    </button>


</template>

<script>
export default {
    name: "AccountButton",
    props: ['title', 'count'],
    emits: ['open'],
    methods: {
        clickHandler() {
            this.$emit('open')
        }
    }
}
</script>

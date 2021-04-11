<template>
    <div>
        <img
            @click="clickHandler"
            class="rounded-full w-32 h-32 border shadow-lg cursor-pointer"
            :src="imagePath"
            alt="profile photo"
        />
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "AccountImg",
    methods: {
        clickHandler() {
            this.$emit('image')
        }
    },
    computed: {
        ...mapGetters([
            'imagePath'
        ])
    }
}
</script>

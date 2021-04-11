<template>
    <li class="flex justify-between items-center py-4 px-2 border-b-2 hover:bg-gray-100">
        <div>{{ subs.name }}</div>
        <BaseButton
            @subscribe="subscribe(subs)"
            :isSubscribed="subs.subscribed"
        />
    </li>
</template>

<script>
import {mapActions} from "vuex";
import BaseButton from "@/Base/BaseButton";

export default {
    name: "AccountModalListItem",
    props: ['subs'],
    components: { BaseButton },
    methods: {
        ...mapActions([
            'subscribe'
        ]),
    }
}
</script>

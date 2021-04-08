<template>
    <ul>
        <AccountModalListItem
            v-for="subs in subsList"
            :key="subs.id"
            :subs="subs"
        />
    </ul>
</template>

<script>
import AccountModalListItem from "./AccountModalListItem";

export default {
    name: "AccountModalList",
    components: {AccountModalListItem},
    props: ['subsList'],
}
</script>

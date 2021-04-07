<template>
    <dialog-modal :show="open" @close="closeHandler">
        <template #title>
            <div class="flex justify-between items-center">
                <div>
                    {{ name }}
                </div>
                <secondary-button @click="closeHandler">
                    Cancel
                </secondary-button>
            </div>
        </template>

        <template #content>
            <div class="mt-4">
                <ul>
                    <li v-for="subs in subsList" :key="subs.id" class="flex justify-between items-center py-4 px-2 border-b-2 hover:bg-gray-100">
                        <div>{{ subs.name }}</div>
                        <BaseButton
                            @subscribe="subscribe(subs)"
                            :isSubscribed="subs.subscribed"
                        />
                    </li>
                </ul>
            </div>
        </template>
    </dialog-modal>
</template>

<script>
import DialogModal from '@/Jetstream/DialogModal'
import SecondaryButton from '../../Jetstream/SecondaryButton'
import BaseButton from "@/Base/BaseButton";
import {mapActions} from "vuex";

export default {
    name: "AccountModal",
    components: {
        BaseButton,
        DialogModal,
        SecondaryButton
    },
    props: ['name','open', 'subsList'],
    emits: ['count'],
    methods: {
        closeHandler() {
            this.$emit('close')
        },
        ...mapActions([
            'subscribe'
        ]),
    }
}
</script>

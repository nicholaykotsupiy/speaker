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
                <AccountModalList :subsList="subsList" />
            </div>
        </template>
    </dialog-modal>
</template>

<script>
import DialogModal from '@/Jetstream/DialogModal'
import SecondaryButton from '../../Jetstream/SecondaryButton'
import AccountModalList from "./AccountModalList";

export default {
    name: "AccountModal",
    components: {
        AccountModalList,
        DialogModal,
        SecondaryButton
    },
    props: ['name','open', 'subsList'],
    emits: ['count'],
    methods: {
        closeHandler() {
            this.$emit('close')
        },

    }
}
</script>

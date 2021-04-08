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
                <form class="flex flex-col">
                    <label>
                        Name:
                        <input type="text" name="chat_name">
                    </label>
                    <label>
                         User list:
                        <select name="user_list">
                            <option value="">Jhon Doe</option>
                            <option value="">Jhon Doe</option>
                            <option value="">Jhon Doe</option>
                            <option value="">Jhon Doe</option>
                            <option value="">Jhon Doe</option>
                            <option value="">Jhon Doe</option>
                        </select>
                    </label>
                </form>
            </div>
        </template>
    </dialog-modal>
</template>

<script>
import DialogModal from '@/Jetstream/DialogModal'
import SecondaryButton from '../../Jetstream/SecondaryButton'

export default {
    name: "ChatsModal",
    components: {
        DialogModal,
        SecondaryButton
    },
    props: ['name','open'],
    methods: {
        closeHandler() {
            this.$emit('close')
        },

    }
}
</script>

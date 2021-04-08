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
                <form @submit.prevent="sendForm">
                    <input ref="input" type="file" @change="selectFile"/>
                    <input
                        class="block mx-auto py-2 px-4 bg-blue-400 rounded-md cursor-pointer focus:outline-none"
                        type="submit"
                        value="Update"
                    />
                </form>
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
    name: "AccountImageModal",
    components: {
        BaseButton,
        DialogModal,
        SecondaryButton
    },
    props: ['name','open'],
    emits: ['close'],
    data: () => ({
        image: null
    }),
    methods: {
        ...mapActions([
            'upploadImage'
        ]),
        closeHandler() {
            this.$emit('close')
        },
        selectFile(event) {
            this.image = event.target.files[0]
        },
        sendForm() {
            this.upploadImage(this.image)
            this.$refs.input.value = null
            this.closeHandler()
        }
    }
}
</script>

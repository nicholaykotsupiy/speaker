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
                <form class="flex flex-col" @submit.prevent="clickHandle">
                    <label class="my-2 flex items-center justify-center">
                        <input v-model="input" type="text" name="chat_name" placeholder="Name..." class="w-80 border-0 border-b-2 py-1 px-2 focus:ring-0" maxlength="30">
                        {{ input.length }}/30
                    </label>
                    <select v-model="usersID" multiple name="user_list" class="border-none h-40 focus:ring-0">
                        <option disabled>User list:</option>
                        <option
                            v-for="subscriber in subscribers.data"
                            :key="subscriber.id"
                            :value="subscriber.id"
                        >
                            {{ subscriber.name }}
                        </option>
                    </select>
                    <input type="submit" value="Create chat" class="block px-4 py-2 bg-blue-400 mx-auto rounded-md mt-4">
                </form>
            </div>
        </template>
    </dialog-modal>
</template>

<script>
import DialogModal from '@/Jetstream/DialogModal'
import SecondaryButton from '../../Jetstream/SecondaryButton'
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "ChatsModal",
    components: {
        DialogModal,
        SecondaryButton
    },
    props: ['name','open', 'optionChat'],
    data: () => ({
        input: '',
        usersID: []
    }),
    methods: {
        ...mapActions([
            'editChat'
        ]),
        closeHandler() {
            this.$emit('close')
        },
        clickHandle() {
            this.editChat({
                id: this.optionChat.id,
                admin: this.optionChat.admin,
                input: this.input,
                usersID: this.usersID,
            })
            this.input = ''
            this.usersID = []
            this.closeHandler()
        }
    },
    computed: {
        ...mapGetters([
            'subscribers'
        ]),
    },
    mounted() {
        if(this.optionChat) {
            this.input = this.optionChat.name || ''
            this.usersID = this.optionChat.users || []
        }
    }
}
</script>

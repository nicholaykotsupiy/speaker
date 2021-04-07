<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-between items-center p-6">
                        <div>
                            <AccountImg />
                        </div>
                        <div>
                            <AccountButton
                                @open="openSubscribeModal"
                                title="Subscribe"
                                :count="subscribe.subscribe_count"
                            />
                            <AccountButton
                                @open="openSubscribersModal"
                                title="Subscribers"
                                :count="subscribers.subscribers_count"
                            />
                        </div>
                    </div>
                    <AccountModal
                        name="Subscribe"
                        :subsList="subscribe.data"
                        :open="openSubscribeModalList"
                        @close="openSubscribeModal"
                    />
                    <AccountModal
                        name="Subscribers"
                        :subsList="subscribers.data"
                        :open="openSubscribersModalList"
                        @close="openSubscribersModal"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import AccountImg from "./Account/AccountImg"
import AccountButton from "./Account/AccountButton"
import AccountModal from "./Account/AccountModal"
import { mapGetters, mapActions } from 'vuex'

export default {
    name: 'Account',
    components: {
        AccountModal,
        AccountImg,
        AccountButton,
        AppLayout,
    },
    data: () => ({
        openSubscribeModalList: false,
        openSubscribersModalList: false
    }),
    methods: {
        ...mapActions([
            'setSubscribeToState',
            'setSubscribersToState'
        ]),
        openSubscribeModal() {
            this.openSubscribeModalList = !this.openSubscribeModalList;
        },
        openSubscribersModal() {
            this.openSubscribersModalList = !this.openSubscribersModalList;
        },
    },
    computed: {
        ...mapGetters([
            'subscribe',
            'subscribers'
        ])
    },
    mounted() {
        this.setSubscribeToState()
        this.setSubscribersToState()
    }
}
</script>

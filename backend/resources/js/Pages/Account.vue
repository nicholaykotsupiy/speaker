<template>
    <app-layout>
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between items-center p-6">
                    <div class="">
                        <AccountImg @image="openImageModal" />
                        <div>
                            <div class="my-2">Name: {{ user.name }}</div>
                            <div>Login: {{ user.login }}</div>
                        </div>
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
                <AccountImageModal
                    name="Image"
                    :open="openImage"
                    @close="openImageModal"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import AccountImg from "./Account/AccountImg"
import AccountButton from "./Account/AccountButton"
import AccountModal from "./Account/AccountModal"
import { mapGetters, mapActions, mapMutations } from 'vuex'
import AccountImageModal from "./Account/AccountImageModal";

export default {
    name: 'Account',
    components: {
        AccountImageModal,
        AccountModal,
        AccountImg,
        AccountButton,
        AppLayout,
    },
    data: () => ({
        openImage: false,
        openSubscribeModalList: false,
        openSubscribersModalList: false
    }),
    methods: {
        ...mapActions([
            'setSubscribeToState',
            'setSubscribersToState'
        ]),
        ...mapMutations([
            'setUserImage',
            'setUserInfo'
        ]),
        openSubscribeModal() {
            this.openSubscribeModalList = !this.openSubscribeModalList;
        },
        openSubscribersModal() {
            this.openSubscribersModalList = !this.openSubscribersModalList;
        },
        openImageModal() {
            this.openImage = !this.openImage;
        }
    },
    computed: {
        ...mapGetters([
            'subscribe',
            'subscribers',
            'user'
        ])
    },
    mounted() {
        this.setSubscribeToState()
        this.setSubscribersToState()
        this.setUserImage()
        this.setUserInfo()
    }
}
</script>

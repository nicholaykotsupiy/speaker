<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-between items-center p-6">
                        <div>
                            <AccountImg @image="openImageModal" />
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
            'setUserImage'
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
        ])
    },
    mounted() {
        this.setSubscribeToState()
        this.setSubscribersToState()
        this.setUserImage()
    }
}
</script>

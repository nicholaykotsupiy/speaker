<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white py-6 overflow-hidden  shadow-xl sm:rounded-lg">
                    <FindForm @find="getUser"/>
                    <FindItem :user="user" :isSubscribed="isSubscribed" @subscribe="subscribedUser"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import FindForm from './Find/FindForm'
import FindItem from './Find/FindItem'


export default {
    components: {
        AppLayout,
        FindForm,
        FindItem
    },
    data: () => ({
        user: [],
        isSubscribed: false
    }),
    methods: {
        getUser(data) {
            axios.get('/users/' + data.userLogin.toLowerCase())
                .then(response => {
                    this.user = response.data.user || []
                    this.isSubscribed = response.data.subscribed || false
                })
        },
        subscribedUser() {
            if(this.isSubscribed) {
                axios.delete('/users/' + this.user[0].id)
                    .then(response => this.isSubscribed = false)
            }else {
                axios.post('/users/?_method=put', { user_id: this.user[0].id })
                    .then(response => this.isSubscribed = true)
            }
        }
    }
}
</script>

<template>
    <app-layout>
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white py-6 overflow-hidden  shadow-xl sm:rounded-lg">
                <FindForm @find="getUser"/>
                <FindItem :user="user" @subscribe="subscribedUser"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import FindForm from './Find/FindForm'
import FindItem from './Find/FindItem'
import { mapActions } from 'vuex'

export default {
    components: {
        AppLayout,
        FindForm,
        FindItem
    },
    data: () => ({
        user: {},
    }),
    methods: {
        ...mapActions([
            'subscribe'
        ]),
        getUser(data) {
            if(!data.userLogin.includes(' ')) {
                axios.get('/users/' + data.userLogin.toLowerCase())
                    .then(response => this.user = response.data || {})
                    .catch( e => console.error('Error:', e) )
            } else {
                alert('Not login')
            }
        },
        subscribedUser() {
            this.subscribe(this.user)
        }
    }
}
</script>

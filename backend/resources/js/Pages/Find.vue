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
            // const csrfToken = document.querySelector('meta[name="csrf-token"]').content
            // console.log(csrfToken)
            /* Headers for axios request
            * {
                'Content-type': 'application/json',
                'Authorization': `Bearer ${csrfToken}`,
                'Access-Control-Allow-Origin': '*'
               }
            * */
            axios.get('/users/' + data.userLogin)
                .then(response => {

                    this.user = response.data.user
                    this.isSubscribed = !!(response.data.subscribed)
                    console.log(response.data)
                })
        },
        subscribedUser() {
            if(this.isSubscribed) {
                axios.delete('/users/' + this.user[0].id)
                    .then(response => console.log(response))
            }else {
                axios.post('/users/?_method=put', { user_id: this.user[0].id })
                    .then(response => console.log(response))
            }

            // this.isSubscribed = !this.isSubscribed
        }
        // subscribedUser() {
        //     let postData = {
        //         user_id: this.user[0].id
        //     }
        //
        //     let headers = {
        //         'Content-Type': 'application/json',
        //         "Access-Control-Allow-Origin": "*",
        //     }
        //
        //     if(this.isSubscribed){
        //         console.log('delete')
        //         // axios.delete()
        //     }else {
        //         console.log('create')
        //         axios.post('/users', postData, {"headers": headers})
        //             .then(this.isSubscribed = true)
        //     }
        //     this.isSubscribed = !this.isSubscribed
        // }
    }
}
</script>

import { createStore } from 'vuex'
import axios from "axios";

export default createStore({
    state: {
        user: {},
        subscribe: [],
        subscribers: [],
        chats: [],
        messages: []
    },
    mutations: {
        setSubscribeToState( state ) {
            axios.get('/subscribe')
                .then(response => state.subscribe = response.data)
        },
        setSubscribersToState( state ) {
            axios.get('/subscribers')
                .then(response => state.subscribers = response.data)
        },
        deleteSubscriber( state, subs ) {
            axios.delete('/users/' + subs.id)
                .then(response => {
                    subs.subscribed = false
                    let currentIndex = state.subscribe.data.findIndex(item => item.id === subs.id)
                    state.subscribe.data.splice(currentIndex, 1)
                    state.subscribe.subscribe_count -= 1

                })
        },
        addSubscriber( state, subs ) {
            axios.post('/users/?_method=put', { user_id: subs.id })
                .then(response => {
                    subs.subscribed = true
                    state.subscribe.data.push(subs)
                    state.subscribe.subscribe_count += 1
                })
        },
        setUserImage(state) {
            axios.get('/image')
                .then(response => state.user = response.data)
        },
        sendImageForm(state, form) {
            axios.post('/image/upload/?_method=put', form)
                .then(response => state.user = response.data)
        },
        setAllChatsToState(state) {
            axios.get('/chatItems')
                .then(response => state.chats = response.data)
        },

        setChatToState(state, form) {
            axios.post('/chats/?_method=put', form)
                .then( response => state.chats.push(response.data))
                .catch( e => console.error(e) )
        },

        setMessagesToState(state, messages) {
            state.messages = messages
        },

        addMessage(state, message) {
            axios.post('/message/?_method=put', message)
                .then( response => state.messages.push(response.data))
                .catch( e => console.error(e) )
        },

        exitUserFromChat(state, chatID) {
            axios.delete('/exit/' + chatID)
                .then( () => {
                    let index = state.chats.findIndex(element => element.id === chatID)
                    state.chats.splice(index, 1)
                })
                .catch(e => console.log(e))
        },

        deleteChat(state, chatID) {
            axios.delete('/chats/' + chatID)
                .then( response => {
                    let index = state.chats.findIndex(element => element.id === chatID)
                    state.chats.splice(index, 1)
                })
                .catch(e => console.log(e))
        },

        setUserInfo(state) {
            axios.get('/user_info')
                .then(response => {
                    state.user.name = response.data.name
                    state.user.login = response.data.login
                })
                .catch( e => console.log(e) )
        }
    },
    actions: {
        setSubscribeToState({ commit }) {
            commit('setSubscribeToState')
        },
        setSubscribersToState({ commit }) {
            commit('setSubscribersToState')
        },

        subscribe( { commit }, subs ) {
            if(subs.subscribed) {
                commit('deleteSubscriber', subs)
            } else {
                commit('addSubscriber', subs)
            }
        },

        uploadImage( { commit }, image ) {
            let form = new FormData()
            form.append('image', image)

            commit('sendImageForm', form)
        },

        createChat({ commit }, payload) {
            let form = new FormData()
            form.append('name', payload.input)
            form.append('usersID', payload.usersID)

            commit('setChatToState', form)
        },

        editChat({ getters }, payload) {
            let form = new FormData()
            form.append('id', payload.id)
            form.append('admin', payload.admin)
            form.append('name', payload.input)
            form.append('usersID', payload.usersID)

            axios.post('/chat/edit/?_method=put', form)
                .then(response => {
                    console.log(response.data)
                    let chatItem = getters.chats.findIndex(item => item.id === response.data.id)
                    getters.chats.splice(chatItem, 1, response.data)
                })
                .catch(e => console.log(e))
        },

        sendMessage({ commit }, message) {
            commit('addMessage', message)
        },
    },
    getters: {
        subscribe(state) {
            return state.subscribe
        },
        subscribers(state) {
            return state.subscribers
        },
        imagePath(state) {
            if(state.user.path){
                return `storage/${state.user.path}`
            }else {
                return `https://www.searchpng.com/wp-content/uploads/2019/02/Profile-PNG-Icon.png`
            }
        },
        chats(state) {
            return state.chats
        },
        messageList(state) {
            return state.messages
        },
        user(state) {
            return state.user
        }
    }
})

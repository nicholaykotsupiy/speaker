import { createStore } from 'vuex'

export default createStore({
    state: {
        subscribe: [],
        subscribers: []
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
        }
    },
    getters: {
        subscribe(state) {
            return state.subscribe
        },
        subscribers(state) {
            return state.subscribers
        }
    }
})

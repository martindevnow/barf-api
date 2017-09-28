import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        customers: [],
        orders: [],
        packages: [],
        pets: [],
        plans: [],
        selected: {
            order: null,
            plan: null,
            package: null,
        },
        show: {
            paymentModal: false,
            packedModal: false,
            pickedModal: false,
            shippedModal: false,
            deliveredModal: false,
            noteModal: false,
        }
    },
    getters: {

    },
    actions: {
        openPaymentModal(context, order) {
            context.commit('setSelectedOrder', order);
            context.commit('showPaymentModal');
        },
        closePaymentModal(context) {
            context.commit('hidePaymentModal');
            context.commit('deselectOrder');
        },
        openPackedModal(context, order) {
            context.commit('setSelectedOrder', order);
            context.commit('showPackedModal');
        },
        closePackedModal(context) {
            context.commit('hidePackedModal');
            context.commit('deselectOrder');
        },
        loadOrders(context) {
            axios.get('/admin/api/orders')
                .then(response => context.commit('populateOrdersCollection', response.data))
                .catch(error => console.log(error));
        },
        loadPackages(context) {
            axios.get('/admin/api/packages')
                .then(response => context.commit('populatePackagesCollection', response.data))
                .catch(error => console.log(error));
        },
        loadPlans(context) {
            axios.get('/admin/api/plans')
                .then(response => context.commit('populatePlansCollection', response.data))
                .catch(error => console.log(error));
        },
        loadPets(context) {
            axios.get('/admin/api/pets')
                .then(response => context.commit('populatePetsCollection', response.data))
                .catch(error => console.log(error));
        }
    },
    mutations: {
        populateOrdersCollection(state, data) {
            state.orders = data;
        },
        populatePackagesCollection(state, data) {
            state.packages = data;
        },
        populatePlansCollection(state, data) {
            state.plans = data;
        },
        populatePetsCollection(state, data) {
            state.pets = data;
        },
        setSelectedOrder(state, order) {
            state.selected.order = order;
        },
        deselectOrder(state) {
            state.selected.order = null;
        },
        showPaymentModal(state) {
            state.show.paymentModal = true;
        },
        hidePaymentModal(state) {
            state.show.paymentModal = false;
        },
        showPackedModal(state) {
            state.show.packedModal = true;
        },
        hidePackedModal(state) {
            state.show.packedModal = false;
        },
        updateSelectedOrder(state, payload) {
            state.selected.order = { ...state.selected.order, ...payload };
            state.orders = state.orders.filter(order => order.id !== state.selected.order.id);
            state.orders.unshift(state.selected.order);
        }
    }
});
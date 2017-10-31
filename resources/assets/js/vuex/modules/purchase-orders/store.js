import * as actions from './actions';
import * as mutations from './mutations';

const state = {
    collection: [],
    selected: null,
    show: {
        receivedModal: false,
        orderedModal: false,
    }
}

const purchaseOrdersModule = {
    namespaced: true,
    state,
    mutations,
    actions,
};

export default purchaseOrdersModule;
import * as actions from './actions';
import * as mutations from './mutations';

const state = {
    collection: [],
    selected: null,
    show: {
        meatCreatorModal: false,
    }
};

const meatsModule = {
    namespaced: true,
    state,
    mutations,
    actions,
};

export default meatsModule;
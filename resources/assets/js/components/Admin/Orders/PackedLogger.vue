<template>
    <form @keydown="errors.clear($event.target.name)"
          @submit.prevent=""
    >
        <div class="row">
            <div class="col-sm-12">
                <p>Note: if you update the package or # of weeks packed here, it will update their Order for this shipment.</p>
                <p>It will not change their plan.</p>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <div class="form-group"
                     v-bind:class="{'has-error': errors.has('weeks_packed') }"
                >
                    <label for="weeks_packed">Weeks Packed</label>
                    <input type="text" class="form-control"
                           id="weeks_packed"
                           name="weeks_packed"
                           v-model="weeks_packed"
                    >
                    <span class="help-block">{{ errors.get('weeks_packed') }}</span>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="form-group"
                     v-bind:class="{'has-error': errors.has('packed_package_id') }"
                >
                    <label>Package</label>
                    <admin-package-selector v-model="packed_package"
                                            @input="errors.clear('packed_package_id')"
                    >
                    </admin-package-selector>
                    <span class="help-block">{{ errors.get('packed_package_id') }}</span>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-success btn-block"
                        @click="save()"
                >
                    Save
                </button>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-default btn-block"
                        @click="$emit('cancelled')"
                >
                    Cancel
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { mapState, mapActions, mapMutations, mapGetters } from 'vuex';
import eventBus from '../../../events/eventBus';
import hasErrors from '../../../mixins/hasErrors';

export default {
    mixins: [
        hasErrors
    ],
    data() {
        return {
            weeks_packed: 0,
            package_id: null,
            packed_package: {},
        };
    },
    methods: {
        ...mapActions('orders', [
            'closePackedModal',
        ]),
        ...mapActions('packages', [
            'loadPackages',
        ]),
        ...mapMutations('orders', [
            'updateSelectedOrder',
        ]),
        save() {
            let vm = this;

            return axios.post('/admin/api/orders/'+ this.selected.id +'/packed', {
                weeks_packed:      this.weeks_packed,
                packed_package_id: this.packed_package.id,
            }).then(response => {
                vm.updateSelectedOrder({
                    packed: true,
                    weeks_packed: vm.weeks_packed,
                    packed_package_id: vm.packed_package.id,
                });
                vm.$emit('saved')
            }).catch(error => {
                vm.errors.record(error.response.data.errors);
            });
        },
    },
    computed: {
        ...mapState('orders', [
            'show',
            'selected',
        ]),
        ...mapState('packages', {
            'packages': 'collection'
        }),
        ...mapGetters('packages', [
            'getPackageById',
        ]),
    },
    mounted() {
        this.loadPackages();
        this.weeks_packed = this.selected.plan.weeks_of_food_per_shipment;
        this.package_id = this.selected.packed_package_id
            || this.selected.plan.package_id;
        this.packed_package = this.getPackageById(this.package_id);
    }
}
</script>

<style>
span.label {
    color: black;
}
</style>
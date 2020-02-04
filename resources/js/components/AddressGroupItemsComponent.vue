<template>
    <div class="address-group-items-container border p-4">
        <p class="font-bold mb-2">Add addresses below to this account. Every time this group address receives a payment, the balance will be split between all addresses below:</p>
        <div class="mb-4">
            <button v-if="canAddItems" type="button" class="btn btn-primary" @click="addAddressGroupItem">Add Address</button>
        </div>
        <div>
            <div v-if="addressGroupItems.length == 0" class="text-red-600">No addresses have been added. Add one to get started</div>
            <div v-for="(addressGroupItem, addressGroupItemKey) in addressGroupItems" class="border font-black bg-blue-600 shadow p-4 md:flex mb-1">
                <div class="mx-2 mb-2 md:w-1/4">
                    <input type="text" placeholder="Label" v-model="addressGroupItem.label" class="p-2 border w-full" />
                </div>
                <div class="mx-2 mb-2 md:w-1/4">
                    <input type="text" placeholder="Address" v-model="addressGroupItem.address" class="p-2 border w-full" />
                </div>
                <div class="mx-2 mb-2 md:w-1/4">
                    <div class="flex">
                        <div class="mr-2">
                            <input type="text" placeholder="Percentage" v-model="addressGroupItem.percentage" class="p-2 border w-full" />
                        </div>
                        <div class="">
                            <span class="text-white px-2">%</span>
                        </div>
                    </div>
                </div>
                <div class="mx-2 md:w-1/4 text-right">
                    <button type="button" @click="removeAddressGroupItem(addressGroupItemKey)" class="bg-red-600 text-white p-2 rounded">DELETE</button>
                </div>
            </div>
        </div>
        <textarea class="hidden" name="items" v-model="addressGroupData"></textarea>
        <div v-if="addressGroupItems.length > 0 && totalPercentage != 100" class="text-red-600 font-bold p-4 border mb-4">
            Total Percentage: {{ totalPercentage }} <br/>
            This value must equal 100!
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            if(this.initialItems){
                this.addressGroupItems = JSON.parse(this.initialItems);
            }
        },
        props: [
            'initialItems'
        ],
        data() {
            return {
                addressGroupItems: [

                ]
            }
        },
        methods: {
            addAddressGroupItem: function(){
                this.addressGroupItems.push({
                    id: null,
                    label: '',
                    address: '',
                    percentage: '',
                });
                console.log(this.addressGroupItems);
                console.log(this.addressGroupItems.length);
            },
            removeAddressGroupItem: function(addressGroupItemKey){
                this.addressGroupItems.splice(addressGroupItemKey, 1);
            }
        },
        computed: {
            canAddItems: function(){
                return this.addressGroupItems.length < 25;
            },
            addressGroupData: function(){
                return JSON.stringify(this.addressGroupItems);
            },
            totalPercentage: function(){
                let total = 0;
                for(var i=0;i<this.addressGroupItems.length; i++){
                    total += parseFloat(this.addressGroupItems[i].percentage);
                }
                return total;
            }
        }
    }
</script>

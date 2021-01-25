<template>
    <div>
        <div class="row px-3">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Profit (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{data.monthlyProfit}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Profit (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{data.annualProfit}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">SOLD ITEMS (MONTHLY)</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{data.monthlySoldItem}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chair fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">SOLD ITEMS (ANNUAL)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{data.annualSoldItem}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-couch fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3">
            <div v-for="umkm in data.umkm" :key="umkm.id">
                <hr>
                <div class="mb-3" style="display:flex;justify-content:space-between">
                    <h5>{{umkm.name}},<span class="text-dark h6"> Total Profit = {{'Rp. '+ Intl.NumberFormat('de-DE').format(umkm.profit)}}</span> 
                    </h5>
                    <a style="cursor:pointer;color:blue" @click="showDetail('id'+umkm.id)">show details!</a>
                </div>
                <div :id="'id'+umkm.id" class="table-responsive data-transaction">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>Product Name</th>
                                <th>Net Price</th>
                                <th>Gross Price</th>
                                <th>Discount</th>
                                <th>Profit</th>
                                <th>Shipping Cost</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr v-if="!umkm.transaction[0]" class="h3">
                                <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                            </tr>
                            <tr v-for="transaction in umkm.transaction" :key="transaction.id">
                                <td>{{transaction.product_name}}</td>
                                <td>{{transaction.net_price}}</td>
                                <td>{{transaction.gross}}</td>
                                <td>{{transaction.discount}}</td>
                                <td>{{transaction.profit}}</td>
                                <td>{{transaction.ongkir}}</td>
                                <td>{{transaction.updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted(){
        axios.get('/api/overview').then(response=>{
            this.data = response.data;
            // console.log(this.data);
            this.data.annualProfit = 'Rp. '+ Intl.NumberFormat('de-DE').format(this.data.annualProfit);
            this.data.monthlyProfit = 'Rp. '+ Intl.NumberFormat('de-DE').format(this.data.monthlyProfit);

            // sort umkm from the biggest profit
            this.data.umkm = this.data.umkm.sort((a,b)=>b.profit-a.profit);
        })
    },
    data(){
        return{
            data:{
                annualProfit:'',
                monthlyProfit:'',
                annualSoldItem:'',
                monthlySoldItem:'',
                umkm:{}
            },
        }
    },
    methods:{
        showDetail(id_umkm){
            document.getElementById(id_umkm).classList.toggle('data-transaction');
            document.getElementById(id_umkm).classList.toggle('detail');
        }
    }
}
</script>

<style>
    .data-transaction{
        display: none;
    }
    .detail{
        display: block;
    }
</style>
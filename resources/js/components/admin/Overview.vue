<template>
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
</template>

<script>
export default {
    mounted(){
        axios.get('/api/overview').then(response=>{
            this.data = response.data;
            // console.log(this.data);
            this.data.annualProfit = 'Rp. '+ Intl.NumberFormat('de-DE').format(this.data.annualProfit);
            this.data.monthlyProfit = 'Rp. '+ Intl.NumberFormat('de-DE').format(this.data.monthlyProfit);
        })
    },
    data(){
        return{
            data:{
                annualProfit:'',
                monthlyProfit:'',
                annualSoldItem:'',
                monthlySoldItem:''
            },
        }
    }
}
</script>

<style>

</style>
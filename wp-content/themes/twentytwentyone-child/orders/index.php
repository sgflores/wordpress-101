<?php 
/* Template Name: CustomOrdersPage */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom WP Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        [v-cloak] {display: none}
        .pointer {
            cursor: pointer;
        }
    </style>

</head>
<body>
        
    <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <p class="h5 my-0 me-md-auto fw-normal">The Company</p>
    </header>

    <main class="container" id="app" v-cloak>
        <div class="alert alert-info">Press enter key to update the required count value</div>
        <table class="table table-sm table-striped table-hover">
            <thead>
                <th class="pointer" v-for="list in header" :key="list.column" @click="sortBy(list)">
                    <i class="fa fa-sort" v-if="currentSorterColumn != list.column"></i>
                    <i class="fa fa-sort-up" v-if="currentSorterColumn == list.column && currentSorterValue == 'asc'"></i>
                    <i class="fa fa-sort-down" v-if="currentSorterColumn == list.column && currentSorterValue == 'desc'"></i>
                    {{list.label}}
                </th>
            </thead>
            <tbody>
                <tr v-for="list in orders" :key="list.id">
                    <td>{{list.id}}</td>
                    <td>{{list.post_date}}</td>
                    <td>{{list.email}}</td>
                    <td>{{list.post_id}}</td>
                    <td class="pointer">
                        <input type="number" required min="0" class="form-control" v-model="list.count" v-on:keyup.enter="updateCount(list)" >
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                orders: [],
                header: [
                    { column: 'id', label: 'Order ID' },
                    { column: 'post_date', label: 'Date Submitted' },
                    { column: 'email', label: 'Client Email' },
                    { column: 'post_id', label: 'Article ID' },
                    { column: 'count', label: 'Required Word Count' }
                ],
                currentSorterColumn: '',
                currentSorterValue: 'asc'
            },
            methods: {
                updateCount(list) {
                    var count = parseInt(list.count);
                    if (isNaN(count)) {
                        alert('Invalid count');
                        list.count = 0;
                        return;
                    }
                    axios.post('/wp-json/v1/UpdateRequiredWordCount', {
                        'order_id': list.id,
                        'count': count
                    })
                    .then(function(response) {
                        alert(response.data);
                    })
                    .catch(function(error) {
                        alert(error.response.data.message);
                    });
                },
                getAllOrders() {
                    var vm = this;
                    axios.get('/wp-json/v1/GetAllArticles')
                    .then(function(response) {
                        vm.orders = response.data;
                    })
                    .catch(function(error) {
                        console.log(error.response);
                    });
                },
                sortBy(list) {
                    var vm = this;
                    vm.currentSorterColumn = list.column;
                    vm.currentSorterValue = vm.currentSorterValue == 'asc' ? 'desc' : 'asc';
                    let asc = vm.currentSorterValue == 'asc' ? 1 : -1;
                    let desc = vm.currentSorterValue == 'asc' ? -1 : 1;
                    vm.orders.sort(function(a, b) {
                        if (a[vm.currentSorterColumn].toLowerCase() > b[vm.currentSorterColumn].toLowerCase()){
                            return asc;
                        }
                        return desc;
                    });
                }
            },
            created() {
                this.getAllOrders();
            }
        });
    </script>

</body>
</html>
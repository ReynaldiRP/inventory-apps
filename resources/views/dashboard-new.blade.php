@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('content')
    <!-- Cards Tell Current Month -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <h5 class="card-title">Current Month Overview</h5>
                    <p class="card-category">Last 30 days</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="tim-icons icon-delivery-fast text-info"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Products In</p>
                                <p class="card-title" id="products-in-count">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="tim-icons icon-send text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Products Out</p>
                                <p class="card-title" id="products-out-count">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="tim-icons icon-alert-circle-exc text-danger"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Low Stock</p>
                                <div id="low-stock-info">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Monthly Inventory In Overview</h5>
                    <h3 class="card-title"><i class="tim-icons icon-chart-bar-32 text-primary"></i> Stock In Movement</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="inventoryInChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Monthly Inventory Out Overview</h5>
                    <h3 class="card-title"><i class="tim-icons icon-chart-bar-32 text-primary"></i> Stock Out Movement</h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="inventoryOutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Receipts Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Receipts</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter">
                            <thead class="text-primary">
                                <tr>
                                    <th>Receipt #</th>
                                    <th>Product</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="recent-receipts-tbody">
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <i class="fa fa-spinner fa-spin"></i> Loading...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            loadDashboardData();

            function loadDashboardData() {
                loadLowStockProducts();
                loadProductsInCurrentMonth();
                loadProductsOutCurrentMonth();
                loadRecentReceipts();
                loadChartData();
            }

            function loadProductsInCurrentMonth() {
                $.ajax({
                    url: "{{ route('dashboard.productInCurrentMonth') }}",
                    method: 'GET',
                    success: function(response) {
                        $('#products-in-count').html(response.count.toLocaleString());
                    },
                    error: function() {
                        $('#products-in-count').html('<span class="text-danger">Error</span>');
                    }
                });
            }

            function loadProductsOutCurrentMonth() {
                $.ajax({
                    url: "{{ route('dashboard.productOutCurrentMonth') }}",
                    method: 'GET',
                    success: function(response) {
                        $('#products-out-count').html(response.count.toLocaleString());
                    },
                    error: function() {
                        $('#products-out-count').html('<span class="text-danger">Error</span>');
                    }
                });
            }


            function loadLowStockProducts() {
                $.ajax({
                    url: "{{ route('dashboard.productWarningStock') }}",
                    method: 'GET',
                    success: function(response) {
                        let lowStockHtml = '';
                        if (response.products.length > 0) {
                            let firstProduct = response.products[0];
                            lowStockHtml = `
                                <div class="d-flex" style="gap: 0.5rem;">
                                    <p class="card-title" style="color: red;">${firstProduct.name}</p>
                                    <p class="card-title" style="color: red;">${firstProduct.stock}</p>
                                </div>
                            `;
                        } else {
                            lowStockHtml = '<p class="card-title text-success">All Good!</p>';
                        }
                        $('#low-stock-info').html(lowStockHtml);
                    },
                    error: function() {
                        $('#low-stock-info').html('<span class="text-danger">Error</span>');
                    }
                });
            }

            // Load Recent Receipts
            function loadRecentReceipts() {
                $.ajax({
                    url: "{{ route('dashboard.newestReceipts') }}",
                    method: 'GET',
                    success: function(response) {
                        let receiptsHtml = '';
                        response.receipts.forEach(function(receipt) {
                            let badgeClass = receipt.type === 'in' ? 'badge-success' :
                                'badge-danger';
                            let date = new Date(receipt.created_at).toLocaleDateString();

                            receiptsHtml += `
                                <tr>
                                    <td>${receipt.receipt_number}</td>
                                    <td>${receipt.product ? receipt.product.name : 'N/A'}</td>
                                    <td>${receipt.user ? receipt.user.name : 'N/A'}</td>
                                    <td><span class="badge ${badgeClass}">${receipt.type.charAt(0).toUpperCase() + receipt.type.slice(1)}</span></td>
                                    <td>${receipt.quantity}</td>
                                    <td>${date}</td>
                                </tr>
                            `;
                        });

                        if (receiptsHtml === '') {
                            receiptsHtml =
                                '<tr><td colspan="6" class="text-center">No receipts found</td></tr>';
                        }

                        $('#recent-receipts-tbody').html(receiptsHtml);
                    },
                    error: function() {
                        $('#recent-receipts-tbody').html(
                            '<tr><td colspan="6" class="text-center text-danger">Error loading receipts</td></tr>'
                        );
                    }
                });
            }

            // Load Chart Data
            function loadChartData() {
                // Load Products In Per Month for Chart
                $.ajax({
                    url: "{{ route('dashboard.productInPerMonth') }}",
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        
                        // Changed: access response.data instead of response.data.inData
                        initializeInChart(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading chart data:', error);
                    }
                });

                // Load Products Out Per Month for Chart
                $.ajax({
                    url: "{{ route('dashboard.productOutPerMonth') }}",
                    method: 'GET',
                    success: function(response) {
                        initializeOutChart(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading chart data:', error);
                    }
                });
            }

            // Initialize In Chart with API data
            function initializeInChart(data) {
                let ctxIn = document.getElementById("inventoryInChart").getContext("2d");

                // Prepare data for all 12 months
                let monthNames = data.months;
                let chartData = data.inData;

                let inventoryInChart = new Chart(ctxIn, {
                    type: 'line',
                    data: {
                        labels: monthNames,
                        datasets: [{
                            label: "Products In",
                            borderColor: "#1f8ef1",
                            backgroundColor: "rgba(31, 142, 241, 0.1)",
                            pointBorderColor: "#FFF",
                            pointBackgroundColor: "#1f8ef1",
                            data: chartData
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: true,
                            labels: {
                                fontColor: 'white'
                            }
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    color: 'rgba(255, 255, 255, 0.1)',
                                    zeroLineColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                ticks: {
                                    fontColor: 'white'
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    color: 'rgba(255, 255, 255, 0.1)',
                                    zeroLineColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                ticks: {
                                    fontColor: 'white'
                                }
                            }]
                        }
                    }
                });
            }

            // Initialize Out Chart with API data
            function initializeOutChart(data) {
                let ctxOut = document.getElementById("inventoryOutChart").getContext("2d");

                // Prepare data for all 12 months
                let monthNames = data.months;
                let chartData = data.outData;

                let inventoryOutChart = new Chart(ctxOut, {
                    type: 'line',
                    data: {
                        labels: monthNames,
                        datasets: [{
                            label: "Products Out",
                            borderColor: "#ff8d72",
                            backgroundColor: "rgba(255, 141, 114, 0.1)",
                            pointBorderColor: "#FFF",
                            pointBackgroundColor: "#ff8d72",
                            data: chartData
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: true,
                            labels: {
                                fontColor: 'white'
                            }
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    color: 'rgba(255, 255, 255, 0.1)',
                                    zeroLineColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                ticks: {
                                    fontColor: 'white'
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    color: 'rgba(255, 255, 255, 0.1)',
                                    zeroLineColor: 'rgba(255, 255, 255, 0.1)'
                                },
                                ticks: {
                                    fontColor: 'white'
                                }
                            }]
                        }
                    }
                });
            }
        });
    </script>
@endpush

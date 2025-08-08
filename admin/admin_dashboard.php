<?php session_start(); include '../includes/db.php'; ?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <?php include '../includes/adhead.php'; ?> 
    <title>Welcome to the Health Shop</title>
    <style>
        body {
            background-image: url('../uploads/background.jpg'); 
            background-size: cover;
            color: white; 
            font-family: Arial, sans-serif;
        }
        nav {
            background-color: skyblue; 
            padding: 10px;
            width: 100%; 
            position: relative; 
            z-index: 1000; 
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline; 
            margin-right: 15px;
        }
        nav ul li a {
            color: blue; 
            text-decoration: none;
            font-weight: bold;
        }
        main {
            background-color: rgba(18, 48, 61, 0.8); 
            padding: 20px;
            border-radius: 8px;
            margin: 20px;
        }
        h1 {
            color: skyblue; 
        }
        .chart-container {
            background-color: rgba(0, 0, 0, 0.7); 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            max-width: 600px; 
            margin: 20px auto; 
        }
        #myChart, #orderComparisonChart {
            max-width: 100%; 
        }
        h2 {
            color: skyblue; 
            text-align: center; 
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head> 
<body> 
<?php include '../includes/admin_header.php'; ?> 
    <main> 
        <h1>Admin Dashboard</h1><br><br> 
        <?php 
            $fruitCount = $pdo->query("SELECT COUNT(*) FROM fruits")->fetchColumn(); 
            $herbCount = $pdo->query("SELECT COUNT(*) FROM herbs")->fetchColumn(); 
            $hospitalCount = $pdo->query("SELECT COUNT(*) FROM hospitals")->fetchColumn(); 
            $userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(); 

            $totalFruitOrders = $pdo->query("SELECT SUM(quantity) FROM orders WHERE fruit_id IS NOT NULL")->fetchColumn();
            $totalHerbOrders = $pdo->query("SELECT SUM(quantity) FROM orders WHERE herb_id IS NOT NULL")->fetchColumn();
        ?> 

        <div class="chart-container"> 
            <h2>Comparison : Users vs Stocks</h2> 
            <canvas id="myChart"></canvas> 
        </div>

        <div class="chart-container"> >
            <h2>Order Comparison: Fruits vs Herbs</h2> 
            <canvas id="orderComparisonChart"></canvas> 
        </div>

        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar', 
                data: {
                    labels: ['Fruits', 'Herbs', 'Hospitals', 'Users'], 
                    datasets: [{
                        label: 'Total Count',
                        data: [<?php echo $fruitCount; ?>, <?php echo $herbCount; ?>, <?php echo $hospitalCount; ?>, <?php echo $userCount; ?>], // Data from PHP
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true 
                        }
                    }
                }
            });


            const orderCtx = document.getElementById('orderComparisonChart').getContext('2d');
            const orderComparisonChart = new Chart(orderCtx, {
                type: 'bar', 
                data: {
                    labels: ['Fruits', 'Herbs'], 
                    datasets: [{
                        label: 'Total Orders',
                        data: [<?php echo $totalFruitOrders; ?>, <?php echo $totalHerbOrders; ?>], 
                        backgroundColor: [
                            'rgba(255, 159, 64, 1)', 
                            'rgba(153, 102, 255, 1)' 
                        ],
                        borderColor: [
                            'rgba(255, 159, 64, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true 
                        }
                    }
                }
            });
        </script>
    </main> 
</body> 
</html>
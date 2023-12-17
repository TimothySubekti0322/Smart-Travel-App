<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Hotel Chart</title>
        <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>
<body>
    <header class="absolute w-full bg-white flex justify-between items-center p-8 h-24 shadow-xl">
        <!-- Logo -->
        <div>
            <a href="/"><img src="/images/logo.png" alt="logo" class="h-8" /></a>
        </div>

        <!-- Menu -->
        <div class="flex items-center gap-x-4">
            <a href="/admin/bookChart" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Booking Data</a>
            <a href="/admin/listPackage" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Add Package</a>
            <a href="/admin/hotelChart" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Hotel Order Data</a>
        </div>

        <!-- Sign Up -->
        <div class="flex items-center">
            <?php
            if (isset($_COOKIE['payload'])) {
                $payload = json_decode($_COOKIE['payload'], true); // Decode JSON to PHP array

                // Check if 'name' key exists in the decoded payload
                if (isset($payload['name'])) {
                    echo '<p class="text-gray-700 mr-4 font-bold">' . $payload['name'] . '</p>';
                    echo '<p class="text-gray-700 mr-4 font-bold">|</p>'; // Added separator
                    echo '<a href="/logout" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">sign out</a>';
                } else {
                    echo '<a href="/login" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Login</a>';
                    echo '<p class="text-gray-700 mr-4 font-bold">|</p>'; // Added separator
                    echo '<a href="/register" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Sign up</a>';
                }
            } else {
                echo '<a href="/login" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Login</a>';
                echo '<p class="text-gray-700 mr-4 font-bold">|</p>'; // Added separator
                echo '<a href="/register" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Sign up</a>';
            }
            ?>
        </div>
    </header>

    <!-- Fill Header -->
    <div class="h-24 w-full"></div>
    
     <div class="w-full flex flex-col justify-center items-center">
        <div id="Caution" class="w-screen h-screen flex justify-center items-center"><p class="font-bold text-2xl text-center">Make Sure that the Hotel Server is turned on <br/>to Load this data</p></div>
        <div class="w-3/5">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        const response = fetch('http://localhost:8081/reportAPI/satya@gmail.com/satya', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                console.log(data);
                const Caution = document.getElementById('Caution');
                Caution.remove();
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.label,
                        datasets: [{
                            label: 'Number of Bookings',
                            data: data.data,
                            backgroundColor: [
                                'rgba(199, 112, 7, 0.6)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });
    </script>
</body>
</html>
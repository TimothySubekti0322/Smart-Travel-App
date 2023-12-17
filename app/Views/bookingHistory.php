<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif;">
        <header class="absolute w-full bg-white flex justify-between items-center p-8 h-24 shadow-xl">
        <!-- Logo -->
        <div>
            <a href="/"><img src="/images/logo.png" alt="logo" class="h-8" /></a>
        </div>

        <!-- Menu -->
        <div class="flex items-center gap-x-4">
            <a href="/" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Home</a>
            <a href="/#body" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Package</a>
            <a href="/bookingHistory" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Booking History</a>
        </div>

        <!-- Sign Up -->
        <div class="flex items-center">
           <?php
                if(isset($_COOKIE['payload'])) {
                    $payload = json_decode($_COOKIE['payload'], true); // Decode JSON to PHP array

                    // Check if 'name' key exists in the decoded payload
                    if(isset($payload['name'])) {
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
    <!-- <div class="h-24"></div> -->

    <!-- Body -->
    <main class="w-screen min-h-screen flex justify-center bg-[#F2F3F3]">
        <div id="cardContainer" class="w-3/5 mt-36 p-8 rounded-xl border-2 border-black flex flex-col gap-y-6 h-fit bg-white mb-8">
            <p class="text-2xl font-bold">Booking History</p>
            <!-- Render Here -->
        </div>
    </main>
    <script src="/js/bookingHistory.js" charset="utf-8"></script>
</body>
</html>
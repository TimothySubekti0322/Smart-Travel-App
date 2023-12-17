<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Travel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Poppins', sans-serif;">
    <header class="absolute w-full bg-white flex justify-between items-center p-8 h-24">
        <!-- Logo -->
        <div>
            <a href="/"><img src="/images/logo.png" alt="logo" class="h-8" /></a>
        </div>

        <!-- Menu -->
        <div class="flex items-center gap-x-4">
            <a href="/" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Home</a>
            <a href="#body" class="text-gray-700 mr-4 font-bold hover:text-[#00B6FF]">Package</a>
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

    <!-- Hero -->
    <div class="w-full h-[67rem] bg-[url('/images/hero.png')]  bg-no-repeat bg-cover flex flex-col items-center justify-center">
        <h1 style="font-family: 'Caveat', cursive;" class="text-white text-[8rem] leading-[9rem]">Greate Trip <span class="block">Travellers</span></h1>
        <text class="text-center mt-20 text-xl text-white">Since 2014, we’ve helped more than 500,000 people of <span class="block">all ages enjoy the best outdoor experience.</span></text>
        <a href="#body"><button class="mt-20 bg-[#EC927E] hover:bg-[#DB816D] py-4 px-16 rounded-[4rem] text-white font-bold">Explore Tours</button></a>
    </div>

    <!-- Content -->
    <div id="body">
        <div class="w-full text-center text-[#36BCA1] text-3xl mt-20" style="font-family: 'Caveat', cursive;">Flash Deals</div>
        <div class="text-extrabold text-[2rem] text-center mt-2" style="font-weight:500;">We’ve Got Some Great Deals</div>
        <div class="w-full flex justify-center mt-8">
            <img src="/images/vector.svg"></img>
        </div>

        <section id="cardSection" class="w-full mt-20 px-8 grid grid-cols-3 gap-y-12">

        </section>
    </div>

    <script src="/js/index.js" charset="utf-8"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
        <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
</head>
<body>
    <?php if($message) {
        echo '    <div class="absolute w-screen flex justify-center items-center">
        <div class="text-black font-semibold px-6 py-2 bg-[#FAEED1] rounded-xl z-[1] mt-8 flex items-center gap-x-2">
            <div class="w-6">
                <img src="/images/checklist.png" class="w-full"/>
            </div>
            <p>Registration success!</p>
        </div>
    </div>';
    } ?>

    <div class="bg-[url('/images/loginBG.jpg')] bg-cover w-screen h-screen flex flex-col justify-center items-center">
        <div class="w-full h-full bg-black opacity-40 absolute"></div>
        <form class="z-[1] flex flex-col justify-center items-center w-full" action="/login" method="POST" enctype="multipart/form-data">
            <div class="text-white text-[3.5rem] opacity-100 ">Login</div>
            <input type="text" class="rounded-[4rem] bg-black opacity-70 text-white mt-12 w-2/5 px-6 py-6 text-xl" name="email" placeholder="email"/>
            <input type="password" class="rounded-[4rem] bg-black opacity-70 text-white mt-12 w-2/5 px-6 py-6 text-xl" name="password" placeholder="password"/>
            <button type="submit" class="rounded-[4rem] bg-[#D8E4F2] hover:bg-[#B6C2D0] text-xl text-black mt-12 w-2/5 px-4 py-6">Login</button>
        </form>
        <p class="mt-12 text-white z-[1]">don't have any account ? <a href="/register" class="text-[#3559E0] hover:underline">sign up</a> here</p>
    </div>
</body>
</html>
<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title }}</title>

    <meta name="description" content="" />

    <style>
        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 12px solid #444444;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }
 
        .center {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }
 
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
        .swal2-container {
            z-index: 9999;
        }
    </style>

    @stack('style')

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/assets/img/favicon/mito.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    @Vite('resources/js/style.js')
</head>

<body>

    <div id="loader" class="center"></div>

    <!-- Error -->
    <div class="container-xxl container-p-y d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="misc-wrapper text-center">
            <h2 class="mb-2 mx-2">Error while processing data</h2>
            <p class="mb-4 mx-2">Oops! 😖 {{ $message }}.</p>
            <a href="{{ route($route) }}" class="btn btn-primary">Back to home</a>
            <div class="mt-3"> 
                <img src="{{ Vite::asset('resources/assets/svg/400.svg') }}" width="500" class="img-fluid"/>
            </div>
        </div>
    </div>
    <!-- /Error -->

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    @vite('resources/js/app')
    <script>
        document.onreadystatechange = function () {
            if (document.readyState !== "complete") {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "#loader").style.visibility = "visible";
            } else {
                document.querySelector(
                    "#loader").style.display = "none";
                document.querySelector(
                    "body").style.visibility = "visible";
            }
        };
    </script>
</body>

</html>

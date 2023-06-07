<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;family=Poppins:wght@400;500;700&amp;display=swap">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/flatpickr/css/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/choices/css/choices.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/tiny-slider/tiny-slider.css">
    <link rel="stylesheet" type="text/css" href="/assets/vendor/nouislider/nouislider.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">

    <script src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.js"></script>
    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia

    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Vendors -->
    <script src="/assets/vendor/flatpickr/js/flatpickr.min.js"></script>
    <script src="/assets/vendor/choices/js/choices.min.js"></script>
    <script src="/assets/vendor/tiny-slider/tiny-slider.js"></script>
    <script src="/assets/vendor/nouislider/nouislider.min.js"></script>

    <!-- ThemeFunctions -->
    <script src="/assets/js/functions.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name') }}</title>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia
        <script src="https://js.stripe.com/v3/"></script>
        <script>
    window.Laravel = {
        flashMessages: {
            success: "{{ session('success') }}",
            error: "{{ session('error') }}",
            warning: "{{ session('warning') }}",
            info: "{{ session('info') }}"
        }
    };
</script>
    </body>
</html>

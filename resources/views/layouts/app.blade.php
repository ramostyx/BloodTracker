<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
{{--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">--}}
{{--        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">--}}
{{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">--}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <!-- Include FilePond library and plugins -->
        <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.min.js"></script>

        <!-- Include the FilePond CSS styles -->
        <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">






        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased ">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="pt-2 bg-red-50 min-h-screen">
            <x-header-responsive/>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="pt-12 px-12 text-gray-700">
                {{ $slot }}
            </main>
        </div>

        @yield('scripts')


        <script type="module" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

{{--        <script>--}}
{{--            config={--}}
{{--                enableTime : false,--}}
{{--                dateFormat : "Y-m-d",--}}
{{--            }--}}
{{--            flatpickr("input[type=datetime-local]", config);--}}
{{--        </script>--}}
    </body>
</html>

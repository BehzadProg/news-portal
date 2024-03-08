<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <title>{{ @$settings['site_seo_title'] }} &mdash; @yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description"
        content="@hasSection('meta_description')
@yield('meta_description')
@else
{{ $settings['site_seo_description'] }}
@endif">
    <meta name="keywords" content="{{ $settings['site_seo_keywords'] }}">
    <meta name="og:title" content="@yield('meta_og_title')">
    <meta name="og:description" content="@yield('meta_og_description')">
    <meta name="og:image"
        content="@hasSection('meta_og_image')
@yield('meta_og_image')
@else
{{ asset(env('SITE_LOGO_IMAGE_UPLOAD_PATH') . $settings['site_logo']) }}
@endif">
    <meta name="twitter:title" content="@yield('meta_tw_title')">
    <meta name="twitter:description" content="@yield('meta_tw_description')">
    <meta name="twitter:image" content="@yield('meta_tw_image')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset(env('SITE_LOGO_IMAGE_UPLOAD_PATH') . $settings['site_favicon']) }}"
        type="image/png">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
    <link href="{{ asset('frontend/assets/css/styles.css') }}" rel="stylesheet">
    <style>
        :root {
            --colorPrimary: {{ @$settings['site_color'] }};
        }
    </style>
</head>

<body>
    @php
        $socialLinks = \App\Models\SocialLink::where('status', 1)->get();
    @endphp

    <!-- Header news -->
    @include('frontend.layouts.header')
    <!-- End Header news -->

    <!-- Main Content -->
    @yield('content')
    <!-- End Main Content -->


    <!--  Footer Section -->
    @include('frontend.layouts.footer')
    <!-- End Footer Section -->

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="{{ asset('frontend/assets/js/index.bundle.js') }}"></script>
    <!-- Sweet Alert PHP Version -->
    @include('sweetalert::alert')
    <!-- Sweet Alert Js Version -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        $(document).ready(function() {
            $('#site-language').on('change', function() {
                let language = $(this).val()

                $.ajax({
                    method: 'GET',
                    url: "{{ route('language') }}",
                    data: {
                        language_code: language
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            window.location.href = "{{url('/')}}";
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            //subscribe newsletter
            $('.newsletter-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: "{{ route('subscribe_newsletter') }}",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('.newsletter-btn').text('Loading...');
                        $('.newsletter-btn').attr('disabled', true);
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            })
                            $('.newsletter-form')[0].reset();
                            $('.newsletter-btn').text('sign up');
                            $('.newsletter-btn').attr('disabled', false);
                        }
                    },
                    error: function(data) {
                        $('.newsletter-btn').text('sign up');
                        $('.newsletter-btn').attr('disabled', false);
                        if (data.status === 422) {
                            let errors = data.responseJSON.errors;
                            $.each(errors, function(index, value) {
                                Toast.fire({
                                    icon: 'error',
                                    title: value[0]
                                })
                            })
                        }
                    }
                })
            })
        })
    </script>
    @stack('script')
</body>

</html>

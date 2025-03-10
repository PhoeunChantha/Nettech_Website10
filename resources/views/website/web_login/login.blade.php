@extends('website.app')
@push('css')
    @include('website.web_login.login-style')
@endpush
@section('contents')
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="login-card">
            <h2 class="text-center">Sign In</h2>
            <form action="{{ route('customer.userlogin') }}" method="post">
                @csrf
                {{-- <div class="form-group mb-3">
                    <label for="signin_phone">Phone Number</label>
                    <div class="input-group">
                        <input id="signin_phone" class="form-control" type="tel" name="signin_phone"
                            placeholder="Enter mobile number">
                    </div>
                    @error('signin_phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}
                <div class="form-group mb-3">
                    <label for="signin_email">Email</label>
                    <div class="input-group">
                        <input id="signin_email" class="form-control" type="email" name="signin_email"
                            placeholder="Enter Email">
                    </div>
                    @error('signin_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-2">
                    <label for="Password">{{ __('Password') }}</label>
                    <div class="password-wrapper">
                        <input type="password" id="signin_password" name="signin_password" class="form-control"
                            placeholder="Enter Your Password">
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('signin_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <input type="checkbox" id="rememberMe" name="rememberMe" value="1">
                        <label for="rememberMe">Remember Me</label>
                    </div>
                    <a href="{{ route('customer.password.request') }}">Forgot Password?</a>
                </div>

                <div class="recaptcha-container">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                </div>
                <button type="submit" class="btn btn-primary mt-3 w-100">Log in</button>
                <div class="social-login text-center">
                    <p>Or Continue With</p>
                    <a href="{{ route('auth.google') }}"><img src="{{ asset('website/login/google.png') }}" alt="Google"></a>
                    {{-- <a href="#"><img src="{{ asset('website/login/iphone.png') }}" alt="Apple"></a> --}}
                </div>

                <div class="footer">
                    <p>Enjoy New Experience <a href="{{ route('customer.signup') }}">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("signin_password");
            var eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var input = document.querySelector("#signin_phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "kh",
                separateDialCode: true,
                hiddenInput: "full_mobile",
                dropdownContainer: document.body,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                nationalMode: false,
                autoPlaceholder: "aggressive"
            });

            // Optional: Handle form submission if needed
            $("form").on("submit", function() {
                var fullNumber = iti.getNumber();
                console.log(fullNumber);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.upload-icon').on('click', function() {
                $('#profile-image').click();
            });

            $('#profile-image').on('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result); // Display the selected image
                    };
                    reader.readAsDataURL(file); // Read the image file
                }
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {


            // Form submission with AJAX
            $('#profileForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('account.profile.update', auth()->user()->id) }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.msg);
                            success.play();
                            setTimeout(function() {
                                location.reload();
                            }, 2000); // Reload after 2 seconds to show the toastr message
                        } else {
                            toastr.error(response.msg);
                            error.play();
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]);
                            error.play();
                        });
                    }
                });
            });
        });
    </script> --}}
@endpush

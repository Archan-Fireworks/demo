<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">{{ translate('Login') }}</h6>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <form class="form-default" role="form" id="LogFormData" action="{{ route('cart.login.submit') }}" method="POST">
                        @csrf

                        <!-- Phone -->
                        <div class="form-group phone-form-group">
                            <input type="tel" id="phone-code"
                                class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                        </div>
                        <!-- Country Code -->
                        <input type="hidden" name="country_code" id="country_code" value="">

                        <!-- Name (Initially hidden) -->
                        <div class="form-group" id="nameField" style="display: none;">
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{ translate('Name') }}">
                            <span class="text-danger" id="nameError"></span>
                        </div>

                        <!-- Password (Initially hidden) -->
                        <div class="form-group" id="passwordField" style="display: none;">
                            <input type="password" name="password" id="passwordValue" class="form-control h-auto rounded-0 form-control-lg"
                                placeholder="{{ translate('Password') }}" required>
                            <span class="text-danger" id="passwordError"></span>
                        </div>

                        <!-- Confirm Password (Initially hidden) -->
                        <div class="form-group" id="confirmPasswordField" style="display: none;">
                            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="{{ translate('Confirm Password') }}">
                            <span class="text-danger" id="confirmPasswordError"></span>
                        </div>

                        <!-- OTP (Initially hidden) -->
                        <div class="form-group" id="otpField" style="display: none;">
                            <input type="text" class="form-control" id="otp" name="otp" placeholder="{{ translate('OTP') }}">
                            <span class="text-danger" id="otpError"></span>
                        </div>

                        <!-- Remember Me & Forgot password -->
                        <div class="row mb-2 mt-1">
                            <div class="col-6">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class=opacity-60>{{ translate('Remember Me') }}</span>
                                    <span class="aiz-square-check"></span>
                                </label>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.request') }}"
                                    class="text-reset opacity-60 hov-opacity-100 fs-14">{{ translate('Forgot password?') }}</a>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="mb-5" id="checkPhone">
                            <button type="button"
                                class="btn btn-primary btn-block fw-600 rounded-0" id="log_btn">{{ translate('Login') }}</button>
                        </div>
                        <div class="mb-5" id="verifyOtp" style="display: none;">
                            <button type="button"
                                class="btn btn-primary btn-block fw-600 rounded-0" id="verifyOtpBtn">{{ translate('Login') }}</button>
                        </div>
                    </form>

                    <!-- Register Now -->
                    <!-- <div class="text-center mb-3">
                        <p class="text-muted mb-0">{{ translate('Dont have an account?') }}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                    </div> -->
                    
                    <!-- Social Login -->
                    @if (get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With') }}</span>
                        </div>
                        <ul class="list-inline social colored text-center mb-5">
                            <!-- Facebook -->
                            @if (get_setting('facebook_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                        class="facebook">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                            <!-- Google -->
                            @if (get_setting('google_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                        class="google">
                                        <i class="lab la-google"></i>
                                    </a>
                                </li>
                            @endif
                            <!-- Twitter -->
                            @if (get_setting('twitter_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}"
                                        class="twitter">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                            @endif
                            <!-- Apple -->
                            @if (get_setting('apple_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                        class="apple">
                                        <i class="lab la-apple"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

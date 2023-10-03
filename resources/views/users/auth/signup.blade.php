@extends('layouts.users')
@section('page-styles')
    <style>
        body
        {
            background-image: url("{{asset('img/background.jpg')}}");
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
        }
        .container
        {
            background-color: white;
        }
    </style>
@endsection
@section('guest-content')
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <div class="container p-4 mx-auto border rounded-lg shadow-lg" style="max-width: 500px;">
            <div class="row justify-content-center">
                <ul class="nav nav-pills nav-justified mb-3 border" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab"
                            aria-controls="pills-login" aria-selected="true">登錄</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab"
                            aria-controls="pills-register" aria-selected="false">注冊</a>
                    </li>
                </ul>

                <!-- Pills content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <form action="{{ route('login') }}" method="POST" id="loginForm">
                            @csrf
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="loginEmail" name="email" class="form-control" />
                                <label class="form-label" for="loginEmail">電子郵件</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="loginPassword" name="password" class="form-control" />
                                <label class="form-label" for="loginPassword">密碼</label>
                            </div>

                            <!-- Remember me checkbox and forgot password link -->
                            <div class="row mb-4">
                                <div class="col-6 d-flex align-items-center">
                                    <div class="form-check mb-3 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="" id="loginRemember" name="remember">
                                        <label class="form-check-label" for="loginRemember">記住賬號</label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#!" class="text-decoration-none">忘記密碼？</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="d-grid">
                                <button id="loginSubmitBtn" class="btn btn-primary" type="submit" form="loginForm">登入</button>
                            </div>

                            <!-- Register buttons -->
                            <div class="text-center mt-3">
                                <p>非會員？<a class="text-decoration-none" onclick="switchTab('pills-register')" style="cursor: pointer;">注冊</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <form action="{{ route('register') }}" method="POST" id="registerForm">
                            @csrf
                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="registerName" name="name" class="form-control" />
                                <label class="form-label" for="registerName">姓名</label>
                            </div>

                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="registerUsername" name="username" class="form-control" />
                                <label class="form-label" for="registerUsername">用戶名</label>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="registerEmail" name="email" class="form-control" />
                                <label class="form-label" for="registerEmail">電子郵件</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="registerPassword" name="password" class="form-control" />
                                <label class="form-label" for="registerPassword">密碼</label>
                            </div>

                            <!-- Repeat Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="registerRepeatPassword" name="password_confirmation" class="form-control" />
                                <label class="form-label" for="registerRepeatPassword">重複輸入密碼</label>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" name="terms" checked aria-describedby="registerCheckHelpText" />
                                <label class="form-check-label" for="registerCheck">
                                    我已閱讀並同意條款
                                </label>
                            </div>

                            <!-- Submit button -->
                            <div class="d-grid">
                                <button id="registerSubmitBtn" class="btn btn-primary" type="submit" form="registerForm">注冊</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        function switchTab(tabId) {
            const tab = document.querySelector(`#${tabId}`);
            const navLink = document.querySelector(`a[href="#${tabId}"]`);
            // Deactivate all other tabs
            const tabs = document.querySelectorAll('.tab-pane');
            const navLinks = document.querySelectorAll('.nav-link');
            tabs.forEach((tab) => tab.classList.remove('show', 'active'));
            navLinks.forEach((navLink) => navLink.classList.remove('active'));

            // Activate the selected tab
            tab.classList.add('show', 'active');
            navLink.classList.add('active');
        }
    </script>
@endsection

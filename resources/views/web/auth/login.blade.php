@extends('web.layouts.app')

@section('content')


    <div class="row">
        <div class="form-body mt-4">
            <form class="row g-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="col-12">
                    <label for="inputEmailAddress" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control  border-3" id="inputEmailAddress" placeholder="jhon@example.com">
                </div>
                <div class="col-12">
                    <label for="inputChoosePassword" class="form-label">Password</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" name="password" class="form-control border-end-0  border-3" id="inputChoosePassword"  placeholder="Enter Password">
                        <a href="javascript:;" class="input-group-text bg-transparent  border-3"><i class="bi bi-eye-slash-fill"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch form-check-warning border-3">
                        <input class="form-check-input" name="remember" type="checkbox" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                    </div>
                </div>
                <div class="col-md-6 text-end">	<a href="auth-cover-forgot-password.html">Forgot Password ?</a>
                </div>
                <div class="col-12">
                    <div class="d-grid">
                        <button type="submit" class="btn  border-3 btn-warning">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showHidePassword = document.getElementById('show_hide_password');
            const icon = showHidePassword.querySelector('i');


            icon.addEventListener('click', function (event) {
                event.preventDefault();
                const inputField = showHidePassword.querySelector('input');
                const icon = showHidePassword.querySelector('i');

                if (inputField.type === 'text') {
                    inputField.type = 'password';
                    icon.classList.remove('bi-eye-slash-fill');
                    icon.classList.add('bi-eye-fill');
                } else if (inputField.type === 'password') {
                    inputField.type = 'text';
                    icon.classList.remove('bi-eye-fill');
                    icon.classList.add('bi-eye-slash-fill');
                }
            });
        });
    </script>

@endsection

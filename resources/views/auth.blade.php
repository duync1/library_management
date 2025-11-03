<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Library Login & Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { font-family: "Poppins", sans-serif; }
    .auth-container { background-color: #f8f9fa; min-height: 100vh; display: flex; justify-content: center; align-items: center; }
    .auth-box { width: 400px; background: #fff; border-radius: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 30px; transition: 0.3s ease-in-out; }
    .auth-form { animation: fadeIn 0.4s ease; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .auth-box h2 { font-weight: 600; color: #0d6efd; }
    a { text-decoration: none; color: #0d6efd; font-weight: 500; }
    a:hover { text-decoration: underline; }
  </style>
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <div class="forms-wrapper">

      {{-- Flash success message --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- LOGIN FORM --}}
      <form id="loginForm" class="auth-form" method="POST" action="{{ route('auth.login') }}">
        @csrf
        <h2 class="text-center mb-4">Sign In</h2>

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input name="username" type="text" class="form-control" placeholder="Enter your username" value="{{ old('username') }}" />
          @error('username') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control" placeholder="Enter your password" />
          @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
        <p class="text-center mt-3">
          Don’t have an account? <a href="#" id="showRegister">Register here</a>
        </p>
      </form>

      {{-- REGISTER FORM --}}
      <form id="registerForm" class="auth-form d-none" method="POST" action="{{ route('auth.register') }}">
        @csrf
        <h2 class="text-center mb-4">Sign Up</h2>

        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input name="fullname" type="text" class="form-control" placeholder="Enter your name" value="{{ old('fullname') }}" />
          @error('fullname') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input name="username" type="text" class="form-control" placeholder="Enter your username" value="{{ old('username') }}" />
          @error('username') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control" placeholder="Create a password" />
          @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Confirm Password</label>
          <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm your password" />
        </div>

        <button type="submit" class="btn btn-success w-100">Register</button>
        <p class="text-center mt-3">
          Already have an account? <a href="#" id="showLogin">Login here</a>
        </p>
      </form>

    </div>
  </div>
</div>

<script>
const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");
const showRegister = document.getElementById("showRegister");
const showLogin = document.getElementById("showLogin");

// Hiển thị form register nếu có lỗi từ backend
document.addEventListener("DOMContentLoaded", () => {
    const hasRegisterError = {!! json_encode($errors->any() && old('fullname') !== null) !!};
    if(hasRegisterError){
        loginForm.classList.add("d-none");
        registerForm.classList.remove("d-none");
    }
});

// Toggle forms
showRegister.addEventListener("click", (e) => {
    e.preventDefault();
    loginForm.classList.add("d-none");
    registerForm.classList.remove("d-none");
});

showLogin.addEventListener("click", (e) => {
    e.preventDefault();
    registerForm.classList.add("d-none");
    loginForm.classList.remove("d-none");
});

// Hàm show lỗi
function showError(input, message) {
    let errorDiv = input.parentElement.querySelector(".text-danger");
    if(!errorDiv){
        errorDiv = document.createElement("div");
        errorDiv.classList.add("text-danger","mt-1");
        input.parentElement.appendChild(errorDiv);
    }
    errorDiv.innerText = message;
    input.classList.add("is-invalid");
}

// Hàm clear lỗi
function clearError(input){
    const errorDiv = input.parentElement.querySelector(".text-danger");
    if(errorDiv) errorDiv.innerText = "";
    input.classList.remove("is-invalid");
}

// Validate login form
loginForm.addEventListener("submit", (e)=>{
    let valid = true;
    const username = loginForm.querySelector("input[name='username']");
    const password = loginForm.querySelector("input[name='password']");

    [username,password].forEach(input=>clearError(input));

    if(username.value.trim() === ""){
        showError(username,"Username cannot be empty");
        valid=false;
    }

    if(password.value.trim() === ""){
        showError(password,"Password cannot be empty");
        valid=false;
    }

    if(!valid) e.preventDefault();
});

// Validate register form
registerForm.addEventListener("submit", (e)=>{
    let valid = true;
    const fullname = registerForm.querySelector("input[name='fullname']");
    const username = registerForm.querySelector("input[name='username']");
    const password = registerForm.querySelector("input[name='password']");
    const passwordConfirm = registerForm.querySelector("input[name='password_confirmation']");

    [fullname,username,password,passwordConfirm].forEach(input=>clearError(input));

    if(fullname.value.trim()===""){ showError(fullname,"Full name cannot be empty"); valid=false;}
    if(username.value.trim()===""){ showError(username,"Username cannot be empty"); valid=false;}
    if(password.value.trim()===""){ showError(password,"Password cannot be empty"); valid=false;}
    if(passwordConfirm.value.trim()===""){ showError(passwordConfirm,"Confirm password cannot be empty"); valid=false;}
    if(password.value !== "" && passwordConfirm.value !== "" && password.value !== passwordConfirm.value){
        showError(passwordConfirm,"Passwords do not match"); valid=false;
    }

    if(!valid) e.preventDefault();
});
</script>

</body>
</html>

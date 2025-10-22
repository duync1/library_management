@extends("user.main")

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card" style="min-height: 75vh;"> {{-- Chiều cao cố định vừa màn hình --}}
            <div class="card-header">
                <h4 class="card-title mb-0">User Information</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/user/profile') }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Fullname --}}
                        <div class="col-md-6 mb-3">
                            <label for="fullname" class="form-label">Full name</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                id="fullname" name="fullname" value="{{ old('fullname', Auth::user()->fullname) }}">
                            @error('fullname') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Address --}}
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', Auth::user()->address) }}">
                        </div>

                        {{-- Date of Birth --}}
                        <div class="col-md-6 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                value="{{ old('date_of_birth', Auth::user()->date_of_birth) }}">
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="">-- Select Gender --</option>
                                <option value="male" {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', Auth::user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        {{-- Current Password --}}
                        <div class="col-md-6 mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" placeholder="Enter current password">
                                <button class="btn btn-outline-secondary" type="button" id="toggleCurrent">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @error('current_password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- New Password --}}
                        <div class="col-md-6 mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
                                <button class="btn btn-outline-secondary" type="button" id="toggleNew">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="col-md-6 mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirm">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Save Information</button>
                        <button type="reset" class="btn btn-secondary ms-2">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword(inputId, btnId) {
        const input = document.getElementById(inputId);
        const btn = document.getElementById(btnId);
        btn.addEventListener('click', () => {
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            btn.querySelector('i').classList.toggle('fa-eye');
            btn.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }

    togglePassword('current_password', 'toggleCurrent');
    togglePassword('new_password', 'toggleNew');
    togglePassword('confirm_password', 'toggleConfirm');
</script>
@endsection

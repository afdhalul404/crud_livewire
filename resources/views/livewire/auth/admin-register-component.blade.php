<div>

    <div class="d-flex justify-content-center align-items-center vh-100" style="padding-top: 100px">
        <div class="card col-md-4 col-11 shadow-5-strong" style="
                background: hsla(0, 0%, 100%, 0.8);
                backdrop-filter: blur(30px)">
            <div class="card-body;">
                <div class="row d-flex justify-content-center">
                    <div class="px-4 px-md-5 py-4">
                        <h3 class="fw-bold mb-4">Buat Akun</h3>
                        <form wire:submit.prevent='register'>
                            <div class="form-outline mb-3">
                                <label class="form-label" for="user">Nama User</label>
                               <input wire:model='name' type="text" id="form2Example18" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Nama Lengkap" />
                                @error('name') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input wire:model='email' type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email" />
                                @error('email') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-2">
                               <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <input wire:model.defer='password' type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" placeholder="********" />
                                    <span class="input-icon ri-eye-line btn border" id="togglePassword"></span>
                                </div>
                                @error('password') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                               <div class="input-group">
                                    <input wire:model='confirm_password' type="password" id="confirm_password" class="form-control"
                                        placeholder="********" />
                                    <span class="input-icon ri-eye-line btn border" id="toggleConfirmPassword"></span>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block col-12 mb-1">
                                Masuk
                            </button>
                            <p class="text-center">Sudah Punya Akun? <a href="/admin/login" class="link-info">Masuk</a>
                            </p>

                            <!-- Register buttons -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.classList.remove('ri-eye-line');
        this.classList.add('ri-eye-off-line');
        } else {
        passwordInput.type = 'password';
        this.classList.remove('ri-eye-off-line');
        this.classList.add('ri-eye-line');
        }
        });
        
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        var confirmPasswordInput = document.getElementById('confirm_password');
        if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        this.classList.remove('ri-eye-line');
        this.classList.add('ri-eye-off-line');
        } else {
        confirmPasswordInput.type = 'password';
        this.classList.remove('ri-eye-off-line');
        this.classList.add('ri-eye-line');
        }
        });
    </script>
@endpush
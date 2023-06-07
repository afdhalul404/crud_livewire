<div>
    <div class="d-flex align-items-center px-md-5">
        <form wire:submit.prevent='login' class="col-12">
            <div class="form-outline mt-3">
                <label class="form-label" for="email">Email<span class="text-danger fw-bolder">*</span></label>
                <input wire:model.defer='email' type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" />
                @error('email') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
            </div>
            <div class="form-outline mb-2 mt-4">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <input wire:model.defer='password' type="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="********" />
                        <span class="input-icon ri-eye-line btn border" id="togglePassword"></span>
                    </div>
                    @error('password') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
                </div>
                <div class="form-outline mb-4">
                <div class="form-check">
                    <input wire:model='remember' class="form-check-input" type="checkbox" value="" id="remember">
                    <label class="form-check-label" for="remember">
                    Ingat saya
                    </label>
                </div>
             </div>
             <button class="btn col-12 btn-primary" type="submit">Masuk</button>
             <p class="text-center pt-3 pb-3">Belum Punya Akun? <a href="/register" class="link-info">Daftar</a></p>
         </form>
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
    </script>
@endpush

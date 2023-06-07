<div>
    <div class="d-flex align-items-center px-md-5">
        <form wire:submit.prevent='register' class="col-12">
            <div class="form-outline mt-3">
                <label class="form-label" for="role">Masuk Sebagai<span class="text-danger fw-bolder">*</span></label>
                <select wire:model='role' name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                    <option value="" class="">Pilih</option>
                    <option value="dosen">Dosen</option>
                    <option value="mahasiswa">Mahasiswa</option>
                </select>
                @error('role') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
            </div>
            <div class="form-outline mt-3">
                <label class="form-label" for="name">Nama Lengkap<span class="text-danger fw-bolder">*</span></label>
                <input wire:model='name' type="text" id="form2Example18" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" />
                @error('name') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
            </div>
            <div class="form-outline mt-3">
                <label class="form-label" for="email">Email<span class="text-danger fw-bolder">*</span></label>
                <input wire:model='email' type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" />
                @error('email') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
            </div>
            <div class="form-outline mt-3">
                <label class="form-label" for="identity">NIM/NIP<span class="text-danger fw-bolder">*</span></label>
                <input wire:model='identity' name="identity" type="text" id="identity" class="form-control @error('identity') is-invalid @enderror" placeholder="NIM/NIP" />
                @error('identity') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
            </div>
            <div class="form-outline mt-3">
                <label class="form-label" for="tahun_masuk">Tahun Masuk<span class="text-danger fw-bolder">*</span></label>
                <input wire:model='tahun_masuk' type="text" id="tahun_masuk" name="tahun_masuk" class="form-control @error('tahun_masuk') is-invalid @enderror" placeholder="Tahun Masuk" />
                @error('tahun_masuk') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
            </div>
            <div class="form-outline mt-3">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <input wire:model.defer='password' type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" />
                    <span class="input-icon ri-eye-line btn border" id="togglePassword"></span>
                </div>
                @error('password') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
            </div>
            <div class="form-outline mb-4 mt-3">
                <label class="form-label" for="confirm_password">Konfirmasi Password</label>
                <div class="input-group">
                    <input wire:model='confirm_password' type="password" id="confirm_password" class="form-control"
                        placeholder="********" />
                    <span class="input-icon ri-eye-line btn border" id="toggleConfirmPassword"></span>
                </div>
            </div>
                  
            <button class="btn col-12 btn-primary mt-4 mt-md-0" type="submit">Daftar</button>
            <p class="text-center pt-4 pb-4">Sudah Punya Akun? <a href="/login" class="link-info">Masuk</a></p>
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

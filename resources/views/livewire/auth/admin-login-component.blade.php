<div>
    <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 35vh; background-color: #003487; position: absolute; padding-bottom: 100px">
        <img src="{{ asset('img/logo.png') }}" alt="" width="200px"></div>
    <div class="d-flex justify-content-center align-items-center vh-100" style="padding-top: 60px">
        <div class="card col-md-4 col-11 shadow-5-strong" style="
                background: hsla(0, 0%, 100%, 0.8);
                backdrop-filter: blur(30px)">
            <div class="card-body;">
                <div class="row d-flex justify-content-center">
                    <div class="px-4 px-md-5 py-4">
                        <h3 class="fw-bold mb-4">Masuk ke Akun Anda</h3>
                        <form wire:submit.prevent='login'>
                            <!-- Email input -->
                            <div class="form-outline mb-3">
                               <label class="form-label" for="email">Email<span class="text-danger fw-bolder">*</span></label>
                                <input wire:model.defer='email' type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email" />
                                @error('email') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
                            </div>
        
                            <!-- Password input -->
                            <div class="form-outline mb-3">
                               <label class="form-label" for="password">Password</label>
                                <div class="input-group">
                                    <input wire:model.defer='password' type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" placeholder="********" />
                                    <span class="input-icon ri-eye-line btn border" id="togglePassword"></span>
                                </div>
                                @error('password') <span class="text-danger note fst-italic">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-check d-flex mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" />
                                <label class="form-check-label" for="form2Example33">
                                    Ingat saya
                                </label>
                            </div>

                            
                            
        
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block col-12 mb-1">
                                Masuk
                            </button>
                            <p class="text-center">Belum Punya Akun? <a href="/admin/register" class="link-info">Daftar</a></p>
        
                            <!-- Register buttons -->
        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

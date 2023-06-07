<div>
   <div class="container">
      <div class="card border-0 rounded-0 shadow-lg mb-5 bg-body rounded"
         style="background-color: #f0f0f0; box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff;">
         <div class="card-body justify-content-between flex-column flex-md-row col-12" style="z-index: 2">
            <!-- View: search.blade.php -->
            <form action="/search" method="get" class="d-flex flex-column flex-md-row gap-1 gap-md-5 col-12">
               {{-- @csrf --}}
               <div class="select-box position-relative col-md-3">
                  <div class="options-container position-absolute col-12">
                     <div class="option">
                        <input type="radio" class="radio" id="buku" name="category" value="buku" />
                        <label for="buku">Buku</label>
                     </div>

                     <div class="option">
                        <input type="radio" class="radio" id="kp" name="category" value="kp" />
                        <label for="kp">Laporan Kp</label>
                     </div>

                     <div class="option">
                        <input type="radio" class="radio" id="skripsi" name="category" value="skripsi" />
                        <label for="skripsi">Skripsi</label>
                     </div>
                  </div>

                  <div class="selected d-flex justify-content-between align-items-center col-12">
                     <span>Pilih</span>
                     <i class="ri-arrow-down-s-line"></i>
                  </div>
               </div>
               <div class="d-none d-md-block border-start"></div>
               <div class="search d-flex align-items-center col-md-8">
                  <i class="ri-search-2-line"></i>
                  <input type="search" id="form1" class="form-input border-0" name="search"
                     placeholder="Masukan Kata Kunci" />
               </div>
               <button type="submit" class="d-none"></button>
            </form>
         </div>
      </div>
   </div>
</div>
@push('scripts')
    <script>
      const selected = document.querySelector(".selected");
      const optionsContainer = document.querySelector(".options-container");
      const optionsList = document.querySelectorAll(".option");
      
      selected.addEventListener("click", () => {
      optionsContainer.classList.toggle("active");
      selected.classList.toggle("active");
      
      // Putar ikon saat dropdown aktif
      const icon = selected.querySelector("i");
      if (optionsContainer.classList.contains("active")) {
      icon.style.transform = "rotate(180deg)";
      } else {
      icon.style.transform = "rotate(0deg)";
      }
      });
      
      optionsList.forEach((o) => {
      o.addEventListener("click", () => {
      selected.innerHTML = o.querySelector("label").innerHTML;
      optionsContainer.classList.remove("active");
      selected.classList.remove("active");
      
      // Tambahkan kembali ikon setelah item terpilih
      const icon = document.createElement("i");
      icon.classList.add("ri-arrow-down-s-line");
      selected.appendChild(icon);
      });
      });
    </script>
@endpush
<div>
   <div class="container" style="z-index: 999">
      <div class="card border-0 rounded-0 shadow-lg mb-5 bg-body rounded"
         style="background-color: #f0f0f0; box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff;">
         <div class="card-body justify-content-between flex-column flex-md-row col-12" style="z-index: 999">
            <!-- View: search.blade.php -->
            <form action="/search" method="get" class="d-flex flex-column flex-md-row gap-1 gap-md-5 col-12">
               {{-- @csrf --}}
               <div class="col-md-4 col-12 d-flex gap-1">
                  <div class="select-box position-relative col-6 col-md-7">
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
                        <span style="font-size: 13px">Pilih</span>
                        <i class="ri-arrow-down-s-line"></i>
                     </div>
                  </div>

                 <div class="select-box position-relative col-6">
                  <div class="options-container position-absolute col-12">
                     <div class="option">
                        <input type="radio" class="radio" id="judul" name="filter" value="judul" />
                        <label for="judul">Judul</label>
                     </div>
                     <div class="option">
                        <input type="radio" class="radio" id="penulis" name="filter" value="penulis"  />
                        <label for="penulis">Nama Penulis</label>
                     </div>
                     <div class="option">
                        <input type="radio" class="radio" id="tahun" name="filter" value="tahun" />
                        <label for="tahun">Tahun Terbit</label>
                     </div>
                  </div>
                  <div class="selected d-flex justify-content-between align-items-center col-12">
                     <div class="d-flex align-items-center gap-2">
                        <i class="ri-equalizer-line" style="font-size: 15px"></i>
                        <span style="font-size: 13px">Pilih</span>
                     </div>
                  </div>
               </div>
            </div>

               <div class="d-none d-md-block border-start"></div>
               
               <div class="search d-flex align-items-center col-md-7">
                  <i class="ri-search-2-line"></i>
                  <input type="search" id="form1" class="form-input border-0" name="search"
                     placeholder="Masukan Kata Kunci" style="background-color: rgba(0, 0, 0, 0);"/>
               </div>
               <button type="submit" class="d-none"></button>
            </form>
         </div>
      </div>
   </div>
</div>
@push('scripts')
   <script>
      // Dropdown pertama
      const selected1 = document.querySelector(".select-box:nth-of-type(1) .selected");
      const optionsContainer1 = document.querySelector(".select-box:nth-of-type(1) .options-container");
      const optionsList1 = document.querySelectorAll(".select-box:nth-of-type(1) .option");
   
      selected1.addEventListener("click", () => {
         optionsContainer1.classList.toggle("active");
         selected1.classList.toggle("active");
   
         // Putar ikon saat dropdown aktif
         const icon1 = selected1.querySelector("i");
         if (optionsContainer1.classList.contains("active")) {
            icon1.style.transform = "rotate(180deg)";
         } else {
            icon1.style.transform = "rotate(0deg)";
         }
      });
   
      optionsList1.forEach((o) => {
         o.addEventListener("click", () => {
            selected1.innerHTML = o.querySelector("label").innerHTML;
            optionsContainer1.classList.remove("active");
            selected1.classList.remove("active");
   
            // Tambahkan kembali ikon setelah item terpilih
            const icon1 = document.createElement("i");
            icon1.classList.add("ri-arrow-down-s-line");
            selected1.appendChild(icon1);
         });
      });
   
      // Dropdown kedua
      const selected2 = document.querySelector(".select-box:nth-of-type(2) .selected");
      const optionsContainer2 = document.querySelector(".select-box:nth-of-type(2) .options-container");
      const optionsList2 = document.querySelectorAll(".select-box:nth-of-type(2) .option");
      
      selected2.addEventListener("click", () => {
      optionsContainer2.classList.toggle("active");
      selected2.classList.toggle("active");
      
      // Putar ikon saat dropdown aktif
      const icon2 = selected2.querySelector("i");
      if (optionsContainer2.classList.contains("active")) {
      icon2.style.transform = "rotate(180deg)";
      } else {
      icon2.style.transform = "rotate(0deg)";
      }
      });
      
      optionsList2.forEach((o) => {
      o.addEventListener("click", () => {
      const label = o.querySelector("label").innerHTML;
      
      // Hapus ikon sebelumnya
      const prevIcon = selected2.querySelector("i");
      if (prevIcon) {
      prevIcon.remove();
      }
      
      // Tambahkan teks dan ikon yang baru
      const icon2 = document.createElement("i");
      icon2.classList.add("ri-equalizer-line");
      icon2.style.fontSize = "15px";
      
      selected2.innerHTML = "";
      selected2.appendChild(icon2);
      
      const span = document.createElement("span");
      span.style.fontSize = "14px";
      span.innerHTML = label;
      
      selected2.appendChild(span);
      
      optionsContainer2.classList.remove("active");
      selected2.classList.remove("active");
      });
      });
   </script>
@endpush
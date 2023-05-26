// const optionMenu = document.querySelector(".select-menu"),
//     selectBtn = optionMenu.querySelector(".select-btn"),
//     options = optionMenu.querySelectorAll(".option"),
//     sBtn_text = optionMenu.querySelector(".sBtn-text");

// selectBtn.addEventListener("click", () =>
//     optionMenu.classList.toggle("active")
// );

// options.forEach((option) => {
//     option.addEventListener("click", () => {
//         let selectedOption = option.querySelector(".option-text").innerText;
//         sBtn_text.innerText = selectedOption;

//         optionMenu.classList.remove("active");
//     });
// });

// // Tambahkan event listener untuk menutup dropdown saat mengklik di luar dropdown
// window.addEventListener('click', function(e) {
//   const dropdown = document.querySelector('.dropdown');
//   if (!dropdown.contains(e.target)) {
//     const dropdownMenu = dropdown.querySelector('.dropdown-menu');
//     dropdownMenu.style.display = 'none';
//   }
// });

// // Tambahkan event listener untuk membuka atau menutup dropdown saat mengklik dropdown
// const dropdownLinks = document.querySelectorAll('.dropdown > a');
// for (let i = 0; i < dropdownLinks.length; i++) {
//   dropdownLinks[i].addEventListener('click', function(e) {
//     e.preventDefault();
//     const dropdownMenu = this.nextElementSibling;
//     if (dropdownMenu.style.display === 'block') {
//       dropdownMenu.style.display = 'none';
//     } else {
//       dropdownMenu.style.display = 'block';
//     }
//   });
// }


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

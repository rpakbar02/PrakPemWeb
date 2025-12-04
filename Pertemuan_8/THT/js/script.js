document.addEventListener('DOMContentLoaded', function() {
    
    const contactForm = document.getElementById('contactForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const messageInput = document.getElementById('message');
    const successMessage = document.getElementById('success-message');

    // A. Pencegahan Reload (Event Handling)
    contactForm.addEventListener('submit', function(event) {
        // Mencegah aksi default form (reload halaman)
        event.preventDefault();
        resetValidationErrors();
        successMessage.style.display = 'none';

        // B. Validasi Input
        let isValid = true;

        if (nameInput.value.trim() === "") {
            showError(nameInput, "Nama tidak boleh kosong.");
            isValid = false;
        }

        if (emailInput.value.trim() === "") {
            showError(emailInput, "Email tidak boleh kosong.");
            isValid = false;
        }

        if (messageInput.value.trim() === "") {
            showError(messageInput, "Pesan tidak boleh kosong.");
            isValid = false;
        }

        // Skenario Berhasil (Success State)
        if (isValid) {
            successMessage.innerText = "Pesan berhasil dikirim!";
            successMessage.style.display = 'block';

            contactForm.reset();
        }
    });

    // Fungsi helper untuk menampilkan error sesuai instruksi
    function showError(inputElement, message) {
        inputElement.classList.add('input-error');

        const errorElement = document.createElement('small');
        errorElement.innerText = message;
        errorElement.classList.add('error-text');
        
        inputElement.parentElement.appendChild(errorElement);
    }

    // Fungsi untuk membersihkan error sebelum validasi ulang
    function resetValidationErrors() {
        const inputs = document.querySelectorAll('.form-group input, .form-group textarea');
        inputs.forEach(input => {
            input.classList.remove('input-error');
        });

        const errorMessages = document.querySelectorAll('.error-text');
        errorMessages.forEach(msg => {
            msg.remove();
        });
    }
});
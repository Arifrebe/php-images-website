const imageInput = document.getElementById('image-input');
    const imagePreview = document.getElementById('image-preview');
    const customFileLabel = document.querySelector('.custom-file-label');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
            customFileLabel.textContent = file.name;
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
            customFileLabel.textContent = 'Choose Image';
        }
});

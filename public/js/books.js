$(function () {
    $('#datepicker').datetimepicker({
        format: 'YYYY-MM-DD', // Customize the date format as needed
    });

    $('#bookForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function(result) {
                if(result.success) {
                    window.location = result.redirectUrl;
                } else {
                    toastr.error("Something");
                }
            },
            error: function(er){
                let res = JSON.parse(er.responseText);
                $.each(res.errors, function (key, val) {
                    toastr.error(val[0]);
                });
            }
        });
    });
});

// Function to handle image selection and display
document.getElementById('imageInput').addEventListener('change', function() {
    var selectedImage = document.getElementById('selectedImage');
    var imagePreview = document.getElementById('imagePreview');

    var file = this.files[0]; // Get the selected file
    if (file) {
        // Check if the selected file is an image
        if (file.type.match('image.*')) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Set the source of the <img> element to the selected image
                selectedImage.src = e.target.result;
                imagePreview.style.display = 'block'; // Display the image preview
            };

            reader.readAsDataURL(file);
        } else {
            alert('Please select a valid image file.');
        }
    }
});

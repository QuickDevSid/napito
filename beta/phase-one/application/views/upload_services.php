<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel File Upload</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h3>Upload Excel File</h3>

    <!-- Form for File Upload -->
    <form id="upload_form" enctype="multipart/form-data">
        <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv" required>
        <button type="submit" id="upload_button">Upload</button>
    </form>

    <div id="response_message"></div> <!-- To show success or error message -->

    <script>
        $(document).ready(function () {
            // Handle form submission
            $('#upload_form').on('submit', function (e) {
                e.preventDefault();  // Prevent default form submission

                var formData = new FormData(this);

                $.ajax({
                    url: '<?=base_url();?>Upload_controller/upload_services_ajax',  // URL to controller method
                    type: 'POST',
                    data: formData,
                    contentType: false,  // Important for file uploads
                    processData: false,  // Important for file uploads
                    success: function (response) {
                        // Display the server response (success or error message)
                        $('#response_message').html(response);
                    },
                    error: function () {
                        $('#response_message').html('<p style="color: red;">An error occurred during the upload process.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>

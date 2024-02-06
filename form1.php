<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Form with Validation and Pagination</title>
    <style>
        .error {
            color: red;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: skyblue;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        #myForm {
            text-align: center;
            box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.1);
            width: 50%;
            padding: 20px;
            margin: 5% auto;
            border-radius: 10px;
            background-color: #fff;
        }

        label {
            display: inline-block;
            width: 30%;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            display: inline-block;
            width: 65%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #csv-icon {
            display: block;
            text-align: left;
            margin-top: 20px;
            display:inline;
        }
    </style>
</head>
<body>

<h2>Submit Form</h2>

<!-- CSV Icon for Export -->


<form id="myForm" enctype="multipart/form-data">
    <div id="message"></div>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required minlength="5" maxlength="10">
    <br><br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required minlength="5" maxlength="50">
    <br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="mobile">Mobile No:</label>
    <input type="text" id="mobile" name="mobile" required pattern="[0-9]{10}">
    <br><br>
    <label for="image">Profile Image:</label>
    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" required>
    
    <br><br>
    <input type="submit" value="Submit"> 
    <div>
    <span id="csv-icon">
    <h2>Download Here !!!</h2>
    <a href="process_form.php?export=csv"><img src="https://i.ibb.co/HpmT5hC/hhj.webp" alt="CSV Icon" width="50"></a>
    
    </span>
    </div>
</div>
</form>

<!-- Pagination Section -->
<center>
    <div id="pagination">
        <!-- Pagination will be loaded here dynamically -->
    </div>
</center>

<script>
    $(document).ready(function(){
        $('#myForm').submit(function(e){
            e.preventDefault(); // Prevent default form submission

            // Create FormData object to send form data
            var formData = new FormData(this);

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: 'process_form.php', // PHP file for server-side processing
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    // Handle success response
                    $('#message').html('<div style="color: green;">' + response + '</div>');
                    // Clear form fields
                    $('#myForm')[0].reset();
                    // Refresh pagination and data
                    $('#pagination').load(location.href + ' #pagination');
                },
                error: function(xhr, status, error){
                    // Handle error response
                    $('#message').html('<div style="color: red;">' + xhr.responseText + '</div>');
                }
            });
        });
    });
</script>

</body>
</html>

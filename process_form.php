<?php
include("form.php");

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    // Move uploaded image to the desired location
    move_uploaded_file($tmp_name, "./upload/$image");

    // Prepare SQL query to insert data into the database
    $sql = "INSERT INTO users (name, address, email, mobile, image) 
            VALUES ('$name', '$address', '$email', '$mobile', '$image')";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        echo "Form submitted successfully!";
    } else {
        echo "ERROR: " . mysqli_error($conn);
    }

    // Store form data into CSV file
    $data = array($name, $address, $email, $mobile, $image);
    $file = fopen('data.csv', 'a');
    fputcsv($file, $data);
    fclose($file);

    exit; // Exit after processing form submission
} elseif (isset($_GET['export']) && $_GET['export'] == 'csv') {
    // Export data to CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="exported_data.csv"');

    $output = fopen('php://output', 'w');

    $header = array("Name", "Address", "Email", "Mobile", "Image");
    fputcsv($output, $header);

    $data = file('data.csv');
    foreach ($data as $line) {
        $row = str_getcsv($line);
        fputcsv($output, $row);
    }

    fclose($output);

    exit; // Exit after exporting data to CSV
} else {
    // If the form is not submitted via POST, return an error
    echo "Method not allowed.";
    http_response_code(405); // Method Not Allowed
    exit();
}
?>
``

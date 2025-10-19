<?php
// Add shortcode to display form
add_shortcode('user_card', 'user_card_form');

function user_card_form()
{
    ob_start();
?>
<div class="container  my-3 py-5 px-3 shadow p-3 mb-5 rounded">'
    <h1>Download ID Card</h1>
    <form action="" class="my_news_form" method="POST">
        <div class="form-group row">
            <div class="col-md-6">
                <label class="h6" for="mobile_number">Mobile Number:</label>
                <input type="text" class="form-control" name="mobile_number" id="mobile_number" required>
            </div>
            <div class="col-md-6">
                <label class="h6" for="date_of_birth">Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required>
            </div>
        </div>

        <input type="submit" name="cardsubmit" class="btn" value="Download ID Card">
    </form>
</div>
<?php
    return ob_get_clean();
}

global $wpdb; // add this line to access WordPress database

if (isset($_POST["cardsubmit"])) {
    ob_start(); // start output buffering
    global $wpdb;
    // Get the ID card image from the database
    $table_name1 = $wpdb->prefix . "my_news_admin"; // add prefix to table name
    $sql1 = "SELECT id_card_image FROM $table_name1 ORDER BY id DESC LIMIT 1"; // get the last row ordered by ID in descending order and limit the result to 1 row
    $result2 = $wpdb->get_results($sql1, ARRAY_A); // use get_results to get data as associative array
    if (!empty($result2)) {
        $row2 = $result2[0]; // get first row from resultset
        $id_card_image = $row2["id_card_image"];
    }

    $mnumber = esc_sql($_POST["mobile_number"]);
    $mnumber = str_replace("+91", "", $mnumber);
    $mnumber = str_replace(array("0", "91"), "", $mnumber);
    $dob = esc_sql($_POST["date_of_birth"]);
    $table_name = $wpdb->prefix . "news_user"; // add prefix to table name
    $sql = "SELECT * FROM $table_name WHERE mobile_number='$mnumber' AND date_of_birth='$dob' ";
    $result = $wpdb->get_results($sql, ARRAY_A); // use get_results to get data as associative array
    if (!empty($result)) {
        $row = $result[0]; // get first row from resultset
        // perform actions on $row as needed
    } else {
        // handle case where query doesn't return any rows
        echo "<script>alert('There is an error')</script>";
    }

    if ($row != NULL && $row['status'] !== 'pending' && $row['status'] !== 'rejected') {
    $image_path = plugin_dir_path(__FILE__) . $id_card_image; // Replace with your image file path
    $image_info = getimagesize($image_path); // Get image info
    $image_width = $image_info[0]; // Get image width
    $image_height = $image_info[1]; // Get image height

    // Create a new image with the same dimensions as the original image
    $image = imagecreatetruecolor($image_width, $image_height);

    // Load the original image
    $image_mime_type = mime_content_type($image_path);
    if ($image_mime_type === 'image/jpeg' || $image_mime_type === 'image/jpg') {
        $original_image = imagecreatefromjpeg($image_path);
    } elseif ($image_mime_type === 'image/png') {
        $original_image = imagecreatefrompng($image_path);
    } elseif ($image_mime_type === 'image/gif') {
        $original_image = imagecreatefromgif($image_path);
    }

    imagecopy($image, $original_image, 0, 0, 0, 0, $image_width, $image_height);

    $pp = $row["profile_picture"];
    $upload_dir = wp_upload_dir();
    $profile_picture_path = $upload_dir['path'] . '/' . basename($pp);
    if (file_exists($profile_picture_path)) {
        $pimage_mime_type = mime_content_type($profile_picture_path);
        if ($pimage_mime_type === 'image/jpeg' || $pimage_mime_type === 'image/jpg') {
            $profile_picture = imagecreatefromjpeg($profile_picture_path);
        } elseif ($pimage_mime_type === 'image/png') {
            $profile_picture = imagecreatefrompng($profile_picture_path);
        } elseif ($pimage_mime_type === 'image/gif') {
            $profile_picture = imagecreatefromgif($profile_picture_path);
        }
    } else {
        // Default fallback image or error handling
        $profile_picture = null; // Initialize the variable
    }

    if ($profile_picture) {
        // Scale the profile picture to desired width and height
        $profile_picture = imagescale($profile_picture, 200, 200); // Adjust the width and height as needed
    }

        // Copy the profile picture onto the new image
        if ($profile_picture !== null) {
            imagecopy($image, $profile_picture, 144, 160, 0, 0, 200, 200); // Adjust the parameters
            imagedestroy($profile_picture);
        }



        // Set the text color
        $text_color = imagecolorallocate($image, 0, 0, 0); // black

        // Set the font file path
        $font_path = plugin_dir_path(__FILE__) . 'font/arial.ttf'; // Replace with the path to your font file

        // Set the font size
        $font_size = 12;

        // Add the mobile number to the image
        imagettftext($image, $font_size, 0, 260, 415, $text_color, $font_path,  $row["name"]);
        imagettftext($image, $font_size, 0, 260, 445, $text_color, $font_path,  $row["post"]);
        imagettftext($image, $font_size, 0, 260, 475, $text_color, $font_path,  $row["work_area"]);
        imagettftext($image, $font_size, 0, 260, 507, $text_color, $font_path,  $row["date_of_birth"]);
        imagettftext($image, $font_size, 0, 260, 535, $text_color, $font_path,  $row["aadhaar_number"]);
        imagettftext($image, $font_size, 0, 260, 565, $text_color, $font_path,  $row["mobile_number"]);
        imagettftext($image, $font_size, 0, 260, 600, $text_color, $font_path,  $row["unique_number"]);

        // Set appropriate image header
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="idcard.jpg"'); // Specify the filename for the downloaded image

        // Output the image to the browser
        imagejpeg($image);


        // Clean up resources
        imagedestroy($image);
        imagedestroy($original_image);
        exit; // exit to prevent any further output or header statements
    } elseif ($row["status"] == "pending") {
        echo "<script>alert('Your request is pending')</script>";
    } else {
        echo "<script>alert('Please apply for the card')</script>";
    }
}
?>
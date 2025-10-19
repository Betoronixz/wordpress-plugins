<h1 class="text-center">Upload image for ID card</h1>
<form action="" class="mt-5" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-6">
            <label class="h6" for="name">Upload image for ID card:</label>
            <input type="file" accept=".jpg,.jpeg,.png" name="id_card_image" class="form-control" required>
        </div>
    </div>
    <input type="submit" name="idimage" class="my-3 btn btn-lg w-50 btn-success" id="">
</form>

<?php

if (isset($_POST["idimage"])) {
    global $wpdb;
    $id_card_image = $_FILES["id_card_image"];

    $id_card_image_path = '';
    if ($id_card_image['name']) {
        $upload_dir = plugin_dir_path(__FILE__);
        $id_card_image_name = basename($id_card_image['name']);
        $id_card_image_path = $upload_dir . '/' . $id_card_image_name;
        move_uploaded_file($id_card_image['tmp_name'], $id_card_image_path);
    }

    // inserting image
    $table_name = $wpdb->prefix . "my_news_admin";
    $wpdb->insert($table_name, array("id_card_image" => $id_card_image_name));
}

?>
<div class="idcard" style="margin-top: 30px;">
    <?php
    echo "<h4>Current image for id card</h4>";
    global $wpdb;
    // Get the ID card image from the database
    $table_name1 = $wpdb->prefix . "my_news_admin"; // add prefix to table name
    $sql1 = "SELECT id_card_image FROM $table_name1 ORDER BY id DESC LIMIT 1"; // get the last row ordered by ID in descending order and limit the result to 1 row
    $result2 = $wpdb->get_results($sql1, ARRAY_A); // use get_results to get data as associative array
    if (!empty($result2)) {
        $row2 = $result2[0]; // get first row from resultset
        $id_card_image = $row2["id_card_image"];
        echo '<img src="' . plugin_dir_url(__FILE__) . $id_card_image . '"  width="500px">';
    } else {
        echo "Please Upload image";
    }
    ?>
</div>
<hr>
<div>
    <h1 class="text-center">Upload Image for QR</h1>
    <form action="" class="mt-5" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-6 ">
                <label class="h6" for="name">Upload QR Image:</label>
                <input type="file" accept=".jpg,.jpeg,.png" name="id_card_image" class="form-control" required>
            </div>
        </div>
        <input type="submit" value="Upload" name="idqr" class="btn btn-success btn-lg w-50 my-3" id="">
    </form>

    <?php if (isset($_POST["idqr"])) {
        global $wpdb;
        $id_card_image = $_FILES["id_card_image"];

        $id_card_image_path = "";
        if ($id_card_image["name"]) {
            $upload_dir = plugin_dir_path(__FILE__);
            $id_card_image_name = basename($id_card_image["name"]);
            $id_card_image_path =
                $upload_dir . "/" . $id_card_image_name;
            move_uploaded_file(
                $id_card_image["tmp_name"],
                $id_card_image_path
            );
        }

        // inserting image
        $table_name = $wpdb->prefix . "id_user_qr";
        $wpdb->insert($table_name, [
            "id_card_image" => $id_card_image_name,
        ]);
        echo '<script>setTimeout(function() { document.querySelector("#qr").click(); }, 500);</script>';
    } ?>
    <div class="idcard" style="margin-top: 30px;">
        <?php
        echo "<h4>Current image for QR</h4>";
        global $wpdb;
        // Get the ID card image from the database
        $table_name8 = $wpdb->prefix . "id_user_qr"; // add prefix to table name
        $sql1 = "SELECT id_card_image FROM $table_name8 ORDER BY id DESC LIMIT 1"; // get the last row ordered by ID in descending order and limit the result to 1 row
        $result2 = $wpdb->get_results($sql1, ARRAY_A); // use get_results to get data as associative array
        if (!empty($result2)) {
            $row2 = $result2[0]; // get first row from resultset
            $id_card_image = $row2["id_card_image"];
            echo '<img src="' .
                plugin_dir_url(__FILE__) .
                $id_card_image .
                '"  width="500px">';
        } else {
            echo "Please Upload image";
        }
        ?>
    </div>

</div>
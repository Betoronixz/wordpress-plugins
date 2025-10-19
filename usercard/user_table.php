<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body bg-info">Admin Panel</div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">Users</div>
      <div class="panel-body">
        <table id="example" class="display">
          <thead>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Father's Name</th>
              <th>DOB</th>
              <th>State</th>
              <th>District</th>
              <th>Pincode</th>
              <th>Address</th>
              <th>Mobile Number</th>
              <th>Post</th>
              <th>Work Area</th>
              <th>Aadhaar Number</th>
              <th>Payment Screenshot</th>
              <th>Aadhaar Card</th>
              <th>Profile Picture</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            global $wpdb;
            $table_name = $wpdb->prefix . "news_user";
            $result = $wpdb->get_results("SELECT * FROM $table_name");
            if (!empty($result)) {
              foreach ($result as $r) {
            ?>
                <tr>
                  <td><?php echo $r->id ?></td>
                  <td><?php echo $r->name ?></td>
                  <td><?php echo $r->email ?></td>
                  <td><?php echo $r->father_name ?></td>
                  <td><?php echo $r->date_of_birth ?></td>
                  <td><?php echo $r->state ?></td>
                  <td><?php echo $r->district ?></td>
                  <td><?php echo $r->pincode ?></td>
                  <td><?php echo $r->address ?></td>
                  <td><?php echo $r->mobile_number ?></td>
                  <td><?php echo $r->post ?></td>
                  <td><?php echo $r->work_area ?></td>
                  <td><?php echo $r->aadhaar_number ?></td>
                  <td><a href="<?php echo wp_upload_dir()['url'] . '/' . basename($r->payment_ss_picture) ?>" download>Download</a></td>
                  <td><a href="<?php echo wp_upload_dir()['url'] . '/' . basename($r->adhar_card_picture) ?>" download>Download</a></td>
                  <td><a href="<?php echo wp_upload_dir()['url'] . '/' . basename($r->profile_picture) ?>" download>Download</a></td>
                  <td>
                    <form method="POST">
                      <select name="status">
                        <option value="pending" <?php if ($r->status == 'pending') echo 'selected' ?>>Pending</option>
                        <option value="approved" <?php if ($r->status == 'approved') echo 'selected' ?>>Approved</option>
                        <option value="rejected" <?php if ($r->status == 'rejected') echo 'selected' ?>>Rejected</option>
                      </select>
                      <input type="hidden" name="user_id" value="<?php echo $r->id ?>">
                      <input type="submit" name="submit_status" value="Update">
                    </form>
                  </td>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Father's Name</th>
              <th>DOB</th>
              <th>State</th>
              <th>District</th>
              <th>Pincode</th>
              <th>Address</th>
              <th>Mobile Number</th>
              <th>Post</th>
              <th>Work Area</th>
              <th>Aadhaar Number</th>
              <th>Payment Screenshot</th>
              <th>Aadhaar Card</th>
              <th>Profile Picture</th>
              <th>Status</th>
            </tr>
          </tfoot>
        </table>


      </div>
    </div>

  </div>
</div>
<?php
if (isset($_POST['submit_status'])) {
  global $wpdb;
  $table_name = $wpdb->prefix . "news_user";
  $user_id = $_POST['user_id'];
  $new_status = $_POST['status'];

  $user_data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $user_id");
  // Update the status in the database
  $wpdb->update(
    $table_name,
    array('status' => $new_status),
    array('id' => $user_id)
  );

  // If the status is "approved", create a WordPress user account for the user
  if ($new_status == "approved") {
    $username = $user_data->email;
    $password = wp_generate_password(12);

    // Create the user account
    $user_id = wp_create_user($username, $password, $user_data->email);
    if (!is_wp_error($user_id)) {
      // Set the user role to "subscriber"
      wp_update_user(array('ID' => $user_id, 'role' => 'contributor'));

      // Send an email to the user with their login credentials
      $to = $user_data->email;
      $subject = 'Your login credentials for ' . get_bloginfo('name');
      $message = 'Your username is: ' . $username . "\n\n";
      $message .= 'Your password is: ' . $password . "\n\n";
      $message .= 'You can log in at ' . site_url('wp-login.php');
      wp_mail($to, $subject, $message);
    }
  }

  // Update the user's status in the database
  $wpdb->update(
    $table_name,
    array('status' => $new_status),
    array('id' => $user_id)
  );
}

?>
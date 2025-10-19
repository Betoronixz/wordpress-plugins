<?php
require_once(ABSPATH . 'wp-includes/pluggable.php');
// Start session to access alert message
session_start();



// Add shortcode to display form
add_shortcode('mynews_form', 'mynews_display_form');

function mynews_display_form()
{
    ob_start();
?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <div class="container shadow p-3 mb-5 bg-white rounded">
        <?php
        // Check if alert message is set and display it
        if (isset($_SESSION['alert_message'])) {
            echo "<b class='text-success'>" . $_SESSION['alert_message'] . "</b>";
            // Unset the session variable to prevent it from being displayed again on subsequent page loads
            unset($_SESSION['alert_message']);
        }
        if (isset($_SESSION['m_alert_message'])) {
            echo "<b class='text-danger'>" . $_SESSION['m_alert_message'] . "</b>";
            // Unset the session variable to prevent it from being displayed again on subsequent page loads
            unset($_SESSION['m_alert_message']);
        }
        ?>

        <form action="" method="post" class="my_news_form" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="name2">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="father_name">Father's Name:</label>
                    <input type="text" id="father_name" name="father_name" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="name">Post:</label>
                    <input type="text" name="post" class="form-control" required>
                </div>
                <div class="form-group col-md-6 ">
                    <label>Work Area:</label>
                    <input type="text" name="work_area" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="mobile_number">Mobile Number:</label>
                    <input type="text" id="mobile_number" name="mobile_number" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="state">State:</label>
                    <select id="inputState" name="state" class="form-control" required>
                        <option value="">--Select state--</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="MadhyaPradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                        <option value="Delhi">Delhi</option>

                    </select>
                </div>

                <div class="form-group col-md-6 ">
                    <label for="inputDistrict">District</label>
                    <select class="form-control" name="district" id="inputDistrict">
                        <option value="">-- Select district -- </option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="pincode">Pincode:</label>
                    <input type="text" id="pincode" name="pincode" class="form-control" required>
                </div>
            </div>

            <div class="form-group ">
                <div class="form-group col-md-6">
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label>Aadhaar Number:</label>
                    <input type="number" accept=".pdf,.jpg,.jpeg,.png" name="aadhaar_number" class="form-control-file" required>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="paymnet_ss_picture">Payment Screenshot:</label>
                    <input type="file" accept=".pdf,.jpg,.jpeg,.png" maxlength="12" id="payment_ss_picture" name="payment_ss_picture" class="form-control-file" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" id="profile_picture" accept=".pdf,.jpg,.jpeg,.png" name="profile_picture" class="form-control-file">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="adhar_card_picture">Aadhaar Card Picture:</label>
                    <input type="file" id="adhar_card_picture" accept=".pdf,.jpg,.jpeg,.png" name="adhar_card_picture" class="form-control-file">
                </div>
            </div>
            <div class="col-md-12">
                <?php
                echo "<h4>image for QR Payment</h4>";
                global $wpdb;
                // Get the ID card image from the database
                $table_name8 = $wpdb->prefix . "id_user_qr"; // add prefix to table name
                $sql1 = "SELECT id_card_image FROM $table_name8 ORDER BY id DESC LIMIT 1"; // get the last row ordered by ID in descending order and limit the result to 1 row
                $result2 = $wpdb->get_results($sql1, ARRAY_A); // use get_results to get data as associative array
                if (!empty($result2)) {
                    $row2 = $result2[0]; // get first row from resultset
                    $id_card_image = $row2["id_card_image"];
                    echo '<img src="' . plugin_dir_url(__FILE__) . $id_card_image . '"  width="500px">';
                }
                ?>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 ">
                    <label class="cph6"><?php
                                        $n1 = rand(1, 20);
                                        $n2 = rand(1, 20);
                                        $sum = $n1 + $n2;
                                        echo $n1 . "+" . $n2 . "=";
                                        ?></label>
                    <input type="number" name="sum">
                    <input type="hidden" value="<?php echo  $sum ?>" name="sum2">
                </div>

            </div>

            <input type="submit" name="fsubmit" class="btn btn-lg btn-block" id="">

        </form>
    </div>


    <script>
        var AndraPradesh = ["Anantapur", "Chittoor", "East Godavari", "Guntur", "Kadapa", "Krishna", "Kurnool", "Prakasam", "Nellore", "Srikakulam", "Visakhapatnam", "Vizianagaram", "West Godavari"];
        var ArunachalPradesh = ["Anjaw", "Changlang", "Dibang Valley", "East Kameng", "East Siang", "Kra Daadi", "Kurung Kumey", "Lohit", "Longding", "Lower Dibang Valley", "Lower Subansiri", "Namsai", "Papum Pare", "Siang", "Tawang", "Tirap", "Upper Siang", "Upper Subansiri", "West Kameng", "West Siang", "Itanagar"];
        var Assam = ["Baksa", "Barpeta", "Biswanath", "Bongaigaon", "Cachar", "Charaideo", "Chirang", "Darrang", "Dhemaji", "Dhubri", "Dibrugarh", "Goalpara", "Golaghat", "Hailakandi", "Hojai", "Jorhat", "Kamrup Metropolitan", "Kamrup (Rural)", "Karbi Anglong", "Karimganj", "Kokrajhar", "Lakhimpur", "Majuli", "Morigaon", "Nagaon", "Nalbari", "Dima Hasao", "Sivasagar", "Sonitpur", "South Salmara Mankachar", "Tinsukia", "Udalguri", "West Karbi Anglong"];
        var Bihar = ["Araria", "Arwal", "Aurangabad", "Banka", "Begusarai", "Bhagalpur", "Bhojpur", "Buxar", "Darbhanga", "East Champaran", "Gaya", "Gopalganj", "Jamui", "Jehanabad", "Kaimur", "Katihar", "Khagaria", "Kishanganj", "Lakhisarai", "Madhepura", "Madhubani", "Munger", "Muzaffarpur", "Nalanda", "Nawada", "Patna", "Purnia", "Rohtas", "Saharsa", "Samastipur", "Saran", "Sheikhpura", "Sheohar", "Sitamarhi", "Siwan", "Supaul", "Vaishali", "West Champaran"];
        var Chhattisgarh = ["Balod", "Baloda Bazar", "Balrampur", "Bastar", "Bemetara", "Bijapur", "Bilaspur", "Dantewada", "Dhamtari", "Durg", "Gariaband", "Janjgir Champa", "Jashpur", "Kabirdham", "Kanker", "Kondagaon", "Korba", "Koriya", "Mahasamund", "Mungeli", "Narayanpur", "Raigarh", "Raipur", "Rajnandgaon", "Sukma", "Surajpur", "Surguja"];
        var Goa = ["North Goa", "South Goa"];
        var Gujarat = ["Ahmedabad", "Amreli", "Anand", "Aravalli", "Banaskantha", "Bharuch", "Bhavnagar", "Botad", "Chhota Udaipur", "Dahod", "Dang", "Devbhoomi Dwarka", "Gandhinagar", "Gir Somnath", "Jamnagar", "Junagadh", "Kheda", "Kutch", "Mahisagar", "Mehsana", "Morbi", "Narmada", "Navsari", "Panchmahal", "Patan", "Porbandar", "Rajkot", "Sabarkantha", "Surat", "Surendranagar", "Tapi", "Vadodara", "Valsad"];
        var Haryana = ["Ambala", "Bhiwani", "Charkhi Dadri", "Faridabad", "Fatehabad", "Gurugram", "Hisar", "Jhajjar", "Jind", "Kaithal", "Karnal", "Kurukshetra", "Mahendragarh", "Mewat", "Palwal", "Panchkula", "Panipat", "Rewari", "Rohtak", "Sirsa", "Sonipat", "Yamunanagar"];
        var HimachalPradesh = ["Bilaspur", "Chamba", "Hamirpur", "Kangra", "Kinnaur", "Kullu", "Lahaul Spiti", "Mandi", "Shimla", "Sirmaur", "Solan", "Una"];
        var JammuKashmir = ["Anantnag", "Bandipora", "Baramulla", "Budgam", "Doda", "Ganderbal", "Jammu", "Kargil", "Kathua", "Kishtwar", "Kulgam", "Kupwara", "Leh", "Poonch", "Pulwama", "Rajouri", "Ramban", "Reasi", "Samba", "Shopian", "Srinagar", "Udhampur"];
        var Jharkhand = ["Bokaro", "Chatra", "Deoghar", "Dhanbad", "Dumka", "East Singhbhum", "Garhwa", "Giridih", "Godda", "Gumla", "Hazaribagh", "Jamtara", "Khunti", "Koderma", "Latehar", "Lohardaga", "Pakur", "Palamu", "Ramgarh", "Ranchi", "Sahebganj", "Seraikela Kharsawan", "Simdega", "West Singhbhum"];
        var Karnataka = ["Bagalkot", "Bangalore Rural", "Bangalore Urban", "Belgaum", "Bellary", "Bidar", "Vijayapura", "Chamarajanagar", "Chikkaballapur", "Chikkamagaluru", "Chitradurga", "Dakshina Kannada", "Davanagere", "Dharwad", "Gadag", "Gulbarga", "Hassan", "Haveri", "Kodagu", "Kolar", "Koppal", "Mandya", "Mysore", "Raichur", "Ramanagara", "Shimoga", "Tumkur", "Udupi", "Uttara Kannada", "Yadgir"];
        var Kerala = ["Alappuzha", "Ernakulam", "Idukki", "Kannur", "Kasaragod", "Kollam", "Kottayam", "Kozhikode", "Malappuram", "Palakkad", "Pathanamthitta", "Thiruvananthapuram", "Thrissur", "Wayanad"];
        var MadhyaPradesh = ["Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar", "Balaghat", "Barwani", "Betul", "Bhind", "Bhopal", "Burhanpur", "Chhatarpur", "Chhindwara", "Damoh", "Datia", "Dewas", "Dhar", "Dindori", "Guna", "Gwalior", "Harda", "Hoshangabad", "Indore", "Jabalpur", "Jhabua", "Katni", "Khandwa", "Khargone", "Mandla", "Mandsaur", "Morena", "Narsinghpur", "Neemuch", "Panna", "Raisen", "Rajgarh", "Ratlam", "Rewa", "Sagar", "Satna",
            "Sehore", "Seoni", "Shahdol", "Shajapur", "Sheopur", "Shivpuri", "Sidhi", "Singrauli", "Tikamgarh", "Ujjain", "Umaria", "Vidisha"
        ];
        var Maharashtra = ["Ahmednagar", "Akola", "Amravati", "Aurangabad", "Beed", "Bhandara", "Buldhana", "Chandrapur", "Dhule", "Gadchiroli", "Gondia", "Hingoli", "Jalgaon", "Jalna", "Kolhapur", "Latur", "Mumbai City", "Mumbai Suburban", "Nagpur", "Nanded", "Nandurbar", "Nashik", "Osmanabad", "Palghar", "Parbhani", "Pune", "Raigad", "Ratnagiri", "Sangli", "Satara", "Sindhudurg", "Solapur", "Thane", "Wardha", "Washim", "Yavatmal"];
        var Manipur = ["Bishnupur", "Chandel", "Churachandpur", "Imphal East", "Imphal West", "Jiribam", "Kakching", "Kamjong", "Kangpokpi", "Noney", "Pherzawl", "Senapati", "Tamenglong", "Tengnoupal", "Thoubal", "Ukhrul"];
        var Meghalaya = ["East Garo Hills", "East Jaintia Hills", "East Khasi Hills", "North Garo Hills", "Ri Bhoi", "South Garo Hills", "South West Garo Hills", "South West Khasi Hills", "West Garo Hills", "West Jaintia Hills", "West Khasi Hills"];
        var Mizoram = ["Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip", "Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip"];
        var Nagaland = ["Dimapur", "Kiphire", "Kohima", "Longleng", "Mokokchung", "Mon", "Peren", "Phek", "Tuensang", "Wokha", "Zunheboto"];
        var Odisha = ["Angul", "Balangir", "Balasore", "Bargarh", "Bhadrak", "Boudh", "Cuttack", "Debagarh", "Dhenkanal", "Gajapati", "Ganjam", "Jagatsinghpur", "Jajpur", "Jharsuguda", "Kalahandi", "Kandhamal", "Kendrapara", "Kendujhar", "Khordha", "Koraput", "Malkangiri", "Mayurbhanj", "Nabarangpur", "Nayagarh", "Nuapada", "Puri", "Rayagada", "Sambalpur", "Subarnapur", "Sundergarh"];
        var Punjab = ["Amritsar", "Barnala", "Bathinda", "Faridkot", "Fatehgarh Sahib", "Fazilka", "Firozpur", "Gurdaspur", "Hoshiarpur", "Jalandhar", "Kapurthala", "Ludhiana", "Mansa", "Moga", "Mohali", "Muktsar", "Pathankot", "Patiala", "Rupnagar", "Sangrur", "Shaheed Bhagat Singh Nagar", "Tarn Taran"];
        var Rajasthan = ["Ajmer", "Alwar", "Banswara", "Baran", "Barmer", "Bharatpur", "Bhilwara", "Bikaner", "Bundi", "Chittorgarh", "Churu", "Dausa", "Dholpur", "Dungarpur", "Ganganagar", "Hanumangarh", "Jaipur", "Jaisalmer", "Jalore", "Jhalawar", "Jhunjhunu", "Jodhpur", "Karauli", "Kota", "Nagaur", "Pali", "Pratapgarh", "Rajsamand", "Sawai Madhopur", "Sikar", "Sirohi", "Tonk", "Udaipur"];
        var Sikkim = ["East Sikkim", "North Sikkim", "South Sikkim", "West Sikkim"];
        var TamilNadu = ["Ariyalur", "Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kanchipuram", "Kanyakumari", "Karur", "Krishnagiri", "Madurai", "Nagapattinam", "Namakkal", "Nilgiris", "Perambalur", "Pudukkottai", "Ramanathapuram", "Salem", "Sivaganga", "Thanjavur", "Theni", "Thoothukudi", "Tiruchirappalli", "Tirunelveli", "Tiruppur", "Tiruvallur", "Tiruvannamalai", "Tiruvarur", "Vellore", "Viluppuram", "Virudhunagar"];
        var Telangana = ["Adilabad", "Bhadradri Kothagudem", "Hyderabad", "Jagtial", "Jangaon", "Jayashankar", "Jogulamba", "Kamareddy", "Karimnagar", "Khammam", "Komaram Bheem", "Mahabubabad", "Mahbubnagar", "Mancherial", "Medak", "Medchal", "Nagarkurnool", "Nalgonda", "Nirmal", "Nizamabad", "Peddapalli", "Rajanna Sircilla", "Ranga Reddy", "Sangareddy", "Siddipet", "Suryapet", "Vikarabad", "Wanaparthy", "Warangal Rural", "Warangal Urban", "Yadadri Bhuvanagiri"];
        var Tripura = ["Dhalai", "Gomati", "Khowai", "North Tripura", "Sepahijala", "South Tripura", "Unakoti", "West Tripura"];
        var UttarPradesh = ["Agra", "Aligarh", "Allahabad", "Ambedkar Nagar", "Amethi", "Amroha", "Auraiya", "Azamgarh", "Baghpat", "Bahraich", "Ballia", "Balrampur", "Banda", "Barabanki", "Bareilly", "Basti", "Bhadohi", "Bijnor", "Budaun", "Bulandshahr", "Chandauli", "Chitrakoot", "Deoria", "Etah", "Etawah", "Faizabad", "Farrukhabad", "Fatehpur", "Firozabad", "Gautam Buddha Nagar", "Ghaziabad", "Ghazipur", "Gonda", "Gorakhpur", "Hamirpur", "Hapur", "Hardoi", "Hathras", "Jalaun", "Jaunpur", "Jhansi", "Kannauj", "Kanpur Dehat", "Kanpur Nagar", "Kasganj", "Kaushambi", "Kheri", "Kushinagar", "Lalitpur", "Lucknow", "Maharajganj", "Mahoba", "Mainpuri", "Mathura", "Mau", "Meerut", "Mirzapur", "Moradabad", "Muzaffarnagar", "Pilibhit", "Pratapgarh", "Raebareli", "Rampur", "Saharanpur", "Sambhal", "Sant Kabir Nagar", "Shahjahanpur", "Shamli", "Shravasti", "Siddharthnagar", "Sitapur", "Sonbhadra", "Sultanpur", "Unnao", "Varanasi"];
        var Uttarakhand = ["Almora", "Bageshwar", "Chamoli", "Champawat", "Dehradun", "Haridwar", "Nainital", "Pauri", "Pithoragarh", "Rudraprayag", "Tehri", "Udham Singh Nagar", "Uttarkashi"];
        var WestBengal = ["Alipurduar", "Bankura", "Birbhum", "Cooch Behar", "Dakshin Dinajpur", "Darjeeling", "Hooghly", "Howrah", "Jalpaiguri", "Jhargram", "Kalimpong", "Kolkata", "Malda", "Murshidabad", "Nadia", "North 24 Parganas", "Paschim Bardhaman", "Paschim Medinipur", "Purba Bardhaman", "Purba Medinipur", "Purulia", "South 24 Parganas", "Uttar Dinajpur"];
        var AndamanNicobar = ["Nicobar", "North Middle Andaman", "South Andaman"];
        var Chandigarh = ["Chandigarh"];
        var DadraHaveli = ["Dadra Nagar Haveli"];
        var DamanDiu = ["Daman", "Diu"];
        var Delhi = ["Central Delhi", "East Delhi", "New Delhi", "North Delhi", "North East Delhi", "North West Delhi", "Shahdara", "South Delhi", "South East Delhi", "South West Delhi", "West Delhi"];
        var Lakshadweep = ["Lakshadweep"];
        var Puducherry = ["Karaikal", "Mahe", "Puducherry", "Yanam"];


        $("#inputState").change(function() {
            var StateSelected = $(this).val();
            var optionsList;
            var htmlString = "";

            switch (StateSelected) {
                case "Andhra Pradesh":
                    optionsList = AndraPradesh;
                    break;
                case "Arunachal Pradesh":
                    optionsList = ArunachalPradesh;
                    break;
                case "Odisha":
                    optionsList = Odisha;
                    break;
                case "Assam":
                    optionsList = Assam;
                    break;
                case "Bihar":
                    optionsList = Bihar;
                    break;
                case "Chhattisgarh":
                    optionsList = Chhattisgarh;
                    break;
                case "Goa":
                    optionsList = Goa;
                    break;
                case "Gujarat":
                    optionsList = Gujarat;
                    break;
                case "Haryana":
                    optionsList = Haryana;
                    break;
                case "Himachal Pradesh":
                    optionsList = HimachalPradesh;
                    break;
                case "Jammu and Kashmir":
                    optionsList = JammuKashmir;
                    break;
                case "Jharkhand":
                    optionsList = Jharkhand;
                    break;
                case "Karnataka":
                    optionsList = Karnataka;
                    break;
                case "Kerala":
                    optionsList = Kerala;
                    break;
                case "MadhyaPradesh":
                    optionsList = MadhyaPradesh;
                    break;
                case "Maharashtra":
                    optionsList = Maharashtra;
                    break;
                case "Manipur":
                    optionsList = Manipur;
                    break;
                case "Meghalaya":
                    optionsList = Meghalaya;
                    break;
                case "Mizoram":
                    optionsList = Mizoram;
                    break;
                case "Nagaland":
                    optionsList = Nagaland;
                    break;
                case "Orissa":
                    optionsList = Orissa;
                    break;
                case "Punjab":
                    optionsList = Punjab;
                    break;
                case "Rajasthan":
                    optionsList = Rajasthan;
                    break;
                case "Sikkim":
                    optionsList = Sikkim;
                    break;
                case "Tamil Nadu":
                    optionsList = TamilNadu;
                    break;
                case "Telangana":
                    optionsList = Telangana;
                    break;
                case "Tripura":
                    optionsList = Tripura;
                    break;
                case "Uttaranchal":
                    optionsList = Uttaranchal;
                    break;
                case "Uttar Pradesh":
                    optionsList = UttarPradesh;
                    break;
                case "West Bengal":
                    optionsList = WestBengal;
                    break;
                case "Andaman and Nicobar Islands":
                    optionsList = AndamanNicobar;
                    break;
                case "Chandigarh":
                    optionsList = Chandigarh;
                    break;
                case "Dadar and Nagar Haveli":
                    optionsList = DadraHaveli;
                    break;
                case "Daman and Diu":
                    optionsList = DamanDiu;
                    break;
                case "Delhi":
                    optionsList = Delhi;
                    break;
                case "Lakshadeep":
                    optionsList = Lakshadeep;
                    break;
                case "Pondicherry":
                    optionsList = Pondicherry;
                    break;
                case "Uttarakhand":
                    optionsList = Uttarakhand;
                    break;

            }


            for (var i = 0; i < optionsList.length; i++) {
                htmlString = htmlString + "<option value='" + optionsList[i] + "'>" + optionsList[i] + "</option>";
            }
            $("#inputDistrict").html(htmlString);

        });
    </script>



<?php
    return ob_get_clean();
}
if (isset($_POST["fsubmit"])) {

    if ($_POST["sum"] !== $_POST["sum2"]) {
        echo "<script>alert('Invaild Captcha')</script>";
        $current_url = esc_url_raw($_SERVER['REQUEST_URI']);
        wp_safe_redirect($current_url);
    } else {
        // Get global $wpdb object
        global $wpdb;

        // Get form data
        $name = sanitize_text_field($_POST['name']);
        $father_name = sanitize_text_field($_POST['father_name']);
        $post = sanitize_text_field($_POST['post']);
        $work_area = sanitize_text_field($_POST['work_area']);
        $adhar_number = sanitize_text_field($_POST['aadhaar_number']);
        $email = sanitize_email($_POST['email']);
        $mobile_number = sanitize_text_field($_POST['mobile_number']);
        $mobile_number = str_replace("+91", "", $mobile_number);
        $mobile_number = str_replace(array("0", "91"), "", $mobile_number);
        $date_of_birth = sanitize_text_field($_POST['date_of_birth']);
        $state = sanitize_text_field($_POST['state']);
        $district = sanitize_text_field($_POST['district']);
        $pincode = sanitize_text_field($_POST['pincode']);
        $address = sanitize_text_field($_POST['address']);
        $profile_picture = $_FILES['profile_picture'];
        $payment_ss_picture = $_FILES['payment_ss_picture'];
        $adhar_card_picture = $_FILES['adhar_card_picture'];

        // Checking if any feild is empty
        if (!empty($name) || !empty($father_name) || !empty($email) || !empty($mobile_number) || !empty($date_of_birth) || !empty($state) || !empty($district) || !empty($pincode) || !empty($address) || !empty($state) || !empty($payment_ss_picture)) {
            // Check if mobile number already exists
            $table_name = $wpdb->prefix . 'news_user';
            $existing_mobile = $wpdb->get_var("SELECT mobile_number FROM $table_name WHERE mobile_number = '$mobile_number' AND status = 'approved'");
            if ($existing_mobile) {
                $_SESSION['alert_message'] = 'Mobile Number is already registerd';
                // Redirect to the same page after submitting the form
                $current_url = esc_url_raw($_SERVER['REQUEST_URI']);
                wp_safe_redirect($current_url);
                exit;
            }

            // Upload  Profile picture
            $profile_picture_path = '';
            if ($profile_picture['name']) {
                $upload_dir = wp_upload_dir();
                $profile_picture_name = basename($profile_picture['name']);
                $profile_picture_path = $upload_dir['path'] . '/' . $profile_picture_name;
                move_uploaded_file($profile_picture['tmp_name'], $profile_picture_path);
            }
            // Upload adhar card picture
            $adhar_card_picture_path = '';
            if ($adhar_card_picture['name']) {
                $upload_dir = wp_upload_dir();
                $adhar_card_picture_name = basename($adhar_card_picture['name']);
                $adhar_card_picture_path = $upload_dir['path'] . '/' . $adhar_card_picture_name;
                move_uploaded_file($adhar_card_picture['tmp_name'], $adhar_card_picture_path);
            }
            // Upload payment screenshot picture
            $payment_ss_picture_path = '';
            if ($payment_ss_picture['name']) {
                $upload_dir = wp_upload_dir();
                $payment_ss_picture_name = basename($payment_ss_picture['name']);
                $payment_ss_picture_path = $upload_dir['path'] . '/' . $payment_ss_picture_name;
                move_uploaded_file($payment_ss_picture['tmp_name'], $payment_ss_picture_path);
            }

            // Generate a unique identifier
            $unique_number = uniqid();

            // Insert data into database
            $table_name = $wpdb->prefix . 'news_user';
            $wpdb->insert(
                $table_name,
                array(
                    'unique_number' => $unique_number,
                    'name' => $name,
                    'father_name' => $father_name,
                    'email' => $email,
                    'mobile_number' => $mobile_number,
                    'date_of_birth' => $date_of_birth,
                    'state' => $state,
                    'district' => $district,
                    'pincode' => $pincode,
                    'address' => $address,
                    'profile_picture' => $profile_picture_path,
                    'payment_ss_picture' => $payment_ss_picture_path,
                    'adhar_card_picture' => $adhar_card_picture_path,
                    'status' => "pending",
                    'post' => $post,
                    'work_area' => $work_area,
                    'aadhaar_number' => $adhar_number
                )
            );


            // Set session variable with alert message
            $_SESSION['alert_message'] = "Your form has been submitted, we'll mail you when your application approved";

            // Redirect to the same page after submitting the form
            $current_url = esc_url_raw($_SERVER['REQUEST_URI']);
            wp_safe_redirect($current_url);
            exit; // Add exit after redirect to prevent further execution of code


        } else {
            echo "<script>alert('All, Feilds are required')</script>";
        }
    }
}

?>
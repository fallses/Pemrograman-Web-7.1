<?php
    $koneksi = mysqli_connect("localhost", "root", "");

    if(isset($_POST['submit'])) {
        $email = $_POST['txt_email'];
        $pass = $_POST['txt_pass'];

        if (!empty(trim($email)) && !empty(trim($pass))) {
            //select data berdasarkan username dari database
            $query = "SELECT * FROM user_detail WHERE user_email = '$email'";
            $result = mysqli_query($koneksi, $query);
            $num = mysqli_num_rows($result);

            while ($row = mysqli_fetch_array($result)) {
                $userVal = $row['user_email'];
                $passVal = $row['user_password'];
                $userName = $row['user_fullname'];
            }

            if ($num > 0) {
                if ($userVal == $email && $passVal == $pass) {
                    header('Location: home.php?user_fullname=' . urlencode($userName));
                } else {
                    $error = 'user atau password salah!!';
                    header('Location: login.php');
                }
            } else {
                $error = 'Data tidak boleh kosong !!!';
                echo $error;
            }
        }
    }
?>
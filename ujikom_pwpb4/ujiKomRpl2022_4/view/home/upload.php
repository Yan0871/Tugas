<?php
if (isset($_POST['register']) && isset($_FILES['foto'])) {
    echo "<pre>";
    print_r($_FILES['foto']);
    echo "</pre>";

    $img_name = $_FILES['foto']['name'];
    $img_size = $_FILES['foto']['size'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $error = $_FILES['foto']['error'];

    if ($error == 0) {
        if ($img_size > 1250000) {
            $em = "Sorry, your file is too large.";
            header("Location: register.php?error=$em");
        }
        else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg","jpeg","png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
            }
            else {
                $em = "You can't upload files of this type";
                header("Location: register.php?error=$em");
            }
        }
    }
    else {
        $em = "Unknown error occured!";
        header("Location: register.php?error=$em");
    }
}
else {
    header("Location: login.php");
}
?>
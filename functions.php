<?php
$conn = mysqli_connect("localhost", "root", "", "test1_imago");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data)
{
    global $conn;

    $email = strtolower(trim($data["email"]));
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek email sudah ada atau belum
    $resultEmail = mysqli_query($conn, "SELECT email FROM userdata WHERE email = '$email'");
    if (mysqli_fetch_assoc($resultEmail)) {
        echo "<script>
                alert('email sudah terdaftar')
            </script>";
        return false;
    }

    // cek username sudah ada atau belum
    $resultUser = mysqli_query($conn, "SELECT username FROM userdata WHERE username = '$username'");
    if (mysqli_fetch_assoc($resultUser)) {
        echo "<script>
                alert('username sudah terdaftar')
            </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai')
            </script>";
        return false;
    }

    // enkripsi password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    $query = "INSERT INTO userdata (email, username, password) 
              VALUES ('$email', '$username', '$passwordHash')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

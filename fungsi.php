<?php
// Koneksi db
$conn = mysqli_connect ("localhost", "root", "", "gallery");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function registrasi($data){
    global $conn;

    $nama = $data["nama"];
    $email = $data["email"];
    $username = strtolower($data['username']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    $alamat = $data["alamat"];

    if ($password !== $password2) {
        echo "<script>
              alert('password tidak sesuai');
              </script>";
        return false;       
        
    }

    $password = password_hash($password,PASSWORD_DEFAULT);
    
    mysqli_query($conn, "INSERT INTO user VALUES(null, '$username', '$password', '$email' , '$nama', '$alamat')");
    return mysqli_affected_rows($conn);
}


?>
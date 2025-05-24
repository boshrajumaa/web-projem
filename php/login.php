<?php
// Kullanıcı bilgilerini örnek olarak tanımlıyoruz
$dogruKullaniciAdi = "b221210552@sakarya.edu.tr";
$dogruSifre = "b221210552";

// Formdan gelen verileri al
$email = $_POST['email'];
$password = $_POST['password'];

// Bilgileri kontrol et
if ($email == $dogruKullaniciAdi && $password == $dogruSifre) {
    echo "Hoşgeldiniz b221210552";
} else {
    // Başarısızsa tekrar giriş sayfasına yönlendir
    header("Location:../login.html");
    exit();
}
?>

<?php
// Form gönderilmediyse kullanıcıyı geri gönder
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: iletisim.html");
    exit();
}

// Boş alan kontrolü
if (empty($_POST["ad"]) || empty($_POST["email"])) {
    echo "<h2>Lütfen gerekli alanları doldurunuz.</h2>";
    echo '<a href="iletisim.html">Geri dön</a>';
    exit();
}

// E-posta geçerli mi?
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "<h2>Geçerli bir e-posta adresi giriniz.</h2>";
    echo '<a href="iletisim.html">Geri dön</a>';
    exit();
}

// Verileri alalım
$ad = htmlspecialchars($_POST["ad"]);
$email = htmlspecialchars($_POST["email"]);
$tel = htmlspecialchars($_POST["tel"]);
$konu = htmlspecialchars($_POST["konu"]);
$cinsiyet = isset($_POST["cinsiyet"]) ? htmlspecialchars($_POST["cinsiyet"]) : "Belirtilmedi";
$hobi = isset($_POST["hobi"]) ? $_POST["hobi"] : [];
$mesaj = htmlspecialchars($_POST["mesaj"]);
$tarih = $_POST["tarih"];
$renk = $_POST["renk"];
$seviye = $_POST["seviye"];
$gizli_kod = $_POST["gizli_kod"];

// Hobi listesini yazıya dönüştür
$hobi_liste = implode(", ", $hobi);

// Ekrana yazdır
echo "<h2>İletişim Formu Başarıyla Gönderildi!</h2>";
echo "<p><strong>Ad Soyad:</strong> $ad</p>";
echo "<p><strong>E-posta:</strong> $email</p>";
echo "<p><strong>Telefon:</strong> $tel</p>";
echo "<p><strong>Konu:</strong> $konu</p>";
echo "<p><strong>Cinsiyet:</strong> $cinsiyet</p>";
echo "<p><strong>Hobiler:</strong> $hobi_liste</p>";
echo "<p><strong>Mesaj:</strong> $mesaj</p>";
echo "<p><strong>Seçilen Tarih:</strong> $tarih</p>";
echo "<p><strong>Favori Renk:</strong> $renk</p>";
echo "<p><strong>Memnuniyet Seviyesi:</strong> $seviye</p>";
echo "<p><strong>Gizli Kod:</strong> $gizli_kod</p>";

// Dosya yüklenmiş mi?
if (isset($_FILES["dosya"]) && $_FILES["dosya"]["error"] == 0) {
    $dosyaAdi = $_FILES["dosya"]["name"];
    $geciciYol = $_FILES["dosya"]["tmp_name"];
    $hedefYol = "uploads/" . basename($dosyaAdi);

    // uploads klasörü yoksa oluştur
    if (!is_dir("uploads")) {
        mkdir("uploads", 0755, true);
    }

    if (move_uploaded_file($geciciYol, $hedefYol)) {
        echo "<p><strong>Dosya:</strong> $dosyaAdi başarıyla yüklendi.</p>";
    } else {
        echo "<p><strong>Dosya yüklenirken hata oluştu.</strong></p>";
    }
} else {
    echo "<p><strong>Dosya yüklenmedi.</strong></p>";
}

echo '<br><a href="iletisim.html">Forma Geri Dön</a>';
?>

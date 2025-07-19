<?php
// 1. الاتصال بقاعدة البيانات
require_once __DIR__ . '/backend/config/db.php'; // تأكد أن هذا الملف يعرّف $conn (وليس $pdo)

// 2. بيانات المستخدم
$first_name = 'Elio';
$last_name  = 'Faddoul';
$email      = 'eliofaddoul@gmail.com';
$password   = 'eliofaddoul1@';
$city       = 'Tripoli';
$address    = 'Dahr El Ein, Al Koura';
$role_id    = 1; // Super Admin

// 3. تشفير كلمة المرور
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// 4. تحضير واستدعاء إدخال المستخدم
$stmt = $conn->prepare("
    INSERT INTO users (email, password, first_name, last_name, city, address_line)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("ssssss", $email, $hashedPassword, $first_name, $last_name, $city, $address);

if ($stmt->execute()) {
    // 5. الحصول على ID المستخدم الجديد
    $user_id = $conn->insert_id;

    // 6. ربط المستخدم بدور Super Admin
    $stmt2 = $conn->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
    $stmt2->bind_param("ii", $user_id, $role_id);

    if ($stmt2->execute()) {
        echo "✅ Super Admin created successfully!";
    } else {
        echo "❌ Failed to assign role: " . $stmt2->error;
    }

    $stmt2->close();
} else {
    echo "❌ Failed to create user: " . $stmt->error;
}

$stmt->close();
$conn->close();
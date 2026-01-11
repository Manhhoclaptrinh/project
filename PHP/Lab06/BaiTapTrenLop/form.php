<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form thông tin cá nhân</title>
</head>
<body>

<h2>Nhập thông tin cá nhân</h2>

<form method="post" action="result.php">
    <p>
        Họ tên: <br>
        <input type="text" name="full_name" required>
    </p>

    <p>
        Email: <br>
        <input type="email" name="email" required>
    </p>

    <p>
        Tuổi: <br>
        <input type="number" name="age" min="10" max="80" required>
    </p>

    <p>
        Giới tính: <br>
        <label>
            <input type="radio" name="gender" value="Nam"> Nam
        </label>
        <label>
            <input type="radio" name="gender" value="Nữ"> Nữ
        </label>
    </p>

    <p>
        Sở thích: <br>
        <label>
            <input type="checkbox" name="hobbies[]" value="Đọc sách"> Đọc sách
        </label>
        <label>
            <input type="checkbox" name="hobbies[]" value="Nghe nhạc"> Nghe nhạc
        </label>
        <label>
            <input type="checkbox" name="hobbies[]" value="Thể thao"> Thể thao
        </label>
    </p>

    <p>
        Ghi chú: <br>
        <textarea name="note" rows="4" cols="40"></textarea>
    </p>

    <button type="submit" name="submit">Gửi</button>
</form>

</body>
</html>

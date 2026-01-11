<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Trả sách</title>
<style>
body { font-family: Arial; margin: 30px; }
label { display: block; margin-top: 10px; }
</style>
</head>
<body>

<h2>Trả sách</h2>

<form method="post" action="return_process.php">
    <label>
        Mã phiếu mượn:
        <input type="text" name="borrow_id" required>
    </label>

    <label>
        Ngày trả:
        <input type="date" name="return_date" required>
    </label>

    <br>
    <button type="submit">Trả sách</button>
</form>

</body>
</html>

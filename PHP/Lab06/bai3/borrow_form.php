<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Lập phiếu mượn sách</title>
<style>
body { font-family: Arial; margin: 30px; }
label { display: block; margin-top: 10px; }
</style>
</head>
<body>

<h2>Phiếu mượn sách</h2>

<form method="post" action="borrow_process.php">
    <label>
        Mã sách:
        <input type="text" name="book_code" required>
    </label>

    <label>
        Ngày mượn:
        <input type="date" name="borrow_date" required>
    </label>

    <label>
        Số ngày mượn (1–30):
        <input type="number" name="days" min="1" max="30" required>
    </label>

    <br>
    <button type="submit">Lập phiếu</button>
</form>

</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sách</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<h2>Quản lý sách</h2>

<form id="bookForm">
    ISBN:
    <input type="text" name="isbn" required>

    Tên sách:
    <input type="text" name="title" required>

    Tác giả:
    <input type="text" name="author" required>

    SL:
    <input type="number" name="quantity" min="0" value="1">

    <button type="submit">Thêm</button>
</form>

<hr>

<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Tên</th>
            <th>SL</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody id="bookTable">
    </tbody>
</table>

<script src="/labs/lab09/library/public/js/books.js"></script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Products Ajax</title>
</head>
<body>

<h2>Danh sách sản phẩm</h2>

<input type="text" id="search" placeholder="Tìm theo mã hoặc tên">

<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Price</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="product-body"></tbody>
</table>

<script src="js/products.js"></script>
</body>
</html>

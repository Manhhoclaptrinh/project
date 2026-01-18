    // Load danh sách sách
    function loadBooks() {
        $.ajax({
            url: '/labs/lab09/library/api/books.php?action=list',
            method: 'GET',
            dataType: 'json',
            success: function (res) {
                if (!res.success) {
                    alert(res.message);
                    return;
                }

                let html = '';
                res.data.forEach(b => {
                    html += `
                        <tr>
                            <td>${b.id}</td>
                            <td>${b.isbn}</td>
                            <td>${b.title}</td>
                            <td>${b.quantity}</td>
                            <td>
                                <button onclick="deleteBook(${b.id})">Xóa</button>
                            </td>
                        </tr>
                    `;
                });

                $('#bookTable').html(html);
            },
            error: function () {
                alert('Không gọi được API books');
            }
        });
    }

    // Submit form 
    $('#bookForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '/labs/lab09/library/api/books.php?action=create',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {
                alert(res.message);
                if (res.success) {
                    loadBooks();
                    $('#bookForm')[0].reset();
                }
            },
            error: function () {
                alert('Lỗi khi thêm sách');
            }
        });
    });

    // Xóa sách
    function deleteBook(id) {
        if (!confirm('Xóa sách này?')) return;

        $.ajax({
            url: '/labs/lab09/library/api/books.php?action=delete',
            method: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (res) {
                alert(res.message);
                if (res.success) loadBooks();
            }
        });
    }

    loadBooks();

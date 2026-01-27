const tbody = document.getElementById('product-body');
const search = document.getElementById('search');

/* Load products */
function loadProducts(q = '') {
    fetch(`http://localhost/labs/lab13/mini-inventory/api/products.php?action=search&q=${q}`)
        .then(res => res.json())
        .then(data => {
            tbody.innerHTML = '';
            data.forEach(p => {
                tbody.innerHTML += `
                    <tr id="row-${p.id}">
                        <td>${p.id}</td>
                        <td>${p.code}</td>
                        <td>${p.name}</td>
                        <td>${p.price}</td>
                        <td>${p.created_at}</td>
                        <td>
                            <button onclick="deleteProduct(${p.id})">Xóa</button>
                        </td>
                    </tr>
                `;
            });
        });
}

/* Live search */
search.addEventListener('keyup', () => {
    loadProducts(search.value);
});

/* Ajax delete */
function deleteProduct(id) {
    if (!confirm('Xóa sản phẩm này?')) return;

    fetch('/api/products.php?action=delete', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${id}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`row-${id}`).remove();
        }
    });
}

loadProducts();

function loadData() {
    $.get(
        'index.php?api=1&action=list',
        function (res) {
            let html = '';

            if (!res.data || res.data.length === 0) {
                html = '<tr><td colspan="6">Chưa có dữ liệu</td></tr>';
            } else {
                $.each(res.data, function (i, s) {
                    html += `
                    <tr data-id="${s.id}">
                        <td>${i + 1}</td>
                        <td>${s.code}</td>
                        <td>${s.full_name}</td>
                        <td>${s.email}</td>
                        <td>${s.dob ?? ''}</td>
                        <td>
                            <button class="edit">Sửa</button>
                            <button class="delete">Xóa</button>
                        </td>
                    </tr>`;
                });
            }

            $('#studentTable').html(html);
        },
        'json'
    );
}

$('#studentForm').on('submit', function (e) {
    e.preventDefault();

    let id = $('input[name=id]').val();
    let action = id ? 'update' : 'create';

    $.post(
        'index.php?api=1&action=' + action,
        $(this).serialize(),
        function (res) {
            if (res.success) {
                loadData();
                $('#studentForm')[0].reset();
                $('input[name=id]').val('');
            } else {
                alert(res.message);
            }
        },
        'json'
    );
});

$(document).on('click', '.delete', function () {
    if (!confirm('Bạn có chắc muốn xóa?')) return;

    let id = $(this).closest('tr').data('id');

    $.post(
        'index.php?api=1&action=delete',
        { id: id },
        function () {
            loadData();
        },
        'json'
    );
});

$(document).on('click', '.edit', function () {
    let row = $(this).closest('tr');

    $('input[name=id]').val(row.data('id'));
    $('input[name=code]').val(row.children().eq(1).text());
    $('input[name=full_name]').val(row.children().eq(2).text());
    $('input[name=email]').val(row.children().eq(3).text());
    $('input[name=dob]').val(row.children().eq(4).text());
});

$(document).ready(loadData);

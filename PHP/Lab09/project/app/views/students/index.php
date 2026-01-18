<h2>Quản lý sinh viên</h2>

<form id="studentForm">
    <input type="hidden" name="id">

    <input type="text" name="code" placeholder="Mã SV" required>
    <input type="text" name="full_name" placeholder="Họ tên" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="date" name="dob">

    <button type="submit">Lưu</button>
</form>

<table border="1" width="100%" cellpadding="5">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody id="studentTable">
        <tr><td colspan="6">Đang tải...</td></tr>
    </tbody>
</table>

<?php
require_once '../models/MemberModel.php';

header('Content-Type: application/json; charset=utf-8');

$model  = new MemberModel();
$action = $_GET['action'] ?? 'list';

try {

    // Danh sách độc giả
    if ($action === 'list') {
        echo json_encode([
            'success' => true,
            'data'    => $model->all()
        ]);
        exit;
    }

    // Thêm độc giả
    if ($action === 'create') {

        // Validate bắt buộc
        if (
            empty($_POST['member_code']) ||
            empty($_POST['full_name']) ||
            empty($_POST['email'])
        ) {
            throw new Exception('Vui lòng nhập đầy đủ thông tin bắt buộc');
        }

        // Validate email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email không đúng định dạng');
        }

        $model->create($_POST);

        echo json_encode([
            'success' => true,
            'message' => 'Thêm độc giả thành công'
        ]);
        exit;
    }

    // Cập nhật độc giả
    if ($action === 'update') {

        if (empty($_POST['id'])) {
            throw new Exception('Thiếu ID độc giả');
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email không đúng định dạng');
        }

        $sql = "UPDATE members 
                SET full_name = ?, email = ?, phone = ?
                WHERE id = ?";
        $db = Database::connect();
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $_POST['full_name'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['id']
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Cập nhật thành công'
        ]);
        exit;
    }

    // Xóa độc giả
    if ($action === 'delete') {

        if (empty($_POST['id'])) {
            throw new Exception('Thiếu ID độc giả');
        }

        $model->delete($_POST['id']);

        echo json_encode([
            'success' => true,
            'message' => 'Xóa độc giả thành công'
        ]);
        exit;
    }

    // Action không hợp lệ
    throw new Exception('Action không hợp lệ');

} catch (PDOException $e) {

    // Lỗi trùng email / member_code
    if ($e->getCode() == 23000) {
        echo json_encode([
            'success' => false,
            'message' => 'Email hoặc mã độc giả đã tồn tại'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }

} catch (Exception $e) {

    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

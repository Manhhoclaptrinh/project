<?php
require_once '../models/BookModel.php';
header('Content-Type: application/json');

$model = new BookModel();
$action = $_GET['action'] ?? 'list';

try {
    if ($action === 'list') {
        echo json_encode([
            'success' => true,
            'data' => $model->all()
        ]);
    }

    if ($action === 'create') {
        if ($_POST['quantity'] < 0) {
            throw new Exception("Số lượng phải >= 0");
        }
        $model->create($_POST);
        echo json_encode(['success'=>true,'message'=>'Thêm sách thành công']);
    }

    if ($action === 'delete') {
        $model->delete($_POST['id']);
        echo json_encode(['success'=>true,'message'=>'Đã xóa']);
    }

} catch (Exception $e) {
    echo json_encode([
        'success'=>false,
        'message'=>$e->getMessage()
    ]);
}

<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/StudentModel.php';

class StudentController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    public function index() {
        $this->view('students/index');
    }

    public function api() {
        $action = $_GET['action'] ?? 'list';

        try {
            switch ($action) {
                case 'list':
                    $data = $this->model->all();
                    $this->json([
                        'success' => true,
                        'data' => $data
                    ]);
                    break;

                case 'create':
                    $this->model->create($_POST);
                    $this->json([
                        'success' => true,
                        'message' => 'Thêm sinh viên thành công'
                    ]);
                    break;

                case 'update':
                    $this->model->update($_POST['id'], $_POST);
                    $this->json([
                        'success' => true,
                        'message' => 'Cập nhật thành công'
                    ]);
                    break;

                case 'delete':
                    $this->model->delete($_POST['id']);
                    $this->json([
                        'success' => true,
                        'message' => 'Xóa thành công'
                    ]);
                    break;

                default:
                    $this->json([
                        'success' => false,
                        'message' => 'Action không hợp lệ'
                    ]);
            }
        } catch (Exception $e) {
            $this->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

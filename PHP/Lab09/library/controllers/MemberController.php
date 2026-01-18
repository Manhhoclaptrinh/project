<?php
class MemberController
{
    // Hiển thị trang quản lý độc giả
    public function index()
    {
        require_once __DIR__ . '/../views/members/index.php';
    }

    // API: danh sách độc giả
    public function apiList()
    {
        require_once __DIR__ . '/../api/members.php';
    }

    public function apiCreate()
    {
        require_once __DIR__ . '/../api/members.php';
    }

    public function apiUpdate()
    {
        require_once __DIR__ . '/../api/members.php';
    }

    public function apiDelete()
    {
        require_once __DIR__ . '/../api/members.php';
    }
}

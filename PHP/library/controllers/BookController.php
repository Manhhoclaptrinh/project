<?php
class BookController
{
    // Hiển thị trang quản lý sách
    public function index()
    {
        require_once __DIR__ . '/../views/books/index.php';
    }

    public function apiList()
    {
        require_once __DIR__ . '/../api/books.php';
    }

    public function apiCreate()
    {
        require_once __DIR__ . '/../api/books.php';
    }

    public function apiUpdate()
    {
        require_once __DIR__ . '/../api/books.php';
    }

    public function apiDelete()
    {
        require_once __DIR__ . '/../api/books.php';
    }
}

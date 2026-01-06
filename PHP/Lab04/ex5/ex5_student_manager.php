<?php
require_once "Student.php";

function h($s)
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

$students = [];
$error = '';
$stats = null;

// Xử lý POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $raw = trim($_POST['data'] ?? '');
    $threshold = $_POST['threshold'] ?? '';
    $sortDesc = isset($_POST['sort_desc']);

    if ($raw === '') {
        $error = "Vui lòng nhập dữ liệu sinh viên.";
    } else {
        // Parse dữ liệu
        $records = explode(';', $raw);

        foreach ($records as $rec) {
            $rec = trim($rec);
            if ($rec === '') continue;

            $parts = explode('-', $rec);
            if (count($parts) !== 3) continue;

            [$id, $name, $gpaStr] = $parts;

            if ($id === '' || $name === '' || !is_numeric($gpaStr)) {
                continue;
            }

            $students[] = new Student($id, $name, $gpaStr);
        }

        // Nếu parse rỗng
        if (empty($students)) {
            $error = "Không có dữ liệu sinh viên hợp lệ.";
        } else {

            // Filter theo threshold
            if ($threshold !== '' && is_numeric($threshold)) {
                $students = array_filter($students, function ($st) use ($threshold) {
                    return $st->getGpa() >= $threshold;
                });
            }

            if (empty($students)) {
                $error = "Không có sinh viên nào thỏa điều kiện lọc GPA.";
            } else {
                // Sort GPA giảm dần
                if ($sortDesc) {
                    usort($students, function ($a, $b) {
                        return $b->getGpa() <=> $a->getGpa();
                    });
                }

                // Thống kê
                $gpas = array_map(fn($st) => $st->getGpa(), $students);

                $stats = [
                    'avg' => array_sum($gpas) / count($gpas),
                    'max' => max($gpas),
                    'min' => min($gpas),
                    'rank' => [
                        'Giỏi' => 0,
                        'Khá' => 0,
                        'Trung bình' => 0
                    ]
                ];

                foreach ($students as $st) {
                    $stats['rank'][$st->rank()]++;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 5 - Student Manager</title>
    <style>
        textarea { width: 80%; height: 80px; }
        table { border-collapse: collapse; width: 80%; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px 10px; }
        th { background: #f2f2f2; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h2>Bài 5 — Student Manager (POST)</h2>

<form method="post">
    <p>
        <label>Dữ liệu sinh viên:</label><br>
        <textarea name="data"><?= h($_POST['data'] ?? '') ?></textarea>
    </p>

    <p>
        <label>Threshold GPA ≥ </label>
        <input type="text" name="threshold" value="<?= h($_POST['threshold'] ?? '') ?>">
    </p>

    <p>
        <label>
            <input type="checkbox" name="sort_desc" <?= isset($_POST['sort_desc']) ? 'checked' : '' ?>>
            Sort GPA giảm dần
        </label>
    </p>

    <button type="submit">Parse & Show</button>
</form>

<?php if ($error): ?>
    <p class="error"><?= h($error) ?></p>
<?php endif; ?>

<?php if (!empty($students) && $stats): ?>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>ID</th>
                <th>Name</th>
                <th>GPA</th>
                <th>Rank</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $i => $st): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= h($st->getId()) ?></td>
                    <td><?= h($st->getName()) ?></td>
                    <td><?= number_format($st->getGpa(), 2) ?></td>
                    <td><?= $st->rank() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Thống kê</h3>
    <ul>
        <li>GPA trung bình: <?= number_format($stats['avg'], 2) ?></li>
        <li>GPA cao nhất: <?= number_format($stats['max'], 2) ?></li>
        <li>GPA thấp nhất: <?= number_format($stats['min'], 2) ?></li>
        <li>Giỏi: <?= $stats['rank']['Giỏi'] ?></li>
        <li>Khá: <?= $stats['rank']['Khá'] ?></li>
        <li>Trung bình: <?= $stats['rank']['Trung bình'] ?></li>
    </ul>
<?php endif; ?>

</body>
</html>

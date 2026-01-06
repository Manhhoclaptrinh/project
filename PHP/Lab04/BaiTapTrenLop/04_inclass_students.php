<?php
$input = "SV001-An-3.2;SV002-Binh-2.6;SV003-Chi-3.5";

class Student {
    public $id;
    public $name;
    public $gpa;

    public function __construct($id, $name, $gpa) {
        $this->id = $id;
        $this->name = $name;
        $this->gpa = $gpa;
    }

    public function getRank() {
        if ($this->gpa >= 3.6) return "Xuất sắc";
        if ($this->gpa >= 3.2) return "Giỏi";
        if ($this->gpa >= 2.5) return "Khá";
        return "Trung bình";
    }
}

$list = [];
$records = explode(";", $input);

foreach ($records as $record) {
    $parts = explode("-", $record);
    $id = trim($parts[0]);
    $name = trim($parts[1]);
    $gpa = (float) trim($parts[2]);

    $list[] = new Student($id, $name, $gpa);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <style>
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Danh sách sinh viên GPA ≥ 3.2</h2>

<table>
    <tr>
        <th>Name</th>
        <th>GPA</th>
        <th>Rank</th>
    </tr>

    <?php foreach ($list as $student): ?>
        <?php if ($student->gpa >= 3.2): ?>
            <tr>
                <td><?= htmlspecialchars($student->name) ?></td>
                <td><?= $student->gpa ?></td>
                <td><?= $student->getRank() ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>

</table>

</body>
</html>

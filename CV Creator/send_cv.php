<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "job_title" => $_POST['job_title'] ?? '',
        "edu_degree" => $_POST['edu_degree'] ?? '',
        "major_name" => $_POST['major_name'] ?? '',
        "graduation_year" => $_POST['graduation_year'] ?? '',
        "edu_status" => $_POST['edu_status'] ?? '',
        "exp_type" => $_POST['exp_type'] ?? '',
        "exp_title" => $_POST['exp_title'] ?? '',
        "exp_place" => $_POST['exp_place'] ?? '',
        "exp_summary" => $_POST['exp_summary'] ?? '',
        "cert_name" => $_POST['cert_name'] ?? '',
        "cert_issuer" => $_POST['cert_issuer'] ?? '',
        "cert_type" => $_POST['cert_type'] ?? '',
        "language" => $_POST['language'] ?? '',
        "level" => $_POST['level'] ?? '',
        "achievement" => $_POST['achievement'] ?? '',
    ];

    $apiUrl = "https://cvcreator-6nr3.onrender.com/generate";

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>نتيجة إنشاء السيرة الذاتية</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f9f9f9;
            direction: rtl;
            margin: 40px;
        }

        .container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ddd;
            max-width: 900px;
            margin: auto;
        }

        h2,
        h3 {
            color: #333;
            border-bottom: 2px solid #008cba;
            padding-bottom: 10px;
        }

        ul {
            list-style: none;
            padding-right: 0;
        }

        li {
            margin-bottom: 15px;
            background: #f5f5f5;
            padding: 12px;
            border-radius: 8px;
            line-height: 1.8;
        }

        .section-title {
            margin-top: 30px;
        }

        .skill {
            display: inline-block;
            background: #e0f7fa;
            color: #006064;
            margin: 5px 5px 5px 0;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 14px;
        }

        .type-label {
            font-size: 12px;
            color: #666;
        }

        .skills-group {
            margin-bottom: 25px;
        }

        .skills-group-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($result)): ?>
            <h2>الهدف المهني</h2>
            <p><?= htmlspecialchars($result['career_objective']) ?></p>

            <h2 class="section-title">الدورات المقترحة</h2>
            <ul>
                <?php
                foreach ($result['recommended_courses'] as $course):
                    $type = $course['type'];
                ?>
                    <li>
                        <strong>العنوان:</strong> <?= htmlspecialchars($course['title']) ?><br>
                        <strong>النوع:</strong> <?= htmlspecialchars($type) ?><br>
                        <strong>المنصة:</strong> <?= htmlspecialchars($course['platform']) ?><br>
                        <strong>ملاحظات:</strong> <?= htmlspecialchars($course['notes']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h2 class="section-title">المهارات</h2>
            <?php
            // Group skills by type
            $groupedSkills = [];
            foreach ($result['skills'] as $skill) {
                $type = $skill['skill_type'];
                $groupedSkills[$type][] = $skill['skill_name'];
            }

            foreach ($groupedSkills as $type => $skills):
            ?>
                <div class="skills-group">
                    <div class="skills-group-title"><?= htmlspecialchars($type) ?></div>
                    <?php foreach ($skills as $skill): ?>
                        <span class="skill"><?= htmlspecialchars($skill) ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
           <form method="POST">
            <input type="hidden" name="job_title" value="مصمم جرافيك">
            <input type="hidden" name="edu_degree" value="دبلوم">
            <input type="hidden" name="major_name" value="تصميم جرافيك">
            <input type="hidden" name="graduation_year" value="2018">
            <input type="hidden" name="edu_status" value="متخرج">
            <input type="hidden" name="exp_type" value="دوام كامل">
            <input type="hidden" name="exp_title" value="مصمم جرافيك">
            <input type="hidden" name="exp_place" value="وكالة الإبداع للتسويق">
            <input type="hidden" name="exp_summary" value="تصميم الشعارات، الملصقات، والحملات الإعلانية باستخدام Adobe Photoshop وIllustrator.">
            <input type="hidden" name="cert_name" value="شهادة Adobe Photoshop المتقدمة">
            <input type="hidden" name="cert_issuer" value="Adobe">
            <input type="hidden" name="cert_type" value="شهادة تدريبية">
            <input type="hidden" name="language" value="الإنجليزية">
            <input type="hidden" name="level" value="جيد جدًا">
            <input type="hidden" name="achievement" value="تصميم حملة إعلانية حققت زيادة في المبيعات بنسبة 20%.">
            <button type="submit">إنشاء السيرة الذاتية</button>
        </form>

        <?php endif; ?>
    </div>
</body>

</html>
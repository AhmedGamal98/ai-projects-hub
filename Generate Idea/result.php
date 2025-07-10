<?php

$data = [
    "study_type" => "بحث تطبيقي",
    "specialization" => "تقنيات التعليم",
    "field" => "التعليم الإلكتروني",
    "national_direction" => "تنمية القدرات البشرية",
    "project_algorithms" => "Naive Bayes, SVM",
    "target_audience" => "الطلاب والمعلمين",
    "integration" => "IoT, AI",
    "system_type" => "نظام ويب",
    "programming_languages" => "Python, JavaScript",
    "technologies" => "Django, Vue.js",
    "database_type" => "MySQL",
    "ai_data_type" => "نصوص, درجات",
    "ai_use_types" => "تحليل مشاعر, توصية محتوى",
    "ai_algorithms" => "BERT, Decision Trees",
    "allow_suggested_users" => "نعم",
    "initial_idea" => "منصة تعليمية ذكية تقوم بتحليل أداء الطلاب وتوصية بمصادر تعليمية مخصصة"
];








    $ch = curl_init('https://createagraduationidea.onrender.com/generate');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_status === 200) {
        $decoded_response = json_decode($response, true);
        $markdown = $decoded_response['project_markdown'] ?? "لم يتم العثور على وصف المشروع.";
        $html_content = markdownToHtml(trim($markdown));
    } else {
        $html_content = "<p>حدث خطأ في الاتصال بالخادم. الرجاء المحاولة لاحقًا.</p>";
    }


function markdownToHtml($text) {
    // Remove excessive blank lines
    $text = preg_replace('/[\r\n]{3,}/', "\n\n", $text);

    // Convert headers
    for ($i = 6; $i >= 1; $i--) {
        $text = preg_replace('/^' . str_repeat('#', $i) . ' (.*)$/m', "<h$i>$1</h$i>", $text);
    }

    // Convert bold & italic
    $text = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*(.*?)\*/s', '<em>$1</em>', $text);

    // Convert unordered lists
    $text = preg_replace_callback('/(^\s*[\*\-]\s.*(?:\n^\s*[\*\-]\s.*)*)/m', function ($matches) {
        $items = preg_replace('/^\s*[\*\-]\s(.*)/m', '<li>$1</li>', $matches[1]);
        return "<ul>$items</ul>";
    }, $text);

    // Convert ordered lists
    $text = preg_replace_callback('/(^\s*\d+\.\s.*(?:\n^\s*\d+\.\s.*)*)/m', function ($matches) {
        $items = preg_replace('/^\s*\d+\.\s(.*)/m', '<li>$1</li>', $matches[1]);
        return "<ol>$items</ol>";
    }, $text);

    // Convert tables
    $text = preg_replace_callback('/\n\|(.+)\|\n\|([ \-\|]+)\|\n((?:\|.*\|\n?)*)/s', function ($matches) {
        $headers = array_filter(array_map('trim', explode('|', trim($matches[1]))));
        $rows = explode("\n", trim($matches[3]));
        $thead = '<thead><tr>' . implode('', array_map(fn($h) => "<th>$h</th>", $headers)) . '</tr></thead>';
        $tbody = '';
        foreach ($rows as $row) {
            $cells = array_filter(array_map('trim', explode('|', trim($row))));
            if (count($cells) !== count($headers)) continue;
            $tbody .= '<tr>' . implode('', array_map(fn($c) => "<td>$c</td>", $cells)) . '</tr>';
        }
        return "<table>$thead<tbody>$tbody</tbody></table>";
    }, $text);
    // Blockquotes
    $text = preg_replace('/^>\s*(.*)/m', '<blockquote>$1</blockquote>', $text);

    // Code blocks: triple backticks (```...```)
    $text = preg_replace_callback('/```(.*?)```/s', function ($matches) {
        return '<pre><code>' . htmlspecialchars($matches[1]) . '</code></pre>';
    }, $text);

    // Inline code: `code`
    $text = preg_replace('/`([^`]+)`/', '<code>$1</code>', $text);

    // Line breaks
    $text = nl2br($text);

    return $text;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>نتيجة المشروع الذكي</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to left, #e8f0fe, #fefefe);
      padding: 30px;
      color: #333;
    }

    .result-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 15px;
      max-width: 900px;
      margin: auto;
      box-shadow: 0 5px 25px rgba(0,0,0,0.1);
      line-height: 1.7;
    }

    h1, h2, h3, h4, h5 {
      color: #0056b3;
      margin-top: 1.5em;
    }

    ul, ol {
      padding-right: 25px;
      margin-top: 10px;
    }

    ul li, ol li {
      margin-bottom: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 15px;
    }

    table, th, td {
      border: 1px solid #ccc;
    }

    th {
      background-color: #f2f7fc;
      color: #0056b3;
      font-weight: bold;
    }

    td {
      background-color: #fcfdff;
    }

    tr:nth-child(even) td {
      background-color: #f9f9f9;
    }

    tr:hover td {
      background-color: #e6f2ff;
    }

    th, td {
      padding: 12px;
      text-align: right;
    }

    .back {
      text-align: center;
      margin-top: 40px;
    }

    .back a {
      text-decoration: none;
      padding: 10px 25px;
      background: #0056b3;
      color: white;
      border-radius: 6px;
      transition: background 0.3s;
    }

    .back a:hover {
      background: #003d80;
    }
    .project-output {
  margin-top: 25px;
  font-size: 16px;
  white-space: normal;
}

.project-output blockquote {
  border-right: 4px solid #0056b3;
  padding: 10px 20px;
  background-color: #f1f8ff;
  color: #333;
  margin: 20px 0;
  font-style: italic;
}

.project-output code {
  background: #f5f5f5;
  padding: 2px 6px;
  font-family: Consolas, monospace;
  border-radius: 4px;
}

.project-output pre {
  background: #f0f0f0;
  padding: 15px;
  overflow-x: auto;
  border-radius: 6px;
  direction: ltr;
  text-align: left;
  font-size: 14px;
}

.project-output h2, .project-output h3 {
  border-right: 4px solid #0056b3;
  padding-right: 10px;
  margin-top: 30px;
}

.project-output p {
  margin-bottom: 15px;
}

  </style>
  
</head>
<body>
  <div class="result-container">
    <h2>🎓 نتيجة فكرة مشروعك الذكي</h2>
    <div><?php echo $html_content; ?></div>
    <div class="back">
      <a href="form.php">🔙 عودة للنموذج</a>
    </div>
  </div>
</body>
</html>

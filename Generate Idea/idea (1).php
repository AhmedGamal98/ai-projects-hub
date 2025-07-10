<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function getSelectedText($array) {
  return (is_array($array) && count(array_filter($array)) > 0)
    ? implode('،', array_filter($array))


    : 'لم يتم التحديد';
}

function getNameById($conn, $table, $idColumn, $nameColumn, $id) {
  if (empty($id)) return 'لم يتم التحديد';
  $stmt = $conn->prepare("SELECT $nameColumn FROM $table WHERE $idColumn = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($name);
  $stmt->fetch();
  return $name ?: 'لم يتم التحديد';
}
$conn->set_charset("utf8");

$studyLevel = $_POST['study_level_id'] ?? '';
$major = $_POST['id_major'] ?? '';
$field = $_POST['id_field'] ?? '';
$vision = $_POST['id_goal'] ?? '';
$algorithms = $_POST['id_algorithm'] ?? [];
$targetUsers = $_POST['id_user_target'] ?? [];
$systemType = $_POST['system_type_id'] ?? '';
$integration = $_POST['integration_ids'] ?? [];
$languages = $_POST['id_programming_language'] ?? [];
$technologies = $_POST['id_technology'] ?? [];
$database = $_POST['id_database'] ?? '';
$aiDataType = $_POST['ai_data_type_id'] ?? '';
$aiFunctions = $_POST['ai_usage_type_ids'] ?? [];
$aiAlgorithms = $_POST['id_ai_technique'] ?? [];
$idea = $_POST['initial_idea'] ?? '';

$majorName = getNameById($conn, "majors", "id_major", "name_ar", $major);
$fieldName = getNameById($conn, "fields", "id_field", "name_ar", $field);
$visionName = getNameById($conn, "vision_goals", "id_goal", "goal_text", $vision);
$databaseName = getNameById($conn, "data_bases", "id_database", "database_name", $database);

function getMultipleNames($conn, $query, $params = [], $fieldName = 'name') {
  if (empty($params)) return [];
  $placeholders = implode(',', array_fill(0, count($params), '?'));
  $stmt = $conn->prepare(str_replace('?', $placeholders, $query));
  $types = str_repeat('s', count($params));
  $stmt->bind_param($types, ...$params);
  $stmt->execute();
  $result = $stmt->get_result();
  $names = [];
  while ($row = $result->fetch_assoc()) {
    $names[] = $row[$fieldName];
  }
  return $names;
}

$algorithmNames = getMultipleNames($conn, "SELECT algorithm_name as name FROM algorithms WHERE id_algorithm IN (?)", $algorithms);
$targetUserNames = getMultipleNames($conn, "SELECT target_name as name FROM user_targets WHERE id_user_target IN (?)", $targetUsers);
$languageNames = getMultipleNames($conn, "SELECT language_name as name FROM programming_languages WHERE id_programming_language IN (?)", $languages);
$technologyNames = getMultipleNames($conn, "SELECT technology_name as name FROM technologies WHERE id_technology IN (?)", $technologies);
$aiAlgorithmNames = getMultipleNames($conn, "SELECT algorithm_name as name FROM ai_techniques WHERE id_ai_technique IN (?)", $aiAlgorithms);
$aiFunctionNames = getMultipleNames($conn, "SELECT DISTINCT usage_type as name FROM ai_techniques WHERE usage_type IN (?)", $aiFunctions);

$aiDataTypes = [
  '1' => 'نص',
  '2' => 'صورة',
  '3' => 'بيانات رقمية',
  '4' => 'صوت',
  '5' => 'فيديو',
];

$study_levels = [
  '1' => 'بكالوريوس',
  '2' => 'دبلوم',
  '3' => 'ماجستير',
  '4' => 'دكتوراه',
];

$system_types = [
  '1' => 'موقع ويب',
  '2' => 'تطبيق جوال',
  '3' => 'سطح مكتب',
  '4' => 'ذكاء اصطناعي',
  '5' => 'شبكات',
];

$integration_options = [
  '1' => 'ذكاء اصطناعي',
  '2' => 'API خارجي',
  '3' => 'بوابات دفع',
  '4' => 'SMS',
  '5' => 'ERP',
  '6' => 'CRM',
  '7' => 'IoT',
  '8' => 'Arduino',
  '9' => 'Raspberry Pi',
  '10' => 'GPS',
  '11' => 'حساسات',
  '12' => 'ساعات ذكية',
];

$integrationText = !empty($integration)
  ? implode('،' , array_map(fn($id) => $integration_options[$id] ?? 'غير معروف', $integration))
  : 'لا يوجد';

$phone = $_POST['phone'] ?? $_GET['phone'] ?? '';
$request_id = $_POST['request_id'] ?? $_GET['request_id'] ?? '';

?>


<div id="printArea">
  <div class="idea-details">
    <strong>تفاصيل الفكرة :</strong>
    <p>نوع الدراسة: <?= $study_levels[$studyLevel] ?? 'غير محدد' ?></p>
    <p>التخصص: <?= htmlspecialchars($majorName) ?></p>
    <p>المجال: <?= htmlspecialchars($fieldName) ?></p>
    <p>التوجه الوطني: <?= htmlspecialchars($visionName) ?></p>
    <p>خوارزميات المشروع: <?= getSelectedText($algorithmNames) ?></p>
    <p>الفئة المستهدفة: <?= getSelectedText($targetUserNames) ?></p>
    <p>نوع النظام: <?= $system_types[$systemType] ?? 'لم يتم التحديد' ?></p>
    <p>التكامل مع أنظمة أخرى: <?= $integrationText ?></p>
    <p>لغات البرمجة: <?= getSelectedText($languageNames) ?></p>
    <p>التقنيات المستخدمة: <?= getSelectedText($technologyNames) ?></p>
    <p>نوع قواعد البيانات: <?= htmlspecialchars($databaseName) ?></p>
    <p>نوع البيانات المستخدمة في الذكاء الاصطناعي: <?= $aiDataTypes[$aiDataType] ?? 'لم يتم التحديد' ?></p>
    <p>أنواع الاستخدام للذكاء الاصطناعي: <?= getSelectedText($aiFunctionNames) ?></p>
    <p>الخوارزميات المقترحة للذكاء الاصطناعي: <?= getSelectedText($aiAlgorithmNames) ?></p>
  </div>

  <div>
    <strong>الفكرة المقترحة بناءً على التفاصيل المعطاة هي :</strong>
    <div class="idea-suggestion"><?= nl2br(htmlspecialchars($idea ?: 'لا يوجد فكرة محددة')) ?></div>
  </div>
</div>

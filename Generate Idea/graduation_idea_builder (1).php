<?php


// استقبال request_id و phone من الرابط
$request_id = filter_input(INPUT_GET, 'request_id', FILTER_VALIDATE_INT);
$phone = filter_input(INPUT_GET, 'phone', FILTER_SANITIZE_STRING);

// التحقق من القيم
if (empty($request_id) || empty($phone)) {
    header("Location: login.php?error=missing_data");
    exit;
}

?>



 <form action="idea.php" method="POST">
<input type="hidden" name="phone" value="<?= htmlspecialchars($phone) ?>">
<input type="hidden" name="request_id" value="<?= htmlspecialchars($request_id) ?>">

  <input type="hidden" name="phone" value="<?= htmlspecialchars($phone) ?>">
  <input type="hidden" name="request_id" value="<?= htmlspecialchars($request_id) ?>">

    
 <div class="field">
  <label>نوع الدراسة:</label>
  <select id="study-level" name="study_level_id" required>
    <option value="">-- اختر نوع الدراسة --</option>
    <option value="1">بكالوريوس</option>
    <option value="2">دبلوم</option>
    <option value="3">ماجستير</option>
    <option value="4">دكتوراه</option>
  </select>
</div>


    <!-- 2. التخصص -->
    <div class="field">
      <label>التخصص:</label>
      <select id="major-select" name="id_major" required></select>
    </div>

    <!-- 3. المجال -->
    <div class="field">
      <label>المجال:</label>
      <select id="field-select" name="id_field" required></select>
    </div>

    <!-- 4. التوجه الوطني -->
    <div class="field">
      <label>التوجه الوطني (رؤية 2030):</label>
      <select id="vision" name="id_goal"></select>
    </div>

    <!-- 5. خوارزميات المشروع -->
    <div class="field">
      <label>خوارزميات المشروع:</label>
      <select id="algorithms" name="id_algorithm[]" multiple></select>
    </div>

  </div>
</div>


  <div class="section-box">
  <h3>الفئة المستهدفة</h3>
  <div class="row">
    <div class="field">
      <label>الفئة المستهدفة:</label>
      <select id="target-users" name="id_user_target[]" multiple></select>
    </div>
  </div>
</div>

<div class="section-box">
  <h3>البرمجة والتقنيات</h3>

  <div class="row">

    <!-- 1. نوع النظام -->
<div class="field">
  <label>نوع النظام:</label>
  <select id="system-type" name="system_type_id" required>
    <option value="">-- اختر نوع النظام --</option>
    <option value="1">موقع ويب</option>
    <option value="2">تطبيق جوال</option>
    <option value="3">سطح مكتب</option>
    <option value="4">ذكاء اصطناعي</option>
    <option value="5">شبكات</option>
  </select>
</div>


    <!-- 2. التكامل مع أنظمة أخرى -->
  <div class="field">
  <label>التكامل مع أنظمة أخرى:</label>
  <select id="integration" name="integration_ids[]" multiple>
    <option value="1">ذكاء اصطناعي</option>
    <option value="2">API خارجي</option>
    <option value="3">بوابات دفع</option>
    <option value="4">SMS</option>
    <option value="5">ERP</option>
    <option value="6">CRM</option>
    <option value="7">IoT</option>
    <option value="8">Arduino</option>
    <option value="9">Raspberry Pi</option>
    <option value="10">GPS</option>
    <option value="11">حساسات</option>
    <option value="12">ساعات ذكية</option>
  </select>
</div>


  </div>

  <div class="row">
    <!-- 3. لغات البرمجة المقترحة -->
    <div class="field">
      <label>لغات البرمجة المقترحة:</label>
      <select id="tech-stack" name="id_programming_language[]" multiple></select>
    </div>

    <!-- 4. التقنيات المستخدمة -->
    <div class="field">
      <label>التقنيات المستخدمة:</label>
      <select id="technologies" name="id_technology[]" multiple></select>
    </div>
  </div>

  <div class="row">
    <!-- 5. نوع قواعد البيانات -->
    <div class="field">
      <label>نوع قواعد البيانات:</label>
      <select id="db-type" name="id_database"></select>
    </div>
  </div>

</div>



    <div class="section-box" id="ai-section" style="display: none;">
  <h3>الذكاء الاصطناعي</h3>

  <div class="row">

    <!-- 1. نوع البيانات المستخدمة -->
<div class="field">
  <label>نوع البيانات المستخدمة:</label>
  <select id="ai-data-type" name="ai_data_type_id">
    <option value="">-- اختر نوع البيانات --</option>
    <option value="1">نص</option>
    <option value="2">صورة</option>
    <option value="3">بيانات رقمية</option>
    <option value="4">صوت</option>
    <option value="5">فيديو</option>
  </select>
</div>


    <!-- 2. أنواع الاستخدام -->
    <div class="field">
      <label>أنواع الاستخدام:</label>
      <select id="ai-functions" name="ai_usage_type_ids[]" multiple></select>
    </div>
  </div>

  <div class="row">
    <!-- 3. الخوارزميات المقترحة -->
    <div class="field">
      <label>الخوارزميات المقترحة:</label>
      <select id="ai-algorithms" name="id_ai_technique[]" multiple></select>
    </div>
  </div>

</div>


      <div class="field">
        <label>فكرة أولية (اختياري):</label>
        <textarea rows="3" name="initial_idea" placeholder="إذا كان لديك فكرة أو مشكلة تريد حلها، اكتبها هنا..."></textarea>
      </div>

      <div class="buttons">
        <button type="submit" class="submit-btn"> عرض الفكرة</button>
       <button type="reset" class="reset-btn" style="background-color: #555; color: #fff;"> مسح الحقول</button>

      </div>
   
<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <title>نموذج إنشاء فكرة مشروع</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      direction: rtl;
      background-color: #f4f6f8;
      padding: 40px;
    }

    form {
      background-color: #fff;
      padding: 30px;
      border-radius: 15px;
      width: 90%;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    label {
      margin-top: 15px;
      font-weight: bold;
      display: block;
      color: #444;
    }

    select,
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background-color: #fefefe;
    }

    button {
      margin-top: 25px;
      padding: 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    button:hover {
      background-color: #0056b3;
    }

    details {
      margin-top: 20px;
      padding-top: 10px;
      border-top: 1px solid #ccc;
    }

    summary {
      font-weight: bold;
      cursor: pointer;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <form action="result.php" method="post">
    <h2>🧠 توليد فكرة مشروع باستخدام الذكاء الاصطناعي</h2>

    <!-- نوع الدراسة: -->
    <select name="study_type">
      <option value="جامعية">جامعية</option>
      <option value="دبلوم">دبلوم</option>
      <option value="ماجستير">ماجستير</option>
      <option value="دكتوراه">دكتوراه</option>
      <option value="تدريب مهني">تدريب مهني</option>
    </select>

    <!-- التخصص: -->
    <select name="specialization">
      <option value="علوم الحاسوب">علوم الحاسوب</option>
      <option value="هندسة برمجيات">هندسة برمجيات</option>
      <option value="ذكاء اصطناعي">ذكاء اصطناعي</option>
      <option value="نظم معلومات">نظم معلومات</option>
      <option value="أمن سيبراني">أمن سيبراني</option>
      <option value="تحليل البيانات">تحليل البيانات</option>
      <option value="هندسة حاسوب">هندسة حاسوب</option>
    </select>

    <!-- المجال: -->
    <select name="field">
      <option value="الصحة">الصحة</option>
      <option value="الطاقة">الطاقة</option>
      <option value="الزراعة">الزراعة</option>
      <option value="البيئة">البيئة</option>
      <option value="التعليم">التعليم</option>
      <option value="النقل والمواصلات">النقل والمواصلات</option>
      <option value="التسوق والتجارة">التسوق والتجارة</option>
      <option value="السلامة العامة">السلامة العامة</option>
    </select>

    <!-- الجمهور المستهدف: -->
    <select name="target_audience">
      <option value="الطلاب">الطلاب</option>
      <option value="الشركات">الشركات</option>
      <option value="المزارعين">المزارعين</option>
      <option value="المرضى">المرضى</option>
      <option value="ذوي الإعاقة">ذوي الإعاقة</option>
      <option value="المستهلكين">المستهلكين</option>
      <option value="المواطنين">المواطنين</option>
    </select>

    <!-- نوع النظام: -->
    <select name="system_type">
      <option value="ويب">ويب</option>
      <option value="تطبيق جوال">تطبيق جوال</option>
      <option value="نظام مدمج">نظام مدمج</option>
      <option value="سطح مكتب">سطح مكتب</option>
      <option value="نظام ذكي">نظام ذكي</option>
      <option value="لوحة تحكم">لوحة تحكم</option>
    </select>

    <!-- التقنيات المستخدمة: -->
    <select name="technologies" multiple>
      <option value="Python">Python</option>
      <option value="TensorFlow">TensorFlow</option>
      <option value="React">React</option>
      <option value="Node.js">Node.js</option>
      <option value="Flask">Flask</option>
      <option value="Django">Django</option>
      <option value="Keras">Keras</option>
      <option value="OpenCV">OpenCV</option>
      <option value="Firebase">Firebase</option>
      <option value="FastAPI">FastAPI</option>
    </select>

    <!-- نوع قاعدة البيانات: -->
    <select name="database_type">
      <option value="MySQL">MySQL</option>
      <option value="MongoDB">MongoDB</option>
      <option value="SQLite">SQLite</option>
      <option value="PostgreSQL">PostgreSQL</option>
      <option value="Oracle">Oracle</option>
      <option value="Firebase Realtime">Firebase Realtime</option>
    </select>


    <!-- Optional Section -->
    <details>
      <summary>🔍 خيارات متقدمة (اختيارية)</summary>

      <label>الاتجاه الوطني:</label>
      <select name="national_direction">
        <option value="">-- اختر --</option>
        <option value="الرؤية الوطنية 2030">الرؤية الوطنية 2030</option>
        <option value="التحول الرقمي">التحول الرقمي</option>
        <option value="الطاقة النظيفة">الطاقة النظيفة</option>
      </select>

      <label>خوارزميات المشروع:</label>
      <select name="project_algorithms">
        <option value="">-- اختر --</option>
        <option value="تصنيف">تصنيف</option>
        <option value="تجميع">تجميع</option>
        <option value="توقع">توقع</option>
      </select>

      <label>نوع التكامل:</label>
      <select name="integration">
        <option value="">-- اختر --</option>
        <option value="API">API</option>
        <option value="IoT">IoT</option>
        <option value="ERP">ERP</option>
      </select>

      <label>لغات البرمجة:</label>
      <select name="programming_languages" multiple>
        <option value="Python">Python</option>
        <option value="JavaScript">JavaScript</option>
        <option value="Java">Java</option>
        <option value="C#">C#</option>
        <option value="PHP">PHP</option>
      </select>

      <label>نوع بيانات الذكاء الاصطناعي:</label>
      <select name="ai_data_type">
        <option value="">-- اختر --</option>
        <option value="صور">صور</option>
        <option value="نصوص">نصوص</option>
        <option value="صوت">صوت</option>
        <option value="بيانات حساسات">بيانات حساسات</option>
      </select>

      <label>أنواع استخدام الذكاء الاصطناعي:</label>
      <select name="ai_use_types">
        <option value="">-- اختر --</option>
        <option value="تصنيف">تصنيف</option>
        <option value="توقع">توقع</option>
        <option value="تحليل">تحليل</option>
        <option value="توصية">توصية</option>
      </select>

      <label>خوارزميات الذكاء الاصطناعي:</label>
      <select name="ai_algorithms">
        <option value="">-- اختر --</option>
        <option value="Decision Trees">Decision Trees</option>
        <option value="Random Forest">Random Forest</option>
        <option value="KNN">KNN</option>
        <option value="SVM">SVM</option>
        <option value="Neural Networks">Neural Networks</option>
      </select>
    </details>

    <button type="submit">🚀 توليد الفكرة</button>
  </form>
</body>

</html>
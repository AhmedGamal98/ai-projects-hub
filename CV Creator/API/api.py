from flask import Flask, request, jsonify, json
import google.generativeai as genai
import random
import string
import os
import re

# ----------------- Configuration -----------------
app = Flask(__name__)
GENAI_API_KEY = os.environ.get("GEMINI_API_KEY", "YOUR_GEMINI_API_KEY")
genai.configure(api_key=GENAI_API_KEY)
gemini_model = genai.GenerativeModel("gemini-1.5-flash")

# ----------------- Prompt Builder -----------------
def build_prompt(data):
    return f"""
        أرغب في توليد محتوى احترافي لسيرة ذاتية مستخدم، بالاعتماد فقط على البيانات الفعلية التالية التي تم جمعها من النظام.
        يرجى عدم افتراض أي معلومات غير موجودة، والعمل فقط على ما تم تقديمه.

        🔹 البيانات المدخلة:
        👤 البيانات الشخصية:
        المسمى الوظيفي الحالي: {data.get("job_title", "")}

        🎓 المؤهلات العلمية (قد تكون أكثر من مؤهل):
        الدرجة العلمية: {data.get("edu_degree", "")}
        التخصص: {data.get("major_name", "")}
        سنة التخرج: {data.get("graduation_year", "")}
        حالة التخرج (مثلاً: متخرج، مستمر): {data.get("edu_status", "")}

        💼 الخبرات العملية (قد تكون متعددة):
        لكل خبرة:
        نوع الخبرة: {data.get("exp_type", "")}
        المسمى الوظيفي: {data.get("exp_title", "")}
        اسم الجهة: {data.get("exp_place", "")}
        وصف المهام الوظيفية: {data.get("exp_summary", "")}

        📜 الدورات والشهادات:
        يرجى التمييز بين:
        "الدورات التدريبية" و
        "الشهادات الاحترافية"
        لكل عنصر:
        الاسم: {data.get("cert_name", "")}
        الجهة المانحة: {data.get("cert_issuer", "")}
        النوع: {data.get("cert_type", "")} → (دورة او شهادة احترافية)

        🗣 اللغات:
        (قد تشمل أكثر من لغة)
        اللغة: {data.get("language", "")}
        المستوى: {data.get("level", "")}

        🏆 الإنجازات:
        وصف كل إنجاز: {data.get("achievement", "")}

        🔸 المطلوب من الذكاء الاصطناعي:

        **1. توليد 20 مهارة احترافية:**
        يُرجى استخراج المهارات من:
        - المؤهلات الأكاديمية
        - الخبرات العملية
        - محتوى الدورات والشهادات
        - الإنجازات
        - واللغات إن كان لها دور وظيفي

        📌 **مهم جدًا**:
        ✅ لا يُسمح بإدراج أي مهارات تقنية عامة (مثل برمجة، تحليل بيانات، إدارة مشاريع، إلخ).
        ✅ المهارات يجب أن تكون فقط من أحد النوعين التاليين:
          1. **مهارات شخصية** (مثل: العمل الجماعي، الالتزام، الانضباط، ...).
          2. **مهارات مرتبطة بالتخصص الدراسي** فقط (مثل: مهارات محاسبية، هندسية، إدارية... إلخ حسب التخصص المذكور).

        🔹 لكل مهارة:
        اسم المهارة  
        نوع المهارة (شخصية / محاسبية / هندسية / طبية / قانونية... حسب التخصص)

        **2. صياغة هدف وظيفي احترافي مختصر:**
        يرجى كتابة هدف وظيفي مكوّن من 4 إلى 6 أسطر، باللغة العربية الفصحى، واضح ومهني، وجاهز للاستخدام في بداية السيرة الذاتية.

        ✅ الهدف يجب أن يكون:
        - **إبداعيًا ومميزًا**
        - لا يكتفي فقط بذكر المؤهلات الدراسية والشهادات
        - يعكس الطموح، القيم المهنية، والقدرة على تقديم قيمة في العمل
        - إذا توفرت خبرات أو شهادات: يُراعى إبراز الكفاءة المهنية.
        - إذا لم تتوفر: اجعل الهدف طموحًا وواقعيًا، ويُظهر الاستعداد للتطور.

        **3. اقتراح دورات تدريبية وشهادات احترافية جديدة:**
        هذا الطلب دائمًا مطلوب، سواء وُجدت دورات سابقة أو لا.

        يرجى اقتراح دورات وشهادات:
        - مرتبطة بالتخصص الأكاديمي أو مجالات الخبرة
        - معترف بها محليًا أو عالميًا
        - مناسبة لمستوى المستخدم (مبتدئ / متوسط / متقدم)
        - يجب اقتراح من 2 الى 3 شهادات احترافية وكذلك من 2 الى 3 الدورات التدريبية

        إذا كان لدى المستخدم شهادات سابقة:
        🔸 اقترح محتوى أكثر تقدمًا أو مكملًا.

        ✅ تعليمات عامة:
        - لا تفترض أي بيانات غير موجودة
        - لا تستخدم صيغًا عامة أو إنشائية
        - استخدم لغة واضحة واحترافية
        - اجعل النتائج قابلة للاستخدام المباشر في ملف سيرة ذاتية دون تعديل

        📄 التنسيق المطلوب:

        **1. 20 مهارة احترافية:**

        | اسم المهارة               | نوع المهارة       |
        |----------------------------|------------------|
        | العمل الجماعي             | شخصية            |
        | الالتزام بالمواعيد        | شخصية            |
        | التفكير التحليلي          | شخصية            |
        | ...                        | محاسبية / هندسية ... |

        **2. هدف وظيفي:**

        صياغة احترافية، 6-4 أسطر، تعكس الطموح والقيمة المهنية.
        وعدم ذكر نهائيا اي معلومة من المعلومات المعطاه من المتسخدم مثل الشهادات والتدريبات وخلافه فقط اجعل الهدف الوظيفي عام بناء على المعطيات والمعلومات المعطاه اليك
        ابدأ دائما بجملة سعى للانضمام إلى بيئة عمل احترافية. في مجال ثم يتم ذكر المجال بناء على المعطيات.
        يجب ذكر القيمة الفعالة التي سوف احققها عند الانضمام الى العمل بعرض مهاراتي التقنية والتعليمية وكيفية استخدامها لتطبيق الهدف.
        يكون الهدف عبارة عن 4 الى 6 اسطر

        مثال لشكل الناتج المراد استخراجه

        أسعى للانضمام إلى بيئة عمل احترافية في المجال المالي، حيث أساهم في دعم العمليات المحاسبية وتحقيق الأهداف المالية للمؤسسة من خلال مهاراتي في تحليل البيانات وإعداد التقارير، والالتزام بمعايير الجودة والامتثال المالي. أؤمن بأهمية التطوير المستمر وأسعى لتعزيز كفاءتي المهنية بشكل دائم.

        **3. اقتراح دورات تدريبية وشهادات احترافية جديدة:**

        - اسم الدورة  
        - المنصة  
        - النوع (دورة او شهادة احترافية)  
        - ملاحظات

        مثال لشكل الناتج المراد استخراجه

        * **اسم الدورة:**  Financial Accounting Fundamentals  
        * **المنصة:** Coursera, edX 
        * **النوع:** دورة تدريبية  
        * **ملاحظات:**  تُقدم هذه الدورة أساسيات المحاسبة المالية، وتشمل إعداد البيانات المالية وتحليلها.  
    
        * **اسم الدورة:**  Advanced Excel for Accounting & Finance  
        * **المنصة:** Udemy, LinkedIn Learning 
        * **النوع:** دورة تدريبية  
        * **ملاحظات:**  تُركز هذه الدورة على استخدام إكسل في المحاسبة، مع التعمق في وظائف متقدمة مثل Pivot Tables و VBA لتحليل البيانات المالية.  
    
        * **اسم الدورة:**  IFRS - International Financial Reporting Standards  
        * **المنصة:** ACCA, Coursera 
        * **النوع:** دورة تدريبية  
        * **ملاحظات:**  تُغطي هذه الدورة المعايير الدولية لإعداد التقارير المالية، وتُساعد في فهم كيفية إعداد البيانات المالية وفقًا للمعايير العالمية.  
    
        * **اسم الدورة:**  Cost Accounting and Management  
        * **المنصة:** edX, Udemy 
        * **النوع:** دورة تدريبية  
        * **ملاحظات:**  تُركز هذه الدورة على محاسبة التكاليف وأساليب تحليل التكاليف، ودورها في دعم اتخاذ القرارات الإدارية والمالية.  
  


        """

# ----------------- Gemini API Call -----------------
def ask_gemini(prompt):
    response = gemini_model.generate_content(prompt)
    return response.text

# ----------------- Extract Arabic Structured Data -----------------
def extract_from_gemini(gemini_output):
    result = {
        "career_objective": "",
        "recommended_courses": [],
        "skills": []
    }

    # استخراج جدول المهارات بين "**1." و "**2."
    skills_section = re.search(r"\*\*1\..*?\*\*\n(.*?)\*\*2\.", gemini_output, re.DOTALL)
    if skills_section:
        table_text = skills_section.group(1)
        lines = table_text.strip().split('\n')

        skip_first_skill = True
        for line in lines:
            line = line.strip()
            if line.startswith('|') and not re.match(r'^\|[-\s|]+$', line):
                cols = [col.strip() for col in line.strip('|').split('|')]
                if len(cols) == 2:
                    skill_name, skill_type = cols
                    if skill_name and skill_type:
                        if skip_first_skill:
                            skip_first_skill = False
                            continue
                        result["skills"].append({
                            "skill_name": skill_name,
                            "skill_type": skill_type
                        })

    # استخراج الهدف المهني بين "**2." و "**3."
    objective_match = re.search(r"\*\*2\..*?\*\*\n(.*?)(?=\*\*3\.|\Z)", gemini_output, re.DOTALL)
    if objective_match:
        career_obj = objective_match.group(1).strip()
        career_obj = re.sub(r'\n\s+', ' ', career_obj)
        result["career_objective"] = career_obj

    # استخراج الدورات والشهادات من القسم "**3."
    courses_section = re.search(r"\*\*3\..*?\*\*\n(.*)", gemini_output, re.DOTALL)
    if courses_section:
        courses_text = courses_section.group(1)

        current_entry = {}
        lines = courses_text.strip().splitlines()
        for line in lines:
            line = line.strip()
            if not line:
                continue

            # استخراج اسم الدورة أو الشهادة
            title_match = re.search(r"اسم (?:الدورة|الشهادة):\s*(.+)", line)
            if title_match:
                if current_entry:
                    result["recommended_courses"].append(current_entry)
                title = title_match.group(1).strip()
                title = re.sub(r'^\*+\s*', '', title)
                current_entry = {
                    "title": title,
                    "type": "",
                    "platform": "",
                    "notes": ""
                }
                continue

            # استخراج النوع
            type_match = re.search(r"النوع:\s*(.+)", line)
            if type_match and current_entry:
                type_ = type_match.group(1).strip()
                type_ = re.sub(r'^\*+\s*', '', type_)
                current_entry["type"] = type_
                continue

            # استخراج الجهة المانحة / منصة / المنصة / جهة مانحة
            platform_match = re.search(
                r"(?:\*?\s*(?:الجهة\s*المانحة|جهة\s*مانحة|المنصة|منصة)\s*:?\s*)(.+)", line)
            if platform_match and current_entry:
                platform = platform_match.group(1).strip()
                platform = re.sub(r'^\*+\s*', '', platform)

                # حذف أي نصوص تفسيرية داخل الأقواس
                platform = re.sub(r'\([^)]*\)', '', platform)

                # حذف "أو موقع متخصص آخر" إذا وُجدت
                platform = re.sub(r'\s*أو\s*موقع\s*متخصص\s*آخر', '', platform)

                # تقسيم النص على "أو" وأخذ أول منصة فقط
                platform = re.split(r'\s*أو\s*', platform)[0]

                # تنظيف النص من الفراغات والشرطات المائلة
                platform = platform.strip().strip('/').strip()

                # إذا كانت النتيجة فارغة، اجعلها "Coursera"
                if not platform:
                    platform = "Coursera"

                current_entry["platform"] = platform
                continue

            # استخراج الملاحظات
            notes_match = re.search(r"ملاحظات:\s*(.+)", line)
            if notes_match and current_entry:
                notes = notes_match.group(1).strip()
                notes = re.sub(r'^\*+\s*', '', notes)
                current_entry["notes"] = notes
                continue

        # إضافة آخر مدخل
        if current_entry:
            result["recommended_courses"].append(current_entry)


    return result
# ----------------- API Endpoint -----------------
@app.route("/ping", methods=["GET"])
def ping():
    return jsonify({"message": "Server is awake"}), 200


# ----------------- API Endpoint -----------------
@app.route("/generate", methods=["POST"])
def generate():
    data = request.json or {}
    prompt = build_prompt(data)
    gemini_output = ask_gemini(prompt)
    structured_data = extract_from_gemini(gemini_output)

    return jsonify(structured_data), 200

# ----------------- Run App -----------------
if __name__ == "__main__":
    print("App running locally at http://127.0.0.1:5000")
    app.run(port=5000, threaded=True)
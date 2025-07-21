# 📄 CV Creator API (Arabic-Powered CV Assistant)

This project is a powerful Arabic-language intelligent assistant that generates **professional CV content** using Google Gemini's generative AI model. The API receives structured user data and returns:

- ✅ A customized **career objective**
- 🛠️ A list of **20 personalized skills** (categorized)
- 🎓 Recommended **courses and certifications**

---

## 🚀 Features

- 🌍 Arabic-language prompt for natural and accurate CV outputs
- 📊 Extracts structured data: skills, objectives, and learning paths
- ⚙️ Built with Flask — simple REST API
- 🤖 Powered by Google Gemini (1.5 Flash)
- 🔐 Secure and configurable with your Gemini API key

---

## 📁 Project Structure

CV Creator/
├── API/

│ ├── api.py # Main Flask app (this file)

│ ├── requirements.txt # All dependencies

│ └── Procfile # For deployment (e.g., Heroku)

├── send_cv.php # Optional: Send CV via email using PHP

├── API.ipynb # Jupyter notebook version (for testing)


---

## ⚙️ Requirements

- Python 3.8+
- Google Generative AI Python SDK (`google-generativeai`)
- Flask

---

## 🔧 Installation & Running Locally

1. **Clone the repository:**

```bash
git clone https://github.com/AhmedGamal98/AI-Porjects-Machine-Learning-Deep-Learning-APIs.git
cd AI-Porjects-Machine-Learning-Deep-Learning-APIs/CV%20Creator/API
```

2. Install dependencies:
```bash
pip install -r requirements.txt
```
4. Set your Gemini API key:

Replace the following line in api.py:
```bash
GENAI_API_KEY = "YOUR_GEMINI_API_KEY"
```
With your actual key from Google AI Studio.

4. Run the server:
```bash
python api.py
```
Server will be available at:
```bash
http://localhost:5000
```
📡 API Endpoints
GET /ping
Check if the server is alive:
```bash
curl http://localhost:5000/ping
```
Response:
```bash
{"message": "Server is awake"}
```

POST /generate
Send CV data and receive structured content.

📤 Request Body (JSON Example):
```bash
{
  "job_title": "محاسب مالي",
  "edu_degree": "بكالوريوس",
  "major_name": "محاسبة",
  "graduation_year": "2020",
  "edu_status": "متخرج",
  "exp_type": "دوام كامل",
  "exp_title": "محاسب أول",
  "exp_place": "شركة ABC",
  "exp_summary": "الإشراف على الحسابات المالية وتحليل التقارير",
  "cert_name": "CPA",
  "cert_issuer": "ACCA",
  "cert_type": "شهادة احترافية",
  "language": "العربية",
  "level": "متقدم",
  "achievement": "خفض التكاليف بنسبة 20% عبر تحليل الإنفاق"
}
```
📥 Response Body (JSON):
```bash
{
  "career_objective": "أسعى للانضمام إلى بيئة عمل احترافية...",
  "skills": [
    {"skill_name": "الالتزام بالمواعيد", "skill_type": "شخصية"},
    ...
  ],
  "recommended_courses": [
    {
      "title": "IFRS - International Financial Reporting Standards",
      "platform": "ACCA",
      "type": "دورة تدريبية",
      "notes": "تُغطي المعايير الدولية..."
    },
    ...
  ]
}
```
📌 Notes
Prompt and outputs are 100% in Arabic

All outputs are ready to use in a CV document

Only factual data is considered — hallucinations avoided

🚀 Deployment
You can deploy this Flask app to:

Render

Railway

Heroku

Include a Procfile:
```bash
web: python api.py
```
And set your environment variable: GENAI_API_KEY

📜 License
MIT License — free to use and modify.

🙋‍♂️ Author
Made with ❤️ by Ahmed Gamal

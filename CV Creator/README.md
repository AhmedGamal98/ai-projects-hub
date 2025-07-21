# 📄 CV Creator API

This project is an intelligent **CV Creator** system that generates personalized curriculum vitae using input data and delivers the final CV via email. It includes both an interactive notebook and a RESTful API built with Flask, along with a PHP-based email handler.

## 📁 Project Structure

CV Creator/
│
├── API/
│ ├── api.py # Main Flask API implementation
│ ├── requirements.txt # Dependencies for the API
│ └── Procfile # Deployment file for platforms like Heroku
│
├── API.ipynb # Jupyter Notebook version of the CV Creator logic
├── send_cv.php # PHP script to send the generated CV via email


---

## 🚀 Features

- 🧠 Automatically generates a CV based on user input
- 📧 Sends the generated CV directly to the provided email
- ⚙️ Flask-based API for integration with web services
- ✅ Ready for deployment with `Procfile` and `requirements.txt`
- 📓 Notebook included for demo/testing

---

## 🔧 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/AhmedGamal98/AI-Porjects-Machine-Learning-Deep-Learning-APIs.git
cd AI-Porjects-Machine-Learning-Deep-Learning-APIs/CV%20Creator
```
2. Set Up the API Environment
cd API
pip install -r requirements.txt

3. Run the Flask API

python api.py

The API will be available at: http://localhost:5000/

🧪 Example Usage
You can send a POST request to:
http://localhost:5000/generate_cv

With a JSON body like:
{
  "name": "Ahmed Gamal",
  "email": "ahmed@example.com",
  "skills": ["Python", "Flask", "Machine Learning"],
  "experience": "3 years at AI Company",
  "education": "B.Sc. in Computer Science"
}

The system will return a downloadable CV or send it to the email provided.

🌐 send_cv.php
The PHP script is used for sending the generated CV as an email attachment. Make sure your server is configured to send mail using mail() or integrate with SMTP services.

📒 Jupyter Notebook
Use API.ipynb to test the logic interactively or to prototype different CV formats.

📬 Contact
Developed by Ahmed Gamal

For inquiries, connect via LinkedIn

📄 License
This project is open-source and available under the MIT License.




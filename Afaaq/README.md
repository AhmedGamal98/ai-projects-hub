# 🌍 Afaaq - Gemini Places Recommender API

**Afaaq** is an AI-powered API that recommends top places in a city using **Google’s Gemini (Generative AI)** combined with **Selenium-based web scraping** for dynamic location mapping.  
It’s perfect for **tourism**, **travel**, and **discovery** applications that need smart and relevant place suggestions with real map links.

---

## 🚀 Features

- 🔎 Recommend places by **category & types** or free-form **description**
- 🤖 Powered by **Gemini Pro LLM** (Google Generative AI)
- 🗺️ Dynamically fetch **Google Maps links** using **Selenium**
- 🌐 Runs with **Flask** and **Ngrok** for public access
- 📦 Clean API structure for fast integration

---

## 📁 Project Structure

Afaaq-Gemini-Recommender/
│
├── app.py # Main Flask application
├── requirements.txt # Project dependencies
└── README.md # Project documentation

yaml
Copy
Edit

---

## 🧪 Tech Stack

- Python
- Flask
- Flask-Ngrok / Pyngrok
- Gemini (Google Generative AI)
- Selenium
- BeautifulSoup
- ChromeDriver (Headless)

---

## ⚙️ Installation & Setup

> ⚠️ Ensure you're using a Python 3.7+ environment (e.g., Google Colab, local virtualenv)

### 1. Install dependencies

```bash
pip install flask-ngrok pyngrok selenium
2. Set your API keys
Edit the following lines in app.py with your actual keys:

python
Copy
Edit
ngrok.set_auth_token("YOUR_NGROK_API_KEY")
genai.configure(api_key="YOUR_GEMINI_API_KEY")
3. Run the app
bash
Copy
Edit
python app.py
You’ll get a message like:

arduino
Copy
Edit
App running at https://xxxx-xx-xx-xx.ngrok-free.app
Use this URL to access your public API.

📡 API Endpoints
🔹 POST /gemini
Recommends places by country, city, category, and category types.

Request JSON:
json
Copy
Edit
{
  "country": "Saudi Arabia",
  "city": "Riyadh",
  "category": "Restaurants",
  "category_type": ["Italian", "Fine Dining"]
}
Response:
json
Copy
Edit
{
  "places": [
    {
      "place_name": "Spazio",
      "average_price": "SAR 200-500",
      "description": "A modern Italian restaurant...",
      "rating": "4.5/5",
      "working_time": "12 PM - 12 AM",
      "location": "https://goo.gl/maps/example"
    },
    ...
  ]
}
🔹 POST /gemini_search
Recommends places using a free-form description of what the user wants.

Request JSON:
json
Copy
Edit
{
  "country": "UAE",
  "city": "Dubai",
  "description": "Best rooftop lounges with music and city view"
}
Response: Same as /gemini
🖥️ Sample Output (Colab)
markdown
Copy
Edit
### Request:
- Country: UAE
- City: Dubai
- Description: Best rooftop lounges with music and city view

### Response:
{
  "places": [
    {
      "place_name": "Cé La Vi",
      "rating": "4.6/5",
      "average_price": "AED 250-600",
      "working_time": "5 PM - 2 AM",
      "description": "Sky-high rooftop lounge with panoramic views.",
      "location": "https://goo.gl/maps/..."
    },
    ...
  ]
}
🧠 Powered By
Google Gemini Pro

Ngrok

Selenium WebDriver

Flask

🤝 Contribution
Have ideas or fixes? Feel free to fork the repo and submit a pull request!
Let’s improve this AI discovery tool together 🌟

📜 License
This project is licensed under the MIT License. See the LICENSE file for details.

👤 Author
Ahmed Gamal
GitHub

Made with ❤️ for smarter cities and travelers.

yaml
Copy
Edit

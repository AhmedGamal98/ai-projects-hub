# AI Projects Hub

> Seven applied AI projects: deep-learning models, classic machine learning, and LLM-powered REST APIs built with Python, Flask and Google Gemini.

![Python](https://img.shields.io/badge/Python-3776AB?logo=python&logoColor=white)
![TensorFlow](https://img.shields.io/badge/TensorFlow-FF6F00?logo=tensorflow&logoColor=white)
![PyTorch](https://img.shields.io/badge/PyTorch-EE4C2C?logo=pytorch&logoColor=white)
![scikit-learn](https://img.shields.io/badge/scikit--learn-F7931E?logo=scikitlearn&logoColor=white)
![Flask](https://img.shields.io/badge/Flask-000000?logo=flask&logoColor=white)
![Google Gemini](https://img.shields.io/badge/Google%20Gemini-8E75B2?logo=googlegemini&logoColor=white)
![License: MIT](https://img.shields.io/badge/License-MIT-green)

## Projects

| Project | What it does | Tech |
| --- | --- | --- |
| [Genetic Medicine](Genetic%20Medicine) | Classifies sickle-cell disease from blood-smear images with a Swin Transformer (about 94% test accuracy), with a Gradio demo UI | PyTorch, timm, OpenCV, Gradio |
| [Nabra](Nabra) | Speech emotion recognition: extracts audio features with librosa and classifies 7 emotions with a CNN, served as an API | TensorFlow / Keras, librosa, Flask |
| [Medi Pal](Medi%20Pal) | Predicts how likely a patient is to take medication on time (medication adherence), served as an API | TensorFlow / Keras, scikit-learn, Flask |
| [Afaaq](Afaaq) | Recommends top places in any city by category or description, with Google Maps links | Flask, Gemini, Selenium |
| [CV Creator](CV%20Creator) | Generates Arabic CV content: career objective, 20 categorized skills, and suggested courses | Flask, Gemini, PHP client |
| [Generate Idea](Generate%20Idea) | Suggests software project ideas from a specialization, field and system type | Flask, Gemini, PHP form |
| [Job Seekers](Job%20Seekers) | Career-advice chatbot API (career change, job search, CV tips) | Flask, Gemini |

## Getting started

Each project lives in its own folder with a notebook (`.ipynb`) and, for the APIs, an `API/` folder.

```bash
git clone https://github.com/AhmedGamal98/ai-projects-hub.git
cd ai-projects-hub/"CV Creator"/API
pip install -r requirements.txt
export GEMINI_API_KEY=your_key        # PowerShell: $env:GEMINI_API_KEY = "your_key"
python api.py
```

The notebooks were written for Google Colab. Where a notebook shows `YOUR_GEMINI_API_KEY` or `YOUR_NGROK_API_KEY`, put in your own key before running. No real keys are stored in this repository.

## Large files

Trained models are attached to the [`files` release](https://github.com/AhmedGamal98/ai-projects-hub/releases/tag/files) instead of being stored in git.

| File in release | Put it at | Size |
| --- | --- | --- |
| `medi-pal-model.keras` | `Medi Pal/Preloads/model.keras` | 62 MB |
| `genetic-medicine-swin_classifier.h5` | `Genetic Medicine/Notebooks/swin_classifier.h5` | 4.5 MB |

## Author

**Ahmed Gamal Saber**, Full-Stack Web Developer & AI Engineer
[LinkedIn](https://linkedin.com/in/ahmed-gamal-saber-382081169) · [GitHub](https://github.com/AhmedGamal98)

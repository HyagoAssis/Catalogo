from flask import Flask, request
import urllib.request
from bs4 import BeautifulSoup as bs
from flask import Flask
from flask_cors import CORS

app = Flask(__name__)
CORS(app)


@app.route("/", methods=["POST"])
def selectHTML():
    body = request.get_json()
    url = body['url']
    page = urllib.request.urlopen(url)
    soup = bs(page, "html5lib")

    response = str(soup)

    return response

import os
from flask import Flask, flash,request, render_template, redirect, url_for, jsonify, send_from_directory
from werkzeug.utils import secure_filename
from script import procesar_video

UPLOAD_FOLDER = './public/videos'
ALLOWED_EXTENSIONS = set(['gif','avi','mp4', 'mov'])

app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
import string
import random

def allowed_file(filename):
    return '.' in filename and \
           filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

def new_random_name_title ():
	return ''.join(random.choice(string.ascii_uppercase + string.digits) for _ in range(28))


@app.route('/procesar/<name>', methods=['GET', 'POST'])
def upload_file(name):
	if request.method == 'GET' :
		id = new_random_name_title ()
		state = procesar_video(name,id)
		if os.path.isfile('./public/videos/'+id+'.mp4') and state:
			return  jsonify({'status':200, 'url':'./public/videos/'+id+'.mp4'})
		else:
			return jsonify({'status':404,'message':'no se pudo procesar'})
	return jsonify({'status':404,'message':'no se pudo procesar'})

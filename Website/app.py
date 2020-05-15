from flask import Flask,render_template,request,jsonify,make_response
import pandas as pd
from recommender_module import similarity_recommender
from sklearn.model_selection import train_test_split

app = Flask(__name__)

data = pd.read_csv("./data/song.csv")
data.sort_values(by=["title","artist_name"],ascending = False,inplace = True)
data.sort_values(by=["listen_count"],ascending = False,inplace = True)
trending_dict = dict(data.iloc[:7,:])

#Recommendation page
song1_df = pd.read_csv("./data/recommend_songs.csv")
train_data, test_data = train_test_split(song1_df, test_size = 0.20, random_state=0)

is_model = similarity_recommender()
is_model.create_s(train_data, 'user_id', 'Song')

@app.route('/')
def home():
   return render_template('home.html')

@app.route('/about')
def aboutus():
   return render_template('about.html')

@app.route('/contactus')
def contactus():
   return render_template("contactus.html")

@app.route('/trending')
def trending():
   return render_template("trending.html",trending_dict=trending_dict)

@app.route('/recommendations')
def recommendation():
   return render_template("recommendation.html",result = None)

@app.route("/recommendations",methods = ["POST"])
def recommendation_result():
   name = request.form["name"]
   if name == None:
      return render_template("recommendation.html",result = None,name = "No input value")
   result = is_model.similar_items([name]).to_dict()
   #result = is_model.similar_items(['U Smile - Justin Bieber']).to_dict()
   return render_template("recommendation.html",result = result,name = name)
   


if __name__ == '__main__':
   app.run(debug = True)
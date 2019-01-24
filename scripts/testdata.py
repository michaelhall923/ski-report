'''this is the most complete version of what I want'''
import mysql.connector
import urllib.parse
import urllib.request
import json
import datetime

api_key = "6f4a54a3c30645a8b7010452182012"

mydb = mysql.connector.connect(
	host= "localhost",
	user="root",
	password="",
	database="ski_resort")


mycursor = mydb.cursor(dictionary=True)

mycursor.execute("""SELECT * FROM resorts ;""")
myresult = mycursor.fetchall()


'''this will take gps points and auto generate an api request''' 
def snowfall_from(location):
	base_url = 'https://api.worldweatheronline.com/premium/v1/ski.ashx?'
	args = {'q': location, 'num_of_days': 1, 'key': api_key, 'format': 'json'}
	url = base_url + urllib.parse.urlencode(args)
	contents = urllib.request.urlopen(url).read()
	json_data = json.loads(contents)['data']
	weather = json_data['weather'][0]
	bottom_weather = json_data['weather'][0]['bottom'][0]
	middle_weather = json_data['weather'][0]['mid'][0]
	top_weather = json_data['weather'][0]['top'][0]
	
	bottom_mintemp = bottom_weather['mintempF']
	bottom_maxtemp = bottom_weather['maxtempF']
	middle_maxtemp = middle_weather['maxtempF']
	middle_mintemp = middle_weather['mintempF']
	top_mintemp = top_weather['mintempF']
	top_maxtemp = top_weather['maxtempF']
	snowfall = weather['totalSnowfall_cm']
	
	return  { 'bottom_mintemp' : bottom_mintemp, 'bottom_maxtemp' : bottom_maxtemp, 'middle_mintemp' : middle_mintemp, 'middle_maxtemp' : middle_maxtemp, 'top_mintemp' : top_mintemp, 'top_maxtemp' : top_maxtemp, 'snowfall' : snowfall }

data = []

for var in myresult:
	resort_id = var['idresort_id']
	weather = (snowfall_from(var['location']))
	date = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d")
	data.append({"resort_id" : resort_id, "date" : date, "snowfall" : weather["snowfall"], "bottom_mintemp" : weather["bottom_mintemp"], "bottom_maxtemp" : weather["bottom_maxtemp"],
	 "middle_mintemp" : weather["middle_mintemp"], "middle_maxtemp" : weather["middle_maxtemp"], "top_mintemp" : weather["top_mintemp"], "top_maxtemp" : weather["top_maxtemp"]})
	
print (data)	
	
for row in data:
	query = (
		f"INSERT INTO Reports (id, todays_date, snowfall, bottom_mintemp, bottom_maxtemp, mid_mintemp, mid_maxtemp, top_mintemp, top_maxtemp)\n"
		f"VALUES ({row['resort_id']}, '{row['date']}', {row['snowfall']}, {row['bottom_mintemp']}, {row['bottom_maxtemp']}, {row['middle_mintemp']}, {row['middle_maxtemp']}, {row['top_mintemp']}, {row['top_maxtemp']})"
	)
	mycursor.execute(query)
	print(query)


mydb.commit()

mydb.close()

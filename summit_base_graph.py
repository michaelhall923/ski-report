'''this is the most complete version of what I want'''
import mysql.connector
import urllib.parse
import urllib.request
import json
import datetime

api_key = "9225175d64d542b98b0172830181712"

mydb = mysql.connector.connect(
	host= "localhost",
	user="root",
	password="root",
	database="ski_report")


mycursor = mydb.cursor(dictionary=True)

mycursor.execute("""SELECT * FROM reports WHERE date = curdate();""")
myresult = mycursor.fetchall()


print (myresult)

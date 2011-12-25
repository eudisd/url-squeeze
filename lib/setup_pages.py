#! /usr/bin/env python 

import os
import datetime
from google.appengine.ext import webapp
from google.appengine.ext.webapp.util import run_wsgi_app
from google.appengine.ext.webapp import template
from google.appengine.ext import db

# First, define the necessary models
class UrlStorage(db.Model):
    long_url = db.StringProperty()
    short_url = db.StringProperty()
    date = db.DateProperty()
    thits = db.IntegerProperty()
    uhits = db.IntegerProperty()

class MainPage(webapp.RequestHandler):
    def get(self):
        self.response.headers['Content-Type'] = 'text/html'
        path = os.path.join(os.path.dirname(__file__), '../templates/index.html')
        self.response.out.write(template.render(path, {}))
        
class StatsPage(webapp.RequestHandler):
    def get(self):
        self.response.headers['Content-Type'] = 'text/html'
        path = os.path.join(os.path.dirname(__file__), '../templates/stats.html')
        self.response.out.write(template.render(path, {}))
 
class FaceboxPage(webapp.RequestHandler):
    def get(self):
        self.response.headers['Content-Type'] = 'text/html'
        path = os.path.join(os.path.dirname(__file__), '../templates/desc.html')
        self.response.out.write(template.render(path, {}))
        
class ShortenPage(webapp.RequestHandler):
    def get(self):
    
        short_handler = "http://eudisd.appspot.com/handler?id="
        
        self.response.headers['Content-Type'] = 'text/plain'
        
        # First we save the copy to be updated
        e = UrlStorage()
        e.long_url = self.request.get('url')
        e.date = datetime.datetime.now().date()
        e.put()
        
        short = short_handler + '1'
        
        self.response.out.write(short)

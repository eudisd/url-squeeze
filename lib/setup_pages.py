#! /usr/bin/env python 

import os
import datetime
from google.appengine.ext import webapp
from google.appengine.ext.webapp.util import run_wsgi_app
from google.appengine.ext.webapp import template
from google.appengine.ext import db

# A single global
short_handler = "http://url-squeeze.appspot.com/handler?id="
#short_handler = "http://localhost:8080/handler?id="

# First, define the necessary model
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
        
class HandlerPage(webapp.RequestHandler):
    """ This redirects the short url given, to the one associated in the db """
    def get(self):
        self.response.headers['Content-Type'] = 'text/html'
        id = self.request.get('id')
        url404 = '/404'
        url = '//' 
        # If it is in the database redirect, else 
        # send to error page
        if id != '':
            id = int(id)
            url = url + UrlStorage.get_by_id(id).long_url
           
            if url:
                self.redirect(url)
            else:
                self.redirect(url404)
        else:
            self.redirect(url404)
    
        
        
class ShortenPage(webapp.RequestHandler):
    def get(self):
        global short_handler
        
        self.response.headers['Content-Type'] = 'text/plain'
        
        # First we save the copy to be updated
        e = UrlStorage()
        e.long_url = self.request.get('url')
        e.date = datetime.datetime.now().date()
        e.put()
        
        short = short_handler + str(e.key().id())
        
        # Update the last entry short_url field
        
        e.short_url = short
        e.put()
        
        self.response.out.write(short)
        
class ErrorPage(webapp.RequestHandler):
    def get(self):
       self.response.headers['Content-Type'] = 'text/html'
       path = os.path.join(os.path.dirname(__file__), '../templates/404.html')
       self.response.out.write(template.render(path, {}))

#! /usr/bin/env python

from google.appengine.ext import webapp
from google.appengine.ext.webapp.util import run_wsgi_app
import lib.setup_pages

def main():
    application = webapp.WSGIApplication(
    [
    ('/', lib.setup_pages.MainPage),
    ('/stats', lib.setup_pages.StatsPage)
    ], debug=True)
    
    run_wsgi_app(application)
    return
  
if __name__ == "__main__":
    main()
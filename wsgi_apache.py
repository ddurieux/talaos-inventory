import sys
sys.path.insert(0, '/www/glpingpy')

from app import app as application

if __name__ == "__main__":
    app.run(debug = True)


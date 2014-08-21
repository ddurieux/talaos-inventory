curl -s -w \\n"%{time_connect}:%{time_starttransfer}:%{time_total}"\\n --request GET http://127.0.0.1/glping/public/computers

curl -s -w \\n"%{time_connect}:%{time_starttransfer}:%{time_total}"\\n --header "Content-type: application/json" --request POST --data '{"name": "pc xxxx"}' http://127.0.0.1/glping/public/computers

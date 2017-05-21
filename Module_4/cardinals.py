import re

def isPlayer(name):
    for i in playersList:
        if i['name'] == name:
            return i

def calculateAverage(name,atbats,hits):
	player = isPlayer(name)
	if player is None:
		player1 = {'name':name,'atbats':atbats,'hits':hits}
		playersList.append(player1)
	else:
		player['atbats'] += atbats
		player['hits'] += hits

myFile = raw_input("Enter name of file: ")

try:
	f = open(myFile, "r")
except IOError:
        print myFile," cannot be opened."
else:
	playersList = []
	players = {}
	line = f.readline()
	while line:
		pat = '(?P<name>[\w\s]+)\sbatted\s(?P<atbats>\d)[\w\s]+with\s(?P<hits>\d)'
		result = re.match(pat,line)
		if result:
			name = result.group('name')
			atbats = int(result.group('atbats'))
			hits = int(result.group('hits'))
			calculateAverage(name,atbats,hits)
		line = f.readline()

	for i in playersList:
		avg = 1.0*i['hits']/i['atbats']
		players[i['name']] = avg

	playerDict=sorted(players.items(), key=lambda avg:avg[1], reverse=True)
	for i in playerDict:
		print i[0],': ',round(i[1],3)

	f.close()
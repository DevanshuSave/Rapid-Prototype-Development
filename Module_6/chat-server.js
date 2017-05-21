// Require the packages we will use:
var http = require("http"),
	socketio = require("socket.io"),
	fs = require("fs");
 
// Listen for HTTP connections.  This is essentially a miniature static file server that only serves our one file, client.html:
var app = http.createServer(function(req, resp){
	// This callback runs when a new connection is made to our HTTP server.
 
	fs.readFile("client.html", function(err, data){
		// This callback runs when the client.html file has been read from the filesystem.
 
		if(err) return resp.writeHead(500);
		resp.writeHead(200);
		resp.end(data);
	});
});
app.listen(3456);

// Do the Socket.IO magic:
var io = socketio.listen(app);
// Structure refered from https://github.com/sterlingrollins/CSE330/
var clients = [];
rooms = {{home:{"members":[],	"master":null, "pwd":null, "banned_users":[]}};
io.sockets.on("connection", function(socket){
	// This callback runs when a new Socket.IO connection is established.
	var userObject = null;
	var server_user = null;
	var myRoom = "home";
	
	socket.on('message_to_server', function(data) {
		// This callback runs when the server receives a new message from the client.
		myData = data['room'];
		console.log("message: "+data["message"]); // log it to the Node.JS output
		for (var i = 0; i < clients.length; i++) {
			if (clients[i].room == message_room) {
				id = clients[i].id;
				//Do not broadcast
				io.to(id).emit("message_to_client",{ message:data["message"], user:data['user'] });
			}
		}
	});
	
	socket.on('private_msg', function(data) {
		slave = data['slave'];
		pm = data['msg'];
		recipient = null;
		master = data['master'];
		
		for (var i = 0; i < clients.length; i++ ) {
			if (clients[i].username == slave) {
				recipient = clients[i].id;
			}
		}
		if (recipient != null) {
			io.sockets.connected[recipient].emit("pm", {pm:pm, master:master});
		}
	});
	
	
	//User login
	socket.on('in',function(data){
		server_user = {'username':data['user'], 'id':socket.id, 'room':"home"};
		rooms.home.members.push(server_user);
		myRoom = "home";
		clients.push(server_user); //={"id":socket.id,"cur_room":"home"};
		io.sockets.emit("display_newUsers", {room:'home', users:rooms.home.members});
		var my_rooms = Object.keys(rooms);
		io.sockets.emit('display_newRoom', {rooms:my_rooms, masater: null});
		//socket.emit("user_join_callback" , {user:server_user, success:true});
		console.log('Login by '+data['user']);
	});
	
	//User logout
	//Code from https://github.com/sterlingrollins/
	socket.on('out', function(data) {
		var temp_user = new_user.username;
		var userObject = null;
		for (var i= 0; i < clients.length;i++) {
			if( clients[i].id==socket.id ) {
				userObject = clients[i];
			}
			var count = clients.indexOf(userObject);
			if(count > -1) {
				clients.splice(count,1);
			}
		}
		userObject = null;
		var room_keys = Object.keys(rooms);
		var room_index = -1;
		the_room = null;
		var user_room = null;
		for (var i = 0; i<room_keys.length; i++) {
			if(room_keys[i] == current_room) {
				room_index = i;
				the_room = room_keys[i];
			}
		}
		user_room = rooms[the_room];
		for (var i = 0; i<user_room.members.length; i++) {
			if(user_room.members[i].id ==socket.id) {
				userObject = user_room.members[i]; 
			}
			var room_no = user_room.members.indexOf(userObject);
			if(room_no >-1) {
				user_room.members.splice(room_no,1);
			}

		}
 
		//socket.emit('user_logout_callback', {success:true});
		io.sockets.emit('display_users', {room:the_room, users:rooms.home.members});
	});
	
	socket.on('new_public', function(data){
		rooms[data.room_name] = {"members":[],"master":data.master,"pwd":null,"banned_users":[]};
		list_rooms = Object.keys(rooms);
		io.sockets.emit('display_newRoom', {rooms:list_rooms, master: data.master});	
		console.log("User - " + data.master + "created a new public room - " + data.room_name);
	});
	
	socket.on('new_private', function(data){
		rooms[data.room_name] = {"members":[],"master":data.master,"pwd":null,"banned_users":[]};
		list_rooms = Object.keys(rooms);
		io.sockets.emit('display_newRoom', {rooms:list_rooms, master: data.master});	
		console.log("User - " + data.master + "created a new private room - " + data.room_name + "with pwd" + data.pwd);
	});
	
	socket.on('kick', function(data) {
		var room = data['room'];
		var master = data['master'];
		var slave = data['slave'];
		var room = rooms[room_name];
		var temp_master = room.master;
		if (temp_master == master) {
			var temp = null;
			for (var i = 0; i<clients.length; i++) {
				if (slave == clients[i].username) {
					temp = clients[i];
					break;
				}
			}
				
		for (var i =0; i<clients.length; i++) {
			if(clients[i] != null) {
			if(clients[i].id == slave.id) {
				userObject = clients[i];
				console.log("the userObject got set, userObject.username = " +  userObject.username);
			}}
		}
		userObject.room = 'home';
		
		var room_keys = Object.keys(rooms);
		console.log("Room keys is:");
		console.log(room_keys);
		var prev_room_index = -1;
		var prev_key_room = null;
		var prev_room = room_name;
		console.log("prev_room_index is " + prev_room_index);
		for (var i = 0; i<room_keys.length; i++) {
			if(room_keys[i] == prev_room) {
				prev_room_index = i;
				prev_key_room = room_keys[i];
			}
		}
		var prev_user_room = rooms[prev_key_room];
		var new_user_room = rooms['home'];
		new_user_room.members.push(userObject);
		console.log("new_user_room.members is " + new_user_room.members);
		
		
		//iterate through the room, remove the user when you find them by id
		for (var i = 0; i<prev_user_room.members.length; i++) {
			if(prev_user_room.members[i].id == slave.id) {
				userObject = prev_user_room.members[i]; 
			}
			var room_no = prev_user_room.members.indexOf(userObject);
			if(room_no > -1) {
				prev_user_room.members.splice(room_no,1);
			}

		}
		io.sockets.emit('display_newUsers', {room:prev_key_room, users:prev_user_room.members});
		
		} 
		else {
			return;
		}
		io.sockets.emit('display_newUsers', {room:'home', users:new_user_room.members});	
	});
	
	socket.on('ban', function(data) {
		var room = data['room'];
		var master = data['master'];
		var slave = data['slave'];
		var room = rooms[room_name];
		var temp_master = room.master;
		
		if (temp_master == master) {
			var slave = null;
			for (var i = 0; i<clients.length; i++) {
				if (slave == clients[i].username) {
					slave = clients[i];
					break;
				}
			}
			
		for (var i =0; i<clients.length; i++) {
			if(clients[i].id == slave.id) {
				userObject = clients[i];
				console.log("the userObject got set, userObject.username = " +  userObject.username);
			}
		}
		userObject.room = 'home';
		
		//find the index of the user's prev room in the rooms object/array
		var room_keys = Object.keys(rooms);
		console.log("Room keys is:");
		console.log(room_keys);
		var prev_room_index = -1;
		var prev_key_room = null;
		var prev_room = room_name;
		console.log("prev_room_index is " + prev_room_index);
		for (var i = 0; i<room_keys.length; i++) {
			if(room_keys[i] == prev_room) {
				prev_room_index = i;
				prev_key_room = room_keys[i];
			}

		}
		var prev_user_room = rooms[prev_key_room];
		var new_user_room = rooms['home'];
		new_user_room.members.push(userObject);
		
		for (var i = 0; i<prev_user_room.members.length; i++) {
			if(prev_user_room.members[i].id == slave.id) {
				userObject = prev_user_room.members[i]; 
			}
			var room_no = prev_user_room.members.indexOf(userObject);
			if(room_no > -1) {
				prev_user_room.members.splice(room_no,1);
			}

		}
		io.sockets.emit('display_newUsers', {room:prev_key_room, users:prev_user_room.members});
		room.banned_users.push(slave);
		} 
		else {
			return;
		}
		io.sockets.emit('display_newUsers', {room:'home', users:new_user_room.members});
		
	});
});

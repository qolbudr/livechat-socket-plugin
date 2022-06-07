const express = require('express');
const cors = require('cors');

const app = express();

const server = require('http').createServer(app);
const io = require('socket.io')(server, {
	cors: {
		origin: '*'
	}
});

const PORT = process.env.PORT || 3000;

app.use(cors());

app.use(express.static(__dirname + "/public"));

app.get('/', (req, res) => {
    res.json({
        message: 'Hello World'
    });
});

app.get('/user', (req, res) => {
    res.json([
    	{
    		id: 1,
    		name: "Admin",
    	}
    ]);
});


io.on("connection", function (socket) {
 	console.log(`User connected to server.`);

 	socket.on("openChat", function (data) {
 		const username = data.fromName;
 		const userId = data.fromId;
 		let room;

 		if(data.fromId > data.toId) {
 			room = `${data.chatId}${data.toId}${data.fromId}`
 		} else {
 			room = `${data.chatId}${data.fromId}${data.toId}`
 		}

	    socket.userId = userId;
	    socket.currentRoom = room;
	    socket.join(room);

	    console.log(`User ${username} join ${room} room successfully.`);

	    // socket.emit("updateChat", "INFO", "You have joined global room");
	    // socket.broadcast.to("global").emit("updateChat", "INFO", username + " has joined global room");
	    // io.sockets.emit("updateUsers", usernames);
	    // socket.emit("updateRooms", rooms, "global");
	});

	socket.on("sendMessage", function (data) {
	    io.sockets.to(socket.currentRoom).emit("updateChat", socket.userId, data);
	});
})

server.listen(PORT, () => {
    console.log(`Listening on ${PORT}`)
})

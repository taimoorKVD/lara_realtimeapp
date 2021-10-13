const express = require('express');
const app = express();

const { v4: uuidv4 } = require('uuid');

const port = process.env.port || 3030;

let mysql = require("mysql");

let connection = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "lara_realtimeapp"
});

const server = app.listen (`${port}`, () => {
  
    console.log(`listening on : ${port}`);
    connection.connect();

});

const io = require("socket.io")(server, {
    cors: {
        orgin: "*"
    }    
});

io.on('connection', (socket) => {
    console.log('client connected.');

    socket.on('order', (data) => {
        console.log(data);
        let order = {
            order_code: uuidv4(),
            item_id: data.itemId,
            quantity: 1,
            created_at: mysql.raw('CURRENT_TIMESTAMP()'),
            updated_at: mysql.raw('CURRENT_TIMESTAMP()')
        };

        let mydata = {
            order:order,
            itemName:data.itemName
        };

        connection.query('INSERT INTO orders SET ?', order, (error, results) => {
            if(error) throw error;
            console.log(results);

            io.emit('order_processed', mydata);
        });

    });


    socket.on('disconnect', () => {
        console.log('client disconnected.');
    });
});



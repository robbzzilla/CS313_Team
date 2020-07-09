var express = require('express');
var path = require('path');
var app = express();
var bcrypt = require('bcrypt');

const { Pool } = require('pg');


const saltRounds = 10;


const connectionString = process.env.DATABASE_URL || "postgres://zvyaaqwwedlmur:3d98e425f9532ac59bf8cfe5b15b83e2161ee22a4c2d7657fd2a2801ca76390f@ec2-34-195-169-25.compute-1.amazonaws.com:5432/d1nb6ksk1037dk?ssl=true";

//check if admin exists and delete him
var pool = new Pool({connectionString: connectionString});

var session = require('express-session');

app.set('trust proxy', 1)
app.use(session({
   secret: 'tunnel',
   name: "Bugs Bunny"
}));

app.use(express.json());
app.use(express.urlencoded({extended:true}));

app.set('port', (process.env.PORT || 5000));

app.use(express.static(path.join(__dirname, 'public')));

app.use(logRequest);
// routes
app.post('/login', login);
app.post('/logout', logout);
// middleware 
app.get('/getServerTime', linkedIn, getServerTime);
// Start the server
app.listen(app.get('port'), function() {
   console.log('Hey there YouTube! We are having a wonderful day here and we are coming to you live from port ', app.get('port'));
});

function login(request, response) {
   var result = {success: false};
   
   var givenHash = "";
   
   var pool = new Pool({connectionString: connectionString});
   pool.query('SELECT * FROM userList WHERE username = "admin"', function(err, result) {
      //  done();
       if (err){
            return console.error('error running query', err);
       }
       var hashFromDb = result.rows[0].userList.passwrd;
       const match = bcrypt.compareSync(request.body.password, hashFromDb);
       if (request.body.username == "admin" && match) {
          request.session.user = request.body.username;
          result = {success: true};
       }
   })

   response.json(result);
}

function logout(request, response) {
    var result = {success: false};
    
    if (request.session.user){
        request.session.destroy();
        result = {success: true};
    }
    response.json(result);
}

function getServerTime(request, response) {
    var time = new Date();

    var result = {success: true, time: time};
    response.json(result);
}

function linkedIn(request, response, next) {
    if (request.session.user) {
        next();
    }
    else {
        var result = {success:false, message: "Access Denied"};
        response.status(401).json(result);
    }
}

function logRequest(request, response, next) {
    console.log("Recieved a request for: " + request.url);
    next();
}
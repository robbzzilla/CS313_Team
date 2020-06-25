const express = require('express');
const app = express();

const { Pool } = require("pg");

const conStr = process.env.DATABASE_URL;

app.set('port', process.env.PORT);
app.use(express.static(__dirname + '/public'));

app.get('/person', getPerson);
app.get('/person/parents', getParents);
app.get('/person/children', getChildren);

app.listen(app.get('port'), function() {
   console.log('WAZZUP!!!!!!')
});

function getPerson(req, res) {
   const id = request.query.id;

   getPersonDb(id, function(error, result) {
      if (error || result == null || result.length != 1) {
         response.status(500).json({success: false, data: error});
      } else {
         const bro = result[0];
         response.status(200).json(bro);
      }
   });
}

function getPersonDb(id, lambda) {
   const sql = "SELECT person_id, first_name, last_name FROM person where id = $1::int";

   const params = [id];

   Pool.query(sql, params, function(error, result) {
      if(error) {
         lambda(error, null);
      }
      lambda(null, result.rows);
   })
}
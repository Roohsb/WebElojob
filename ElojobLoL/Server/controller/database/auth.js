var mysql = require('mysql');

module.exports = class AuthenticatorMYSQL{

    constructor(array){
        this.host = array[0];
        this.user = array[1];
        this.database = array[2];
        this.password = array[3];
    }


     connection(){
       return mysql.createPool({
        host: this.host,
        user: this.user,
        database: this.database,
        password: this.password,
      });
    }

       prepareQuery (query,rows) {
         const pool = this.connection()
        return new Promise((resolve, reject) => { pool.getConnection(function(err, connection) {
          if(err){
            console.log(err)
            return resolve([{errorMySQL: true}])
          }
          connection.query(query,rows, function (error, results, fields) {
            connection.release()
            pool.end()
            if(error) {
              console.log(error)
              resolve([{errorMySQL: true}])
          }else {
            resolve(results);
          }
          });
        });
      })
    }


}

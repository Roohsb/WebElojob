import mysql from 'mysql2'

module.exports = class AuthenticatorMYSQL{
  
    constructor(){
        this.host = process.env.DATABASE[0]
        this.user = process.env.DATABASE[1]
        this.database = process.env.DATABASE[2]
        this.password = process.env.DATABASE[3]
    }

     connection = () => mysql.createPool({
        host: this.host,
        user: this.user,
        database: this.database,
        password: this.password
      });

      prepareQuery (query,rows) {
        const pool = this.connection()
       return new Promise((resolve, reject) => { pool.getConnection(function(err, connection) {
         connection.query(query,rows, function (error, results, fields) {
           connection.release()
           pool.end()
           if(error) {
             resolve([{server: true}])
       }else {
         resolve(results);
       }
         });
       });
     })
   }

}

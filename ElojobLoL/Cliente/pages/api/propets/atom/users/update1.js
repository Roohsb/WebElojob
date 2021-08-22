import AuthenticatorMYSQL from '../../../../../controller/database/control'
import Logged from '../../../../../components/front/logged/class'
import bcrypt from 'bcrypt'


const saltRounds = 10;

const Mysql = new AuthenticatorMYSQL()

const LoggedAuth = new Logged()

export default async function(req,res){
  /**
     * @constant checkUser
     */
  const checkUser = LoggedAuth.VerifyToken(req.body.token)

  /**
    * @if Token
    * 
    * Verificando Token
    */
  if(typeof req.body.token === 'undefined' ||
     typeof req.body.user === 'undefined' ||
       checkUser === 0)
       {
         res.json({
           status:false,
           error: 1})
         return res.end()
       }

       try{
         const Post = JSON.parse(req.body.old)

         if(req.body.nome !== Post[0].nome && req.body.nome.length > 0){
          await Mysql.prepareQuery("UPDATE elo_users SET nome = ? WHERE user = ?",[req.body.nome,req.body.user])
         }
         if(req.body.celular !== Post[0].celular && req.body.celular.length > 0){
          await Mysql.prepareQuery("UPDATE elo_users SET celular = ? WHERE user = ?",[req.body.celular,req.body.user])
         }
         if(parseInt(req.body.nivel) !== Post[0].level && parseInt(req.body.nivel) >= 0 && parseInt(req.body.nivel) < 3){
          await Mysql.prepareQuery("UPDATE elo_users SET level = ? WHERE user = ?",[parseInt(req.body.nivel),req.body.user])
         }
         if(req.body.email !== Post[0].email && req.body.email.length > 1){
          await Mysql.prepareQuery("UPDATE elo_users SET level = ? WHERE user = ?",[req.body.email,req.body.user])
         }
         if(req.body.newpassword !== 'undefined' && req.body.newpassword.length > 1){
          bcrypt.hash(req.body.newpassword, saltRounds, async function(err, hash) {
            await Mysql.prepareQuery("UPDATE elo_users SET password = ? WHERE user = ?",[hash,req.body.user])
          });
         }

        res.json({
          status:true})
        return res.end()

       }catch(e){
         //console.log(e)
        res.json({
          status:false,
          error: 2})
        return res.end()
       }
}
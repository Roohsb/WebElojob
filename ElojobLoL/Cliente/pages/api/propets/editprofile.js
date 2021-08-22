import AuthenticatorMYSQL from '../../../controller/database/control'
import Logged from '../../../components/front/logged/class'
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
       checkUser === 0)
       {
         res.json({
           status:false,
           error: 1})
         return res.end()
       }

       try{
         const Post = JSON.parse(req.body.old)

         if(req.body.nome !== Post.nome && req.body.nome.length > 0){
          await Mysql.prepareQuery("UPDATE elo_users SET nome = ? WHERE id = ?",[req.body.nome,checkUser.userID2])
         }
         if(req.body.celular !== Post.celular && req.body.celular.length > 0){
          await Mysql.prepareQuery("UPDATE elo_users SET celular = ? WHERE id = ?",[req.body.celular,checkUser.userID2])
         }
         if(req.body.email !== Post.email && req.body.email.length > 1){
          await Mysql.prepareQuery("UPDATE elo_users SET level = ? WHERE id = ?",[req.body.email,checkUser.userID2])
         }
         if(req.body.newpassword !== 'undefined' && req.body.newpassword.length > 1){
          bcrypt.hash(req.body.newpassword, saltRounds, async function(err, hash) {
            await Mysql.prepareQuery("UPDATE elo_users SET password = ? WHERE id = ?",[hash,checkUser.userID2])
          });
         }

        res.json({
          status:true})
        return res.end()

       }catch(e){
        res.json({
          status:false,
          error: 2})
        return res.end()
       }
}
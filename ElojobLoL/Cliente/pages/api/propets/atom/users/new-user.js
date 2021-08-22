import AuthenticatorMYSQL from '../../../../../controller/database/control'
import Logged from '../../../../../components/front/logged/class'
import bcrypt from 'bcrypt'

const Mysql = new AuthenticatorMYSQL()

const saltRounds = 10;

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
     typeof req.body.mail === 'undefined' ||
     typeof req.body.celular === 'undefined' ||
     typeof req.body.nivel === 'undefined' ||
     typeof req.body.nome === 'undefined' ||
     typeof req.body.senha === 'undefined' ||
       checkUser === 0)
       {
         res.json({
           status:false,
           error: 1})
         return res.end()
       }

       try{
         const Search = await Mysql.prepareQuery("SELECT * FROM elo_users WHERE user = ?", [req.body.user])
         if(Search.length > 0)
         {
          res.json({
            status:false,
            error: 2})
          return res.end()
         }
         bcrypt.hash(req.body.senha, saltRounds, async function(err, hash) {
          await Mysql.prepareQuery("INSERT INTO elo_users (user,password,nome,email,level,celular) VALUES(?,?,?,?,?,?)",[req.body.user,hash,req.body.nome,req.body.mail,req.body.nivel,req.body.celular])
        });
        
         res.json({
          status:true})
        return res.end()
       }catch(e){
        res.json({
          status:false,
          error: 3})
        return res.end()
       }
}
import Mysql     from '../../../controller/database/control'
import Logged    from '../../../components/front/logged/class'
const LoggedAuth = new Logged()

const AuthenticatorMYSQL = new Mysql()

export default async function(req,res){
     /**
       * @function Token
       * 
       * Verificnado Token
       */
      if(typeof req.body.token === 'undefined' ||
         typeof req.body.user  === 'undefined' || 
         typeof req.body.ban   === 'undefined' ||
         LoggedAuth.VerifyToken(req.body.token) === 0)
      {
       res.json({
         status:false,
         error: 1})
       return res.end()
      }
      try{
    
        await AuthenticatorMYSQL.prepareQuery("UPDATE elo_users_personalization SET banner = ? WHERE usuario = ?",[req.body.ban,req.body.user])

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
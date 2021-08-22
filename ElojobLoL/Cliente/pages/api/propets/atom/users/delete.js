import AuthenticatorMYSQL from '../../../../../controller/database/control'
import Logged from '../../../../../components/front/logged/class'


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
 

   const Check = await Mysql.prepareQuery("SELECT id,level FROM elo_users WHERE id = ? AND level > ?",[checkUser.userID2,2])
 
   if(Check.length === 0)
   {
     res.json({
       status:false,
       error: 2})
     return res.end()
   }

   try{
    await Mysql.prepareQuery("DELETE FROM elo_users WHERE user = ?",[req.body.user])
    await Mysql.prepareQuery("DELETE FROM elo_users_accounts WHERE usuario = ?",[req.body.user])
    await Mysql.prepareQuery("DELETE FROM booster_messages WHERE user_send = ?" ,[req.body.user])
    await Mysql.prepareQuery("DELETE FROM elo_users_invoices WHERE usuario = ?",[req.body.user])
    await Mysql.prepareQuery("DELETE FROM elo_users_personalization WHERE usuario = ?",[req.body.user])
    await Mysql.prepareQuery("DELETE FROM updates_published WHERE owner = ?",[req.body.user])
  
  
    res.json({
      status:true,
      done: true
    })
    res.end()
  
    
    }catch(e){
      console.log({DeleteError: e})
      res.json({
        status:false,
        error: 3
      })
    }

}



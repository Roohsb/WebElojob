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
      typeof req.body.account === 'undefined' ||
      typeof req.body.user === 'undefined' ||
      checkUser === 0)
      {
        res.json({
          status:false,
          error: 1})
        return res.end()
   }
   try{
     const deletex = await Mysql.prepareQuery("DELETE FROM elo_users_accounts WHERE usuario = ? AND conta = ? AND working = ?",[req.body.user,req.body.account,0])

     if(deletex.affectedRows === 0){
      res.json({
        status:false,
        error: 2})
      return res.end()
     }
    
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
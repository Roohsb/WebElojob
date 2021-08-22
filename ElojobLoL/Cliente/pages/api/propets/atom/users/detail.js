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
    
      try{
        const userResult = await Mysql.prepareQuery("SELECT id,user,nome,email,celular,level,likes FROM elo_users WHERE user = ?",[req.body.user])

        const userAccounts = await Mysql.prepareQuery("SELECT * FROM elo_users_accounts WHERE usuario = ?",[req.body.user])

        if(userResult.length === 0)
          {
            res.json({
              status:false,
              error: 2})
            return res.end()
          }
          res.json({
            status: true,
            userResult,
            userAccounts})
          return res.end()
        }catch(e){
          console.log(e)
          res.json({
            status:false,
            error: 3})
          return res.end()
      }
  }


import AuthenticatorMYSQL from '../../../../../controller/database/control'
import Logged from '../../../../../components/front/logged/class'

const Mysql = new AuthenticatorMYSQL()

const LoggedAuth = new Logged()
export default async function(req,res){

  /**
   * @constant UserID
   * 
   * Verifica o token e tambem retorna os dados
   * do usuario logado. TOKEN DECRY
   */
  const checkUser = LoggedAuth.VerifyToken(req.body.token)

  /**
   * @if Token
   * 
   * Verificando Token
   */
  if(typeof req.body.token === 'undefined' || 
    typeof req.body.avatar === 'undefined' ||
    checkUser === 0
    )
    {
         res.json({
           status:false,
           error: 1})
         return res.end()
    }
    try{
      const Avatar = await Mysql.prepareQuery("SELECT * FROM personalization_avatar WHERE id = ?",[req.body.avatar])
      if(Avatar.length === 0)
      {
        res.json({
          status:false,
          error: 2})
        return res.end()
      }
        res.json({
        status:true,
        Avatar})
      return res.end()
    }catch(e){
      res.json({
        status:false,
        error: 3})
      res.end()
    }



}
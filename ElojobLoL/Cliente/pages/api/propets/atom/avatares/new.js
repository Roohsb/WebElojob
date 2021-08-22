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
     typeof req.body.avatar === 'undefined'   ||  
     typeof req.body.nome === 'undefined' ||
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
   await Mysql.prepareQuery("INSERT INTO personalization_avatar (name,img) VALUES(?,?)",[req.body.nome,req.body.avatar])

  res.json({
    status:true
  })
  res.end()
  }catch(e){
    res.json({
      status:false,
      error: 3
    })
  }
}
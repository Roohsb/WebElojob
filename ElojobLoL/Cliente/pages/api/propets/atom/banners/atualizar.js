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
     typeof req.body.banner === 'undefined' ||
     typeof req.body.name === 'undefined' ||
     typeof req.body.url === 'undefined' ||
     checkUser === 0)
  {
       res.json({
         status:false,
         error: 1})
       return res.end()
  }
  try{
    const CheckAvatar = await Mysql.prepareQuery("SELECT * FROM personalization_banner WHERE id = ?",[req.body.banner])
    if(CheckAvatar.length === 0){
      res.json({
        status:false,
        error: 2})
      return res.end()
    }
    if(CheckAvatar[0].name !== req.body.name)
    {
      await Mysql.prepareQuery("UPDATE personalization_banner SET name = ? WHERE id = ?",[req.body.name,req.body.banner])
    }
    if(CheckAvatar[0].url !== req.body.url)
    {
      await Mysql.prepareQuery("UPDATE personalization_banner SET img = ? WHERE id = ?",[req.body.url,req.body.banner])
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
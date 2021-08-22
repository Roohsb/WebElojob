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
     typeof req.body.titulo === 'undefined' ||
     typeof req.body.update === 'undefined' ||
     typeof req.body.content === 'undefined' ||
     checkUser === 0)
  {
       res.json({
         status:false,
         error: 1})
       return res.end()
  }
  try{
    const CheckUpdate = await Mysql.prepareQuery("SELECT * FROM updates_published WHERE id = ?",[req.body.update])
    if(CheckUpdate.length === 0){
      res.json({
        status:false,
        error: 2})
      return res.end()
    }
    if(CheckUpdate[0].titulo !== req.body.titulo)
    {
      await Mysql.prepareQuery("UPDATE updates_published SET title = ? WHERE id = ?",[req.body.titulo,parseInt(req.body.update)])
    }
    if(CheckUpdate[0].text !== req.body.content)
    {
      await Mysql.prepareQuery("UPDATE updates_published SET text = ? WHERE id = ?",[req.body.content,parseInt(req.body.update)])
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
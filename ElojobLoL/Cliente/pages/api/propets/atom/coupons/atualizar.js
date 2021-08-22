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
     typeof req.body.codigo === 'undefined' ||
     typeof req.body.idcoupon === 'undefined' ||
     typeof req.body.desconto === 'undefined' ||
     typeof req.body.expiracao === 'undefined' ||
     checkUser === 0)
  {
       res.json({
         status:false,
         error: 1})
       return res.end()
  }
  try{
    const CheckUpdate = await Mysql.prepareQuery("SELECT * FROM booster_cupons WHERE id = ?",[req.body.idcoupon])
    if(CheckUpdate.length === 0){
      res.json({
        status:false,
        error: 2})
      return res.end()
    }
    if(CheckUpdate[0].code !== req.body.codigo)
    {
      await Mysql.prepareQuery("UPDATE booster_cupons SET code = ? WHERE id = ?",[req.body.codigo,parseInt(req.body.idcoupon)])
    }
    if(CheckUpdate[0].discount !== req.body.desconto)
    {
      await Mysql.prepareQuery("UPDATE booster_cupons SET discount = ? WHERE id = ?",[req.body.desconto,parseInt(req.body.idcoupon)])
    }
    if(CheckUpdate[0].expires !== req.body.expiracao)
    {
      await Mysql.prepareQuery("UPDATE booster_cupons SET expires = ? WHERE id = ?",[req.body.expiracao,parseInt(req.body.idcoupon)])
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
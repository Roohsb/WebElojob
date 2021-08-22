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
  if(typeof req.body.token === 'undefined' || LoggedAuth.VerifyToken(req.body.token) === 0 ||
  typeof req.body.id === 'undefined')
  {
    res.json({
      status:false,
      error: 3})
    return res.end()
  }
  
  /**
   * @var Final
   * 
   * valor final do resultado baseado nos parametros
   */

  try{
      var Compras = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_invoices WHERE payment = ? AND booster = ? ORDER BY id DESC", [2, req.body.id])

      res.json({
        status:true,
        compras: Compras
      })
      res.end()

    }catch(e){
  console.log(e)
   res.json({
    status:false,
    error: 4
  })
  res.end()
}
}
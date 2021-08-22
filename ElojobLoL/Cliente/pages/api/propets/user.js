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
  if(typeof req.body.token === 'undefined' || LoggedAuth.VerifyToken(req.body.token) === 0)
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
  var Final = [];

  try{
  if(typeof req.body.user !== 'undefined')
  {
    var Usuario = await AuthenticatorMYSQL.prepareQuery("SELECT id,user,nome,email,celular,likes,level FROM elo_users WHERE user = ?",[req.body.user])
    Final.push({usuario: Usuario.length === 0 ? null: Usuario })
    if(Usuario.length === 0)
    {
      res.json({
        status:false,
        error: 2})
      return res.end()
    }

    if(typeof req.body.style !== 'undefined')
    {
      var Estilo = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_personalization WHERE usuario = ?", [Usuario[0].user])

      var Avatar = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM personalization_avatar WHERE id = ?", [Estilo[0].avatar])

      var Banner = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM personalization_banner WHERE id = ?", [Estilo[0].banner])

      Final.push({estilo: {avatar: Avatar, banner: Banner}})
    }
    
    if(req.body.invoices === true)
    {
      var Compras = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_invoices WHERE usuario = ?", [Usuario[0].user])

      Final.push({compras: Compras})
    }

    if(typeof req.body.jobs !== 'undefined')
    {
      var Compras = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_invoices WHERE booster = ?", [Usuario[0].id])

      Final.push({jobs: Compras})
    }

    if(req.body.accounts === true)
    {
      var LolContas = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_accounts WHERE usuario = ? AND invocador != 'undefined' ", [Usuario[0].user])

      Final.push({contas: LolContas})
    }

    res.json({
      status:true,
      Final})
    return res.end()
  }

  res.json({
    status:false,
    error: 1
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
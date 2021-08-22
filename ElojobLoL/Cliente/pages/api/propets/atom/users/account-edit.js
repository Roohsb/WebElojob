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
      typeof req.body.newaccount === 'undefined' ||
      typeof req.body.password === 'undefined' ||
      typeof req.body.invocador === 'undefined' ||
      typeof req.body.user === 'undefined' ||
      checkUser === 0)
      {
        res.json({
          status:false,
          error: 1})
        return res.end()
   }

   try{
    const Etp1 = await Mysql.prepareQuery("SELECT * FROM elo_users_accounts WHERE conta = ? AND usuario = ?",[req.body.account,req.body.user])

    if(Etp1[0].playing === 1)
    {
      res.json({
        status:false,
        error: 2})
      return res.end()
    }
    if(Etp1[0].working === 1 && req.body.newaccount !== Etp1[0].conta)
      {
        res.json({
          status:false,
          error: 3})
        return res.end()
    }

    if(req.body.password !== Etp1[0].senha)
    {
      await Mysql.prepareQuery("UPDATE elo_users_accounts SET senha = ? WHERE conta = ? AND usuario = ?",[req.body.password,req.body.account,req.body.user])
    }
    if(req.body.invocador !== Etp1[0].invocador)
    {
      await Mysql.prepareQuery("UPDATE elo_users_accounts SET invocador = ? WHERE conta = ? AND usuario = ? ",[req.body.invocador,req.body.account,req.body.user])
    }
    if(req.body.newaccount !== Etp1[0].conta)
    {
      await Mysql.prepareQuery("UPDATE elo_users_accounts SET conta = ? WHERE conta = ? AND usuario = ?",[req.body.newaccount,req.body.account,req.body.user])
    }
    
    res.json({status:true})
    return res.end()

   }catch(e){
    res.json({
      status:false,
      error: 4})
    return res.end()
   }
  }
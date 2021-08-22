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
  if(typeof req.body.token === 'undefined' || 
     typeof req.body.order === 'undefined' || 
     LoggedAuth.VerifyToken(req.body.token) === 0)
    {
      res.json({
        status:false,
        error: 1})
      return res.end()
    }
  

  try{
    await AuthenticatorMYSQL.prepareQuery("UPDATE elo_users_invoices SET booster = ? WHERE id = ?",[LoggedAuth.VerifyToken(req.body.token).userID2,req.body.order])

    res.json({
      status:true
    })

  res.end()

}catch(e){
  console.log(e)
   res.json({
    status:false,
    error: 2
  })
  res.end()
}
}
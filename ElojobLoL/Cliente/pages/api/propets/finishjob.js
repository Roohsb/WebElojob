import Mysql     from '../../../controller/database/control'
import Logged    from '../../../components/front/logged/class'
import {More}    from '../../../components/front/more/more'

const LoggedAuth = new Logged()

const Moree = new More()

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
    await AuthenticatorMYSQL.prepareQuery("UPDATE elo_users_invoices SET payment = ?, finish_date = ? WHERE id = ?",[3,Moree.timedatabase(new Date().getTime()),req.body.order])

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
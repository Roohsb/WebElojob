import Mysql from '../../../controller/database/control'
import Logged from '../../../components/front/logged/class'
const LoggedAuth = new Logged()

const AuthenticatorMYSQL = new Mysql()

export default async function(req,res){

  /**
	 * @param req.body.token
	 * 
	 * Verificando Token
	 */
	if (typeof req.body.token === 'undefined' ||
      LoggedAuth.VerifyToken(req.body.token) === 0) {
    res.json({
      status: false,
      error: 3
      })
    return res.end()
  }

  try{
    const User = LoggedAuth.VerifyToken(req.body.token)
    var Mensagens = []
    var MyJobs = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_invoices WHERE booster = ? AND payment = ?", [User.userID2,2])
    if(MyJobs.length > 0){
      for(var Ms of MyJobs){
        var Last = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM booster_messages WHERE order_id = ? AND user_send != ? ORDER BY id DESC LIMIT 1", [Ms.id,User.userID])
          if(Last.length > 0){
            Mensagens.push(Last[0])
          }
      }
    }
    
    res.json({
			status: true,
			mensagens: Mensagens
		})
		res.end()

  } catch (e) {
		console.log(e)
		res.json({
			status: false
		})
	}

}
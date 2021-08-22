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
    LoggedAuth.VerifyToken(req.body.token) === 0 ||
    typeof req.body.client === 'undefined') {
    res.json({
      status: false,
      error: 3
      })
    return res.end()
  }

  try{

    var Historico = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM booster_match_records WHERE order_id = ?", [parseInt(req.body.client)])
    
    if(Historico.length === 0 || Historico[0].server )
    {
      res.json({
        status: false
      })
      return res.end()
    }

    if(typeof Historico[0].data === 'undefined')
    {
      return res.json({
        status: true,
        historic: []
      }).end()
    }

    res.json({
			status: true,
			historic: JSON.parse(Historico[0].data)
		})
		res.end()

  } catch (e) {
		console.log(e)
		res.json({
			status: false
		})
	}

}
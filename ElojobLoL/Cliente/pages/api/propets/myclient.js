import Mysql from '../../../controller/database/control'
import Logged from '../../../components/front/logged/class'
const LoggedAuth = new Logged()

const AuthenticatorMYSQL = new Mysql()
export default async function(req, res) {

	/**
	 * @param req.body.token
	 * 
	 * Verificando Token
	 */
	if (typeof req.body.token === 'undefined' ||
		LoggedAuth.VerifyToken(req.body.token) === 0 ||
		typeof req.body.booster === 'undefined' ||
		typeof req.body.client === 'undefined') {
		res.json({
			status: false,
			error: 3
		})
		return res.end()
	}

	try {
		var Order = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_invoices WHERE id = ? AND booster = ? AND payment = ?", [parseInt(req.body.client), req.body.booster, 2])
      if(typeof Order[0].server !== 'undefined')
			{
        res.json({
          status: false
        })
        return res.end()
      }
			var array = JSON.parse(Order[0].data)

			if(array.AccountMethod)
			{
				if(array.AccountMethod === 'adicionarconta')
				{
					var Account = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_accounts WHERE conta = ? AND usuario = ?",[array.Login,Order[0].usuario])
				}else{
					var Account = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_accounts WHERE id = ? AND usuario = ?",[parseInt(array.LolAccount),,Order[0].usuario])
				}
				var Final = Order.concat(Account)
			}else{
				var Final = Order
			}
		res.json({
			status: true,
			order: Final
		})
		res.end()

	} catch (e) {
		res.json({
			status: false
		})
	}

}
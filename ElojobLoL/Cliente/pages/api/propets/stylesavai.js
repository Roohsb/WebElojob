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
         error: 1})
       return res.end()
      }
      try{
        const pic = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM personalization_avatar ORDER BY id DESC")

        const ban = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM personalization_banner ORDER BY id DESC")

        if(typeof req.body.search !== 'undefined')
        {
          const search = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_personalization WHERE usuario = ?", [req.body.search])

          const avatar = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM personalization_avatar WHERE id = ?", [search[0].avatar])

          const banner = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM personalization_banner WHERE id = ?", [search[0].banner])


          res.json({
            status:true,
            pic,
            ban,
            search,
            avatar,
            banner})
          return res.end()
        }

        res.json({
          status:true,
          pic,
          ban})
        return res.end()

      }catch(e){
        res.json({
          status:false,
          error: 2})
        return res.end()
      }
}
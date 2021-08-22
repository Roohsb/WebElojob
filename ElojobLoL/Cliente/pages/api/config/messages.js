import Mysql     from '../../../controller/database/control'
import Logged    from '../../../components/front/logged/class'
const LoggedAuth = new Logged()

const AuthenticatorMYSQL = new Mysql()

export default async function(req,res){

  if(typeof req.body.id === 'undefined' ||
  typeof req.body.token === 'undefined' || 
  LoggedAuth.VerifyToken(req.body.token) === 0)
  {
      res.send(
      {
         status: false,
         errorcode: 1,
         mensagem: 'Campos invalidos'
      })
    return res.end()
  }

  try{
    var CheckOrder = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_invoices WHERE id = ?", [req.body.id])

    if(CheckOrder.length === 0)
    {
      res.send(
        {
           status: false,
           errorcode: 2,
           mensagem: 'Compra não encontrada'
        })
      return res.end()
    }

    const messagesResult = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM booster_messages WHERE order_id = ? ORDER BY id DESC", [parseInt(req.body.id)])
    var mensagens = []

    if(messagesResult.length === 0)
    {
      res.send(
        {
           status: true,
           mensagens
        })
      return res.end()
    }

    for(var m of messagesResult){
      var t = m.user_send !== LoggedAuth.VerifyToken(req.body.token).userID ? 0 : 1
      var userDetails = await LoggedAuth.Details(req.body.token,m.user_send,['style'])

      mensagens.push({
        id: m.id, 
        tipo: t, 
        url: "https:\/\/elojobhigh.com.br\/app\/perfil\/"+m.user_send+"",
        nome: userDetails.Final[0].usuario[0].nome,
        avatar: userDetails.Final[1].estilo.avatar[0].img,
        mensagem: m.message,
        data: m.date
      })

    }

    res.send({
      status: true,
      mensagens
   })
   return res.end()

  }catch(e){

    res.send(
      {
         status: false,
         errorcode: 2,
         mensagem: 'Erro interno'
      })
    return res.end()

  }
}
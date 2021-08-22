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
   if(typeof req.body.mensagem === 'undefined' ||
      typeof req.body.id === 'undefined' ||
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
    var Command = 0;
    var checkOrder = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM elo_users_invoices WHERE id = ? AND payment > ?",[req.body.id,1])

    if(checkOrder.length === 0)
    {
        res.send(
          {
             status: false,
             errorcode: 2,
             mensagem: 'Compra nao encontrada'
          })
      return res.end()
    }
    const specialMessages = ['/alertar containcorreta', '/alertar precisodevoce']
    const special = specialMessages.filter(x => req.body.mensagem === x)

    if(special.length === 0){
      await AuthenticatorMYSQL.prepareQuery("INSERT INTO booster_messages (message,user_send,order_id) VALUES(?,?,?)", [req.body.mensagem,LoggedAuth.VerifyToken(req.body.token).userID,req.body.id])
    }else{

      async function GetCommand(token,order,mensagem) 
      {
        const Forumalario = new URLSearchParams();
        Forumalario.append('token', token)
        Forumalario.append('order', order)
        Forumalario.append('message', mensagem)
        const Api = await fetch(process.env.URLSERVER+'/api/special-message', {
          method: 'POST',
          body: Forumalario
        })
        const Resultado = await Api.text()
        return Resultado
      }

      const Teori = await GetCommand(req.body.token,req.body.id,req.body.mensagem)
      const Final = JSON.parse(Teori)
        Command = 1
      if(!Final.status){
        Command = 2
      }

    }

    const messagesResult = await AuthenticatorMYSQL.prepareQuery("SELECT * FROM booster_messages WHERE order_id = ? ORDER BY id DESC", [parseInt(req.body.id)])
    var mensagens = []

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
      mensagens,
      command: Command
   })
   return res.end()

   }catch(e){
     console.log(e)
     res.send({
      status: false,
      errorcode: 3,
      mensagem: 'Erro interno'
   })
   res.end()
   }
}
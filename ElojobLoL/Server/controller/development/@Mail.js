const nodemailer = require("nodemailer");

const Main = async (Order,reciver,type, command = 'none') => {
  try{
  let transporter = nodemailer.createTransport({
    host: "mail.elojobx.com",
    port: 465,
    secure: true,
    auth: {
      user: 'noreply@elojobx.com',
      pass: 'KhB$ucm.gpG3',
    },
  });

    var Titulo = "Um Pagamento foi feito"
    var Texto =  "O Pedido "+Order+" Foi pago com sucesso!"
    var Html = "<span>O Pedido "+Order+" Foi pago com sucesso!</span>"
    var Nome = '"Sevidor Pagamento" <noreply@elojobx.com>'

  if(type === 1){
    Titulo = "Hora de Chegar ao Topo, Seu pagamento foi feito com sucesso!"
    Texto = "Pedido pago com sucesso, daqui a 3 meses a gente upa tua conta pro prata, ta muito dificil subir"
    Html = "<span>Pedido pago com sucesso, daqui a 3 meses a gente upa tua conta pro prata, ta muito dificil subir!</span>"
    Nome = '"EloJobx Brasil Pagamentos" <noreply@elojobx.com>'
  }

  if(type === 2){
    Titulo = "Teste De Servidor"
    Texto = "Voce só esta recebendo este aviso por iniciar o servidor no nivel 3"
    Html = "Voce só esta recebendo este aviso por iniciar o servidor no nivel 3"
    Nome = 'Servidor Boot" <noreply@elojobx.com>'
  }
  if(type === 3){
    if(command !== 'none'){

      const Content = [{
        command: "/alertar containcorreta",
        titulo: "Alerta do Booster - Conta incorreta",
        texto: "Tivemos um problema ao tentar logar na sua conta do League Of Legends referente ao pedido "+Order+", pedimos que nos informe a conta corretamente no chat do seu pedido",
        html: "<span>Tivemos um problema ao tentar logar na sua conta do League Of Legends referente ao pedido "+Order+", pedimos que nos informe a conta corretamente no chat do seu pedido</span>",
        nome: '"EloJobx Brasil Alertas" <noreply@elojobx.com>'
      },
      {
        command: "/alertar precisodevoce",
        titulo: "Alerta do Booster - Precisamos falar com voce!",
        texto: "Voce esta recebendo este aviso porque encontramos algum problema referente ao pedido "+Order+", pedimos que nos contate o mais rapido possivel pelo no chat do seu pedido",
        html: "<span>Voce esta recebendo este aviso porque encontramos algum problema referente ao pedido "+Order+", pedimos que nos contate o mais rapido possivel pelo no chat do seu pedido</span>",
        nome: '"EloJobx Brasil Alertas" <noreply@elojobx.com>'
      }
    ]

    var Search = Content.filter(function(c){return (c.command == command)});
    if(Search.length === 0){
      return false
    }
    Titulo = Search[0].titulo
    Texto =  Search[0].texto
    Html =   Search[0].html
    Nome =   Search[0].nome
    }
  }

  await transporter.sendMail({
    from: Nome,
    to: reciver,
    subject: Titulo,
    text: Texto,
    html: Html
  });

  return true;

  }catch(e){
    console.log(e)
    return false
  }
}


module.exports = Main;

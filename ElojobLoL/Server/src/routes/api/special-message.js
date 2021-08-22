module.exports = function Authenticate(app, authJwt, modo, mysql, mail){
  app.post("/api/special-message", async function(req, res){
    const Token = req.body.token
    const Order = req.body.order
    const Menssagem = req.body.message

    if(typeof Token  === 'undefined' ||
       typeof Order  === 'undefined' ||
       typeof Menssagem === 'undefined')
       {
        return res.json({
          status: false,
          errorcode: 102,
          errormsg: "Parametros insuficientes"
        }).end()
      }

      /**
       * @const Autenthicate
       *
       * Verificando se o Token é correto
       * Retorna os dados já decodado
       */
       const Autenthicate = authJwt.CheckToken(Token)

       modo > 0 ?
       console.log('\x1b[33m%s\x1b[0m', `[ALERTAR USUARIO][${Autenthicate.userID}][${Token.substring(0, 15)}...][${Autenthicate !== 1 ? "AUTORIZADO": "NÃO AUTORIZADO"}][/api/special-message]`) : false

       if (Autenthicate === 1)
       {

         modo > 0 ?
         console.log('\x1b[33m%s\x1b[0m', `[ALERTAR USUARIO][${Autenthicate.userID}][RECUSADO][TOKEN DE ACESSO INVALIDO][/api/special-message]`) : false

          res.status(403)
          res.json({
                status: false,
                errormsg: "Token invalido",
                errorcode: 101
          })
          res.end();
          return;
       }



      try{
      const CheckOrder = await mysql.prepareQuery("SELECT * FROM elo_users_invoices WHERE id = ? AND payment > ?",[Order,1])

      if(CheckOrder.length === 0)
      {
        return res.json({
          status: false,
          errorcode: 102,
          errormsg: "Pedido nao encontrado"
        }).end()
      }

      if(typeof CheckOrder[0].errorMySQL !== 'undefined')
      {

        console.log('\x1b[31m%s\x1b[0m', `[ALERTAR USUARIO][ERROINTERNO][NÃO FOI POSSIVEL SE CONECTAR COM A DATABASE][/api/special-message]`)

          res.json({
            status: false,
            errorcode: 144,
            errormsg: "Erro Interno"
          })
          return res.end()

      }

      const specialMessages = ['/alertar containcorreta', '/alertar precisodevoce']
      const special = specialMessages.filter(x => Menssagem === x)
      if(special.length === 0)
        {
          modo > 0 ?
          console.log('\x1b[33m%s\x1b[0m', `[ALERTAR USUARIO][${Autenthicate.userID}][${Menssagem}][COMANDO DESCONHECIDO][/api/special-message]`) : false

          res.json({
            status:false,
            errorcode:103,
            errormsg:"Comando desconhecido"
          })
          return res.end()
      }

      const User = await mysql.prepareQuery("SELECT * FROM elo_users WHERE user = ?",[CheckOrder[0].usuario])
        if(User.length === 0)
        {
          modo > 0 ?
          console.log('\x1b[33m%s\x1b[0m', `[ALERTAR USUARIO][${Autenthicate.userID}][${CheckOrder[0].usuario}][${CheckOrder[0].id}][COMANDO DESCONHECIDO][/api/special-message]`) : false
          res.json({
            status:false,
            errorcode:102,
            errormsg:"Usuario desconhecido"
          })
          return res.end()
        }

      const SendMail = await mail(CheckOrder[0].id,User[0].email,3,Menssagem)

      if(!SendMail){
          res.json({
          status:false,
          errorcode:145,
          errormsg:"Erro interno"
        })
        return res.end()
      }

      res.json({
        status:true,
      })
      return res.end()


      }catch(e){
        console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/api/special-message]`)
        console.log(e)

        res.json({
          status:false,
          errorcode:145,
          errormsg:"Erro interno"
        })
        return res.end()
      }

  })
}

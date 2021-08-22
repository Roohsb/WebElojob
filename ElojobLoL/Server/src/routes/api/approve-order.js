module.exports = function ApproveOrder(app, authJwt, modo, mysql, SendMail, assist){
    app.post("/api/order/approve", async function(req, res)
    {

        res.setHeader('Access-Control-Allow-Origin', process.env.ALLOW_WEBSITE)
        res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
        res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type')
        res.setHeader('Access-Control-Allow-Credentials', true)

       /**
       * @const Token
       *
       * Contem todos os detalhes do post
       * {userID: PassWord:}
       */
      const Token = req.body.token
      const Order = req.body.order

      if(typeof Token  === 'undefined' ||
         typeof Order  === 'undefined')
         {
         return res.json({
          server: true,
          error: true,
          logged: false,
          errormsg: "Campos invalidos",
          errorcod: 100
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
      console.log('\x1b[33m%s\x1b[0m', `[APROVAR PEDIDO][${Autenthicate.userID}][${Token.substring(0, 15)}...][${Autenthicate !== 1 ? "AUTORIZADO": "NÃO AUTORIZADO"}][/api/order/approve]`) : false

      if (Autenthicate === 1)
      {

        modo > 0 ?
        console.log('\x1b[33m%s\x1b[0m', `[APROVAR PEDIDO][${Autenthicate.userID}][RECUSADO][TOKEN DE ACESSO INVALIDO][/api/order/approve]`) : false

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

        const Check = await mysql.prepareQuery("SELECT * FROM elo_users_invoices WHERE payment = ? AND id = ?",["1",req.body.order])

        if (Check.length === 0)
        {
          modo > 0 ?
          console.log('\x1b[33m%s\x1b[0m', `[PROCURAR PEDIDO][${Autenthicate.userID}][RECUSADO][PEDIDO DESCONHECIDO OU INVALIDO ${req.body.order}][/api/order/approve]`) : false

          res.json({
            status: false,
            errorcode: 102,
            errormsg: "Pedido desconhecido ou invalido"
          })
          return res.end()
        }

        if(typeof Check[0].errorMySQL !== 'undefined')
        {

        console.log('\x1b[31m%s\x1b[0m', `[PROCURAR PEDIDO][${Autenthicate.userID}][ERROINTERNO][NÃO FOI POSSIVEL SE CONECTAR COM A DATABASE][/api/order/approve]`)

          res.json({
            status: false,
            errorcode: 144,
            errormsg: "Erro Interno"
          })
          return res.end()

        }

        const User = await mysql.prepareQuery("SELECT user,email FROM elo_users WHERE user = ?",[Check[0].usuario])

        if (User.length === 0)
        {
          modo > 0 ?
          console.log('\x1b[33m%s\x1b[0m', `[PROCURAR PEDIDO][${Autenthicate.userID}][RECUSADO][O USUARIO QUE ESTA VINCULADO AO PEDIDO NÃO EXISTE ${Check[0].usuario}][/api/order/approve]`) : false

          res.json({
            status: false,
            errorcode: 103,
            errormsg: "Usuario desconhecido"
          })
          return res.end()
        }

        await mysql.prepareQuery("UPDATE elo_users_invoices SET payment = ?, date_aproved = ? WHERE id = ?",[2,assist.time(new Date().getTime()),req.body.order])

        await SendMail(req.body.order,User[0].email,1)

        res.json({
            status: true
        })

        return res.end()

    }catch(e){

      console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/api/order/approve]`)
      console.log(e)

        res.json({
            status: false,
            errorcode: 104,
            errormsg: "Erro Interno"
          })
          return res.end()
    }
})

}



module.exports = function MercadoPago(app, modo, mysql, assist, key, fire) {
  const mercadopago = require('mercadopago')
  mercadopago.configurations.setAccessToken(key)

  /**
     * @function BUY::APP.Post
     *
     * @description Função para criar um novo pedido PIX
     */
  app.post("/api/mercadopago/:order/buy", async function(req, res) {

      res.setHeader('Access-Control-Allow-Origin', 'https://elojobx.com')
      res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
      res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type')
      res.setHeader('Access-Control-Allow-Credentials', true)

      const Parametros = {
        c: req.body.cpf     ?? '',
        ci: req.body.cidade     ?? '',
        e: req.body.estado     ?? '',
        n: req.body.nome    ?? '',
        s: req.body.sobrenome ?? '',
        ce: req.body.cep    ?? '',
        r: req.body.rua     ?? '',
        b: req.body.bairro  ?? '',
        nu: req.body.numero ?? 'S/N',
        o: req.params.order ?? '',
        k: req.body.token   ?? ''
      }


      if(Parametros.c.replace(/\D/g,'').length < 11 ||
         Parametros.c.replace(/\D/g,'').length > 11 ||
         Parametros.n.length < 1 ||
         Parametros.s.length < 1 ||
         Parametros.r.length < 1 ||
         Parametros.b.length < 1 ||
         Parametros.k.length < 1 ){
          res.json({
            status: false,
            errorcode: 100,
            errormsg: "Parametros insuficientes"
          })
          return res.end()
        }


      const CheckToken = await mysql.prepareQuery("SELECT * FROM orders_tokens WHERE token = ? AND order_id = ?",[Parametros.k,Parametros.o])

      if (CheckToken.length === 0)
      {

        modo > 0 ?
        console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::PIX][${Parametros.k}][RECUSADO][TOKEN DE ACESSO INVALIDO][/api/mercadopago/:order/buy]`) : false

        res.json({
          status: false,
          errorcode: 101,
          errormsg: "Token Invalido"
        })
        return res.end()

      }

      if(typeof CheckToken[0].errorMySQL !== 'undefined')
      {

        console.log('\x1b[31m%s\x1b[0m', `[MERCADOPAGO::PIX][ERROINTERNO][NÃO FOI POSSIVEL SE CONECTAR COM A DATABASE][/api/mercadopago/:order/buy]`)

          res.json({
            status: false,
            errorcode: 144,
            errormsg: "Erro Interno"
          })
          return res.end()

      }

      const Order = await mysql.prepareQuery("SELECT * FROM elo_users_invoices WHERE id = ?",[Parametros.o])

      if (Order.length === 0)
      {
        await mysql.prepareQuery("DELETE FROM orders_tokens WHERE token = ? AND order_id = ?",[Parametros.k,Parametros.o])

        modo > 0 ?
        console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::PIX][${Order[0].id}][RECUSADO][PEDIDO DESCONHECIDO][/api/mercadopago/:order/buy]`) : false

        res.json({
          status: false,
          errorcode: 103,
          errormsg: "Pedido desconhecido"
        })
        return res.end()

      }

      const User = await mysql.prepareQuery("SELECT * FROM elo_users WHERE user = ?",[Order[0].usuario])

      if (User.length === 0)
      {

        modo > 0 ?
        console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::PIX][${Order[0].id}][RECUSADO][O CLIENTE QUE ESTA VINCULADO AO PEDIDO NAO EXISTE][/api/mercadopago/:order/buy]`) : false

        await mysql.prepareQuery("DELETE FROM orders_tokens WHERE token = ? AND order_id = ?",[Parametros.k,Parametros.o])
        res.json({
          status: false,
          errorcode: 103,
          errormsg: "Usuario não encontrado"
        })
        return res.end()

      }

      var payment_data = {
        transaction_amount: Number(assist.toamount(Order[0].valor)),

        description: `'EloJobx Brasil ${Order[0].id}`,
        payment_method_id: 'pix',
        payer: {
            email: User[0].email,
            first_name: Parametros.n,
            last_name:  Parametros.s,
            identification: {
                type: 'CPF',
                number: Parametros.c
            },
            address: {
                zip_code: Parametros.ce,
                street_name: Parametros.r,
                street_number: Parametros.nu,
                neighborhood: Parametros.b,
                city: Parametros.ci,
                federal_unit: Parametros.e
            }
        }
      };

      await mysql.prepareQuery("DELETE FROM orders_tokens WHERE token = ? AND order_id = ?",[Parametros.k,Parametros.o])
      if(!isNaN(parseInt(Order[0].payment_id)))
      {
          mercadopago.payment.get(Order[0].payment_id).then(async function(data) {
          if(data.body.status === 'approved')
          {

            console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::PIX][${Order[0].id}][RECUSADO][O USUARIO TENTOU PAGAR UM PEDIDO JÁ PAGO][/api/mercadopago/:order/buy]`)

            res.json({
              status:false,
              errorcode:143,
              errormsg:"Pedido já pago"
            })
            return res.end()

          }

          if(new Date().getTime() > assist.stamp(data.body.date_of_expiration))
          {

          modo > 0 ?
          console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::PIX][${Order[0].id}][NOTIFICACAO][OS DADOS DOPEDIDO FORAM ATUALIZADOS POIS O PIX JA ESTAVA VENCIDO][/api/mercadopago/:order/buy]`) : false

          mercadopago.payment.create(payment_data).then(async function(data2) {
          await mysql.prepareQuery("UPDATE elo_users_invoices SET payment_id = ? WHERE id = ?",[data2.body.id,Parametros.o])

          modo > 0 ?
          console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::PIX][${Order[0].id}][SUCESSO][O USUARIO RECEBEU UM QRCODE][/api/mercadopago/:order/buy]`) : false

            res.json({
              status:true,
              payment:{
                qrcodeimg: data2.body.point_of_interaction.transaction_data.qr_code_base64,
                qrcodecopy: data2.body.point_of_interaction.transaction_data.qr_code,
              }
            })
            return res.end()

        }).catch(function(error) {

          console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/api/mercadopago/:order/buy][PAYMENT_ID EXISTENTE]`)
          console.log(error)

          res.json({
            status:false,
            errorcode:145,
            errormsg:"Erro interno"
          })
          return res.end()
        });
        }

        modo > 0 ?
        console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::PIX][${Order[0].id}][SUCESSO][O USUARIO RECEBEU UM QRCODE][/api/mercadopago/:order/buy]`) : false

          res.json({
            status:true,
            payment:{
              qrcodeimg: data.body.point_of_interaction.transaction_data.qr_code_base64,
              qrcodecopy: data.body.point_of_interaction.transaction_data.qr_code,
            }
          })
          return res.end()

        }).catch(function(error) {
          console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/api/mercadopago/:order/buy][ERRO API MERCADOPAGO 1]`)
          console.log(error)

          res.json({
            status:false,
            errorcode:145,
            errormsg:"Erro interno"
          })
          return res.end()
        });
      }
      else
      {
        mercadopago.payment.create(payment_data).then(async function(data) {
          modo > 0 ?
          console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::PIX][${Order[0].id}][SUCESSO][O USUARIO RECEBEU UM QRCODE][/api/mercadopago/:order/buy]`) : false

          await mysql.prepareQuery("UPDATE elo_users_invoices SET payment_id = ? WHERE id = ?",[data.body.id,Parametros.o])
          fire.push({Order: data.body.id, Checkagens: 0}).write()
            res.json({
              status:true,
              payment:{
                qrcodeimg: data.body.point_of_interaction.transaction_data.qr_code_base64,
                qrcodecopy: data.body.point_of_interaction.transaction_data.qr_code,
              }
            })
            return res.end()

        }).catch(function(error) {

          console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/api/mercadopago/:order/buy][ERRO API MERCADOPAGO 2]`)
          console.log(error)

          res.json({
            status:false,
            errorcode:145,
            errormsg:"Erro interno"
          })
          return res.end()
        });
      }
  })

  /**
    * @function ALTERNATIVE::APP.Post
    *
    * @description Pedidos MercadoPago para pagamentos usando Cartão/boleto dentre outros.
    */
  app.post("/api/mercadopago/:order/buy/alternative", async function(req, res){

    res.setHeader('Access-Control-Allow-Origin', 'https://elojobx.com')
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type')
    res.setHeader('Access-Control-Allow-Credentials', true)

    if(typeof req.body.token   === 'undefined' ||
       typeof req.params.order === 'undefined')
    {
      res.json({
        status:false,
        errorcode: 100,
        errormsg: "Token invalido ou Parametros incorretos"
      })
      return res.end();
    }

    const CheckToken = await mysql.prepareQuery("SELECT * FROM orders_tokens WHERE token = ? AND order_id = ?",[req.body.token,req.params.order])


    if (CheckToken.length === 0)
    {
      modo > 0 ?
      console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::ALTERNATIVO][${req.body.token}][RECUSADO][TOKEN DE ACESSO INVALIDO][/api/mercadopago/:order/buy/alternative]`) : false

      res.json({
        status: false,
        errorcode: 101,
        errormsg: "Token Invalido"
      })
      return res.end()
    }

    if(typeof CheckToken[0].errorMySQL !== 'undefined')
    {

      console.log('\x1b[31m%s\x1b[0m', `[MERCADOPAGO::ALTERNATIVO][ERROINTERNO][NÃO FOI POSSIVEL SE CONECTAR COM A DATABASE][/api/mercadopago/:order/buy/alternative]`)

        res.json({
          status: false,
          errorcode: 144,
          errormsg: "Erro Interno"
        })
        return res.end()

    }

    const Order = await mysql.prepareQuery("SELECT * FROM elo_users_invoices WHERE id = ?",[req.params.order])

    if (Order.length === 0)
    {
      modo > 0 ?
      console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::ALTERNATIVO][${req.params.order}][RECUSADO][PEDIDO DESCONHECIDO][/api/mercadopago/:order/buy/alternative]`) : false

      await mysql.prepareQuery("DELETE FROM orders_tokens WHERE token = ? AND order_id = ?",[req.body.token,req.params.order])
      res.json({
        status: false,
        errorcode: 102,
        errormsg: "Pedido desconhecido"
      })
      return res.end()
    }

    const User = await mysql.prepareQuery("SELECT * FROM elo_users WHERE user = ?",[Order[0].usuario])

    if (User.length === 0)
    {
      modo > 0 ?
      console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::ALTERNATIVO][${Order[0].usuario}][RECUSADO][O CLIENTE QUE ESTA VINCULADO AO PEDIDO NAO EXISTE][/api/mercadopago/:order/buy/alternative]`) : false

      await mysql.prepareQuery("DELETE FROM orders_tokens WHERE token = ? AND order_id = ?",[req.body.token,req.params.order])
      res.json({
        status: false,
        errorcode: 103,
        errormsg: "Usuario não encontrado"
      })
      return res.end()
    }

    await mysql.prepareQuery("DELETE FROM orders_tokens WHERE token = ? AND order_id = ?",[req.body.token,req.params.order])

  /**
    * Parametros para criar um Pedido
    */
   Date.prototype.addDays = function (days) {
    const date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
      };

    var preference = {}
    var item = {
      title: `EloJobx ${Order[0].id}`,
      quantity: 1,
      currency_id: 'BRL',
      unit_price: Number(assist.toamount(Order[0].valor))
    }

    var payer = {
      email: User[0].email
    }
    const Reference = assist._generate(25)
    preference = {
      "back_urls": {
            "success": "https://elojobx.com/user/compras",
            "failure": "https://elojobx.com/user/compras",
            "pending": "https://elojobx.com/user/compras",
        },
    }
    preference.items = [item]
    preference.payer = payer
    preference.auto_return = "approved"
    preference.binary_mode = true
    preference.external_reference = Reference
    preference.date_of_expiration = new Date(new Date().addDays(1).toString().split('GMT')[0]+' UTC').toISOString()

    if(Order[0].payment_id !== null)
    {

      var filters = {
        external_reference: Order[0].payment_id
      };

      mercadopago.payment.search({qs: filters}).then(async function(data) {
      if(data.body.results.length > 0){
        const Result = data.body.results[0]
        if(Result.body.status === 'approved')
        {
          modo > 0 ?
          console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::ALTERNATIVO][${req.params.order}][RECUSADO][UM USUARIO TENTOU PAGAR UM PEDIDO JÁ PAGO][/api/mercadopago/:order/buy/alternative]`) : false

          res.json({
            status:false,
            errorcode:143,
            errormsg:"Pedido já pago"
          })
          return res.end()

        }
        else
        {
        fire.remove({Order: Order[0].payment_id}).write()
        fire.push({Order: Reference, Checkagens: 0}).write()

        mercadopago.preferences.create(preference).then(async function(data) {
          const PaymentID = data.body.id

          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::ALTERNATIVO][${Order[0].id}][SUCESSO][UM LINK DE PAGAMENTO FOI GERADO][/api/mercadopago/:order/buy/alternative]`) : false

          await mysql.prepareQuery("UPDATE elo_users_invoices SET payment_id = ? WHERE id = ?",[Reference,Order[0].id])

            res.json({
              status: true,
              paymentid: PaymentID
            })
          return res.end()

        }).catch(function(error) {

          console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/api/mercadopago/:order/buy/alternative][ERRO API MERCADOPAGO::ALTERNATIVO 1]`)
          console.log(error)

          res.json({
            status:false,
            errorcode:145,
            errormsg:"Erro interno"
          })
          return res.end()
        });

        }

      }
      else
      {
        fire.remove({Order: Order[0].payment_id}).write()
        fire.push({Order: Reference, Checkagens: 0}).write()

        mercadopago.preferences.create(preference).then(async function(data) {
          const PaymentID = data.body.id
          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::ALTERNATIVO][${Order[0].id}][SUCESSO][UM LINK DE PAGAMENTO FOI GERADO][/api/mercadopago/:order/buy/alternative]`) : false

          await mysql.prepareQuery("UPDATE elo_users_invoices SET payment_id = ? WHERE id = ?",[Reference,Order[0].id])

            res.json({
              status: true,
              paymentid: PaymentID
            })
          return res.end()

        }).catch(function(error) {
          modo > 0 ?
          console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/api/mercadopago/:order/buy/alternative][ERRO API MERCADOPAGO::ALTERNATIVO 2]`) : false
          console.log(error)

          res.json({
            status:false,
            errorcode:145,
            errormsg:"Erro interno"
          })
          return res.end()
        });
      }

      })
    }
    else
    {

    mercadopago.preferences.create(preference).then(async function(data) {
      const PaymentID = data.body.id
      fire.push({Order: Reference, Checkagens: 0}).write()

      modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[MERCADOPAGO::ALTERNATIVO][${Order[0].id}][SUCESSO][UM LINK DE PAGAMENTO FOI GERADO][/api/mercadopago/:order/buy/alternative]`) : false

      await mysql.prepareQuery("UPDATE elo_users_invoices SET payment_id = ? WHERE id = ?",[Reference,Order[0].id])

        res.json({
          status: true,
          paymentid: PaymentID
        })
        res.end()

    }).catch(function(error) {

      modo > 0 ? console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/api/mercadopago/:order/buy/alternative][ERRO API MERCADOPAGO::ALTERNATIVO 3]`) : false
      console.log(error)

      res.json({
        status:false,
        errorcode:145,
        errormsg:"Erro interno"
      })
      res.end()
    });
    }
  })
}

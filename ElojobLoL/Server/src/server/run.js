module.exports = function Run(Assist, modo , fire , mysql, key, email){
  var cron = require('node-cron');

  const Check = async () => {
    var d = 0;
    var o = 0;
    for(var p of fire.value())
        {
        if(p.Checkagens < 144){
          o++
        }
        if(p.Checkagens === 144){
          d++;
          await mysql.prepareQuery("UPDATE elo_users_invoices SET payment_id = ? WHERE id = ?",[null,p.Order])
          fire.remove({Order: p.Order}).write()
        }
     }
    console.log(`Deletado: ${d} A Rodar: ${o}`)
  }

  const PaymentDone = async (order) =>{
    const mercadopago = require('mercadopago')
    mercadopago.configurations.setAccessToken(key)

    var pagamento;
    if(order.toString().length > 24){

      var filters = {
        external_reference: order
      };
      pagamento = mercadopago.payment.search({qs: filters}).then(async function(data) {
        if(data.body.results.length > 0){

          if(data.body.results[0].status === 'approved')
          {

          await mysql.prepareQuery("UPDATE elo_users_invoices SET payment = ?, date_aproved = ? WHERE payment_id = ?",[2,Assist.time(new Date().getTime()),order])
          const getUser =  await mysql.prepareQuery("SELECT usuario,payment_id FROM elo_users_invoices WHERE payment_id = ?",[order])
          const getEmail = await mysql.prepareQuery("SELECT user,email FROM elo_users WHERE user = ?",[getUser[0].usuario])
          await email(order,getEmail[0].email,1)
          return 0
        }
          return 1
        }
        return 1
      }).catch(function(error) {
        console.log(error)
        return 2
      });
    }else{
      pagamento = mercadopago.payment.get(order).then(async function(data) {
      if(data.body.status === 'approved')
      {
        await mysql.prepareQuery("UPDATE elo_users_invoices SET payment = ?, date_aproved = ? WHERE payment_id = ?",[2,Assist.time(new Date().getTime()),order])

        await email(order,data.body.payer.email,1)

        return 0
      }
      return 1
    }).catch(function(error) {
      console.log(error)
      return 2
    });
  }

    return pagamento
  }

  const Verify = async () =>{
    for(var p of fire.value())
    {
      if(p.Checkagens < 144){
        fire.find({Order: p.Order}).assign({Checkagens: p.Checkagens+1}).write()
          var Pedido = await PaymentDone(p.Order)
          if(Pedido === 0){
            var Email = await email(p.Order,"suporte@elojobx.com",0)
              if(Email){
                console.log('Um pedido foi pago! '+p.Order +' Email Enviado!')
              }else{
                console.log('Um pedido foi pago! '+p.Order +' mas não foi possivel enviar o Email!')
              }
             fire.remove({Order: p.Order}).write()
          }
          if(Pedido === 1){
             console.log('Ainda não foi pago! '+p.Order)
          }
          if(Pedido === 2){
             console.log('Ocorreu um erro! '+p.Order)
          }
      }
    }
    return true;
  }

  cron.schedule('*/2 * * * *', () => {
    Check();
  });

  cron.schedule('*/10 * * * *', () => {
    Verify()
  });

    Check()
}

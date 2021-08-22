module.exports.Presets = class Presets{
  NORMAL = 0
  SECURE = 1
  DEVOLOPER = 2
  SERVER_PORT = 80

  MYSQL = ['localhost','root','elojobx',null]

  LEAGUE_KEY = 'RGAPI-79dc7fd8-a24d-4810-8d8f-6d233b3e5afe'
  MPKEY = 'APP_USR-6758894704344785-070519-991df5fb69ced4043ceff96f315ed984-335152350'

  MASTER_EMAIL = 'suporte@elojobx.com'

}

module.exports.Assistants = class Assistants{

duration = (num) => {
  var a = num / 60
  var b = a.toString().substring(0, 2)
  var c = a.toString().split(".")[1].substring(0, 2)
  return `${b}:${c}`
}

time = (stamp) => {
  var date = new Date(stamp);
  return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
}

stamp = (time) =>{
  const data = new Date(time);
  return data.getTime()
}

_decry = (hash) =>{
  const crypto = require('crypto');
  try{
  var decryptor = crypto.createDecipheriv('AES-256-CBC', '0bfa8olhmBcGwa2HxjvC0bfa8olhmBcG', '0bfa8olhmBcGwa2HxjvC0bfa8olhmBcG'.substr(0,16));
      return decryptor.update(hash, 'base64', 'utf8') + decryptor.final('utf8');
  }catch(e){
    return false;
  }
}

_generate = (length) => {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() *
 charactersLength));
   }
   return result;
}


toamount = (money) =>{
  const conversor = (valor) =>{
    if(valor.split("R$ ")[1].replace(",",".").replace(".","").length === 7){
      return valor.split("R$ ")[1].replace(",",".").replace(".","")
    }
    if(valor.split("R$ ")[1].replace(",",".").replace(".",".").length === 6){
      return valor.split("R$ ")[1].replace(",",".").replace(".",".")
    }
    if(valor.split("R$ ")[1].replace(",",".").replace(".",".").length === 5){
      return valor.split("R$ ")[1].replace(",",".").replace(".",".")
    }
    if(valor.split("R$ ")[1].replace(",",".").replace(".",".").length === 4){
      return valor.split("R$ ")[1].replace(",",".").replace(".",".")
    }
  }
  return conversor(money)
}

}

module.exports.Database = class Database{

Connect = (Database) => {
  var low = require('lowdb');
  var FileSync = require('lowdb/adapters/FileSync');
  var adapter = new FileSync(`./controller/payments/${Database}.json`);
  var db = low(adapter);
  return db
}


}

module.exports.Starting = class Starting{

  MAXLevel = 2
  PRIVATEJwt =    typeof process.env.PRIVATE_JWT !== 'undefined' ? process.env.PRIVATE_JWT.length > 0 ? process.env.PRIVATE_JWT : false : false
  PRIVATEPts =    typeof process.env.PRIVATE_PTS !== 'undefined' ? process.env.PRIVATE_PTS.length > 0 ? process.env.PRIVATE_PTS : false : false
  PRIVATEString = typeof process.env.PRIVATE_STRING !== 'undefined' ? process.env.PRIVATE_STRING.length > 0 ? process.env.PRIVATE_STRING : false : false

  checkLevel = (level) => {
    if(isNaN(level) || level > this.MAXLevel)
    {
      return isNaN(level) === true ? ' O Nivel deve ser um valor int': ' O Modo de inicializacao deve ser de 0 a 3';
    }
    return false
  }

  checkKeys = () =>{
  if(!this.PRIVATEJwt){    return 'A KEY JWT Deve ser preenchida!'}
  if(!this.PRIVATEPts){    return 'A KEY PTS Deve ser preenchida!'}
  if(!this.PRIVATEString){ return 'A KEY STRING Deve ser preenchida!'}
  return false
  }

  checkLeague = (key) =>{
    return key !== 'undefined' ? key.length > 0 ? false: 'A KEY LEAGUE_KEY Deve ser corretamente!' : 'A KEY LEAGUE_KEY Deve ser corretamente!'
  }

  checkMpKey = (key) =>{
    return key !== 'undefined' ? key.length > 0 ? false: 'A KEY MERCADO_KEY Deve ser corretamente!' : 'A KEY MERCADO_KEY Deve ser corretamente!'
  }

  checkMailMaster = (mail) =>{
    return mail !== 'undefined' ? mail.length > 0 ? false: 'A KEY MASTER_EMAIL Deve ser corretamente!' : 'A KEY MASTER_EMAIL Deve ser corretamente!'
  }

  checkMYSQL = (my) =>{
    if(typeof my.host === 'undefined'){ return ' A KEY MYSQL Esta no formato errado,deve ser HOST||DB||USER||PASS' }
    if(typeof my.user === 'undefined'){ return ' A KEY MYSQL Esta no formato errado,deve ser HOST||DB||USER||PASS' }
    if(typeof my.database === 'undefined'){ return ' A KEY MYSQL Esta no formato errado,deve ser HOST||DB||USER||PASS' }
  }

  advanceCheck = {

    async MySQL(Conn){
        const Connect = await Conn.prepareQuery("SELECT user FROM elo_users")
          if(Connect[0].server === true){
            process.exit()
          }
          console.log('\x1b[33m%s\x1b[0m', `TESTE: MYSQL/Conn: ${Conn.host.substring(0, 8)}... Conectado`)
        return false
    },

    async League(league){
      const lolSearch = await league.getSummoner('Homem Veigar')
        if (lolSearch.status === 403)
        {
          console.log('Não foi possível obter acesso a Riot API, pois a chave usada é invalida')
          process.exit()
        }
        console.log('\x1b[33m%s\x1b[0m', `TESTE: RIOT/Acess: Acesso Autorizado`)
        return false
    },

    async MercadoP(key){
      const mercadopago = require('mercadopago')
      mercadopago.configurations.setAccessToken(key)

      var filters = {
        external_reference: 'Teste'
      };

     mercadopago.payment.search({qs: filters}).then(async function(data) {
       if(data.status === 200){
        console.log('\x1b[33m%s\x1b[0m', `TESTE: MPAPI/Key: Acesso Autorizado`)
        return false
       }
       process.exit()
    })
    },

    async Email(mail){
      var Email = await mail(0,"projecflex@gmail.com",2)
      if(Email){
        console.log('\x1b[33m%s\x1b[0m', `TESTE: EMAIL/Send: Email configurado corretamente`)
        return false
      }
      console.log('Não foi possivel enviar um email devido a má configuração do sistema NodeMailer')
      process.exit()
    }


  }
}


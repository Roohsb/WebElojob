/**
 *  ELOJOBX SERVER
 *  Foi feito com o intuito de gerenciar Payouts e Detalhes de usuarios
 * @author Skillerm
 *
 */
 const express = require('express');
 const app =    express();
 const http =   require('http').Server(app);
 const dotenv = require('dotenv');

 dotenv.config();
 const Devolopment = require("./controller/development/@Start");
 const Dev = new Devolopment.Presets()
 const Assist = new Devolopment.Assistants()
 const LowDB = new Devolopment.Database()


 app.use(express.urlencoded({
    extended: true
  }))


 /**
  * LowDatabase
  * Contem todas os pedidos, para serem escaneados
  * @param FILE.ARRAY
  */
 const Fire = LowDB.Connect('Fire').get('Payments');

 /**
  * Email NodeMailer
  * Modulo para enviar email
  * @param Order
  * @param Reciver
  */
 const SendMail = require('./controller/development/@Mail');

 /**
  * Modo de Incializacao
  * Modo de inicilizacao e debug em niveis
  * @see NORMAL: Inicia normalmente (Mostra apenas informacões nescessarias)
  * @see SECURE: 1° Inicializacão verifica todos os arquivos e funcões.
  * @see DEVOLOPER: Todos os resultados são mostrados.
  */
 const START_MODE = process.env.START_MODE || Dev.DEVOLOPER;

/**
 * League OF Legends
 * Sua chave de acesso ao Riot Api
 * @param YOURKEY
 */
const LEAGUE_KEY = process.env.LEAGUE_KEY || Dev.LEAGUE_KEY

/**
 * Porta de Conexao
 * Defina a porta em que o servidor irar rodar
 * @param PORT
 */
const SERVER_PORT = process.env.SERVER_PORT || Dev.SERVER_PORT

/**
 * Master Email
 * Email ao qual receberar avisos de pagamentos recebidos
 * @param MAIL
 */
const MASTER_EMAIL = process.env.MASTER_EMAIL || Dev.MASTER_EMAIL

/**
 * Mercado Pago Key
 * Chave privada para pagamentos
 * @param KEY
 */

const MERCADO_KEY = process.env.MERCADO_KEY || Dev.MPKEY

/**
 *  MYSQL Incializacao
 * Inicializando a conexao com o MYSQL
 * e seus requerimentos
 * @class AuthenticatorMYSQL
 */

const AuthenticatorMYSQL = require("./controller/database/auth");
const ConnectionMYSQL = new AuthenticatorMYSQL(typeof process.env.MYSQL !== 'undefined' ? process.env.MYSQL.split('||'): Dev.MYSQL || Dev.MYSQL);

/**
 *  League of Legends Auth
 * Primeiro passo para o usuario
 * @class AuthenticatorLEAGUE
 */

const AuthenticatorLEAGUE = require("./controller/league/auth");
const LoggeINLEAGUE = new AuthenticatorLEAGUE(LEAGUE_KEY)

 /**
  * Iniciando todo o processo
  * Para deixar o primeiro ambiente menos sujo
  * resolvi jogar para esse arquivo, que por sua vez
  * indica os caminhos corretos para cada acao
  * @requires App
  */
    require("./src/App")(
      app,
      LoggeINLEAGUE,
      ConnectionMYSQL,
      parseInt(START_MODE),
      Assist,
      MERCADO_KEY,
      Fire,
      SendMail
      )

 http.listen(SERVER_PORT, function() {

    require('./src/server/boot')(
      Devolopment,
      parseInt(START_MODE),
      LEAGUE_KEY,
      MERCADO_KEY,
      MASTER_EMAIL,
      SERVER_PORT,
      ConnectionMYSQL,
      LoggeINLEAGUE,
      SendMail)

 })

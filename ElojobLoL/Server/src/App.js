module.exports = async function(app, league, mysql, modo, Assist, mpk, fire , email){

    /**
     * @const JWTAuth
     *
     * Ferramentas para o Auth
     */
       const JWT = require("../controller/authorization/jwt");
      const JWTAuth = new JWT()

    /**
     * Servidor Pagamentos
     * Roda o servidor a todos tempo.
     * Script completo onde funciona o sistema de pagamentos
     */
    require('./server/run')(Assist, modo, fire, mysql, mpk, email)

    /**
     * League of Legends API
     * Requisicao de Detalhes
     * @function League
     */
    require('./routes/post/league')(app, league, mysql, modo, Assist, JWTAuth);

    /**
     * EloJobx Mather Auth
     * Sistema de Autenticação
     */
    require('./routes/api/authenticate')(app,JWTAuth,modo,mysql)

    /**
     * ChekToken Status
     * Sistema de validador de Token
     * Client->Server->Client
     */
    require('./routes/api/checktoken')(app,JWTAuth,modo)

    /**
     * MercadoPago API
     * Sistema para API MercadoPago
     */
    require('./routes/api/mercadopago')(app, modo, mysql, Assist, mpk, fire)

    /**
     * Aprovação de Pedido
     * Api para aprovação de pedido manualmente.
     */
    require('./routes/api/approve-order')(app, JWTAuth, modo, mysql, email, Assist)

    /**
     * Mensagem Especial
     * Envio de Emails no comando master.
     */
    require('./routes/api/special-message')(app, JWTAuth, modo, mysql, email)

     /**
     *
     */
      require('./routes/api/teste')(app, Assist, mysql, email)


}

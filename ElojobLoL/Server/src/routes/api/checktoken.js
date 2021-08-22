module.exports = function Authenticate(app, authJwt, modo){
  app.post("/api/checktoken", async function(req, res)
  {
     /**
     * @const Token
     *
     * Contem todos os detalhes do post
     * {userID: PassWord:}
     */
      const Token = req.body.authorization

      if(typeof Token  === 'undefined' ||
        Token  === 0 )
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
       */
      const Autenthicate = authJwt.CheckToken(Token)

      modo > 0 ?
      console.log('\x1b[33m%s\x1b[0m', `[CHECKTOKEN][${Autenthicate.userID}][${Token.substring(0, 15)}...][${Autenthicate !== 1 ? "TOKEN VALIDO": "TOKEN INVALIDO"}][/api/checktoken]`) : false

      if (Autenthicate === 1)
      {
         res.status(403)
         res.json({
               server: true,
               error: true,
               logged: false,
               errormsg: "Token invalido",
               errorcod: 101
         })
         res.end();
         return;
      }
      res.status(200)
      res.json({
            server: true,
            error: false,
            errormsg: "",
            errorcod: 0
      })
      res.end();
      return;
  })
}

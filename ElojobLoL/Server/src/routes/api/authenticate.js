module.exports = function Authenticate(app, authJwt, modo, mysql){
  app.post("/api/authenticate", async function(req, res)
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
     * Retorna os dados já decodado
     */
    const Autenthicate = authJwt.Token(Token)

    modo > 0 ?
    console.log('\x1b[33m%s\x1b[0m', `[LOGIN][${Autenthicate.userID}][${Token.substring(0, 15)}...][${Autenthicate !== 1 ? "AUTORIZADO": "NÃO AUTORIZADO"}][/api/authenticate]`) : false

    if (Autenthicate === 1)
    {
      modo > 0 ?
      console.log('\x1b[33m%s\x1b[0m', `[LOGIN][${Autenthicate.userID}][RECUSADO][TOKEN DE ACESSO INVALIDO][/api/authenticate]`) : false

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

    /**
     * @const CheckUser
     *
     * Primeira etapa de verificação
     * Retorna todos os dados da conta
     * Mas só é usado a coluna SENHA
     */
    const CheckUser = await mysql.prepareQuery("SELECT * FROM elo_users WHERE user = ? AND level > 0",[Autenthicate.userID])

    if (CheckUser.length === 0)
    {
      modo > 0 ?
      console.log('\x1b[33m%s\x1b[0m', `[LOGIN][${Autenthicate.userID}][RECUSADO][USUARIO NÃO ENCONTRADO][/api/authenticate]`) : false

      return res.json({
        server: true,
        error: true,
        logged: false,
        errormsg: "Usuario não encontrado",
        errorcod: 102
      }).end()
    }

    if(typeof CheckUser[0].errorMySQL !== 'undefined')
      {

        console.log('\x1b[31m%s\x1b[0m', `[LOGIN][${Autenthicate.userID}][ERROINTERNO][NÃO FOI POSSIVEL SE CONECTAR COM A DATABASE][/api/authenticate]`)

          res.json({
            server: true,
            error: true,
            logged: false,
            errormsg: "Erro Interno",
            errorcod: 144,
          })
          return res.end()

      }

    /**
     * @const CheckPassword
     *
     * Checkando a senha em Bycrypt
     */
    const CheckPassword = await authJwt.passwordVerify(Autenthicate.PassWord,CheckUser[0].password)

    if (CheckPassword === false)
    {
      modo > 0 ?
      console.log('\x1b[33m%s\x1b[0m', `[LOGIN][${Autenthicate.userID}][RECUSADO][USUARIO OU SENHA INVALIDOS][/api/authenticate]`) : false

      return res.json({
        server: true,
        error: true,
        logged: false,
        errormsg: "Usuario ou senha invalidos",
        errorcod: 103
      }).end()
    }

    modo > 0 ?
    console.log('\x1b[33m%s\x1b[0m', `[LOGIN][${Autenthicate.userID}::${CheckUser[0].id}][SUCESSO][USUARIO LOGADO][/api/authenticate]`) : false

    return res.json({
      server: true,
      error: false,
      logged: true,
      user: Autenthicate.userID,
      userid: CheckUser[0].id,
      errormsg: "",
      errorcod: 0
    }).end()
  })

}

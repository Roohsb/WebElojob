module.exports = function(app, league, mysql, modo, Assist, authJwt)
{
   app.post("/post/league", async function(req, res)
   {
    res.setHeader('Access-Control-Allow-Origin', process.env.ALLOW_WEBSITE)
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type')
    res.setHeader('Access-Control-Allow-Credentials', true)

      if (typeof req.body.order === "undefined" ||
          typeof req.body.token === "undefined")
      {
         return res.send(
         {
            status: false,
            error: 4,
            mensagem: 'Preencha todos os campos!'
         }).end()
      }

      /**
       * @const Order
       *
       * @description ID da compra
       */
      const Order = req.body.order

      /**
       * @var matchs
       *
       * @description retorna a quantidade de partidas
       * a serem requisitadas, caso seja nulo ou Nan
       * retorna 1
       */
      var matchs = typeof req.body.matchs !== 'undefined' ? isNaN(parseInt(req.body.matchs)) === false ? parseInt(req.body.matchs) : 1 : 1

      /**
       * @var MatchsCache
       *
       * @description recuperando informações da partida.
       * Somente partidas novas são retornadas
       */
      var MatchsCache = [];

      /**
       * @var newMatchs
       *
       * @description Guarda os ids de partidas novas
       */
      var newMatchs = []

      /**
       * @var MatchsResult
       *
       * @description Guarda detalhes das partidas
       * prontas para serem inseridas na coluna
       */
      var MatchsResult = []

      /**
       * @var Summoner
       *
       * Summoner que sera requisitado na api da Riot.
       */
      var Summoner;

      try
      {

        /**
         * @const Autenthicate
         *
         * Verificando se o Token é correto
         * Retorna os dados já decodado
         */
        const Autenthicate = authJwt.CheckToken(req.body.token)

        modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LOLAPI][${Autenthicate.userID}][${req.body.token.substring(0, 15)}...]`): false

        if (Autenthicate === 1)
        {

          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LOLAPI][${Autenthicate.userID}][RECUSADO][TOKEN DE ACESSO INVALIDO][[/post/league]`) : false

          res.status(403)
          return res.send(
            {
               status: false,
               errorcode: 101,
               mensagem: 'Token Invalido'
            }).end()
        }

         /**
          * @const CheckOrder
          *
          * Retorna todos os dados da compra
          * @return [id,usuario..] Ou Error
          */
         const checkOrder = await mysql.prepareQuery("SELECT * FROM elo_users_invoices WHERE id = ? ", [Order])

         if (checkOrder.length === 0)
         {

          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${Order}][RECUSADO][PEDIDO DESCONHECIDO OU INVALIDO][/post/league]`) : false

            return res.send(
            {
               status: false,
               errorcode: 102,
               mensagem: 'Compra nao encontrada'
            }).end()

         }

         /**
          * @if Matchs
          *
          * Devido ao uso da api Riot só podemos
          * aceitar no minino 1 partida e no
          * maximo 15 partidas
          */
         if(matchs < 1 || matchs > 15)
         {

          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${Order}][RECUSADO][NUMERO DE PARTIDAD INVALIDAS :: ${matchs}][/post/league]`) : false

          return res.send(
          {
             status: false,
             errorcode: 103,
             mensagem: 'Numero de partidas invalidas'
          }).end()

         }

         /**
          * @const checkOrderJSON
          *
          * Convertendo data para JSON
          * @return Array
          **/
         var checkOrderJSON = JSON.parse(checkOrder[0].data)

         if(checkOrderJSON.Servico !== 'MD10')
         {
         /**
          * @const checkAccount
          *
          * Verificando qual o metodo de entrada da conta.
          * Eu poderia ter feito melhor o resultado, para
          * nao ter que fazer esse if. Isso é problema no
          * client
          */
         const checkAccount = checkOrderJSON.AccountMethod === 'contaexistente' ? parseInt(checkOrderJSON.LolAccount) : checkOrderJSON.Login

         /**
          * @if
          *
          * @param parseInt(checkAccount) =
          * Parametro definido para metodo de
          * conta existente
          * @var detailsAccount = retorna os detalhes da
          * conta
          */
         var detailsAccount;
         if (checkAccount === parseInt(checkAccount))
         {
            detailsAccount = await mysql.prepareQuery("SELECT * FROM elo_users_accounts WHERE id = ?", [checkAccount])
            if (detailsAccount.length === 0)
            {

              modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${checkAccount}][RECUSADO][CONTA NÃO ENCONTRADA][/post/league]`) : false

               return res.send(
               {
                  status: false,
                  error: 103,
                  mensagem: 'Conta não encontrada'
               }).end()

            }
            Summoner = detailsAccount[0].invocador
         }
         else
         {
            /**
             * @else
             *
             * @description Ações caso o metodo
             * seja Adicionar Conta
             */
            detailsAccount = await mysql.prepareQuery("SELECT * FROM elo_users_accounts WHERE conta = ? AND usuario = ?", [checkAccount, checkOrder[0].usuario])
            if (detailsAccount.length === 0)
            {
              modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${checkAccount}][RECUSADO][CONTA NÃO ENCONTRADA][ADICIONAR CONTA][/post/league]`) : false
               return res.send(
               {
                  status: false,
                  error: 103,
                  mensagem: 'Conta não encontrada'
               }).end()
            }
            Summoner = detailsAccount[0].invocador
         }
        }else{  Summoner = checkOrderJSON.Detalhes.invocador }

         /**
          * League of Legends
          * @const lolSearch
          *
          * Procurando a conta do usuario pelo nick
          * @returns puuid
          */
         const lolSearch = await league.getSummoner(Summoner)

         if (lolSearch.status === 403)
         {
          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${Summoner}][RECUSADO][A SUA KEY DA RIOTAPI ESTA VENCIDA][/post/league]`) : false
            return res.send(
            {
               status: false,
               error: 142,
               mensagem: 'API Key Invalida'
            }).end()
         }

         if (typeof lolSearch.id === 'undefined')
         {
          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${Summoner}][RECUSADO][PUUID NAO ENCONTRADO][/post/league]`) : false
            return res.send(
            {
               status: false,
               error: 102,
               mensagem: 'Puuid não encontrado'
            }).end()
         }

         /**
          * lolMatch
          * @const lolMatch
          *
          * @description Retorna as ultimas X partidas do usuario
          */
         const lolMatch = await league.getMatchsID(lolSearch.puuid, matchs)

         /**
          * @const matchExistentes
          *
          * @description Retornado as partidas do usuario
          * @returns BinaryArray
          */
         var matchExistentes = await mysql.prepareQuery("SELECT * FROM booster_match_records WHERE order_id = ? ", [Order])

         if (matchExistentes.length === 0)
         {

          await mysql.prepareQuery("INSERT INTO booster_match_records (order_id) VALUES(?)",[Order])
          matchExistentes = await mysql.prepareQuery("SELECT * FROM booster_match_records WHERE order_id = ? ", [Order])

          //modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${Order}][RECUSADO][NÃO FOI POSSIVEL //ACHAR A COMPRA VINCULADA AO BOOSTER_MATCH_RECORDS][/post/league]`) : false
          //  return res.send(
          //  {
          //     status: false,
          //     error: 103,
          //     mensagem: 'Compra incorreta'
          //  }).end()
         }

         const matchExistentesARRAY = matchExistentes[0].match_data ?? ''

         if (lolMatch.length === 0)
         {
          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${lolSearch.puuid}][RECUSADO][PARTIDA NÃO ENCONTRADA][/post/league]`) : false
            return res.send(
            {
               status: false,
               error: 102,
               mensagem: 'Puuid não encontrado'
            }).end()
         }


         for (match of lolMatch)
         {
            var resultMatch = await league.getMatchsDetails(match)
            JSON.stringify(resultMatch, function(key, value)
            {
               if (matchExistentesARRAY.indexOf(value.metadata.matchId) === -1)
               {
                  MatchsCache.push(value);
                  newMatchs.push(value.metadata.matchId)
               }
            })
         }

         if (MatchsCache.length === 0)
         {
          modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${matchExistentesARRAY}][RECUSADO][NÃO HÁ PARTIDAS NOVAS PARA ACRESCENTAR][/post/league]`) : false
            return res.send(
            {
               status: false,
               error: 143,
               mensagem: 'Novas partidas não encontradas!'
            }).end()
         }

         if (matchExistentes[0].data === null)
         {
            for (resultMatch of MatchsCache)
            {
               MatchsResult.push(
               {
                  duracao: Assist.duration(resultMatch.info.gameDuration),
                  criacao: Assist.time(resultMatch.info.gameCreation),
                  modo: resultMatch.info.gameMode,
                  modo2: resultMatch.info.queueId,
                  id: resultMatch.metadata.matchId,
                  result: resultMatch.info.participants.find((
                  {
                     puuid
                  }) => puuid === lolSearch.puuid)
               });
            };

            await mysql.prepareQuery("UPDATE booster_match_records SET data = ?, match_data = ? WHERE order_id = ?", [JSON.stringify(MatchsResult), JSON.stringify(lolMatch), Order])

            modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${Order}][SUCESSO][NOVAS PARTIDAS FORAM ADICIONADAS][/post/league]`) : false
            return res.send(
            {
               status: true,
               mensagem: 'Conta atualizada'
            }).end()
         }

         const lastData = matchExistentes[0].data
         const lastMatchData = JSON.parse(matchExistentes[0].match_data)


         for (resultMatch of MatchsCache)
         {
            MatchsResult.push(
            {
               duracao: Assist.duration(resultMatch.info.gameDuration),
               criacao: Assist.time(resultMatch.info.gameCreation),
               modo: resultMatch.info.gameMode,
               modo2: resultMatch.info.queueId,
               id: resultMatch.metadata.matchId,
               result: resultMatch.info.participants.find((
               {
                  puuid
               }) => puuid === lolSearch.puuid)
            });
         };

         const fusionData = MatchsResult.concat(JSON.parse(lastData))
         const funsionMatchData = newMatchs.concat(lastMatchData)


         await mysql.prepareQuery("UPDATE booster_match_records SET data = ?, match_data = ? WHERE order_id = ?", [JSON.stringify(fusionData), JSON.stringify(funsionMatchData), Order])

         modo > 0 ? console.log('\x1b[33m%s\x1b[0m', `[LEAGUEOFLEGENDS][${Order}][SUCESSO][NOVAS PARTIDAS FORAM ADICIONADAS][/post/league]`) : false
         return res.send(
         {
            status: true,
            mensagem: 'Conta atualizada'
         }).end()


      }
      catch (e)
      {

         if (e.errno === -4078)
         {
          console.log('\x1b[31m%s\x1b[0m', `[LEAGUEOFLEGENDS][${Order}][ERROINTERNO 2][NÃO FOI POSSIVEL SE CONECTAR COM A DATABASE][/post/league]`)
            return res.send(
            {
               status: false,
               error: 144,
               mensagem: 'Conexão com a Database recusada'
            }).end()
         }

        console.log('\x1b[31m%s\x1b[0m', `[ERRO NO TRY][ERROINTERNO][VOCÊ ESTA RECEBENDO ESSA MENSAGEM DEVIDO A UM ERRO INTERNO][/post/league]`)
        console.log(e)

         return res.send(
         {
            status: false,
            error: 145,
            mensagem: 'Erro interno!'
         }).end()

      }
   });
};

import jwt from 'jsonwebtoken'
import nookies from 'nookies'
import { useEffect } from "react";
import Router from "next/router";
import { useBeforeUnload } from "react-use";

module.exports = class Logged
{

  /**
   * Verificando o Token no cookie
   * 
   * @param {Cookie} Obj 
   * @returns result
   */
    VerifyCookie(res,Obj){
    let result
    try{ 
      result = jwt.verify(Obj, process.env.PRIVATE_JWT)
    }catch (e){
      nookies.destroy({ res }, '_AuthorizationJobx')
      nookies.destroy({ res }, '_AlertBox')
      result = 0
    }
    return result
      }

    /**
     * Detalhes do Usuario logado
     */
    VerifyToken(Obj){
      let result
      try{ 
        result = jwt.verify(Obj, process.env.PRIVATE_JWT)
      }catch (e){
        result = 0
      }
      return result
      }

    async Details(token,user,addons) 
      {
        const Formulario = new URLSearchParams();
          if(addons.length > 0){
              for(var i = 0; i < addons.length; i++)
              {
                Formulario.append(addons[i], true)
              }
            }
            Formulario.append('token', token);
            Formulario.append('user', user);
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/user', {
          method: 'POST',
          body: Formulario
        })
        return await Api.json()
      }

    async ClientOrdersSearch(token,user) 
      {
        const Forumalario = new URLSearchParams();
        Forumalario.append('token', token);
        Forumalario.append('user', user);
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/lista-search', {
          method: 'POST',
          body: Forumalario
        })
        return await Api.json()
      }

    async ClientAwait(token) 
      {
        const Forumalario = new URLSearchParams();
        Forumalario.append('token', token);
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/clientsawait', {
          method: 'POST',
          body: Forumalario
        })
        return await Api.json()
      }

    async ClientAwaitMy(token,id) 
      {
        const Forumalario = new URLSearchParams();
        Forumalario.append('token', token);
        Forumalario.append('id', id);
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/clientsawaitmy', {
          method: 'POST',
          body: Forumalario
        })
        return await Api.json()
      }

    async Client(token,client)
    {
        const Formulario = new URLSearchParams()
        Formulario.append('token',token)
        Formulario.append('client', client)
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/client',{
          method: 'POST',
          body: Formulario
        })
        return await Api.json()
      }

    async MyClient(token,booster,client)
    {
      const Formulario = new URLSearchParams()
      Formulario.append('token',token)
      Formulario.append('booster', booster)
      Formulario.append('client', client)
      const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/myclient',{
        method: 'POST',
        body: Formulario
      })
      return await Api.json()
      }

    async matchHistoric(token,id)
    {
      const Formulario = new URLSearchParams()
      Formulario.append('token',token)
      Formulario.append('client',id)
      const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/matchhistoric',{
        method: 'POST',
        body: Formulario
      })
      return await Api.json()
      }

    async boosterJob(token,id)
      {
        const Formulario = new URLSearchParams()
        Formulario.append('token',token)
        Formulario.append('user',id)
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/boosterjob',{
          method: 'POST',
          body: Formulario
        })
        return await Api.json()
    }

    async EditProfile(token,dados){
      const Formulario = new URLSearchParams()
      Formulario.append('token',token)
      Formulario.append('email',$("#input-email-edit").val())
      Formulario.append('nome',$("#input-name-edit").val())
      Formulario.append('celular',$("#input-celular-edit").val())
      Formulario.append('newpassword',$("#input-senha-edit").val())
      Formulario.append('old', JSON.stringify(dados))
      const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/editprofile',{
        method: 'POST',
        body: Formulario
      })
      const Result = await Api.json()
      var m = 0
      var stop = 0
      if(Result.status){
        var Alert = setInterval(function(){
          if(m === 99){ stop++
          if(stop === 1000){ 
            $(".alert.alert-success").css("opacity", "0")
            return clearInterval(Alert)
          }
        }else{ m++ }
          $(".alert.alert-success").css("opacity", `${0}.${m}`)
      }, 1)
      return 
     }
     var Alert = setInterval(function(){
        if(m === 99){ stop++
        if(stop === 500){ 
          $(".alert.alert-danger").css("opacity", "0")
          return clearInterval(Alert)
        }
      }else{ m++ }
        $(".alert.alert-danger").css("opacity", `${0}.${m}`)
    }, 1)
    return 
    }

    async Commom(token){
      const Formulario = new URLSearchParams()
      Formulario.append('token',token)
      const Api = await fetch(process.env.URLSERVERSIDE+'/api/config/graphics',{
        method: 'POST',
        body: Formulario
      })
      return await Api.json()
    }

    async LastMessages(token){
      const Formulario = new URLSearchParams()
      Formulario.append('token',token)
      const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/last-messages',{
        method: 'POST',
        body: Formulario
      })
      return await Api.json()
    }

    
    useLeavePageConfirm = ( isConfirm = true, message = "Voce deseja realmente sair desta pagina?",timer) => {
      useBeforeUnload(isConfirm, message);
      useEffect(() => {
        const handler = () => {
          if (isConfirm && !window.confirm(message)) {
            throw "Route Canceled";
          }
    };

    Router.events.on("routeChangeStart", handler);
 
    return () => {
      clearInterval(timer)
      Router.events.off("routeChangeStart", handler);
    };
  }, [isConfirm, message]);
};

    Acceptjob = async (t,o) =>{
      const Formulario = new URLSearchParams()
        Formulario.append('token',o)
        Formulario.append('order',t)
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/acceptjob',{
          method: 'POST',
          body: Formulario
        })
        const result =  await Api.json()

        if(result.status){
          return window.location.href = "/manage/customers/my";
        }
        return alert('Erro interno')
    }

    FinishJob = async (t,o) =>{
      const Formulario = new URLSearchParams()
        Formulario.append('token',o)
        Formulario.append('order',t)
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/finishjob',{
          method: 'POST',
          body: Formulario
        })
        const result =  await Api.json()

        if(result.status){
          return window.location.href = "/manage/customers/my";
        }
        return alert('Erro interno')
    }

    CancelOrder = async (t,o) =>{
      const Formulario = new URLSearchParams()
        Formulario.append('token',o)
        Formulario.append('order',t)
        const Api = await fetch(process.env.URLSERVERSIDE+'/api/atom/orders/cancel',{
          method: 'POST',
          body: Formulario
        })
        const result =  await Api.json()

        if(result.status){
          return window.location.href = "/manage/customers/my";
        }
        return alert('Erro interno')
    }

    updateMatchs = async (order, token, type = 0) => {
      try {
          console.log("Atualizacao de partidas solicitada")
  
          const Erro = (mensagem = "Erro interno") => {
              document.getElementById("errormsg").innerHTML = ` Aconteceu um erro, olha so! : ${mensagem}`
              var m = 0
              var stop = 0
              var Alert = setInterval(function() {
                  if (m === 99) {
                      stop++
                      if (stop === 500) {
                          $(".alert.alert-danger").css("opacity", "0")
                          return clearInterval(Alert)
                      }
                  } else {
                      m++
                  }
                  $(".alert.alert-danger").css("opacity", `${0}.${m}`)
              }, 1)
          }
  
          const Sucesso = (mensagem = "Novas Partidas adicionadas") => {
              document.getElementById("successmsg").innerHTML = ` ${mensagem}`
              var m = 0
              var stop = 0
              var Alert = setInterval(function() {
                  if (m === 99) {
                      stop++
                      if (stop === 1000) {
                          $(".alert.alert-success").css("opacity", "0")
                          return clearInterval(Alert)
                      }
                  } else {
                      m++
                  }
                  $(".alert.alert-success").css("opacity", `${0}.${m}`)
              }, 1)
              return
          }
  
          if (type === 1) {
              const Count = $('.form-control.matchs').val()
              if (isNaN(parseInt(Count)) || Count < 1 || Count > 15) {
                  return Erro("Coloque um numero de partidas validos")
              }
  
              async function getMatchs(order, token, count) {
                  const Formulario = new URLSearchParams()
                  Formulario.append('token', token)
                  Formulario.append('order', order)
                  Formulario.append('matchs', count)
                  const Api = await fetch(process.env.URLSERVER + '/post/league', {
                      method: 'POST',
                      body: Formulario
                  })
                  const result = await Api.json()
                  return result
              }
  
              const result = await getMatchs(order, token, Count)
              console.log(result)
              if (!result.status) {
                  return Erro(result.mensagem)
              }
              document.getElementById('iframeHistorico').contentWindow.location.reload();
              return Sucesso()
          }
  
          return document.getElementsByClassName('form-matchs')[0].style.display = "block"
        
      } catch (e) {
          console.log(e)
          return alert("Erro interno")
      }
  
    }

    StartJob = async (account,token) => {
      try{
        async function startJob(token, account){
          const Formulario = new URLSearchParams()
          Formulario.append('token', token)
          Formulario.append('account', account)
          const Api = await fetch(process.env.URLSERVERSIDE + '/api/propets/startjob', {
              method: 'POST',
              body: Formulario
          })
          const result = await Api.json()
          return result
        }

        const Start = await startJob(token,account)
        if(!Start.status){
          return alert("Não foi possivel")
        }

        location.reload()

      }catch(e){
          console.log(e)
        return alert("Erro interno")
      }
    }

    StopJob = async (account,token) => {
      try{
        async function stopJob(token, account){
          const Formulario = new URLSearchParams()
          Formulario.append('token', token)
          Formulario.append('account', account)
          const Api = await fetch(process.env.URLSERVERSIDE + '/api/propets/stopjob', {
              method: 'POST',
              body: Formulario
          })
          const result = await Api.json()
          return result
        }

        const Stop = await stopJob(token,account)
        if(!Stop.status){
          return alert("Não foi possivel")
        }

        location.reload()
        
      }catch(e){
          console.log(e)
        return alert("Erro interno")
      }
    }

    logout = async () => 
    {
      async function Execut(){
      const Api = await fetch(process.env.URLSERVERSIDE+'/api/config/logout', {
        method: 'POST'
      })
      return await Api.json()
    }
      const result = await Execut()
      if(result.redirect){
        return window.location.href = "/auth/acess";
      }else{
      return alert('Error')
      }
    }


}
module.exports = class Logged
{

  async checkLevel(token){
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/lista', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async usersLista(token) 
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/lista', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async usersListaSearch(token,user) 
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('user', user);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/lista-search', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async avataresLista(token) 
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/avatares/list', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async avatarSearch(token,avatar)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('avatar', avatar);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/avatares/search', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async deleteAvatar(token,avatar)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('avatar', avatar);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/avatares/delete', {
      method: 'POST',
      body: Formulario
    })
    const Final = await Api.json()
    if(Final){
      return  window.location.href = "/development/avatares/list"
    }
    return alert('Error')
  }
  async atualizarAvatar(token){
    const Formulario = new URLSearchParams()
     Formulario.append('avatar', $("#input-id-avatar").val())
     Formulario.append('name',   $("#input-nome-avatar").val())
     Formulario.append('url',    $("#input-url-avatar").val())
     Formulario.append('token', token)

     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/avatares/atualizar', {
       method: 'POST',
       body: Formulario
     })

     const result = await Api.json()
     var m = 0
     var stop = 0
     if(result.status){
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

  async bannersLista(token) 
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/banners/list', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async bannersSearch(token,Banner)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('banner', Banner);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/banners/search', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async deleteBanner(token,banner)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('banner', banner);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/banners/delete', {
      method: 'POST',
      body: Formulario
    })
    const Final = await Api.json()
    console.log(Final)
    if(Final){
      return  window.location.href = "/development/banners/list"
    }
    return alert('Error')
  }
  async atualizarBanner(token){
    const Formulario = new URLSearchParams()
     Formulario.append('banner', $("#input-id-banner").val())
     Formulario.append('name',   $("#input-nome-banner").val())
     Formulario.append('url',    $("#input-url-banner").val())
     Formulario.append('token', token)

     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/banners/atualizar', {
       method: 'POST',
       body: Formulario
     })

     const result = await Api.json()
     var m = 0
     var stop = 0
     if(result.status){
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

  async temasLista(token)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/themes/list', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async temasSearch(token,Theme)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('theme', Theme);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/themes/search', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async deleteTheme(token,theme)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('theme', theme);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/themes/delete', {
      method: 'POST',
      body: Formulario
    })
    const Final = await Api.json()
    if(Final){
      return  window.location.href = "/development/themes/list"
    }
    return alert('Error')
  }
  async atualizarTheme(token){
    const Formulario = new URLSearchParams()
     Formulario.append('theme', $("#input-id-theme").val())
     Formulario.append('name',   $("#input-nome-theme").val())
     Formulario.append('url',    $("#input-url-theme").val())
     Formulario.append('css',    $("#input-css-theme").val())
     Formulario.append('token', token)

     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/themes/atualizar', {
       method: 'POST',
       body: Formulario
     })

     const result = await Api.json()
     var m = 0
     var stop = 0
     if(result.status){
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

  async newsSearch(token,news)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('news', news);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/news/search', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }


  async createAvatar(token)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('avatar',  $("#input-url-newavatar").val());
    Formulario.append('nome',  $("#input-nome-avatar").val());
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/avatares/new', {
      method: 'POST',
      body: Formulario
    })
    const Final = await Api.json()
    if(Final){
      return  window.location.href = "/development/avatares/list"
    }
    return alert('Error')
  }

  async createBanner(token)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('banner',  $("#input-url-newbanner").val());
    Formulario.append('nome',    $("#input-nome-banner").val());
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/banners/new', {
      method: 'POST',
      body: Formulario
    })
    const Final = await Api.json()
    if(Final){
      return  window.location.href = "/development/banners/list"
    }
    return alert('Error')
  }

  async createTheme(token)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('theme',  $("#input-url-newtheme").val());
    Formulario.append('nome',    $("#input-nome-theme").val());
    Formulario.append('color',    $("#input-color-theme").val());
    
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/themes/new', {
      method: 'POST',
      body: Formulario
    })
    const Final = await Api.json()
    if(Final){
      return  window.location.href = "/development/themes/list"
    }
    return alert('Error')
  }

  async ordersLista(token) 
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/orders/lista', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async ClientOrderView(token,client)
  {
    const Formulario = new URLSearchParams()
    Formulario.append('token',token)
    Formulario.append('client', client)
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/orders/view',{
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async DeleteOrder(token)
  {
    const Formulario = new URLSearchParams()
    Formulario.append('token',token)
    Formulario.append('order', $("#inseriridpedido").text())
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/orders/delete',{
      method: 'POST',
      body: Formulario
    })
    const Resultado =  await Api.json()
    if(Resultado){
      $("#id-order-"+$("#inseriridpedido").text()+"").remove()
      return $('#modal-default').modal('toggle');
    }
    return alert("Erro interno!")
  }

  async approveOrder(order,token){
    const Formulario = new URLSearchParams()
    Formulario.append('token',token)
    Formulario.append('order',order)
    const Api = await fetch('http://66.70.148.51/api/order/approve',{
      method: 'POST',
      body: Formulario
    })
    const Resultado =  await Api.json()
    if(Resultado){
      return window.location.href = "http://localhost:3000/development/orders/list";
    }
    return alert("Erro interno!")
  }

  async updatesLista(token) 
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/news/lista', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
  async atualizarUpdate(token){
    const Formulario = new URLSearchParams()
     Formulario.append('titulo',   $("#input-titulo-update").val())
     Formulario.append('update',   $("#input-id-update").val())
     Formulario.append('content',  $("#textarea-value-update").val())
     Formulario.append('token', token)

     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/news/atualizar', {
       method: 'POST',
       body: Formulario
     })

     const result = await Api.json()
     var m = 0
     var stop = 0
     if(result.status){
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
  async updatesDelete(token) 
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token)
    Formulario.append('update',   $("#input-id-update").val())
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/news/delete', {
      method: 'POST',
      body: Formulario
    })
    const Final = await Api.json()
    if(Final){
      return  window.location.href = "/development/news/list"
    }
    return alert('Error')
  }
  async criarUpdate(token,user){
    const Formulario = new URLSearchParams()
     Formulario.append('titulo',   $("#input-titulo-update").val())
     Formulario.append('content',  $("#textarea-value-update").val())
     Formulario.append('token', token)
     Formulario.append('owner', user)

     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/news/create', {
       method: 'POST',
       body: Formulario
     })

     const result = await Api.json()
     var m = 0
     var stop = 0
     if(result.status){
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

  async couponsLista(token) 
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/coupons/lista', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async couponsSearch(token,coupon)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('token', token);
    Formulario.append('coupon', coupon);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/coupons/search', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async atualizarCoupon(token){
    const Formulario = new URLSearchParams()
     Formulario.append('codigo',   $("#input-codigo-coupon").val())
     Formulario.append('idcoupon',   $("#input-id-coupon").val())
     Formulario.append('desconto',  $("#input-desconto-coupon").val())
     Formulario.append('expiracao',  $("#input-expiracao-coupon").val())
     Formulario.append('token', token)

     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/coupons/atualizar', {
       method: 'POST',
       body: Formulario
     })

     const result = await Api.json()
     var m = 0
     var stop = 0
     if(result.status){
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

  async deleteCoupon(token){
    const Formulario = new URLSearchParams();
    Formulario.append('token', token)
    Formulario.append('coupon',   $("#input-id-coupon").val())
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/coupons/delete', {
      method: 'POST',
      body: Formulario
    })
    const Final = await Api.json()
    if(Final){
      return  window.location.href = "/development/coupons/list"
    }
    return alert('Error')
  }

  async criarCoupon(token){
    const Formulario = new URLSearchParams()
     Formulario.append('codigo',   $("#input-codigo-coupon").val())
     Formulario.append('desconto',  $("#input-desconto-coupon").val())
     Formulario.append('expiracao',  $("#input-expiracao-coupon").val())
     Formulario.append('token', token)

     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/coupons/new', {
       method: 'POST',
       body: Formulario
     })

     const result = await Api.json()
     var m = 0
     var stop = 0
     if(result.status){
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


  /**
   * Abaixo as funcões para a remoção
   * de um usuario
   * 
   * @param {token,user} dados 
   */
  Name = (e) => {
    $("#inserirusername").text(e.target.getAttribute('data-user'))
    return
  }

  async propetsDelete(user,token){
    const Formulario = new URLSearchParams();
    Formulario.append('user', user);
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/delete', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }
   
  deleteUser = async (token) =>{
    const user = $("#inserirusername").text()
    const result = await this.propetsDelete(user,token)
    if(typeof result.error !== 'undefined'){
      alert('error')
      return
    }
   alert(`Usuario ${user} Deletado com sucesso!`)
   $('*[data-user-list="'+user+'"]').remove()
   $('#modal-default').modal('toggle');

    return
  }

  deleteUserOther = async (token) =>{
    const user = $("#user-delete-id").text()
    const result = await this.propetsDelete(user,token)
    if(typeof result.error !== 'undefined'){
      alert('error')
      return
    }
    return window.location.href = "/development/users/list"
  }

  AccountDelete = (e) =>{
    $("#data-account-delete-id").text(e.target.getAttribute('data-account-delete'))
    return
  }

  AccountEdite = (e) =>{
    var js = JSON.parse(e.target.getAttribute('data-account-edite-json'))
    $("#data-account-edite-id").text(e.target.getAttribute('data-account-edite'))
    if(js.w === '1'){
      $(".form-control.account").prop("disabled", true)
    }
    if(js.p === '1'){
      $(".form-control.account").prop("disabled", true)
      $(".form-control.password").prop("disabled", true)
      $(".form-control.invocador").prop("disabled", true)
    }
    $(".form-control.account").val(e.target.getAttribute('data-account-edite'))
    $(".form-control.password").val(js.s)
    $(".form-control.invocador").val(js.i)
    return
  }

  preViewAvatar = (e) =>{
    var Avatar = $("#input-url-newavatar").val()
    $("#avatar-new").attr("src", `/lol/profiles/avatar/${Avatar}`);
  }

  preViewBanner = (e) =>{
    var Banner = $("#input-url-newbanner").val()
  
    $("div.header.pb-6.d-flex.align-items-center.react").css('background-image', `url('/lol/profiles/banners/${Banner}')`);
  }
  preViewTheme = (e) =>{
    var Tema = $("#input-color-theme").val()
  
    $("div.header.pb-6.d-flex.align-items-center.react").css('backgroundColor', Tema);
  }
  preViewUpdate = (e) =>{
    return $("#framepre").contents().find("#previewhtml").empty().html($(".form-control.textarea").val())
  }

  /**
   * Usuario detalhes
   * 
   * @description Abaixo somente as funções para os detalhes
   * do usuario requisitado, para ver/editar.
   */

  /**
   * @function userDetail
   * 
   * Retorna os dados do usuario requisitado
   * @param {username} user 
   * @param {cookie} token 
   * @returns array
   */
  async userDetail(user,token)
  {
    const Formulario = new URLSearchParams();
    Formulario.append('user', user);
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/detail', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async AvaiStyl(token,param)
  {
    const Formulario = new URLSearchParams();
    if(typeof param !== 'undefined'){
      Formulario.append('search', param);
    }
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/stylesavai', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async ChangerPic(token,user,pic){
    const Formulario = new URLSearchParams();
    Formulario.append('user', user);
    Formulario.append('pic', pic);
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/changer-picprofile', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async ChangerBan(token,user,ban){
    const Formulario = new URLSearchParams();
    Formulario.append('user', user);
    Formulario.append('ban', ban);
    Formulario.append('token', token);
    const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/changer-banprofile', {
      method: 'POST',
      body: Formulario
    })
    return await Api.json()
  }

  async Etapa1(form,token,dados){

    const Formulario = new URLSearchParams()
    $("form#"+form+" :input").each(function(){
      if(typeof $(this).attr("name") !== 'undefined' || typeof $(this).val() !== 'undefined' || $(this).val().length > 0){
        Formulario.append($(this).attr("name"), $(this).val())
      }
     })
     Formulario.append('user', dados[0].user)
     Formulario.append('old', JSON.stringify(dados))
     Formulario.append('token', token._AuthorizationJobx)

     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/update1', {
       method: 'POST',
       body: Formulario
     })

     const result = await Api.json()
     var m = 0
     var stop = 0
     if(result.status){
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

  async newUser(token){
    if($("#input-username-new").val().length < 3 || 
      $("#input-email-new").val().length  < 3 || 
      $("#input-celular-new").val().length < 3){
      console.log($("#input-username-new").val().length,
      $("#input-email-new").val().length,
      $("#input-celular-new").val().length)
      return alert("Preencha tudo corretamente")
    }

    const Formulario = new URLSearchParams()
     Formulario.append('user', $("#input-username-new").val())
     Formulario.append('mail', $("#input-email-new").val())
     Formulario.append('celular', $("#input-celular-new").val())
     Formulario.append('nivel', $("#nivellabel").find(":selected").val())
     Formulario.append('nome', $("#input-name-new").val())
     Formulario.append('senha', $("#input-senha-new").val())
     Formulario.append('token', token)


     const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/new-user', {
       method: 'POST',
       body: Formulario
     })
     const result = await Api.json()

     if(result.status){
       return alert("Conta criada!")
     }
     if(result.error === 2){
       return alert("Este usuario já está em uso!")
     }
     return alert("Erro interno")
  }
  
  
}
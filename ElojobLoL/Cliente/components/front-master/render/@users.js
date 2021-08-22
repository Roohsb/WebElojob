import React, { Component } from 'react'
import Link from 'next/link'

import {LeagueOfTools,Assistants,More} from '../../front/more/more'
import LoggedM from '../../front-master/logged/@class'

const Assistant = new Assistants();

const leagueTools = new LeagueOfTools()

const Moree = new More()

const Logged = new LoggedM()


class renderMore {

   /**
    * @function userserachaccounts
    * 
    * @param {array accounts} c 
    * @returns Elements TR
    */
   userserachaccounts(c){
      var b = []
      for(var a of c){
         b.push(<tr key={Moree.generateKey(15)}>
            <th scope="row">
              <div className="media align-items-center">
                <div className="media-body">
                  <span className="name mb-0 text-sm">{a.conta}</span>
                </div>
              </div>
            </th>
            <td className="budget">
              {a.senha}
            </td>
            <td>
              <span className="badge badge-dot mr-4">
                <span className="status">{a.invocador}</span>
              </span>
            </td>
            <td>
              <div className="avatar-group">
              <span className="status">{a.working === '1' ? 'SIM': 'NÃO'} <i className={a.working === '1' ? 'ni ni-check-bold text-green' : 'ni ni-fat-remove text-red'}></i></span>
              </div>
            </td>
            <td>
              <div className="d-flex align-items-center">
                <span className="completion mr-2">{a.playing === '1' ? 'SIM': 'NÃO'}  <i className={a.playing === '1' ? 'ni ni-check-bold text-green' : 'ni ni-fat-remove text-red'}></i></span>
                <div>
              </div>
              </div>
            </td>
            <td className="text-right">
                    <div className="dropdown">
                        <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i className="fas fa-ellipsis-v"></i>
                        </a>
                        <div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a className="dropdown-item" data-toggle="modal" data-target="#modal-account-delete" href="#modal-account-delete" data-account-delete={a.conta} onClick={(e) => Logged.AccountDelete(e)}>Remover</a>
                            <a data-account-edite={a.conta} className="dropdown-item" data-toggle="modal" data-target="#modal-account-edit" href="#modal-account-edit" data-account-edite-json={JSON.stringify({i: a.invocador, s: a.senha, w: a.working, p: a.playing})} onClick={(e) => Logged.AccountEdite(e)}>Editar</a>
                        </div>
                    </div>
                </td>
          </tr>)
      }
      return(<>{b}</>)
   }


   async savePic(a,e){
      const token = a._AuthorizationJobx
      const usuario = e.userResult[0].user
      const id = $(".avatar.active.avatar-lg.rounded-circle").attr("data-profile-pic")
      var Changer = await Logged.ChangerPic(token,usuario,id)
      
      if(Changer.status === true){
         return $('#modal-profile-pictures').modal('hide')
      }
      return alert('Error!')
      
   }

   async saveBan(a,e){
      const token = a._AuthorizationJobx
      const usuario = e.userResult[0].user
      const id = $(".avatar.active.avatar-lg.rounded-circle").attr("data-profile-ban")
      var Changer = await Logged.ChangerBan(token,usuario,id)
      
      if(Changer.status === true){
         return $('#modal-profile-banners').modal('hide')
      }
      return alert('Error!')
   }

   async deleteAccount(a,e){
      const Formulario = new URLSearchParams();
      Formulario.append('user', e);
      Formulario.append('account', $("#data-account-delete-id").text());
      Formulario.append('token', a);
      const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/account-delete', {
        method: 'POST',
        body: Formulario
      })
      const Result = await Api.json()
      if(Result.status){
         $("tbody.list").children().each(function(e,y) {
            $(y).children("th").each(function(){
               if($("#data-account-delete-id").text() === $(this).text()){
                  $(y).remove()
                  }
            })
       });
         return $('#modal-account-delete').modal('hide')
      }
      if(Result.error === 2){
         $('#modal-account-delete').modal('hide')
         return alert("Não é possivel deletar contas que estão vinculadas a um pedido")
      }
      $('#modal-account-delete').modal('hide')
      return alert("Erro!")
   }

   async editeAccount(a,e){
      const Formulario = new URLSearchParams();
      Formulario.append('user', e);
      Formulario.append('token', a);
      Formulario.append('account', $("#data-account-edite-id").text());
      Formulario.append('newaccount', $(".form-control.account").val());
      Formulario.append('password', $(".form-control.password").val());
      Formulario.append('invocador', $(".form-control.invocador").val());
      const Api = await fetch(process.env.URLSERVERSIDE+'/api/propets/atom/users/account-edit', {
        method: 'POST',
        body: Formulario
      })
      const Result = await Api.json()
      if(Result.status){
         $('#modal-account-edit').modal('hide')
         return alert("Dados atualizados")
      }
      if(Result.error === 1){
         $('#modal-account-edit').modal('hide')
         return Alert('Aconteceu um erro, meio estranho.. tente atualizar a pagina!')
      }
      return  Alert('Erro interno!')
   }

   /**
    * @function changerpictureview
    * 
    * Clique para selecionar a foto e trocar a de fundo
    * @param {targetclick} pic 
    * @returns script action
    */
   changerpictureview = (pic) =>{
      $(".avatar.active.avatar-lg.rounded-circle").removeClass("active")
      $(`[data-profile-pic='${pic.target.attributes["data-profile-pic-src"].value}']`).addClass("active");
      return $(".rounded-circle.divisoria").attr("src", pic.target.currentSrc);
   }

   /**
    * @function usersearchprofilepictures
    * 
    * Retorna a lista de imagens para o perfil
    * No Editar
    * @param {current style data} dates 
    */
   usersearchprofilepictures(dates){
      var i = []
     for(var p of dates.pic){
        var courrent = p.id === parseInt(dates.search[0].avatar) ? 'active': ''
        i.push(<a key={Moree.generateKey(13)} data-profile-pic={p.id} href="#" onClick={(e) => this.changerpictureview(e)} style={{marginLeft: '0rem'}} className={"avatar "+courrent+" avatar-lg rounded-circle"} data-toggle="tooltip" data-original-title={p.name} title={p.name}>
        <img alt="Image placeholder" data-profile-pic-src={p.id} src={"/lol/profiles/avatar/"+p.img+""}/>
      </a>)
     }
      return(<>{i}</>)
   }

   changerbannerview = (pic) =>{
      $(".avatar.active.avatar-lg.rounded-circle").removeClass("active")
      $(`[data-profile-ban='${pic.target.attributes["data-profile-ban-src"].value}']`).addClass("active");
      return $(".card-img-top").attr("src", pic.target.currentSrc);
   }

   usersearchprofilebanners(dates){
      var i = []
      for(var b of dates.ban){
      var courrent = b.id === parseInt(dates.search[0].banner) ? 'active': ''
      i.push(<a key={Moree.generateKey(13)} data-profile-ban={b.id} href="#" onClick={(e) => this.changerbannerview(e)} style={{marginLeft: '0rem'}} className={"avatar "+courrent+" avatar-lg rounded-circle"} data-toggle="tooltip" data-original-title={b.name} title={b.name}>
      <img alt="Image placeholder" style={{width: '100%',height: '100%'}}data-profile-ban-src={b.id} src={"/lol/profiles/banners/"+b.img+""}/>
    </a>)
      }
      return(<>{i}</>)
   }

   listavatares(avatares){
      var avatar = []
      for(var v of avatares){
         avatar.push(<Link href={"/development/avatares/view/"+v.id+""} key={v.id}><a className="avatar avatar-lg rounded-circle list" data-toggle="tooltip" data-original-title={v.name} title={v.name}>
         <img alt="Image placeholder" src={"/lol/profiles/avatar/"+v.img+""}/><span style=
         {{position: 'absolute',
         top: '60px',
         color: 'black',
         textAlign: 'center',
         fontSize: '13px',
         overflow: 'hidden',
         textOverflow: 'ellipsis',
         display: '-webkit-box',
         WebkitLineClamp: '2',
         WebkitBoxOrient: 'vertical'}}>{v.name} ({v.id})</span></a></Link>)
      }
      return(<>{avatar}</>)
   }

   listbanners(banners){
      var banner = []
      for(var v of banners){
         banner.push(<Link href={"/development/banners/view/"+v.id+""} key={v.id}><a className="avatar avatar-lg rounded-circle list" data-toggle="tooltip" data-original-title={v.name} title={v.name}>
         <img alt="Image placeholder" src={"/lol/profiles/banners/"+v.img+""}/><span style=
         {{position: 'absolute',
         top: '60px',
         color: 'black',
         textAlign: 'center',
         fontSize: '13px',
         overflow: 'hidden',
         textOverflow: 'ellipsis',
         display: '-webkit-box',
         WebkitLineClamp: '2',
         WebkitBoxOrient: 'vertical'}}>{v.name} ({v.id})</span></a></Link>)
      }
      return(<>{banner}</>)
   }

   listthemes(themes){
      var theme = []
      for(var v of themes){
         theme.push(<Link href={"/development/themes/view/"+v.id+""} key={Assistant.generateKey(8)}><a className="avatar avatar-lg rounded-circle list" data-toggle="tooltip" data-original-title={v.name} title={v.name}>
         <div style={{
         backgroundColor: v.ref_color,
         width: '100%',
         height: '100%',
         borderRadius: '50%'}}></div>
         <span style=
         {{position: 'absolute',
         top: '60px',
         color: 'black',
         textAlign: 'center',
         fontSize: '13px',
         overflow: 'hidden',
         textOverflow: 'ellipsis',
         display: '-webkit-box',
         WebkitLineClamp: '2',
         WebkitBoxOrient: 'vertical'}}>{v.name} ({v.id})</span></a></Link>)
      }
      return(<>{theme}</>)
   }

   alertDeleteOrder(e){
      $("#inseriridpedido").text(e.target.attributes["data-id-order"].value)
   }
}

class renderClient extends renderMore{

  /**
    * @function usersList
    * 
    * Retorna a lista de usuarios nivel < 2
    * @param {cxt} dados 
    * @returns component
    */
  usersList(dados) {
    var items = []
    for(var item of dados.final.l.users){
    items.push(<tr key={item.id} data-user-list={item.user}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"><div className="media-body"> <span className="name mb-0 text-sm">{item.user}</span></div></div></th><td className="budget">{item.nome}</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">{Moree.Niveis(item.level)}</span> </span></td><td> {item.likes}</td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <Link href={"/development/users/edit/"+item.user+""}><a className="dropdown-item">Editar</a></Link><a data-toggle="modal" data-target="#modal-default" href="#modal-default" data-user={item.user} className="dropdown-item" onClick={(e) => Logged.Name(e)}>Apagar</a></div></div></td></tr>)
    }
    return(<>{items}</>)
    
  }

  updatesList(dados) {
   
   var items = []
   for(var item of dados){
   items.push(<tr key={item.id} data-update-list={item.id}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"><div className="media-body"> <span className="name mb-0 text-sm">{item.title}</span></div></div></th><td className="budget">{item.owner}</td><td> {Moree.time(item.date)}</td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <Link href={"/development/news/view/"+item.id+""}><a className="dropdown-item">Editar/Ver</a></Link><a data-toggle="modal" data-target="#modal-default" href="#modal-default" data-update={item.id} className="dropdown-item" onClick={(e) => Logged.Name(e)}>Apagar</a></div></div></td></tr>)
   }
   return(<>{items}</>)
   
 }

  ordersList(dados) {
      try{
        const items = []
          for(const item of dados.final.l.Orders){
            var array = JSON.parse(item.data)
            var prioridade = typeof array.PrioritySER !== 'undefined' ? '#fb6340' : ''
            var Booster = item.booster !== null ? item.booster: 'AINDA SEM'
            var Status = item.payment === '2' ? 'PEDIDO PAGO': item.payment === '3' ? 'FINALIZADO':  item.payment === '0' ? 'CANCELADO': 'NÃO PAGO'
            var StatusIcone = item.payment === '2' ? 'bg-success': item.payment === '3' ? 'bg-info': 'bg-warning'
                  if(typeof array.Curso !== 'undefined')
                    {
                items.push(<tr key={item.id} style={{backgroundColor: prioridade}} id={"id-order-"+item.id}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Season-10-Gold-Summoner-Icon.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">Curso</span></div></div></th><td className="budget"> COACH / {array.Curso.toUpperCase()} / {array.Aulas} DIAS DE AULA</td><td> <span className="badge badge-dot mr-4"> <i className={StatusIcone}></i> <span className="status">{Status}</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td> <span className="status center">{Booster}</span> </td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <a className="dropdown-item" href="!#"  data-toggle="modal" data-target="#modal-default" data-id-order={item.id} onClick={(e) => this.alertDeleteOrder(e)}>Apagar</a> <Link href={"/development/orders/view/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
              } 
              else if(typeof array.Servico !== 'undefined' && array.Servico === 'MD10')
              {
                items.push(<tr key={item.id} style={{backgroundColor: prioridade}} id={"id-order-"+item.id}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Challenger-Summoner-Icon-Season-10-Reward.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">MD 10</span></div></div></th><td className="budget"> {array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.Temporada,array.Detalhes.divisao,'imagem')+".png"} style={{maxHeight: '30px'}}/> {array.Temporada.toUpperCase()} {array.Detalhes.divisao.toUpperCase()} / {array.Aulas} PARTIDAS</td><td> <span className="badge badge-dot mr-4"> <i className={StatusIcone}></i> <span className="status">{Status}</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td> <span className="status center">{Booster}</span> </td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <a className="dropdown-item" href="!#"  data-toggle="modal" data-target="#modal-default">Apagar</a> <Link href={"/development/orders/view/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
              }
              else
              {
                items.push(<tr key={item.id} style={{backgroundColor: prioridade}} id={"id-order-"+item.id}><td className="budget"> # {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Diamond-Summoner-Icon-Season-10-Reward.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">{array.Servico.toUpperCase()}</span></div></div></th><td className="budget"> {array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloSelecionado,array.DivisaoSelecionada,'imagem')+".png"} style={{maxHeight: '30px'}}/>{array.EloSelecionado.toUpperCase()} {array.DivisaoSelecionada.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloDesejado,array.DivisaoDesejada,'imagem')+".png"} data-toggle="tooltip" style={{maxHeight: '30px'}} data-original-title="" title=""/>{array.EloDesejado.toUpperCase()} {array.DivisaoDesejada.toUpperCase()}</td><td> <span className="badge badge-dot mr-4"> <i className={StatusIcone}></i> <span className="status">{Status}</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td> <span className="status center">{Booster}</span> </td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <a className="dropdown-item" href="!#"  data-toggle="modal" data-target="#modal-default">Apagar</a> <Link href={"/development/orders/view/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
              }
    }
  
    return (<>{items}</>)
  
    }catch(e){
      console.log(e)
      return (<><tr>Não encontrado</tr></>)
      }
  }

  couponsList(dados) {
   
   var items = []
   for(var item of dados){
   items.push(<tr key={item.id} data-update-list={item.id}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"><div className="media-body"> <span className="name mb-0 text-sm">{item.code}</span></div></div></th><td className="budget">{item.discount}</td><td> {Moree.time(item.expires)}</td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <Link href={"/development/coupons/view/"+item.id+""}><a className="dropdown-item">Editar/Ver</a></Link><a data-toggle="modal" data-target="#modal-default" href="#modal-default" data-update={item.id} className="dropdown-item" onClick={(e) => Logged.Name(e)}>Apagar</a></div></div></td></tr>)
   }
   return(<>{items}</>)
   
 }
  

  /**
   * @function userserachdetail
   * 
   * Elemento completo da pagina do usuario procurado
   * Pagina para editar/ver dados
   * @param {cxt} dados 
   * @param {array} contas 
   * @returns component
   */
  userserachdetail(dados,contas,estilo,token){
   return(<>
      <div className="col-xl-4 order-xl-2">
    <div className="card card-profile">
       <a data-toggle="modal" data-target="#modal-profile-banners" href="#modal-profile-banners"><img src={"/lol/profiles/banners/"+estilo.banner[0].img} alt="Image placeholder" className="card-img-top"/></a>
       <div className="row justify-content-center">
          <div className="col-lg-3 order-lg-2">
             <div className="card-profile-image"><a  data-toggle="modal" data-target="#modal-profile-pictures" href="#modal-profile-pictures"><img src={"/lol/profiles/avatar/"+estilo.avatar[0].img} className="rounded-circle divisoria"/></a></div>
          </div>
       </div>
       <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          <div className="d-flex justify-content-between"><a data-toggle="modal" data-target="#modal-user-delete" href="#modal-user-delete" className="btn btn-sm btn-danger  mr-4 ">Apagar</a><Link href={"/development/users/orders/"+dados[0].user}><a className="btn btn-sm btn-default float-right">Pedidos</a></Link></div>
       </div>
       <div className="card-body pt-0">
          <div className="row">
             <div className="col">
                <div className="card-profile-stats d-flex justify-content-center">
                   <div style={{marginRight: '1rem'}}><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{dados[0].user}</span><span className="description">Usuario</span></div>
                   <div style={{marginRight: '2rem'}}><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{dados[0].nome}</span><span className="description">Nome</span></div>
                   <div style={{marginRight: '2rem'}}><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{Moree.Niveis(dados[0].level)}</span><span className="description">Nivel</span></div>
                </div>
             </div>
          </div>
          <div className="text-center">
             <h5 className="h3">Extra</h5>
             <table className="table align-items-end" style={{textAlign: 'left'}}>
             <tbody>
                </tbody>
             </table>
          </div>
       </div>
    </div>
    </div>
      <div className="col-xl-8 order-xl-1">
         <div className="card">
            <div className="card-header">
               <div className="row align-items-center">
                  <div className="col-8">
                     <h3 className="mb-0">Dados Usuario</h3>
                     <h5 className="mb-0">Os campos em branco, significa que voce precisa por algum valor caso queira acrescentar algo, não são obrigatorios</h5>
                  </div>
                  <div className="col-4 text-right">
                     <Link href="/development/users/list"><a className="btn btn-sm btn-primary">Voltar</a></Link>
                  </div>
               </div>
            </div>
            <div className="card-body">
               <form id="etapa1">
                  <h6 className="heading-small text-muted mb-4">Informação</h6>
                  <div className="pl-lg-4">
                     <div className="row">
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-username">Usuario</label>
                              <input name="usuario" type="text" id="input-username" className="form-control" placeholder="Username" defaultValue={dados[0].user} disabled/>
                           </div>
                        </div>
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-email">Email</label>
                              <input type="email" name="email" id="input-email" className="form-control" placeholder="email" defaultValue={dados[0].email}/>
                           </div>
                        </div>
                     </div>
                     <div className="row">
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-first-name">Nome</label>
                              <input type="text" name="nome" id="input-first-name" className="form-control" placeholder="Nome" defaultValue={dados[0].nome}/>
                           </div>
                        </div>
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-last-name">Celular</label>
                              <input type="text" name="celular" id="input-last-name" className="form-control" placeholder="Numero" defaultValue={dados[0].celular}/>
                           </div>
                        </div>
                     </div>
                     <div className="row">
                        <div className="col-lg-6">
                           <div className="form-group">
                           <label  className="form-control-label" htmlFor="nivellabel">Nivel</label>
                           <select className="form-control" name="nivel" id="nivellabel">
                              <option defaultValue="default" value={dados[0].level}>{Moree.Niveis(dados[0].level)}</option>
                              <option value="0">Cliente</option>
                              <option value="1">Booster</option>
                              <option value="2">Master</option>
                           </select>
                           </div>
                        </div>
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-last-name">Nova senha <i className="ni ni-bulb-61 text-orange" title="Preencha este campo caso queira mudar a senha do usuario"></i></label>
                              <input type="text" id="input-last-name" name="newpassword" className="form-control" placeholder="Senha nova"/>
                           </div>
                        </div>
                     </div>
                     <div style={{marginLeft: '36%',marginRight: '36%'}}>
                     <button type="button" className="btn btn-primary" onClick={(e) => Logged.Etapa1("etapa1",token,dados)}>Alterar Dados</button>
                     </div>
                  </div>
                  </form>

                  <form>
                  <hr className="my-4" />
                  <h6 className="heading-small text-muted mb-4">Contas Lol</h6>
                  <div className="pl-lg-4">
                     <div className="row">
                        <div className="tablejobx">
                         <table className="table align-items-center">
                            <thead className="thead-light">
                               <tr>
                <th scope="col" className="sort" data-sort="name">Conta</th>
                <th scope="col" className="sort" data-sort="budget">Senha</th>
                <th scope="col" className="sort" data-sort="status">Invocador</th>
                <th scope="col">Trabalhando</th>
                <th scope="col" className="sort" data-sort="completion">Jogando</th>
                <th scope="col" className="sort" data-sort="acoes">Acoes</th>
                </tr>
                </thead>
                <tbody className="list">
                   {this.userserachaccounts(contas)}
                </tbody>
                      </table>
                      </div>
                     </div>
                  </div>
                  <hr className="my-4" />
                  <h6 className="heading-small text-muted mb-4">About me</h6>
                  <div className="pl-lg-4">
                     <div className="form-group">
                        <label className="form-control-label">About Me</label>
                        <textarea rows="4" className="form-control" placeholder="A few words about you ..." value="A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   
   
     </>)

  }

  teste(){ 
      $("span.Nivel").text($("#nivellabel").find(":selected").text())
      $("span.heading.n").text($("#nivellabel").find(":selected").val())
  }

}


export {renderClient,renderMore}

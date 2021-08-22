import React, { Component } from 'react'
import Link from 'next/link'

import {LeagueOfTools,Assistants,More} from '../more/more'
import Logged    from '../../../components/front/logged/class'

const LoggedAuth = new Logged()

const Assistant = new Assistants();

const leagueTools = new LeagueOfTools()

const Moree = new More()

class renderClient{

  /**
   * @function clientsAllAwait
   * 
   * Retorna a lista de clients "Prontos ou já feitos"
   * @param {cxt} dados 
   * @returns component
   */
  clientsAllAwait(dados) {
    try{
      const items = []
        for(const item of dados){
          var array = JSON.parse(item.data)
          var prioridade = typeof array.PrioritySER !== 'undefined' ? '#fb6340' : ''
            if(item.booster === null)
            {
              if(typeof array.Curso !== 'undefined')
            {
              items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Season-10-Gold-Summoner-Icon.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">Curso</span></div></div></th><td className="budget"> COACH / {array.Curso.toUpperCase()} / {array.Aulas} DIAS DE AULA</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">aguardando invocador</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><Link href={"/manage/customers/free/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
              
            } 
            else if(typeof array.Servico !== 'undefined' && array.Servico === 'MD10')
            {

              items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Challenger-Summoner-Icon-Season-10-Reward.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">MD 10</span></div></div></th><td className="budget"> {array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.Temporada,array.Detalhes.divisao,'imagem')+".png"} style={{maxHeight: '30px'}}/> {array.Temporada.toUpperCase()} {array.Detalhes.divisao.toUpperCase()} / {array.Aulas} PARTIDAS</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">aguardando invocador</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><Link href={"/manage/customers/free/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
          
            }
            else
            {
            items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"> # {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Diamond-Summoner-Icon-Season-10-Reward.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">{array.Servico.toUpperCase()}</span></div></div></th><td className="budget"> {array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloSelecionado,array.DivisaoSelecionada,'imagem')+".png"} style={{maxHeight: '30px'}}/>{array.EloSelecionado.toUpperCase()} {array.DivisaoSelecionada.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloDesejado,array.DivisaoDesejada,'imagem')+".png"} data-toggle="tooltip" style={{maxHeight: '30px'}} data-original-title="" title=""/>{array.EloDesejado.toUpperCase()} {array.DivisaoDesejada.toUpperCase()}</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">aguardando invocador</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><Link href={"/manage/customers/free/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
            }  
      }
  }

    return (<>{items}</>)
  
      }catch(e){
    console.log(e)
    return (<><tr>Não encontrado</tr></>)
  }
}

  /**
   * @function clientsAllAwaitMy
   * 
   * Retorna a lista de clients "Prontos ou já feitos" 
   * do Booster Logado
   * @param {cxt} dados 
   * @returns component
   */
  clientsAllAwaitMy(dados) {
    try{
      const items = []
        for(const item of dados){
          var array = JSON.parse(item.data)
          var prioridade = typeof array.PrioritySER !== 'undefined' ? '#fb6340' : ''
            if(item.booster != null)
              {
                if(typeof array.Curso !== 'undefined')
                  { 

              items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Season-10-Gold-Summoner-Icon.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">Curso</span></div></div></th><td className="budget"> COACH / {array.Curso.toUpperCase()} / {array.Aulas} DIAS DE AULA</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">Aguardando você!</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <a className="dropdown-item" href="#">Começar</a> <Link href={"/manage/customers/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
    
            } 
            else if(typeof array.Servico !== 'undefined' && array.Servico === 'MD10')
            {

              items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Challenger-Summoner-Icon-Season-10-Reward.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">MD 10</span></div></div></th><td className="budget"> {array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.Temporada,array.Detalhes.divisao,'imagem')+".png"} style={{maxHeight: '30px'}}/> {array.Temporada.toUpperCase()} {array.Detalhes.divisao.toUpperCase()} / {array.Aulas} PARTIDAS</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">Aguardando você!</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <a className="dropdown-item" href="#">Começar</a> <Link href={"/manage/customers/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
            }
            else
            {
              items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"> # {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Diamond-Summoner-Icon-Season-10-Reward.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">{array.Servico.toUpperCase()}</span></div></div></th><td className="budget"> {array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloSelecionado,array.DivisaoSelecionada,'imagem')+".png"} style={{maxHeight: '30px'}}/>{array.EloSelecionado.toUpperCase()} {array.DivisaoSelecionada.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloDesejado,array.DivisaoDesejada,'imagem')+".png"} data-toggle="tooltip" style={{maxHeight: '30px'}} data-original-title="" title=""/>{array.EloDesejado.toUpperCase()} {array.DivisaoDesejada.toUpperCase()}</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">Aguardando você!</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <a className="dropdown-item" href="#">Começar</a> <Link href={"/manage/customers/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
            }
        }
  }

  return (<>{items}</>)

  }catch(e){
    console.log(e)
    return (<><tr>Não encontrado</tr></>)
    }
}


 /**
   * @function contentOrderAwait
   * 
   * O que sera mostrado na pagina de compra
   * referente ao ID da compra #, sem booster
   * @param {ctx} dados 
   */
  contentOrderAwait(cxt) {
   const Booster = 'Ainda sem'

   //cxt.final.o.order[0] == dados da elo_invoices
   //cxt.final.o.order[1] == dados da conta
   const array = JSON.parse(cxt.final.o.order[0].data)

   /**
    * Verificando se é um produto ELO BOOST!
    */
    if (array.AccountMethod) {
  
    const account = cxt.final.o.order[1]
      return(<>
        <div className="col-xl-4 order-xl-2">
      <div className="card card-profile">
         <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
         <div className="row justify-content-center">
            <div className="col-lg-3 order-lg-2">
               <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
            </div>
         </div>
         <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div className="d-flex justify-content-between"><a href="!#" data-toggle="modal" data-target="#modal-acept-job" className="btn btn-sm btn-info  mr-4 ">Aceitar</a></div>
         </div>
         <div className="card-body pt-0">
            <div className="row">
               <div className="col">
                  <div className="card-profile-stats d-flex justify-content-center">
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.invocador}</span><span className="description">Invocador</span></div>
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.conta}</span><span className="description">Conta</span></div>
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.senha}</span><span className="description">Senha</span></div>
                  </div>
               </div>
            </div>
            <div className="text-center">
               <h5 className="h3">Extra</h5>
               <table className="table align-items-end" style={{textAlign: 'left'}}>
               <tbody>
                    {Moree.addServices(array)}
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
        <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
            <div className="card">
               <div className="card-header">
                  <div className="row align-items-center">
                     <div className="col-8">
                        <h3 className="mb-0">Vizualizar Compra</h3>
                     </div>
                    
                  </div>
               </div>
               <div className="card-body">
                  <form>
                     <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                     <div className="tablejobx">
                     <table className="table align-items-center" style={{textAlign: 'center'}}>
                     <tbody>
                               <tr>
                                  <th>Iden</th>
                                  <th>Status</th>
                                  <th>Servico</th>
                                  <th>Produto</th>
                               </tr>
                               <tr>
                                  <td>#{cxt.final.o.order[0].id}</td>
                                  <td>Aguardando um Booster!<img src="https://cdn.iconscout.com/icon/free/png-64/clock-1605637-1360989.png" style={{width: '11px',marginLeft: '3px'}}/></td>
                                  <td>{array.Servico.toUpperCase()}</td>
                                  <td>{array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloSelecionado,array.DivisaoSelecionada,'imagem')+".png"} style={{maxWidth: '30px'}}/>
                                     {array.EloSelecionado.toUpperCase()} {array.DivisaoSelecionada.toUpperCase()} / 
                                 <img src={"/lol/badges/"+leagueTools.eloImg(array.EloDesejado,array.DivisaoDesejada,'imagem')+".png"} data-toggle="tooltip" style={{maxWidth: '30px'}} data-original-title="" title=""/>
                                     {array.EloDesejado.toUpperCase()} {array.DivisaoDesejada.toUpperCase()}
                                  </td>
                               </tr>
                               <tr>
                                  <th>Booster</th>
                                  <th>Valor</th>
                                  <th>Prazo</th>
                                  <th>Solicitado</th>
                               </tr>
                               <tr>
                                 <td>{Booster}</td>
                                 <td>{cxt.final.o.order[0].valor}</td>
                                 <td>{array.Prazo} dias</td>
                                 <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                               </tr>
                               <tr>
                                 <th>Aprovacao</th>
                                 <th>Finalizado</th>
                               </tr>
                               <tr>
                                 <td>{Assistant.time(cxt.final.o.order[0].date_aproved)}</td>
                                 <td>-</td>
                               </tr>
                     </tbody>
                     </table>
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

         /**
          * CONTENT MD10
          */
    } else if (array.Servico === 'MD10') {
      return(<>
        <div className="col-xl-4 order-xl-2">
        <div className="card card-profile">
         <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
         <div className="row justify-content-center">
            <div className="col-lg-3 order-lg-2">
               <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
            </div>
         </div>
         <div className="card-header text-center border-0 pt-6 pt-md-5 pb-0 pb-md-2">
            <div className="d-flex justify-content-between"><a href="!#" data-toggle="modal" data-target="#modal-acept-job" className="btn btn-sm btn-info  mr-4 ">Aceitar</a></div>
         </div>
         <div className="card-body pt-0">
            <div className="row">
               <div className="col">
                  <div className="card-profile-stats d-flex justify-content-center">
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '150px'}}>{array.Detalhes.invocador}</span><span className="description">Invocador</span></div>
                  </div>
               </div>
            </div>
            <div className="text-center">
               <h5 className="h3">Extra</h5>
               <table className="table align-items-end" style={{textAlign: 'left'}}>
               <tbody>
                {Moree.addServices(array)}
                     </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
            <div className="card">
               <div className="card-header">
                  <div className="row align-items-center">
                     <div className="col-8">
                        <h3 className="mb-0">Vizualizar Compra</h3>
                     </div>
                    
                  </div>
               </div>
               <div className="card-body">
                  <form>
                     <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                     <div className="tablejobx">
                     <table className="table align-items-center" style={{textAlign: 'center'}}>
                     <tbody>
                               <tr>
                                  <th>Iden</th>
                                  <th>Status</th>
                                  <th>Servico / Modo</th>
                                  <th>Produto</th>
                               </tr>
                               <tr>
                                  <td>#{cxt.final.o.order[0].id}</td>
                                  <td>Aguardando um Booster!<img src="https://cdn.iconscout.com/icon/free/png-64/clock-1605637-1360989.png" style={{width: '11px',marginLeft: '3px'}}/></td>
                                  <td>{array.Servico.toUpperCase()} / {array.Modo.toUpperCase()}</td>
                                  <td>{array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.Temporada,array.Detalhes.divisao,'imagem')+".png"} style={{maxWidth: '30px'}}/>{array.Temporada.toUpperCase()} {array.Detalhes.divisao.toUpperCase()} / {array.Aulas} PARTIDAS</td>
                               </tr>
                               <tr>
                                  <th>Booster</th>
                                  <th>Valor</th>
                                  <th>Rota</th>
                                  <th>Solicitado</th>
                               </tr>
                               <tr>
                                 <td>{Booster}</td>
                                 <td>{cxt.final.o.order[0].valor}</td>
                                 <td><img src={"/lol/routes/lane-"+array.Detalhes.rota+".png"} style={{maxWidth: '25px'}}/>  {array.Detalhes.rota.toUpperCase()}</td>
                                 <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                               </tr>
                               <tr>
                                 <th>Aprovacao</th>
                                 <th>Finalizado</th>
                               </tr>
                               <tr>
                                 <td>{Assistant.time(cxt.final.o.order[0].date_aproved)}</td>
                                 <td>-</td>
                               </tr>
                     </tbody>
                     </table>
                     </div>
                     <hr className="my-4" />
                     <h6 className="heading-small text-muted mb-4">Adicional</h6>
                     <div className="pl-lg-4">
                        <div className="form-group">
                           <label className="form-control-label">Horarios Disponiveis</label>
                           <textarea rows="4" className="form-control" placeholder="Horarios" defaultValue={array.Detalhes.horarios} disabled></textarea>
                        </div>
                     </div>

                     <div className="pl-lg-4">
                        <div className="form-group">
                           <label className="form-control-label">Dias Disponiveis  </label><span style={{fontSize: '15px', textAlign: 'left'}}>  segunda-feira, terca-feira e quarta-feira</span>
                        </div>
                     </div>

                  </form>
               </div>
            </div>
         </div>
       </>)
       /**
        * O ELSE DE TODOS CONTENT
        */
    } else {
    
      return(<>
         <div className="col-xl-4 order-xl-2">
         <div className="card card-profile">
          <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
          <div className="row justify-content-center">
             <div className="col-lg-3 order-lg-2">
                <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
             </div>
          </div>
          <div className="card-header text-center border-0 pt-6 pt-md-5 pb-0 pb-md-2">
             <div className="d-flex justify-content-between"><a href="!#" data-toggle="modal" data-target="#modal-acept-job" className="btn btn-sm btn-info  mr-4 ">Aceitar</a></div>
          </div>
          <div className="card-body pt-0">
             <div className="row">
                <div className="col">
                   <div className="card-profile-stats d-flex justify-content-center">
                      <div><span className="heading" style={{fontSize: '13px', maxWidth: '150px'}}>{array.Detalhes.invocador}</span><span className="description">Invocador</span></div>
                   </div>
                </div>
             </div>
             <div className="text-center">
                <h5 className="h3">Extra</h5>
                <table className="table align-items-end" style={{textAlign: 'left'}}>
                <tbody>
                 {Moree.addServices(array)}
                      </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
    <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
             <div className="card">
                <div className="card-header">
                   <div className="row align-items-center">
                      <div className="col-8">
                         <h3 className="mb-0">Vizualizar Compra</h3>
                      </div>
                     
                   </div>
                </div>
                <div className="card-body">
                   <form>
                      <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                      <div className="tablejobx">
                      <table className="table align-items-center" style={{textAlign: 'center'}}>
                      <tbody>
                                <tr>
                                   <th>Iden</th>
                                   <th>Status</th>
                                   <th>Servico / Modo</th>
                                   <th>Produto</th>
                                </tr>
                                <tr>
                                   <td>#{cxt.final.o.order[0].id}</td>
                                   <td>Aguardando um Booster!<img src="https://cdn.iconscout.com/icon/free/png-64/clock-1605637-1360989.png" style={{width: '11px',marginLeft: '3px'}}/></td>
                                   <td>COACH / {array.Curso.toUpperCase()}</td>
                                   <td>{array.Aulas} DIAS DE AULA</td>
                                </tr>
                                <tr>
                                   <th>Booster</th>
                                   <th>Valor</th>
                                   <th>Rota</th>
                                   <th>Solicitado</th>
                                </tr>
                                <tr>
                                  <td>{Booster}</td>
                                  <td>{cxt.final.o.order[0].valor}</td>
                                  <td><img src={"/lol/routes/lane-"+array.Detalhes.rota+".png"} style={{maxWidth: '25px'}}/>  {array.Detalhes.rota.toUpperCase()}</td>
                                  <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                                </tr>
                                <tr>
                                  <th>Aprovacao</th>
                                  <th>Finalizado</th>
                                </tr>
                                <tr>
                                  <td>{Assistant.time(cxt.final.o.order[0].date_aproved)}</td>
                                  <td>-</td>
                                </tr>
                      </tbody>
                      </table>
                      </div>
                      <hr className="my-4" />
                      <h6 className="heading-small text-muted mb-4">Adicional</h6>
                      <div className="pl-lg-4">
                         <div className="form-group">
                            <label className="form-control-label">Horarios Disponiveis</label>
                            <textarea rows="4" className="form-control" placeholder="Horarios" defaultValue={array.Detalhes.horarios} disabled></textarea>
                         </div>
                      </div>
 
                      <div className="pl-lg-4">
                         <div className="form-group">
                            <label className="form-control-label">Dias Disponiveis  </label><span style={{fontSize: '15px', textAlign: 'left'}}>{Assistant.Days(array.Detalhes.dias)}</span>
                         </div>
                      </div>
 
                   </form>
                </div>
             </div>
          </div>
        </>)

    }
   
    
}

/**
   * @function clientsAllOrders
   * 
   * Retorna a lista de pedidos do Cliente Requistado
   * Somente para admins
   * @param {cxt} dados 
   * @returns component
   */
 clientsAllOrders(dados) {
   try{
     const items = []
       for(const item of dados){
         var array = JSON.parse(item.data)
         var prioridade = typeof array.PrioritySER !== 'undefined' ? '#fb6340' : ''
           if(item.booster != null)
             {
               if(typeof array.Curso !== 'undefined')
                 { 

             items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Season-10-Gold-Summoner-Icon.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">Curso</span></div></div></th><td className="budget"> COACH / {array.Curso.toUpperCase()} / {array.Aulas} DIAS DE AULA</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">{item.booster}</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><Link href={"/manage/customers/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
   
           } 
           else if(typeof array.Servico !== 'undefined' && array.Servico === 'MD10')
           {

             items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"># {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Challenger-Summoner-Icon-Season-10-Reward.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">MD 10</span></div></div></th><td className="budget"> {array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.Temporada,array.Detalhes.divisao,'imagem')+".png"} style={{maxHeight: '30px'}}/> {array.Temporada.toUpperCase()} {array.Detalhes.divisao.toUpperCase()} / {array.Aulas} PARTIDAS</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">{item.booster}</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><Link href={"/manage/customers/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
           }
           else
           {
             items.push(<tr key={item.id} style={{backgroundColor: prioridade}}><td className="budget"> # {item.id}</td><th scope="row"><div className="media align-items-center"> <a href="#" className="avatar rounded-circle mr-3"> <img alt="Image placeholder" src="https://img.rankedboost.com/wp-content/uploads/2020/10/Diamond-Summoner-Icon-Season-10-Reward.jpg"/> </a><div className="media-body"> <span className="name mb-0 text-sm">{array.Servico.toUpperCase()}</span></div></div></th><td className="budget"> {array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloSelecionado,array.DivisaoSelecionada,'imagem')+".png"} style={{maxHeight: '30px'}}/>{array.EloSelecionado.toUpperCase()} {array.DivisaoSelecionada.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloDesejado,array.DivisaoDesejada,'imagem')+".png"} data-toggle="tooltip" style={{maxHeight: '30px'}} data-original-title="" title=""/>{array.EloDesejado.toUpperCase()} {array.DivisaoDesejada.toUpperCase()}</td><td> <span className="badge badge-dot mr-4"> <i className="bg-warning"></i> <span className="status">{item.booster}</span> </span></td><td> {item.valor}</td><td><div className="d-flex align-items-center"> <span className="completion mr-2">0%</span><div><div className="progress"><div className="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style={{width: '0%'}}></div></div></div></div></td><td className="text-right"><div className="dropdown"> <a className="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="fas fa-ellipsis-v"></i> </a><div className="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><Link href={"/manage/customers/"+item.id}><a className="dropdown-item">Detalhes</a></Link></div></div></td></tr>)
           }
       }
 }

 return (<>{items}</>)

 }catch(e){
   console.log(e)
   return (<><tr>Não encontrado</tr></>)
   }
}




  /**
   * @function contentOrder
   * 
   * O que sera mostrado na pagina de compra
   * referente ao ID da compra #
   * @param {ctx} dados 
   */
  contentOrder(cxt) {
   const Booster = typeof cxt.final.bo.Final[0].usuario[0] === 'undefined' ? 'Ainda sem': cxt.final.bo.Final[0].usuario[0].user

   //cxt.final.o.order[0] == dados da elo_invoices
   //cxt.final.o.order[1] == dados da conta
   const array = JSON.parse(cxt.final.o.order[0].data)

   /**
    * Verificando se é um produto ELO BOOST!
    */
    if (array.AccountMethod) {
  
    const account = cxt.final.o.order[1]
    const Playing = account.playing === "2" ? <a  href="!#" className="btn btn-sm btn-warning  mr-4" data-toggle="modal" data-toggle="modal" data-target="#modal-cansei">Cansei</a> : account.playing === "0" ? <a  href="!#" className="btn btn-sm btn-info  mr-4" data-toggle="modal" data-target="#modal-start">Começar</a> : ''

      return(<>
        <div className="col-xl-4 order-xl-2">
      <div className="card card-profile">
         <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
         <div className="row justify-content-center">
            <div className="col-lg-3 order-lg-2">
               <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
            </div>
         </div>
         <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div className="d-flex justify-content-between">{Playing}<Link href={"/manage/customers/"+cxt.final.o.order[0].id+"/chat"}><a className="btn btn-sm btn-default float-right">Chat/Historico</a></Link></div>
            <div className="d-flex justify-content-between"><a href="!#" data-toggle="modal" data-target="#modal-finish-job" className="btn btn-sm btn-danger float-right">Finalizar Pedido</a></div>
         </div>
         <div className="card-body pt-0">
            <div className="row">
               {account.playing === "1" ?  <span style={{
                                                 fontSize: "14px",
                                                 textAlign: "center",
                                                 color: "red"}}>
                                          Não sera possivel começar o trabalho,pois a conta esta em uso!
               </span>: ""}
               {
                  account.playing === "2" ? <span style={{
                     fontSize: "14px",
                     textAlign: "center",
                     color: "green"}}>
               Perfeito, você trocou o status da conta, agora começe a jogar!
               </span>: ""
               }
               <div className="col">
                  <div className="card-profile-stats d-flex justify-content-center">
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.invocador}</span><span className="description">Invocador</span></div>
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.conta}</span><span className="description">Conta</span></div>
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.senha}</span><span className="description">Senha</span></div>
                  </div>
               </div>
            </div>
            <div className="text-center">
               <h5 className="h3">Extra</h5>
               <table className="table align-items-end" style={{textAlign: 'left'}}>
               <tbody>
                    {Moree.addServices(array)}
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
        <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
            <div className="card">
               <div className="card-header">
                  <div className="row align-items-center">
                     <div className="col-8">
                        <h3 className="mb-0">Vizualizar Compra</h3>
                     </div>
                    
                  </div>
               </div>
               <div className="card-body">
                  <form>
                     <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                     <div className="tablejobx">
                     <table className="table align-items-center" style={{textAlign: 'center'}}>
                     <tbody>
                               <tr>
                                  <th>Iden</th>
                                  <th>Status</th>
                                  <th>Servico</th>
                                  <th>Produto</th>
                               </tr>
                               <tr>
                                  <td>#{cxt.final.o.order[0].id}</td>
                                  <td>Pagamento aprovado<img src="/assets/img/icons/ok.png" style={{width: '11px',marginLeft: '3px'}}/></td>
                                  <td>{array.Servico.toUpperCase()}</td>
                                  <td>{array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloSelecionado,array.DivisaoSelecionada,'imagem')+".png"} style={{maxWidth: '30px'}}/>
                                     {array.EloSelecionado.toUpperCase()} {array.DivisaoSelecionada.toUpperCase()} / 
                                 <img src={"/lol/badges/"+leagueTools.eloImg(array.EloDesejado,array.DivisaoDesejada,'imagem')+".png"} data-toggle="tooltip" style={{maxWidth: '30px'}} data-original-title="" title=""/>
                                     {array.EloDesejado.toUpperCase()} {array.DivisaoDesejada.toUpperCase()}
                                  </td>
                               </tr>
                               <tr>
                                  <th>Booster</th>
                                  <th>Valor</th>
                                  <th>Prazo</th>
                                  <th>Solicitado</th>
                               </tr>
                               <tr>
                                 <td>{Booster}</td>
                                 <td>{cxt.final.o.order[0].valor}</td>
                                 <td>{array.Prazo} dias</td>
                                 <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                               </tr>
                               <tr>
                                 <th>Aprovacao</th>
                                 <th>Finalizado</th>
                               </tr>
                               <tr>
                                 <td>{Assistant.time(cxt.final.o.order[0].date_aproved)}</td>
                                 <td>-</td>
                               </tr>
                     </tbody>
                     </table>
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

         /**
          * CONTENT MD10
          */
    } else if (array.Servico === 'MD10') {
      return(<>
        <div className="col-xl-4 order-xl-2">
        <div className="card card-profile">
         <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
         <div className="row justify-content-center">
            <div className="col-lg-3 order-lg-2">
               <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
            </div>
         </div>
         <div className="card-header text-center border-0 pt-6 pt-md-5 pb-0 pb-md-2">
            <div className="d-flex justify-content-between"><a href="!#" data-toggle="modal" data-target="#modal-finish-job" className="btn btn-sm btn-danger mr-4">Finalizar Pedido</a><Link href={"/manage/customers/"+cxt.final.o.order[0].id+"/chat"}><a className="btn btn-sm btn-default float-right">Chat/Historico</a></Link></div>
         </div>
         <div className="card-body pt-0">
            <div className="row">
               <div className="col">
                  <div className="card-profile-stats d-flex justify-content-center">
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '150px'}}>{array.Detalhes.invocador}</span><span className="description">Invocador</span></div>
                  </div>
               </div>
            </div>
            <div className="text-center">
               <h5 className="h3">Extra</h5>
               <table className="table align-items-end" style={{textAlign: 'left'}}>
               <tbody>
                {Moree.addServices(array)}
                     </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
            <div className="card">
               <div className="card-header">
                  <div className="row align-items-center">
                     <div className="col-8">
                        <h3 className="mb-0">Vizualizar Compra</h3>
                     </div>
                    
                  </div>
               </div>
               <div className="card-body">
                  <form>
                     <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                     <div className="tablejobx">
                     <table className="table align-items-center" style={{textAlign: 'center'}}>
                     <tbody>
                               <tr>
                                  <th>Iden</th>
                                  <th>Status</th>
                                  <th>Servico / Modo</th>
                                  <th>Produto</th>
                               </tr>
                               <tr>
                                  <td>#{cxt.final.o.order[0].id}</td>
                                  <td>Pagamento aprovado<img src="/assets/img/icons/ok.png" style={{width: '11px',marginLeft: '3px'}}/></td>
                                  <td>{array.Servico.toUpperCase()} / {array.Modo.toUpperCase()}</td>
                                  <td>{array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.Temporada,array.Detalhes.divisao,'imagem')+".png"} style={{maxWidth: '30px'}}/>{array.Temporada.toUpperCase()} {array.Detalhes.divisao.toUpperCase()} / {array.Aulas} PARTIDAS</td>
                               </tr>
                               <tr>
                                  <th>Booster</th>
                                  <th>Valor</th>
                                  <th>Rota</th>
                                  <th>Solicitado</th>
                               </tr>
                               <tr>
                                 <td>{Booster}</td>
                                 <td>{cxt.final.o.order[0].valor}</td>
                                 <td><img src={"/lol/routes/lane-"+array.Detalhes.rota+".png"} style={{maxWidth: '25px'}}/>  {array.Detalhes.rota.toUpperCase()}</td>
                                 <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                               </tr>
                               <tr>
                                 <th>Aprovacao</th>
                                 <th>Finalizado</th>
                               </tr>
                               <tr>
                                 <td>{Assistant.time(cxt.final.o.order[0].date_aproved)}</td>
                                 <td>-</td>
                               </tr>
                     </tbody>
                     </table>
                     </div>
                     <hr className="my-4" />
                     <h6 className="heading-small text-muted mb-4">Adicional</h6>
                     <div className="pl-lg-4">
                        <div className="form-group">
                           <label className="form-control-label">Horarios Disponiveis</label>
                           <textarea rows="4" className="form-control" placeholder="Horarios" defaultValue={array.Detalhes.horarios} disabled></textarea>
                        </div>
                     </div>

                     <div className="pl-lg-4">
                        <div className="form-group">
                           <label className="form-control-label">Dias Disponiveis  </label><span style={{fontSize: '15px', textAlign: 'left'}}>  segunda-feira, terca-feira e quarta-feira</span>
                        </div>
                     </div>

                  </form>
               </div>
            </div>
         </div>
       </>)
       /**
        * O ELSE DE TODOS CONTENT
        */
    } else {
    
      return(<>
         <div className="col-xl-4 order-xl-2">
         <div className="card card-profile">
          <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
          <div className="row justify-content-center">
             <div className="col-lg-3 order-lg-2">
                <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
             </div>
          </div>
          <div className="card-header text-center border-0 pt-6 pt-md-5 pb-0 pb-md-2">
             <div className="d-flex justify-content-between"><a href="!#" data-toggle="modal" data-target="#modal-finish-job" className="btn btn-sm btn-danger  mr-4 ">Finalizar Pedido</a><Link href={"/manage/customers/"+cxt.final.o.order[0].id+"/chat"}><a className="btn btn-sm btn-default float-right">Chat/Historico</a></Link></div>
          </div>
          <div className="card-body pt-0">
             <div className="row">
                <div className="col">
                   <div className="card-profile-stats d-flex justify-content-center">
                      <div><span className="heading" style={{fontSize: '13px', maxWidth: '150px'}}>{array.Detalhes.invocador}</span><span className="description">Invocador</span></div>
                   </div>
                </div>
             </div>
             <div className="text-center">
                <h5 className="h3">Extra22</h5>
                <table className="table align-items-end" style={{textAlign: 'left'}}>
                <tbody>
                 {Moree.addServices(array)}
                      </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
    <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
             <div className="card">
                <div className="card-header">
                   <div className="row align-items-center">
                      <div className="col-8">
                         <h3 className="mb-0">Vizualizar Compra</h3>
                      </div>
                     
                   </div>
                </div>
                <div className="card-body">
                   <form>
                      <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                      <div className="tablejobx">
                      <table className="table align-items-center" style={{textAlign: 'center'}}>
                      <tbody>
                                <tr>
                                   <th>Iden</th>
                                   <th>Status</th>
                                   <th>Servico / Modo</th>
                                   <th>Produto</th>
                                </tr>
                                <tr>
                                   <td>#{cxt.final.o.order[0].id}</td>
                                   <td>Pagamento aprovado<img src="/assets/img/icons/ok.png" style={{width: '11px',marginLeft: '3px'}}/></td>
                                   <td>COACH / {array.Curso.toUpperCase()}</td>
                                   <td>{array.Aulas} DIAS DE AULA</td>
                                </tr>
                                <tr>
                                   <th>Booster</th>
                                   <th>Valor</th>
                                   <th>Rota</th>
                                   <th>Solicitado</th>
                                </tr>
                                <tr>
                                  <td>{Booster}</td>
                                  <td>{cxt.final.o.order[0].valor}</td>
                                  <td><img src={"/lol/routes/lane-"+array.Detalhes.rota+".png"} style={{maxWidth: '25px'}}/>  {array.Detalhes.rota.toUpperCase()}</td>
                                  <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                                </tr>
                                <tr>
                                  <th>Aprovacao</th>
                                  <th>Finalizado</th>
                                </tr>
                                <tr>
                                  <td>{Assistant.time(cxt.final.o.order[0].date_aproved)}</td>
                                  <td>-</td>
                                </tr>
                      </tbody>
                      </table>
                      </div>
                      <hr className="my-4" />
                      <h6 className="heading-small text-muted mb-4">Adicional</h6>
                      <div className="pl-lg-4">
                         <div className="form-group">
                            <label className="form-control-label">Horarios Disponiveis</label>
                            <textarea rows="4" className="form-control" placeholder="Horarios" defaultValue={array.Detalhes.horarios} disabled></textarea>
                         </div>
                      </div>
 
                      <div className="pl-lg-4">
                         <div className="form-group">
                            <label className="form-control-label">Dias Disponiveis  </label><span style={{fontSize: '15px', textAlign: 'left'}}>{Assistant.Days(array.Detalhes.dias)}</span>
                         </div>
                      </div>
 
                   </form>
                </div>
             </div>
          </div>
        </>)

    }
   
    
}


 /**
   * @function contentOrderMaster
   * 
   * O que sera mostrado na pagina de compra
   * referente ao ID da compra # Do Master
   * @param {ctx} dados 
   */
  contentOrderMaster(cxt) {

 const Booster = typeof cxt.final.bo.Final[0].usuario[0] === 'undefined' ? 'Ainda sem': cxt.final.bo.Final[0].usuario[0].user
 var Status = cxt.final.o.order[0].payment === '2' ? <td>Pagamento aprovado<img src="/assets/img/icons/ok.png" style={{width: "11px",marginLeft: "3px"}}/></td>: cxt.final.o.order[0].payment === '3' ? <td>Servico Finalizado<img src="/assets/img/icons/ok.png" style={{width: "11px",marginLeft: "3px"}}/></td>: cxt.final.o.order[0].payment === '0' ? <td>Pedido Cancelado<img src="/assets/img/icons/ok.png" style={{width: "11px",marginLeft: "3px"}}/></td> : <td>Aguardando Pagamento<img src="/assets/img/icons/ok.png" style={{width: "11px",marginLeft: "3px"}}/></td>

 var StatusBotao = cxt.final.o.order[0].payment === '2' ? <a href="!#" data-toggle="modal" data-target="#modal-finish-job" className="btn btn-sm btn-danger">Cancelar Pedido</a>: cxt.final.o.order[0].payment === '3' ? '': cxt.final.o.order[0].payment === '0' ? '': <a href="!#" data-toggle="modal" data-target="#modal-approve-order" className="btn btn-sm btn-success float-right">Aprovar</a>



 //cxt.final.o.order[0] == dados da elo_invoices
 //cxt.final.o.order[1] == dados da conta
 const array = JSON.parse(cxt.final.o.order[0].data)

 /**
  * Verificando se é um produto ELO BOOST!
  */
  if (array.AccountMethod) {

  const account = cxt.final.o.order[1]
    return(<>
      <div className="col-xl-4 order-xl-2">
    <div className="card card-profile">
       <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
       <div className="row justify-content-center">
          <div className="col-lg-3 order-lg-2">
             <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
          </div>
       </div>
       <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          <div className="d-flex justify-content-between">
         {StatusBotao}
         <Link href={"/manage/customers/"+cxt.final.o.order[0].id+"/chat"}><a className="btn btn-sm btn-default float-right">Chat/Historico</a></Link>
             </div>
          
       </div>
       <div className="card-body pt-0">
          <div className="row">
             <div className="col">
                <div className="card-profile-stats d-flex justify-content-center">
                   <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.invocador}</span><span className="description">Invocador</span></div>
                   <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.conta}</span><span className="description">Conta</span></div>
                   <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.senha}</span><span className="description">Senha</span></div>
                </div>
             </div>
          </div>
          <div className="text-center">
             <h5 className="h3">Extra</h5>
             <table className="table align-items-end" style={{textAlign: 'left'}}>
             <tbody>
                  {Moree.addServices(array)}
                </tbody>
             </table>
          </div>
       </div>
    </div>
 </div>
      <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
          <div className="card">
             <div className="card-header">
                <div className="row align-items-center">
                   <div className="col-8">
                      <h3 className="mb-0">Vizualizar Compra</h3>
                   </div>
                  
                </div>
             </div>
             <div className="card-body">
                <form>
                   <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                   <div className="tablejobx">
                   <table className="table align-items-center" style={{textAlign: 'center'}}>
                   <tbody>
                             <tr>
                                <th>Iden</th>
                                <th>Status</th>
                                <th>Servico</th>
                                <th>Produto</th>
                             </tr>
                             <tr>
                                <td>#{cxt.final.o.order[0].id}</td>
                                {Status}
                                <td>{array.Servico.toUpperCase()}</td>
                                <td>{array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.EloSelecionado,array.DivisaoSelecionada,'imagem')+".png"} style={{maxWidth: '30px'}}/>
                                   {array.EloSelecionado.toUpperCase()} {array.DivisaoSelecionada.toUpperCase()} / 
                               <img src={"/lol/badges/"+leagueTools.eloImg(array.EloDesejado,array.DivisaoDesejada,'imagem')+".png"} data-toggle="tooltip" style={{maxWidth: '30px'}} data-original-title="" title=""/>
                                   {array.EloDesejado.toUpperCase()} {array.DivisaoDesejada.toUpperCase()}
                                </td>
                             </tr>
                             <tr>
                                <th>Booster</th>
                                <th>Valor</th>
                                <th>Prazo</th>
                                <th>Solicitado</th>
                             </tr>
                             <tr>
                               <td>{Booster}</td>
                               <td>{cxt.final.o.order[0].valor}</td>
                               <td>{array.Prazo} dias</td>
                               <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                             </tr>
                             <tr>
                               <th>Aprovacao</th>
                               <th>Finalizado</th>
                             </tr>
                             <tr>
                               <td>{
                                  cxt.final.o.order[0].date_aproved !== null ?  Assistant.time(cxt.final.o.order[0].date_aproved) : ''
                                 }
                              </td>
                               <td>-</td>
                             </tr>
                   </tbody>
                   </table>
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

       /**
        * CONTENT MD10
        */
  } else if (array.Servico === 'MD10') {
    return(<>
      <div className="col-xl-4 order-xl-2">
      <div className="card card-profile">
       <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
       <div className="row justify-content-center">
          <div className="col-lg-3 order-lg-2">
             <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
          </div>
       </div>
       <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          <div className="d-flex justify-content-between">
          {StatusBotao}
             <Link href={"/manage/customers/"+cxt.final.o.order[0].id+"/chat"}><a className="btn btn-sm btn-default float-right">Chat/Historico</a></Link>
             </div>
          
       </div>
       <div className="card-body pt-0">
          <div className="row">
             <div className="col">
                <div className="card-profile-stats d-flex justify-content-center">
                   <div><span className="heading" style={{fontSize: '13px', maxWidth: '150px'}}>{array.Detalhes.invocador}</span><span className="description">Invocador</span></div>
                </div>
             </div>
          </div>
          <div className="text-center">
             <h5 className="h3">Extra</h5>
             <table className="table align-items-end" style={{textAlign: 'left'}}>
             <tbody>
              {Moree.addServices(array)}
                   </tbody>
             </table>
          </div>
       </div>
    </div>
 </div>
 <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
          <div className="card">
             <div className="card-header">
                <div className="row align-items-center">
                   <div className="col-8">
                      <h3 className="mb-0">Vizualizar Compra</h3>
                   </div>
                  
                </div>
             </div>
             <div className="card-body">
                <form>
                   <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                   <div className="tablejobx">
                   <table className="table align-items-center" style={{textAlign: 'center'}}>
                   <tbody>
                             <tr>
                                <th>Iden</th>
                                <th>Status</th>
                                <th>Servico / Modo</th>
                                <th>Produto</th>
                             </tr>
                             <tr>
                                <td>#{cxt.final.o.order[0].id}</td>
                                {Status}
                                <td>{array.Servico.toUpperCase()} / {array.Modo.toUpperCase()}</td>
                                <td>{array.Fila.toUpperCase()} / <img src={"/lol/badges/"+leagueTools.eloImg(array.Temporada,array.Detalhes.divisao,'imagem')+".png"} style={{maxWidth: '30px'}}/>{array.Temporada.toUpperCase()} {array.Detalhes.divisao.toUpperCase()} / {array.Aulas} PARTIDAS</td>
                             </tr>
                             <tr>
                                <th>Booster</th>
                                <th>Valor</th>
                                <th>Rota</th>
                                <th>Solicitado</th>
                             </tr>
                             <tr>
                               <td>{Booster}</td>
                               <td>{cxt.final.o.order[0].valor}</td>
                               <td><img src={"/lol/routes/lane-"+array.Detalhes.rota+".png"} style={{maxWidth: '25px'}}/>  {array.Detalhes.rota.toUpperCase()}</td>
                               <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                             </tr>
                             <tr>
                               <th>Aprovacao</th>
                               <th>Finalizado</th>
                             </tr>
                             <tr>
                             <td>{
                                  cxt.final.o.order[0].date_aproved !== null ?  Assistant.time(cxt.final.o.order[0].date_aproved) : ''
                                 }
                              </td>
                               <td>-</td>
                             </tr>
                   </tbody>
                   </table>
                   </div>
                   <hr className="my-4" />
                   <h6 className="heading-small text-muted mb-4">Adicional</h6>
                   <div className="pl-lg-4">
                      <div className="form-group">
                         <label className="form-control-label">Horarios Disponiveis</label>
                         <textarea rows="4" className="form-control" placeholder="Horarios" defaultValue={array.Detalhes.horarios} disabled></textarea>
                      </div>
                   </div>

                   <div className="pl-lg-4">
                      <div className="form-group">
                         <label className="form-control-label">Dias Disponiveis  </label><span style={{fontSize: '15px', textAlign: 'left'}}>  segunda-feira, terca-feira e quarta-feira</span>
                      </div>
                   </div>

                </form>
             </div>
          </div>
       </div>
     </>)
     /**
      * O ELSE DE TODOS CONTENT
      */
  } else {
  
    return(<>
       <div className="col-xl-4 order-xl-2">
       <div className="card card-profile">
        <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
        <div className="row justify-content-center">
           <div className="col-lg-3 order-lg-2">
              <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
           </div>
        </div>
        <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          <div className="d-flex justify-content-between">
          {StatusBotao}
             <Link href={"/manage/customers/"+cxt.final.o.order[0].id+"/chat"}><a className="btn btn-sm btn-default float-right">Chat/Historico</a></Link>
             </div>
          
       </div>
        <div className="card-body pt-0">
           <div className="row">
              <div className="col">
                 <div className="card-profile-stats d-flex justify-content-center">
                    <div><span className="heading" style={{fontSize: '13px', maxWidth: '150px'}}>{array.Detalhes.invocador}</span><span className="description">Invocador</span></div>
                 </div>
              </div>
           </div>
           <div className="text-center">
              <h5 className="h3">Extra</h5>
              <table className="table align-items-end" style={{textAlign: 'left'}}>
              <tbody>
               {Moree.addServices(array)}
                    </tbody>
              </table>
           </div>
        </div>
     </div>
  </div>
  <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
           <div className="card">
              <div className="card-header">
                 <div className="row align-items-center">
                    <div className="col-8">
                       <h3 className="mb-0">Vizualizar Compra</h3>
                    </div>
                   
                 </div>
              </div>
              <div className="card-body">
                 <form>
                    <h6 className="heading-small text-muted mb-4">Dados da Compra</h6>
                    <div className="tablejobx">
                    <table className="table align-items-center" style={{textAlign: 'center'}}>
                    <tbody>
                              <tr>
                                 <th>Iden</th>
                                 <th>Status</th>
                                 <th>Servico / Modo</th>
                                 <th>Produto</th>
                              </tr>
                              <tr>
                                 <td>#{cxt.final.o.order[0].id}</td>
                                 {Status}
                                 <td>COACH / {array.Curso.toUpperCase()}</td>
                                 <td>{array.Aulas} DIAS DE AULA</td>
                              </tr>
                              <tr>
                                 <th>Booster</th>
                                 <th>Valor</th>
                                 <th>Rota</th>
                                 <th>Solicitado</th>
                              </tr>
                              <tr>
                                <td>{Booster}</td>
                                <td>{cxt.final.o.order[0].valor}</td>
                                <td><img src={"/lol/routes/lane-"+array.Detalhes.rota+".png"} style={{maxWidth: '25px'}}/>  {array.Detalhes.rota.toUpperCase()}</td>
                                <td>{Assistant.time(cxt.final.o.order[0].date)}</td>
                              </tr>
                              <tr>
                                <th>Aprovacao</th>
                                <th>Finalizado</th>
                              </tr>
                              <tr>
                              <td>{
                                  cxt.final.o.order[0].date_aproved !== null ?  Assistant.time(cxt.final.o.order[0].date_aproved) : ''
                                 }
                              </td>
                                <td>-</td>
                              </tr>
                    </tbody>
                    </table>
                    </div>
                    <hr className="my-4" />
                    <h6 className="heading-small text-muted mb-4">Adicional</h6>
                    <div className="pl-lg-4">
                       <div className="form-group">
                          <label className="form-control-label">Horarios Disponiveis</label>
                          <textarea rows="4" className="form-control" placeholder="Horarios" defaultValue={array.Detalhes.horarios} disabled></textarea>
                       </div>
                    </div>

                    <div className="pl-lg-4">
                       <div className="form-group">
                          <label className="form-control-label">Dias Disponiveis  </label><span style={{fontSize: '15px', textAlign: 'left'}}>{Assistant.Days(array.Detalhes.dias)}</span>
                       </div>
                    </div>

                 </form>
              </div>
           </div>
        </div>
      </>)

  }
 
  
}


 /**
    * @function contentChat
    * 
    * Chat da Order, referente ao ID Da compra #
    * @param {cxt} cxt 
    * @returns 
    */
contentChat(cxt) {
   //cxt.final.o.order[0] == dados da elo_invoices
   //cxt.final.o.order[1] == dados da conta
   const array = JSON.parse(cxt.final.o.order[0].data)
   const Booster = typeof cxt.final.bo.Final[0].usuario[0] === 'undefined' ? 'Ainda sem': cxt.final.bo.Final[0].usuario[0].user
   
   /**
    * Verificando se é um produto ELO BOOST!
    */
    if (array.AccountMethod) {
    const account = cxt.final.o.order[1]
      return(<>
        <div className="col-xl-4 order-xl-2">
      <div className="card card-profile">
         <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
         <div className="row justify-content-center">
            <div className="col-lg-3 order-lg-2">
               <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a>
               </div>
               <a href="#!" className="btn btn-sm btn-warning btn-block" style={{left: "3%",top: "80px"}} onClick={(e) => LoggedAuth.updateMatchs(cxt.final.o.order[0].id,cxt.final.c._AuthorizationJobx,0)}>Atualizar Partidas</a>
            </div>
         </div>
         <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div className="d-flex justify-content-between"><Link href={"/manage/customers/"+cxt.final.o.order[0].id}><a className="btn btn-sm btn-default float-right">Detalhes</a></Link></div>
         </div>
         <div className="card-body pt-0">
            <div className="row">
               <div className="col">
                  <div className="card-profile-stats d-flex justify-content-center">
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.invocador}</span><span className="description">Invocador</span></div>
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.conta}</span><span className="description">Conta</span></div>
                     <div><span className="heading" style={{fontSize: '13px', maxWidth: '100px'}}>{account.senha}</span><span className="description">Senha</span></div>
                  </div>
                  <div className="form-matchs">
                     <input type="number" className="form-control matchs" defaultValue="1" min="1" max="15"/>
                        <button type="button" className="btn btn-outline-success" onClick={(e) => LoggedAuth.updateMatchs(cxt.final.o.order[0].id,cxt.final.c._AuthorizationJobx,1)}>Atualizar</button>
                        </div>
               </div>
            </div>
            <div className="text-center">
               <h5 className="h3">Partidas</h5>
            </div>
            <div style={{margin: '0px -6% 0px -22px'}}>
            <iframe id="iframeHistorico" src={"/manage/customers/"+cxt.final.o.order[0].id+"/historic"} frameBorder="0" style={{border: 'none',height: '450px',width: '100%'}}></iframe>
            </div>
         </div>
      </div>
   </div>
        <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
            <div className="card">
               <div className="card-header">
                  <div className="row align-items-center">
                     <div className="col-8">
                        <h3 className="mb-0">Vizualizar Compra</h3>
                     </div>
                    
                  </div>
               </div>
               <div className="card-body">
                     <h6 className="heading-small text-muted mb-4">Chat</h6>
                     <form role="form">
                  <div className="pl-lg-4">
                        <div className="form-group">
                           <div className="col-md-13">
                              <div id="chat">
                                 <div id="mensagens">
                                    <ul>
                                      {Moree.loadMessages(cxt)}
                                    </ul>
                                 </div>
                                 <div className="form-group">
                                    <div className="col-md-13">
                                       <div className="input-group">
                                          <input type="text" name="mensagem" id="mensagem" className="form-control" placeholder="Digite aqui sua mensagem e pressione enter..." onKeyDown={(e) => Moree.KeyPressMensagem(e)}/>
                                          <span className="input-group-btn">
                                          <input type="hidden" id="compraid" value={cxt.final.o.order[0].id}/>
                                          <input type="hidden" id="autorizacao" value={cxt.final.c._AuthorizationJobx}/>
                                          <button type="button" onClick={Moree.sendMensagemMore} className="btn btn-primary">enviar</button>
                                          </span>
                                       </div>
                                    </div>
                                    <div className="dropdown-menu dropdown-menu-xl dropdown-menu-left py-0 overflow-hidden show" style={{left: '50px', marginTop: '0px', top: '92%'}}>
                                       <div className="px-3 py-3" id="previasmensagens" style={{display: "none"}}></div></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
       </>)
    }

    /**
     * MD10 AQUI
     */
   if (array.Servico === 'MD10') {
      const detail = JSON.parse(cxt.final.o.order[0].data)
      return(<>
         <div className="col-xl-4 order-xl-2">
       <div className="card card-profile">
          <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
          <div className="row justify-content-center">
             <div className="col-lg-3 order-lg-2">
                <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
             </div>
          </div>
          <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
             <div className="d-flex justify-content-between"><Link href={"/manage/customers/"+cxt.final.o.order[0].id}><a className="btn btn-sm btn-default float-right">Detalhes</a></Link></div>
          </div>
          <div className="card-body pt-0">
             <div className="row">
                <div className="col">
                   <div className="card-profile-stats d-flex justify-content-center">
                      <div><span className="heading" style={{fontSize: '15px', maxWidth: '100px'}}>{detail.Detalhes.invocador}</span><span className="description">Invocador</span></div>
                   </div>
                </div>
             </div>
             <div className="text-center">
                <h5 className="h3">Partidas</h5>
             </div>
             <div style={{margin: '0px -6% 0px -22px'}}>
             <iframe id="iframeHistorico" src={"/manage/customers/"+cxt.final.o.order[0].id+"/historic"} frameBorder="0" style={{border: 'none',height: '450px',width: '100%'}}></iframe>
             </div>
          </div>
       </div>
    </div>
         <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
             <div className="card">
                <div className="card-header">
                   <div className="row align-items-center">
                      <div className="col-8">
                         <h3 className="mb-0">Vizualizar Compra</h3>
                      </div>
                     
                   </div>
                </div>
                <div className="card-body">
                   
 
                      <h6 className="heading-small text-muted mb-4">Chat</h6>
                      <form role="form">
                   <div className="pl-lg-4">
                         <div className="form-group">
                            <div className="col-md-13">
                               <div id="chat">
                                  <div id="mensagens">
                                     <ul>
                                       {Moree.loadMessages(cxt)}
                                     </ul>
                                  </div>
                                  <div className="form-group">
                                     <div className="col-md-13">
                                        <div className="input-group">
                                           <input type="text" name="mensagem" id="mensagem" className="form-control" placeholder="Digite aqui sua mensagem e pressione enter..."/>
                                           <span className="input-group-btn">
                                           <input type="hidden" id="compraid" value={cxt.final.o.order[0].id}/>
                                           <input type="hidden" id="autorizacao" value={cxt.final.c._AuthorizationJobx}/>
                                           <button type="button" onClick={Moree.sendMensagemMore} className="btn btn-primary">enviar</button>
                                           </span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </form>
                </div>
             </div>
          </div>
        </>)
    }else{

      /**
       * O Ultimo Else
       * 
       */
       const detail = JSON.parse(cxt.final.o.order[0].data)
      return(<>
         <div className="col-xl-4 order-xl-2">
       <div className="card card-profile">
          <img src="/lol/profiles/banners/0.jpg" alt="Image placeholder" className="card-img-top"/>
          <div className="row justify-content-center">
             <div className="col-lg-3 order-lg-2">
                <div className="card-profile-image"><a href="#"><img src="/lol/profiles/avatar/exemple.png" className="rounded-circle"/></a></div>
             </div>
          </div>
          <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
             <div className="d-flex justify-content-between"><Link href={"/manage/customers/"+cxt.final.o.order[0].id}><a className="btn btn-sm btn-default float-right">Detalhes</a></Link></div>
          </div>
          <div className="card-body pt-0">
             <div className="row">
                <div className="col">
                   <div className="card-profile-stats d-flex justify-content-center">
                      <div><span className="heading" style={{fontSize: '15px', maxWidth: '100px'}}>{detail.Detalhes.invocador}</span><span className="description">Invocador</span></div>
                   </div>
                </div>
             </div>
             <div className="text-center">
                <h5 className="h3">Partidas</h5>
             </div>
             <div style={{margin: '0px -6% 0px -22px'}}>
           
             </div>
          </div>
       </div>
    </div>
         <div className="col-xl-8 order-xl-1" style={{paddingLeft: '0px',paddingRight: '0px'}}>
             <div className="card">
                <div className="card-header">
                   <div className="row align-items-center">
                      <div className="col-8">
                         <h3 className="mb-0">Vizualizar Compra</h3>
                      </div>
                     
                   </div>
                </div>
                <div className="card-body">
                   
 
                      <h6 className="heading-small text-muted mb-4">Chat</h6>
                      <form role="form">
                   <div className="pl-lg-4">
                         <div className="form-group">
                            <div className="col-md-13">
                               <div id="chat">
                                  <div id="mensagens">
                                     <ul>
                                       {Moree.loadMessages(cxt)}
                                     </ul>
                                  </div>
                                  <div className="form-group">
                                     <div className="col-md-13">
                                        <div className="input-group">
                                           <input type="text" name="mensagem" id="mensagem" className="form-control" placeholder="Digite aqui sua mensagem e pressione enter..."/>
                                           <span className="input-group-btn">
                                           <input type="hidden" id="compraid" value={cxt.final.o.order[0].id}/>
                                           <input type="hidden" id="autorizacao" value={cxt.final.c._AuthorizationJobx}/>
                                           <button type="button" onClick={Moree.sendMensagemMore} className="btn btn-primary">enviar</button>
                                           </span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </form>
                </div>
             </div>
          </div>
        </>)

    }
   
}

matchsHistoric(cxt) {
    if(typeof cxt.final.h === 'undefined'){
       return(<><span> Ainda não há historico </span></>)
    }
   var Matchs = []
   var Historico = cxt.final.h.historic
   if(Historico === null){
      return(<><span> Ainda não há historico </span></>)
   }

   Historico.sort(function (x, y) {
      var a = new Date(x.criacao) 
      var b = new Date(y.criacao)
      return b - a;
   });
   for(var Match of Historico){
      var Win = Match.result.win === false ? 'Lose' : 'Win'
      var Winner = Win === 'Win' ? 'Vitória' : 'Derrota'
      var Ward =   Win === 'Win' ? 'blue': 'red'
      var Duracao = Match.duracao.split(":")
      var KDa = (Match.result.kills + Match.result.assists) / Match.result.deaths

      Matchs.push(<div className="GameItemWrap" key={Assistant.generateKey(25)}>
      <div className={"GameItem "+Win+""} data-summoner-id="42902328" data-game-time="1620899827" data-game-id="2263065778" data-game-result="win">
         <div className="Content">
            <div className="GameStats">
               <div className="GameType" title={leagueTools.searchGameMode(Match.modo2).description}>
                  {leagueTools.searchGameMode(Match.modo2).description}
               </div>
               <div className="TimeStamp"><span className="_timeago _timeCountAssigned tip" data-datetime="1620899827" data-type="" data-interval="60" title={Match.criacao}>{Assistant.diferenceMatch(Match.criacao)}</span></div>
               <div className="Bar"></div>
               <div className="GameResult">
                  {Winner}								
               </div>
               <div className="GameLength">{Duracao[0]}m {Duracao[1]}s</div>
            </div>
            <div className="GameSettingInfo">
               <div className="ChampionImage">
                  <a  target="_blank"><img src={"http://ddragon.leagueoflegends.com/cdn/11.10.1/img/champion/"+Match.result.championName+".png"} className="Image" alt={Match.result.championName}/></a>
               </div>
               <div className="ChampionName">
                  <a  target="_blank">{Match.result.championName}</a>
               </div>
            </div>
            <div className="KDA">
               <div className="KDA">
                  <span className="Kill">{Match.result.kills}</span> /
                  <span className="Death">{Match.result.deaths}</span> /
                  <span className="Assist">{Match.result.assists}</span>
               </div>
               <div className="KDARatio">
                  <span className="KDARatio ">{String(KDa).length >= 4 ? String(KDa).substring(0, 4) : KDa}:{Math.round(Match.result.kills / Match.result.deaths)}</span> KDA				
               </div>
            </div>
            <div className="Stats">
               <div className="Level">
                  Nível{Match.result.champLevel}
               </div>
               <div className="CS">
                  <span className="CS tip">{(Match.result.totalMinionsKilled+Match.result.neutralMinionsKilled)} Minions</span>
               </div>
               <div className="CKRate tip" title="Contribuição em Abates">
                  {Match.result.lane}
               </div>
            </div>
            <div className="Items">
               <div className="ItemList">
               {Match.result.item0 !== 0 ?
                  <div className="Item">
                     <img src={"//opgg-static.akamaized.net/images/lol/item/"+Match.result.item0+".png?image=q_auto:best&amp;v=1620787344"} className="Image tip" alt="Muramana"/>
                  </div> : false
                  }
               {Match.result.item1 !== 0 ?
                  <div className="Item">
                     <img src={"//opgg-static.akamaized.net/images/lol/item/"+Match.result.item1+".png?image=q_auto:best&amp;v=1620787344"} className="Image tip" alt="Muramana"/>
                  </div> : false
                  }
               {Match.result.item2 !== 0 ?
                  <div className="Item">
                     <img src={"//opgg-static.akamaized.net/images/lol/item/"+Match.result.item2+".png?image=q_auto:best&amp;v=1620787344"} className="Image tip" alt="Muramana"/>
                  </div> : false
                  }
               {Match.result.item3 !== 0 ?
                  <div className="Item">
                     <img src={"//opgg-static.akamaized.net/images/lol/item/"+Match.result.item3+".png?image=q_auto:best&amp;v=1620787344"} className="Image tip" alt="Muramana"/>
                  </div> : false
                  }
               {Match.result.item4 !== 0 ?
                  <div className="Item">
                     <img src={"//opgg-static.akamaized.net/images/lol/item/"+Match.result.item4+".png?image=q_auto:best&amp;v=1620787344"} className="Image tip" alt="Muramana"/>
                  </div> : false
                  }
               {Match.result.item5 !== 0 ?
                  <div className="Item">
                     <img src={"//opgg-static.akamaized.net/images/lol/item/"+Match.result.item5+".png?image=q_auto:best&amp;v=1620787344"} className="Image tip" alt="Muramana"/>
                  </div> : false
                  }
               {Match.result.item6 !== 0 ?
                  <div className="Item">
                     <img src={"//opgg-static.akamaized.net/images/lol/item/"+Match.result.item6+".png?image=q_auto:best&amp;v=1620787344"} className="Image tip" alt="Muramana"/>
                  </div> : false
                  }
               </div>
               <div className="Trinket">
               <img src={"//opgg-static.akamaized.net/images/site/summoner/icon-ward-"+Ward+".png"}/>
               Control Ward <span className="wards vision">{Match.result.visionWardsBoughtInGame}</span>
               </div>
            </div>
            <div className="StatsButton">
            <div className="Content">
            <div className="Item">
            <a id="right_match" href="#" className="Button MatchDetail">
            <span className="__spSite __spSite-194 Off"></span>
            <span className="__spSite __spSite-193 On"></span>
            </a>
            </div>
            </div>
            </div>
         </div>
         <div className="GameDetail"></div>
      </div>
   </div>)
   } 
   return(<>{Matchs}</>)
}


}

class renderMore {

}
export {renderClient,renderMore}

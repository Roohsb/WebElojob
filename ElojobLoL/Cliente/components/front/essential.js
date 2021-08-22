import Head  from 'next/head'
import Link  from 'next/link'
import {More}  from './more/more'
import Class from './logged/class'
import React from 'react';

const Moree = new More();
const Logged = new Class();



class Essential extends React.Component {
  header = (title) => { return <Head><meta charSet="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4."/>
  <meta name="author" content="Creative Tim"/>
  <title>{title}</title>
  <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"/>
  <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css"/>
  <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css"/>
  <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css"/>
  </Head>
}

  navbarMenu = (page) => {
    return <nav className="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div className="scroll-wrapper scrollbar-inner" style={{position: 'relative'}}><div className="scrollbar-inner scroll-content scroll-scrolly_visible" style={{height: 'auto', MarginBottom: '0px', MarginRight: '0px', MaxHeight: '521px'}}> 
    <div className="sidenav-header align-items-center"> <a className="navbar-brand" href="javascript:void(0)"> <img src="/assets/img/brand/blue.png" className="navbar-brand-img" alt="..."/> </a> </div>
    <div className="navbar-inner">
       <div className="collapse navbar-collapse" id="sidenav-collapse-main">
          <ul className="navbar-nav">
             {Moree.navbarLiItem(page.page)}
             {page.cxt.final.a.Final[0].usuario[0].level > 2 ? Moree.navbarLiItemOther(page.page): ''}
          </ul>
          <hr className="my-5"/>
          <h6 className="navbar-heading p-0 text-muted"> <span className="docs-normal">Documentação</span> </h6>
          <ul className="navbar-nav mb-md-3">
             <li className="nav-item"> <a className="nav-link" href="/docs/welcome" target="_blank"> <i className="ni ni-spaceship"></i> <span className="nav-link-text">Sistema</span> </a> </li>
             <li className="nav-item"> <a className="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank"> <i className="ni ni-palette"></i> <span className="nav-link-text">Como Trabalhar?</span> </a> </li>
            
          </ul>
       </div>
    </div>
    </div>
    <div className="scroll-element scroll-x scroll-scrolly_visible">
       <div className="scroll-element_outer">
          <div className="scroll-element_size"></div>
          <div className="scroll-element_track"></div>
          <div className="scroll-bar" style={{width: '0px'}}>
       </div>
    </div>
    </div>
    <div className="scroll-element scroll-y scroll-scrolly_visible">
       <div className="scroll-element_outer">
          <div className="scroll-element_size"></div>
          <div className="scroll-element_track"></div>
          <div className="scroll-bar" style={{height: '365px', top: '0px'}}>
       </div>
    </div>
    </div></div>
 </nav>
}



  navbar = (obj) => {
   const Usuario = obj.final.a.Final[0].usuario[0]

 return <nav className="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div className="container-fluid">
       <div className="collapse navbar-collapse" id="navbarSupportedContent">
          <form className="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
             <div className="form-group mb-0">
                <div className="input-group input-group-alternative input-group-merge">
                   <div className="input-group-prepend"> <span className="input-group-text"><i className="fas fa-search"></i></span> </div>
                   <input className="form-control" placeholder="Search" type="text"/> 
                </div>
             </div>
             <button type="button" className="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close"> <span aria-hidden="true">×</span> </button> 
          </form>
          <ul className="navbar-nav align-items-center ml-md-auto ">
             <li className="nav-item d-xl-none">
                <div className="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin" data-target="#sidenav-main">
                   <div className="sidenav-toggler-inner"> <i className="sidenav-toggler-line"></i> <i className="sidenav-toggler-line"></i> <i className="sidenav-toggler-line"></i> </div>
                </div>
             </li>
             <li className="nav-item d-sm-none"> <a className="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main"> <i className="ni ni-zoom-split-in"></i> </a> </li>
             <li>
                <span className="mb-0 text-sm font-weight-bold cronometro" id="CronometroLogout" style={{color: "white"}}>00:00</span></li>
                <li>
                <a href="#!" onClick={(e) => Moree.CronLogout()}><i width="10px" className="ni ni-button-play" style={{color: "#11baef", marginTop: "6px"}}></i></a></li>
             <li className="nav-item dropdown">
                <a className="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="ni ni-bell-55"></i> </a> 
                <div className="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden">
                   <div className="px-3 py-3">
                      <h6 className="text-sm text-muted m-0">Voce tem <strong className="text-primary">0</strong> Notificacoes.</h6>
                   </div>
                   <div className="list-group list-group-flush">
                      <a href="#!" className="list-group-item list-group-item-action">
                         <div className="row align-items-center">
                            <div className="col-auto"> <img alt="Image placeholder" src="http://www.prtidigital.com.br/wp-content/uploads/2021/06/artificial-intelligence-ai-robot-server-room-digital-technology-banner-computer-equipment_39422-768-530x400.jpg" className="avatar rounded-circle"/> </div>
                            <div className="col ml--2">
                               <div className="d-flex justify-content-between align-items-center">
                                  <div>
                                     <h4 className="mb-0 text-sm">Boot</h4>
                                  </div>
                                  <div className="text-right text-muted"> <small>23/06/2021</small> </div>
                               </div>
                               <p className="text-sm mb-0">Este sistema ainda não foi feito.</p>
                            </div>
                         </div>
                      </a>
                   </div>
                   <a href="#!" className="dropdown-item text-center text-primary font-weight-bold py-3">Ver Todos</a> 
                </div>
             </li>
           
          </ul>
          <ul className="navbar-nav align-items-center ml-auto ml-md-0 ">
             <li className="nav-item dropdown">
                <a className="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <div className="media align-items-center">
                      <span className="avatar avatar-sm rounded-circle"> <img alt="Image placeholder" src={"/lol/profiles/avatar/"+obj.final.a.Final[1].estilo.avatar[0].img}/> </span> 
                      <div className="media-body ml-2 d-none d-lg-block"> <span className="mb-0 text-sm font-weight-bold">{Usuario.nome}</span> </div>
                   </div>
                </a>
                <div className="dropdown-menu dropdown-menu-right ">
                   <div className="dropdown-header noti-title">
                      <h6 className="text-overflow m-0">Ola novamente!</h6>
                   </div>
                   <Link href="/profile"><a className="dropdown-item">  <i className="ni ni-single-02"></i> <span>Meu Perfil</span></a></Link>
                   
                 
                   <div className="dropdown-divider"></div>
                   <a onClick={Logged.logout} href="#!" className="dropdown-item"> <i className="ni ni-user-run"></i> <span>Sair</span> </a> 
                </div>
             </li>
          </ul>
       </div>
    </div>
 </nav>

}

}


class EssentialAuth{
  header = () => {
    return <Head><meta charSet="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4."/>
    <meta name="author" content="Creative Tim"/>
    <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
    <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"/>
    <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css"/>
    <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css"/></Head>
}

}



///class NavBar extends React.Component{
//  render(){
//    return <nav className="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom"> <div className="container-fluid"> <div className="collapse navbar-collapse" id="navbarSupportedContent"> <form className="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main"> <div className="form-group mb-0"> <div className="input-group input-group-alternative input-group-merge"> <div className="input-group-prepend"> <span className="input-group-text"><i className="fas fa-search"></i></span> </div><input className="form-control" placeholder="Search" type="text"/> </div></div><button type="button" className="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close"> <span aria-hidden="true">×</span> </button> </form> <ul className="navbar-nav align-items-center ml-md-auto "> <li className="nav-item d-xl-none"> <div className="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main"> <div className="sidenav-toggler-inner"> <i className="sidenav-toggler-line"></i> <i className="sidenav-toggler-line"></i> <i className="sidenav-toggler-line"></i> </div></div></li><li className="nav-item d-sm-none"> <a className="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main"> <i className="ni ni-zoom-split-in"></i> </a> </li><li className="nav-item dropdown"> <a className="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="ni ni-bell-55"></i> </a> <div className="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden"> <div className="px-3 py-3"> <h6 className="text-sm text-muted m-0">You have <strong className="text-primary">13</strong> notifications.</h6> </div><div className="list-group list-group-flush"> <a href="#!" className="list-group-item list-group-item-action"> <div className="row align-items-center"> <div className="col-auto"> <img alt="Image placeholder" src="/assets/img/theme/team-1.jpg" className="avatar rounded-circle"/> </div><div className="col ml--2"> <div className="d-flex justify-content-between align-items-center"> <div> <h4 className="mb-0 text-sm">John Snow</h4> </div><div className="text-right text-muted"> <small>2 hrs ago</small> </div></div><p className="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p></div></div></a> <a href="#!" className="list-group-item list-group-item-action"> <div className="row align-items-center"> <div className="col-auto"> <img alt="Image placeholder" src="/assets/img/theme/team-2.jpg" className="avatar rounded-circle"/> </div><div className="col ml--2"> <div className="d-flex justify-content-between align-items-center"> <div> <h4 className="mb-0 text-sm">John Snow</h4> </div><div className="text-right text-muted"> <small>3 hrs ago</small> </div></div><p className="text-sm mb-0">A new issue has been reported for Argon.</p></div></div></a> <a href="#!" className="list-group-item list-group-item-action"> <div className="row align-items-center"> <div className="col-auto"> <img alt="Image placeholder" src="/assets/img/theme/team-3.jpg" className="avatar rounded-circle"/> </div><div className="col ml--2"> <div className="d-flex justify-content-between align-items-center"> <div> <h4 className="mb-0 text-sm">John Snow</h4> </div><div className="text-right text-muted"> <small>5 hrs ago</small> </div></div><p className="text-sm mb-0">Your posts have been liked a lot.</p></div></div></a> <a href="#!" className="list-group-item list-group-item-action"> <div className="row align-items-center"> <div className="col-auto"> <img alt="Image placeholder" src="/assets/img/theme/team-4.jpg" className="avatar rounded-circle"/> </div><div className="col ml--2"> <div className="d-flex justify-content-between align-items-center"> <div> <h4 className="mb-0 text-sm">John Snow</h4> </div><div className="text-right text-muted"> <small>2 hrs ago</small> </div></div><p className="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p></div></div></a> <a href="#!" className="list-group-item list-group-item-action"> <div className="row align-items-center"> <div className="col-auto"> <img alt="Image placeholder" src="/assets/img/theme/team-5.jpg" className="avatar rounded-circle"/> </div><div className="col ml--2"> <div className="d-flex justify-content-between align-items-center"> <div> <h4 className="mb-0 text-sm">John Snow</h4> </div><div className="text-right text-muted"> <small>3 hrs ago</small> </div></div><p className="text-sm mb-0">A new issue has been reported for Argon.</p></div></div></a> </div><a href="#!" className="dropdown-item text-center text-primary font-weight-bold py-3">View all</a> </div></li><li className="nav-item dropdown"> <a className="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i className="ni ni-ungroup"></i> </a> <div className="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right "> <div className="row shortcuts px-4"> <a href="#!" className="col-4 shortcut-item"> <span className="shortcut-media avatar rounded-circle bg-gradient-red"> <i className="ni ni-calendar-grid-58"></i> </span> <small>Calendar</small> </a> <a href="#!" className="col-4 shortcut-item"> <span className="shortcut-media avatar rounded-circle bg-gradient-orange"> <i className="ni ni-email-83"></i> </span> <small>Email</small> </a> <a href="#!" className="col-4 shortcut-item"> <span className="shortcut-media avatar rounded-circle bg-gradient-info"> <i className="ni ni-credit-card"></i> </span> <small>Payments</small> </a> <a href="#!" className="col-4 shortcut-item"> <span className="shortcut-media avatar rounded-circle bg-gradient-green"> <i className="ni ni-books"></i> </span> <small>Reports</small> </a> <a href="#!" className="col-4 shortcut-item"> <span className="shortcut-media avatar rounded-circle bg-gradient-purple"> <i className="ni ni-pin-3"></i> </span> <small>Maps</small> </a> <a href="#!" className="col-4 shortcut-item"> <span className="shortcut-media avatar rounded-circle bg-gradient-yellow"> <i className="ni ni-basket"></i> </span> <small>Shop</small> </a> </div></div></li></ul> <ul className="navbar-nav align-items-center ml-auto ml-md-0 "> <li className="nav-item dropdown"> <a className="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <div className="media align-items-center"> <span className="avatar avatar-sm rounded-circle"> <img alt="Image placeholder" src="/assets/img/theme/team-4.jpg"/> </span> <div className="media-body ml-2 d-none d-lg-block"> <span className="mb-0 text-sm font-weight-bold">John Snow</span> </div></div></a> <div className="dropdown-menu dropdown-menu-right "> <div className="dropdown-header noti-title"> <h6 className="text-overflow m-0">Welcome!</h6> </div><a href="#!" className="dropdown-item"> <i className="ni ni-single-02"></i> <span>My profile</span> </a> <a href="#!" className="dropdown-item"> <i className="ni ni-settings-gear-65"></i> <span>Settings</span> </a> <a href="#!" className="dropdown-item"> <i className="ni ni-calendar-grid-58"></i> <span>Activity</span> </a> <a href="#!" className="dropdown-item"> <i className="ni ni-support-16"></i> <span>Support</span> </a> <div className="dropdown-divider"></div><a href="#!" className="dropdown-item"> <i className="ni ni-user-run"></i> <span>Logout</span> </a> </div></li></ul> </div></div></nav>

module.exports = {
  Essential : Essential,
  EssentialAuth: EssentialAuth
}
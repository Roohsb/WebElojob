import Devoloper from '../components/front/essential'
import Logged    from '../components/front/logged/class'
import {More}      from '../components/front/more/more'
import nookies   from 'nookies'
const Essential2 = new Devoloper.Essential();
const LoggedAuth = new Logged()

const Moree = new More();




export async function getServerSideProps(ctx) {
  
   const cookies = nookies.get(ctx) 

  /**
   * Verificando o BoxAlert
   * 
   */
  var boxAlert = true;
  if(!cookies._AlertBox)
  {
    boxAlert = false
  }

  /**
   * Verificando Token de autorização
   */
  if(!cookies._AuthorizationJobx || LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx) === 0)
  {
    ctx.res.writeHead(302, { Location: '/auth/acess' });
    ctx.res.end();
    return {
      props: {
        cookies,
      },
   }
  }
  
  const userDetails = await LoggedAuth.Details(
   cookies._AuthorizationJobx,
   LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx).userID,['style','jobs'])

   

 const final = {
   c: cookies, 
   b: boxAlert, 
   a: userDetails
   }

 return {
   props: {
     final,
   },
 }
  
}


export default function Profile(cxt)
{ 
    return (
    <>
      {Essential2.header("Teste")}
      {Essential2.navbarMenu({page: "profile",cxt})}
      <div className="main-content" id="panel">
      {Essential2.navbar(cxt)}
      <div className="header pb-6 d-flex align-items-center" style={{minHeight: '500px',backgroundImage: "url(/lol/profiles/banners/"+cxt.final.a.Final[1].estilo.banner[0].img+")", backgroundSize: 'cover', backgroundPosition: 'center top'}}>
<span className="mask bg-gradient-default opacity-8"></span>
<div className="container-fluid d-flex align-items-center">
   <div className="row">
      <div className="col-lg-7 col-md-10">
         <h1 className="display-2 text-white">Olá {cxt.final.a.Final[0].usuario[0].nome}</h1>
         <p className="text-white mt-0 mb-5">Este aqui é seu perfil, edite seus dados ou apenas confira.</p>
         <span className="text-white mt-0 mb-5">Confira seu perfil publico </span><a href="http://localhost/user/centro" className="btn btn-neutral">Aqui</a>
      </div>
   </div>
</div>
</div>
<div className="container-fluid mt--6">
   <div className="row">
      <div className="col-xl-4 order-xl-2">
         <div className="card card-profile">
            <img src={"/lol/profiles/banners/"+cxt.final.a.Final[1].estilo.banner[0].img} alt="Image placeholder" className="card-img-top"/>
            <div className="row justify-content-center">
               <div className="col-lg-3 order-lg-2">
                  <div className="card-profile-image">
                     <a href="#">
                     <img src={"/lol/profiles/avatar/"+cxt.final.a.Final[1].estilo.avatar[0].img} className="rounded-circle"/>
                     </a>
                  </div>
               </div>
            </div>
            <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
               <div className="d-flex justify-content-between">
                  <a href="http://localhost/user/centro" target="_blank" className="btn btn-sm btn-info  mr-4 ">Mudar Estilo</a>
               </div>
            </div>
            <div className="card-body pt-0">
               <div className="row">
                  <div className="col">
                     <div className="card-profile-stats d-flex justify-content-center">
                        <div>
                           <span className="heading">{cxt.final.a.Final[0].usuario[0].likes}</span>
                           <span className="description">Curtidas</span>
                        </div>
                        <div>
                           <span className="heading">{cxt.final.a.Final[2].jobs.length}</span>
                           <span className="description">Trabalhos</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div className="text-center">
                  <h5 className="h3">
                     {cxt.final.a.Final[0].usuario[0].nome}
                  </h5>
                 
               </div>
            </div>
         </div>
      </div>
      <div className="col-xl-8 order-xl-1">
         <div className="card">
            <div className="card-header">
               <div className="row align-items-center">
                  <div className="col-8">
                     <h3 className="mb-0">Editar Perfil</h3>
                  </div>
               </div>
            </div>
            <div className="card-body">
               <form>
                  <h6 className="heading-small text-muted mb-4">Informação</h6>
                  <div className="pl-lg-4">
                     <div className="row">
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-username">Usuario</label>
                              <input type="text" id="input-username" className="form-control" placeholder="Username" defaultValue={cxt.final.a.Final[0].usuario[0].user} disabled/>
                           </div>
                        </div>
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-email-edit">Email</label>
                              <input type="email" id="input-email-edit" className="form-control" placeholder="jesse@example.com" defaultValue={cxt.final.a.Final[0].usuario[0].email}/>
                           </div>
                        </div>
                     </div>
                     <div className="row">
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-name-edit">Nome</label>
                              <input type="text" id="input-name-edit" className="form-control" placeholder="First name" defaultValue={cxt.final.a.Final[0].usuario[0].nome}/>
                           </div>
                        </div>
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-celular-edit">Celular</label>
                              <input type="text" id="input-celular-edit" className="form-control" placeholder="Last name" defaultValue={cxt.final.a.Final[0].usuario[0].celular}/>
                           </div>
                        </div>
                        <div className="col-lg-6">
                           <div className="form-group">
                              <label className="form-control-label" htmlFor="input-senha-edit">Senha</label>
                              <input type="text" id="input-senha-edit" className="form-control" placeholder="DIGITE ALGO AQUI CASO QUEIRA MUDAR"/>
                           </div>
                        </div>
                     </div>
                  </div>
                  <button type="button" className="btn btn-primary btn-lg btn-block" onClick={(e) => LoggedAuth.EditProfile(cxt.final.c._AuthorizationJobx,cxt.final.a.Final[0].usuario[0])}>Salvar Alterações</button>

               </form>
            </div>
         </div>
      </div>
   </div>
   
   <div className="alert alert-success new" role="alert">
      <strong>Pronto!</strong> Se você alterou algo, nos fizemos acontecer!
      </div>

      <div className="alert alert-danger new" role="alert">
      <strong>Opa!</strong> Algo deu incrivelmente errado, contate um administrador!
      </div>

   <footer className="footer pt-0">
      <div className="row align-items-center justify-content-lg-between">
         <div className="col-lg-6">
            <div className="copyright text-center  text-lg-left  text-muted">
               &copy; 2020 <a href="https://www.creative-tim.com" className="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
         </div>
         <div className="col-lg-6">
            <ul className="nav nav-footer justify-content-center justify-content-lg-end">
               <li className="nav-item">
                  <a href="https://www.creative-tim.com" className="nav-link" target="_blank">Creative Tim</a>
               </li>
               <li className="nav-item">
                  <a href="https://www.creative-tim.com/presentation" className="nav-link" target="_blank">About Us</a>
               </li>
               <li className="nav-item">
                  <a href="http://blog.creative-tim.com" className="nav-link" target="_blank">Blog</a>
               </li>
               <li className="nav-item">
                  <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" className="nav-link" target="_blank">MIT License</a>
               </li>
            </ul>
         </div>
      </div>
   </footer>
</div>
</div>
<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
      </>)
  }
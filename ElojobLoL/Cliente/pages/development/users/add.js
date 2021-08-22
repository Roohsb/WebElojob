import Devoloper from '../../../components/front/essential'
import Logged    from '../../../components/front/logged/class'
import LoggedM   from '../../../components/front-master/logged/@class'
import {More}      from '../../../components/front/more/more'
import {renderClient} from '../../../components/front-master/render/@users'
import nookies   from 'nookies'


const Essential2 = new Devoloper.Essential()

const RenderCli = new renderClient()

const LoggedAuth = new Logged()

const LoggedAuthM = new LoggedM()

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
    LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx).userID,['style'])

  if(userDetails.Final[0].usuario[0].level < 3)
  {
    ctx.res.writeHead(302, { Location: '/' });
    ctx.res.end();
    return {
      props: {
        cookies,
      },
  }
  }

  const final = {
    c: cookies, 
    b: boxAlert, 
    a: userDetails,
    d: await LoggedAuthM.usersLista(cookies._AuthorizationJobx)
    }

  return {
    props: {
      final,
    },
  }
  
}


export default function Adicionar(cxt){

      return (
      <>
        {Essential2.header("Teste")}
        {Essential2.navbarMenu({page: "profile",cxt})}
        <div className="main-content" id="panel">
        {Essential2.navbar(cxt)}
        <div className="header pb-6 d-flex align-items-center">
  </div>
  <div className="container-fluid mt--6">
     <div className="row">
        <div className="col-xl-4 order-xl-2">
           <div className="card card-profile">
              <img src={"/lol/profiles/banners/0.jpg"} alt="Image placeholder" className="card-img-top"/>
              <div className="row justify-content-center">
                 <div className="col-lg-3 order-lg-2">
                    <div className="card-profile-image">
                       <a href="#">
                       <img src={"/lol/profiles/avatar/0.png"} className="rounded-circle"/>
                       </a>
                    </div>
                 </div>
              </div>
              <div className="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                
              </div>
              <div className="card-body pt-0">
                 <div className="row">
                    <div className="col">
                       <div className="card-profile-stats d-flex justify-content-center">
                          <div>
                             <span className="heading">0</span>
                             <span className="description">Curtidas</span>
                          </div>
                          <div>
                             <span className="heading n">0</span>
                             <span className="description">Nivel</span>
                          </div>
                          <div>
                             <span className="heading">0</span>
                             <span className="description">Comments</span>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div className="text-center">
                    <h5 className="h3 user">
                       USUARIO
                    </h5>
                    <div className="h5 font-weight-300">
                       <i className="ni location_pin mr-2"></i><span className="Nivel">Nivel</span>
                    </div>
                 </div>
              </div>
           </div>
        </div>
        <div className="col-xl-8 order-xl-1">
           <div className="card">
              <div className="card-header">
                 <div className="row align-items-center">
                    <div className="col-8">
                       <h3 className="mb-0">Criar Conta</h3>
                    </div>
                    <div className="col-4 text-right">
                       <a href="#!" className="btn btn-sm btn-primary">Voltar</a>
                    </div>
                 </div>
              </div>
              <div className="card-body">
                 <form>
                    <h6 className="heading-small text-muted mb-4">INFORMAÇÃO</h6>
                    <div className="pl-lg-4">
                       <div className="row">
                          <div className="col-lg-6">
                             <div className="form-group">
                                <label className="form-control-label" htmlFor="input-username">Usuario</label>
                                <input type="text" id="input-username-new" className="form-control" placeholder="Usuario"/>
                             </div>
                          </div>
                          <div className="col-lg-6">
                             <div className="form-group">
                                <label className="form-control-label" htmlFor="input-email">Email</label>
                                <input type="email" id="input-email-new" className="form-control" placeholder="usuario@example.com"/>
                             </div>
                          </div>
                       </div>
                       <div className="row">
                          <div className="col-lg-6">
                             <div className="form-group">
                                <label className="form-control-label" htmlFor="input-first-name">Nome</label>
                                <input type="text" id="input-name-new" className="form-control" placeholder="Nome"/>
                             </div>
                          </div>
                          <div className="col-lg-6">
                             <div className="form-group">
                                <label className="form-control-label" htmlFor="input-last-name">Celular</label>
                                <input type="text" id="input-celular-new" className="form-control" placeholder="Celular"/>
                             </div>
                          </div>
                          <div className="col-lg-6">
                            <div className="form-group">
                              <label className="form-control-label" for="nivellabel">Nivel</label>
                              <select className="form-control" name="nivel" id="nivellabel" onClick={(e) => RenderCli.teste(e)}>
                                <option value="0">Cliente</option>
                                <option value="2">Booster</option>
                                <option value="3">Master</option></select>
                                </div>
                            </div>
                            <div className="col-lg-6">
                             <div className="form-group">
                                <label className="form-control-label" htmlFor="input-last-name">Senha</label>
                                <input type="text" id="input-senha-new" className="form-control" placeholder="Senha"/>
                             </div>
                          </div>
                          <div style={{marginLeft: '36%',marginRight: '36%'}}>
                     <button type="button" className="btn btn-primary" onClick={(e) => LoggedAuthM.newUser(cxt.final.c._AuthorizationJobx)}>Cria Conta</button>
                     </div>
                       </div>
                    </div>
                 </form>
              </div>
           </div>
        </div>
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
  <script
            dangerouslySetInnerHTML={{
              __html: `
              $('#input-username-new').keyup(function (evt) {
               $("h5.h3.user").text($("#input-username-new").val())
              });
                  `,
            }}
          ></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
        </>)
}

import Devoloper from '../../../../components/front/essential'
import Logged    from '../../../../components/front/logged/class'
import LoggedM   from '../../../../components/front-master/logged/@class'
import {More}      from '../../../../components/front/more/more'
import {renderClient} from '../../../../components/front-master/render/@users'
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

  const url = typeof ctx.req.url.split("/")[4] !== 'undefined' ? ctx.req.url.split("/")[4]: ctx.req.__NEXT_INIT_QUERY.user;

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

  const userSearchDetail = await LoggedAuthM.userDetail(url,cookies._AuthorizationJobx)

  const availableStyles = await LoggedAuthM.AvaiStyl(cookies._AuthorizationJobx,userSearchDetail.userResult[0].user)

  if(userSearchDetail.server === false || userSearchDetail.userResult.length === 0)  {
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
    d: userSearchDetail,
    s: availableStyles
    }

  return {
    props: {
      final,
    },
  }
  
}


export default function Editar(cxt){
  return (
    <>
      {Essential2.header("Teste")}
      {Essential2.navbarMenu({page: "development",cxt})}
      <div className="main-content" id="panel">
      {Essential2.navbar(cxt)}
      <div className="header pb-6 d-flex align-items-center">
      </div>
   <div className="container-fluid mt--6">  
   <div className="row">
   {RenderCli.userserachdetail(cxt.final.d.userResult,cxt.final.d.userAccounts,cxt.final.s,cxt.final.c)}
   </div>

      <div className="alert alert-success new" role="alert">
      <strong>Pronto!</strong> Se você alterou algo, nos fizemos acontecer!
      </div>

      <div className="alert alert-danger new" role="alert">
      <strong>Opa!</strong> Algo deu incrivelmente errado, contate um administrador!
      </div>


      <div className="modal fade" id="modal-account-delete" tabIndex="-1" role="dialog" aria-labelledby="modal-account-delete" aria-hidden="true">
        <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div className="modal-content">
        	
            <div className="modal-header">
                <h6 className="modal-title" id="modal-title-default">Aviso</h6>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div className="modal-body">
               Você deseja realmente apagar a conta <strong id="data-account-delete-id">CONTA USUARIO</strong> ?  <p></p><p style={{fontSize: '16px'}}> <strong className="text-default">Lembrete: </strong> Não é possivel apagar contas que estão vinculadas a um pedido</p>
            </div>
            <div className="modal-footer">
                <button type="button" className="btn btn-primary" onClick={(e) => RenderCli.deleteAccount(cxt.final.c._AuthorizationJobx,cxt.final.d.userResult[0].user)}>Sim</button>
                <button type="button" className="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

      <div className="modal fade" id="modal-user-delete" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div className="modal-content">
        	
            <div className="modal-header">
                <h6 className="modal-title" id="modal-title-default">Aviso</h6>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div className="modal-body">
            	
                <p>Você deseja realmente apagar os dados de <strong id="user-delete-id">{cxt.final.d.userResult[0].user}</strong></p>
                <p>Ao continuar, você deve estar ciente que, <strong style={{color: 'red', fontSize: '13px'}}>NÃO SERA POSSÍVEL REVERTER ESTÁ AÇÃO</strong></p><p>Todos os dados do usuário serão apagados, como se nunca houvesse existido.</p>
            </div>
            <div className="modal-footer">
                <button onClick={(e) => LoggedAuthM.deleteUserOther(cxt.final.c._AuthorizationJobx)} type="button"  className="btn btn-primary">Continuar</button>
                <button type="button" className="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

      <div className="modal fade" id="modal-profile-pictures" tabIndex="-1" role="dialog"       aria-labelledby="modal-profile-pictures" aria-hidden="true">
              <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
              <div className="modal-content">

                  <div className="modal-header">
                      <h6 className="modal-title" id="modal-title-default">Pictures</h6>
                      <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div className="modal-body">
                  <div className="avatar-group">
                           {RenderCli.usersearchprofilepictures(cxt.final.s)}
                          </div>
                  </div>
                  <div className="modal-footer">
                      <button type="button" className="btn btn-primary" onClick={(e) => RenderCli.savePic(cxt.final.c,cxt.final.d)}>Salvar</button>
                      <button type="button" className="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
                  </div>
              </div>
          </div>
      </div>

      <div className="modal fade" id="modal-profile-banners" tabIndex="-1" role="dialog"       aria-labelledby="modal-profile-banners" aria-hidden="true">
              <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
              <div className="modal-content">

                  <div className="modal-header">
                      <h6 className="modal-title" id="modal-title-default">Banners</h6>
                      <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div className="modal-body">
                  <div className="avatar-group">
                           {RenderCli.usersearchprofilebanners(cxt.final.s)}
                          </div>
                  </div>
                  <div className="modal-footer">
                      <button type="button" className="btn btn-primary" onClick={(e) => RenderCli.saveBan(cxt.final.c,cxt.final.d)}>Salvar</button>
                      <button type="button" className="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
                  </div>
              </div>
          </div>
      </div>

<div className="modal fade" id="modal-account-edit" tabIndex="-1" role="dialog" aria-labelledby="modal-account-edit" aria-hidden="true">
   <div className="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
      <div className="modal-content">
         <div className="modal-body p-0">
            <div className="card bg-secondary border-0 mb-0">
               <div className="card-body px-lg-5 py-lg-5">
                  <div className="text-center text-muted mb-4">
                     <small>Detalhes <strong id="data-account-edite-id">USUARIO</strong></small>
                  </div>
                  <form role="form">
                     <div className="form-group mb-3" title="Conta">
                        <div className="input-group input-group-merge input-group-alternative">
                           <div className="input-group-prepend">
                              <span className="input-group-text"><i className="ni ni-circle-08"></i></span>
                           </div>
                           <input className="form-control account" placeholder="Conta" type="text"/>
                        </div>
                     </div>
                     <div className="form-group mb-3" title="Senha">
                        <div className="input-group input-group-merge input-group-alternative">
                           <div className="input-group-prepend">
                              <span className="input-group-text"><i className="ni ni-lock-circle-open"></i></span>
                           </div>
                           <input className="form-control password" placeholder="Senha" type="text"/>
                        </div>
                     </div>
                     <div className="form-group" title="Invocador">
                        <div className="input-group input-group-merge input-group-alternative">
                           <div className="input-group-prepend">
                              <span className="input-group-text"><i className="ni ni-controller"></i></span>
                           </div>
                           <input className="form-control invocador" placeholder="Invocador" type="text"/>
                        </div>
                     </div>
                     
                    
                     <div className="text-center">
                        <button type="button" className="btn btn-primary my-4" onClick={() => RenderCli.editeAccount(cxt.final.c._AuthorizationJobx,cxt.final.d.userResult[0].user)}>Salvar Alterações</button>
                     </div>
                  </form>
               </div>
            </div>
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
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
      </>)
}
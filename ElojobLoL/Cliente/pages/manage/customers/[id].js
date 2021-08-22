import Devoloper from '../../../components/front/essential'
import Logged    from '../../../components/front/logged/class'
import {renderClient} from '../../../components/front/render/@clients'
import nookies   from 'nookies'


const Essential2 = new Devoloper.Essential()

const RenderCli = new renderClient()

const LoggedAuth = new Logged()



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

  const url = isNaN(ctx.req.url.split("/")[3]) === false ? ctx.req.url.split("/")[3]: ctx.req.__NEXT_INIT_QUERY.id;
  const orderDetail = await LoggedAuth.MyClient(cookies._AuthorizationJobx,LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx).userID2,parseInt(url))
  

  if(orderDetail.status === false || 
     orderDetail.order.length === 0)
  {
    ctx.res.writeHead(302, { Location: '/manage/customers/my' });
    ctx.res.end();
    return {
      props: {
        url,
      },
    }
  }

  
   const userDetails = await LoggedAuth.Details(
    cookies._AuthorizationJobx,
    LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx).userID,['style'])

   const Booster = orderDetail.order[0].booster !== 'undefined' ? parseInt(orderDetail.order[0].booster): false
   var boosterWork;

   if(Booster){
   boosterWork = await LoggedAuth.boosterJob(
      cookies._AuthorizationJobx,orderDetail.order[0].booster,[null])
   }

  const final = {
    c: cookies, 
    b: boxAlert, 
    a: userDetails,
    o: orderDetail,
    bo:  boosterWork // usuario => boosterWork.Final[0].usuario[0]
    }

  return {
    props: {
      final,
    },
  }
   
 }


export default function OrderView(cxt)
{
    return (
    <>
      {Essential2.header("Teste")}
{Essential2.navbarMenu({page: "clients",cxt})}
<div className="main-content" id="panel">
   {Essential2.navbar(cxt)}
   <div className="header pb-6 d-flex align-items-center">
   </div>
   <div className="container-fluid mt--6">
      <div className="row">
         {RenderCli.contentOrder(cxt)}
      </div>
      <div className="modal fade" id="modal-finish-job" tabIndex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
         <div className="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div className="modal-content bg-gradient-danger">
               <div className="modal-header">
                  <h6 className="modal-title" id="modal-title-notification">Opa!</h6>
                  <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div className="modal-body">
                  <div className="py-3 text-center">
                     <i className="ni ni-bell-55 ni-3x"></i>
                     <h4 className="heading mt-4">Finalizacao de Pedido!</h4>
                     <p>Você está preste a confimar que o pedido foi finalizado, deseja realmente continuar?.</p>
                  </div>
               </div>
               <div className="modal-footer">
                  <button type="button" className="btn btn-white" onClick={(e) => LoggedAuth.FinishJob(cxt.final.o.order[0].id,cxt.final.c._AuthorizationJobx)}>Sim, está feito!</button>
                  <button type="button" className="btn btn-link text-white ml-auto" data-dismiss="modal">Não, vou terminar</button>
               </div>
            </div>
         </div>
      </div>

      {cxt.final.o.order[1].playing === "0" ? 
      <div className="modal fade" id="modal-start" tabIndex="-1" role="dialog" aria-labelledby="modal-start" aria-hidden="true">
    <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div className="modal-content">
            <div className="modal-header">
                <h6 className="modal-title" id="modal-title-default">Aviso</h6>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div className="modal-body">
            	
                <span className="heading mt-4">Você quer mesmo começar o trabalho?</span><br/><span>Ao apertar em <strong>continuar</strong>, o status da conta do usuario sera trocado para <strong>"Booster Trabalhando"</strong>, após terminar o trabalho lembre-se de trocar o status.</span>
                
            </div>
            <div className="modal-footer">
                <button type="button" className="btn btn-primary" onClick={(e) => LoggedAuth.StartJob(cxt.final.o.order[1].id,cxt.final.c._AuthorizationJobx)}>Continuar</button>
                <button type="button" className="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>: ''}

{cxt.final.o.order[1].playing === "2" ?  <div className="modal fade" id="modal-cansei" tabIndex="-1" role="dialog" aria-labelledby="modal-cansei" aria-hidden="true">
    <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div className="modal-content">
            <div className="modal-header">
                <h6 className="modal-title" id="modal-title-default">Aviso</h6>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div className="modal-body">
            	
                <span className="heading mt-4">Você quer mesmo parar o trabalho por hoje?</span><br/><span>Ao apertar em <strong>continuar</strong>, o status da conta do usuario sera trocado para <strong>"Conta livre"</strong>, com esse status o cliente saberá que poderar entrar na conta.</span>
                
            </div>
            <div className="modal-footer">
                <button type="button" className="btn btn-primary" onClick={(e) => LoggedAuth.StopJob(cxt.final.o.order[1].id,cxt.final.c._AuthorizationJobx)}>Continuar</button>
                <button type="button" className="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>: ''
}

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
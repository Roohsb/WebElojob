import Devoloper from '../../../../components/front/essential'
import Logged    from '../../../../components/front/logged/class'
import LoggedM from '../../../../components/front-master/logged/@class'
import {renderClient} from '../../../../components/front/render/@clients'
import nookies   from 'nookies'



const Essential2 = new Devoloper.Essential()

const RenderCli = new renderClient()

const LoggedAuth = new Logged()

const LoggedAuthM = new LoggedM()

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

  const url = isNaN(ctx.req.url.split("/")[4]) === false ? ctx.req.url.split("/")[4]: ctx.req.__NEXT_INIT_QUERY.id;
  const orderDetail = await LoggedAuthM.ClientOrderView(cookies._AuthorizationJobx,parseInt(url))
  

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
   //var boosterWork = {Final: [{usuario:}]};
  // const Booster = typeof cxt.final.bo.Final[0].usuario[0] === 'undefined' ? 'Ainda sem': cxt.final.bo.Final[0].usuario[0].user
  var boosterWork = {
   "status": true,
   "Final": [
       {
           "usuario": []
       }
   ]
};

   if(Booster){
   boosterWork = await LoggedAuth.boosterJob(
      cookies._AuthorizationJobx,orderDetail.order[0].booster,[null])
      console.log("test2")
   }
   console.log(boosterWork)

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
   console.log(cxt.final.bo)
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
      {RenderCli.contentOrderMaster(cxt)}
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
      <div class="modal fade" id="modal-approve-order" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Opa!</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            	
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Aprovação de Pedido!</h4>
                    <p>Você está preste a aprovar este pedido, deseja realmente continuar?</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" onClick={(e) => LoggedAuthM.approveOrder(cxt.final.o.order[0].id,cxt.final.c._AuthorizationJobx)}>Sim</button>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Não</button>
            </div>
            
        </div>
    </div>
</div>
<div className="modal fade" id="modal-finish-job" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
                     <h4 className="heading mt-4">Cancelamento de Pedido!</h4>
                     <p>Voce esta prestes a cencelar um pedido, deseja realmente fazer isso</p>
                  </div>
               </div>
               <div className="modal-footer">
                  <button type="button" className="btn btn-white" onClick={(e) => LoggedAuth.CancelOrder(cxt.final.o.order[0].id,cxt.final.c._AuthorizationJobx)}>Sim</button>
                  <button type="button" className="btn btn-link text-white ml-auto" data-dismiss="modal">Não</button>
               </div>
            </div>
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
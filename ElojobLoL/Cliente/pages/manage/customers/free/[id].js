import Devoloper from '../../../../components/front/essential'
import Logged    from '../../../../components/front/logged/class'
import {renderClient} from '../../../../components/front/render/@clients'
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

  const url = isNaN(ctx.req.url.split("/")[4]) === false ? ctx.req.url.split("/")[4]: ctx.req.__NEXT_INIT_QUERY.id;
  const orderDetail = await LoggedAuth.Client(cookies._AuthorizationJobx,parseInt(url))
  

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

  const final = {
    c: cookies, 
    b: boxAlert, 
    a: userDetails,
    o: orderDetail,
    bo:  false
    }

  return {
    props: {
      final,
    },
  }
   
 }


export default function OrderViewFree(cxt)
{
    return (
    <>
      {Essential2.header("Teste")}
      {Essential2.navbarMenu({page: "clients", cxt})}
      <div className="main-content" id="panel">
      {Essential2.navbar(cxt)}
      <div className="header pb-6 d-flex align-items-center">
      </div>
   <div className="container-fluid mt--6">  
   <div className="row">
      {RenderCli.contentOrderAwait(cxt)}
   </div>
   <div class="modal fade" id="modal-acept-job" tabindex="-1" role="dialog" aria-labelledby="modal-acept-job" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Aviso</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente aceitar este pedido?</p>
                    <p>Ao aceitar,o pedido sera ligado ao seu perfil, você sera 100% responsabilidado por esse trabalho.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onClick={(e) => LoggedAuth.Acceptjob(cxt.final.o.order[0].id,cxt.final.c._AuthorizationJobx)}>Vamos lá</button>
                    <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
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
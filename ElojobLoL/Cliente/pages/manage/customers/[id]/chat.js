import Devoloper from '../../../../components/front/essential'
import Logged    from '../../../../components/front/logged/class'
import {renderClient} from '../../../../components/front/render/@clients'
import {More} from '../../../../components/front/more/more'
import nookies   from 'nookies'

const Essential2 = new Devoloper.Essential()

const RenderCli = new renderClient()

const LoggedAuth = new Logged()

const Moree = new More()


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

  const Messages = await Moree.loadConfigMessages(orderDetail.order[0].id,cookies._AuthorizationJobx)

  const final = {
    c: cookies, 
    b: boxAlert, 
    a: userDetails,
    o: orderDetail,
    m: Messages,
    bo:  boosterWork
    }

  return {
    props: {
      final,
    },
  }
   
}



export default function Chat(cxt)
{

   var timer = setInterval( async () => {
      try{
     if(typeof window.location.pathname !== 'undefined'){
           var pat = window.location.pathname.split("/")
              if(typeof pat[4] !== 'undefined'){
                 if(pat[4] !== 'chat'){
                    clearInterval(timer)
                    console.log('Chat pausado')
                 }else{ console.log('Chat Solicitado'); await Moree.loadIntervalMessages(cxt.final.o.order[0].id,cxt.final.c._AuthorizationJobx) }
              }else{
                 console.log('Chat pausado')
                 clearInterval(timer);
              }
        }
        }catch(e){
           //console.log('Chat Finalizado')
        }
    }, 60000);

   LoggedAuth.useLeavePageConfirm(true,"Voce deseja realmente sair desta pagina?",timer);
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
      {RenderCli.contentChat(cxt)}
   </div>

      <div className="alert alert-success new" role="alert">
      <strong>Pronto!</strong> <span id="successmsg">Novas Partidas adicionadas</span>
      </div>

      <div className="alert alert-danger new" role="alert">
      <strong>Opa!</strong><span id="errormsg">Algo deu incrivelmente errado, contate um administrador!</span>
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
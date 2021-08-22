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
    l: await LoggedAuthM.avataresLista(cookies._AuthorizationJobx)
    }

  return {
    props: {
      final,
    },
  }
  
}

export default function UsersList(cxt)
{
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
      <div className="col-xl-12 order-xl-1">
         <div className="card" style={{backgroundColor: 'rgb(248 249 254)'}}>
            <div className="card-header">
               <div className="row align-items-center">
                  <div className="col-8">
                     <h3 className="mb-0">Lista de Avatares</h3>
                  </div>
               </div>
            </div>
            <div className="card-body">
                  <div className="pl-lg-4">
                  <div className="avatar-group">
                    {RenderCli.listavatares(cxt.final.l.avatares)}
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



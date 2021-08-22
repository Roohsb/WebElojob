import Devoloper from '../../../components/front/essential'
import LoggedM    from '../../../components/front-master/logged/@class'
import Logged    from '../../../components/front/logged/class'
import {More}      from '../../../components/front/more/more'
import nookies   from 'nookies'

const Essential2 = new Devoloper.Essential();

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
   LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx).userID,['style'])

  


 const final = {
   c: cookies, 
   b: boxAlert,
   a: userDetails,
   }

 return {
   props: {
     final,
   },
 }
  
}


export default function AddAvatar(cxt)
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
      <div className="col-xl-12 order-xl-2">
         <div className="card card-profile">
         <div className="header pb-6 d-flex align-items-center react" style={{minHeight: '300px',backgroundImage: 'url(/lol/profiles/banners/exemple.jpg)',backgroundSize:'cover',backgroundPosition:'center top'}}>
            <span className="mask bg-gradient-rgb opacity-8"></span>
         </div>
           
          
            <div className="card-body pt-0">
               <div className="row">
                  <div className="col">
                     <div className="card-profile-stats d-flex justify-content-center">
                      
                     </div>
                  </div>
               </div>
               <div className="pl-lg-4"><div className="row">
                  <div className="col-lg-6"><div className="form-group"><label className="form-control-label" for="input-username">Nome</label>

                  <input type="text" id="input-nome-banner" className="form-control" placeholder="Nome"/>
                  
                  </div>
                  </div>
                  <div className="col-lg-4"><div className="row">
                     <label className="form-control-label" for="input-email">Url (/lol/profiles/banners/VALUE)</label>
                     <input type="text" id="input-url-newbanner" className="form-control" defaultValue='exemple.jpg' placeholder="id"/>
                     <span style={{fontSize: '12px'}}>É Recomendado ter as dimensoes: 1885x424px</span>
                    
                     </div>
                     </div>
                     <button type="button" className="btn btn-info" onClick={(e) => LoggedAuthM.preViewBanner(cxt.final.c._AuthorizationJobx)} style={{
                      width: '78px',
                      height: '45px',
                      fontSize: '10px',
                      textAlign: 'center',
                      top: '30px'}}>Previa</button></div>

                   
                     <button type="button" className="btn btn-success" onClick={(e) => LoggedAuthM.createBanner(cxt.final.c._AuthorizationJobx)}>Criar Banner</button>

                  </div>
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
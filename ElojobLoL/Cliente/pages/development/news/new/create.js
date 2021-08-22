import Devoloper from '../../../../components/front/essential'
import LoggedM    from '../../../../components/front-master/logged/@class'
import Logged    from '../../../../components/front/logged/class'
import {More}      from '../../../../components/front/more/more'
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
      <div className="header pb-6 d-flex align-items-center">
         
</div>
<div className="container-fluid mt--6">
   <div className="row">
      <div className="col-xl-12 order-xl-2">
         <div className="card card-profile">
       
            <div className="card-body pt-0">
               <div className="row">
                  <div className="col">
                     <div className="card-profile-stats d-flex justify-content-center">
                        <div>
                           <span className="heading">TITULO</span>
                           <span className="description">Titulo</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div className="pl-lg-4"><div className="row">
                  <div className="col-lg-12"><div className="form-group"><label className="form-control-label" for="input-username">Titulo</label>

                  <input type="text" id="input-titulo-update" className="form-control" defaultValue="TITULO" placeholder="Titulo"/>
                  
                  </div>
                  </div>
                 </div>

                     <div className="row">
                        <div className="col-lg-12">
                           <div className="form-group">
                           <label className="form-control-label" for="input-first-name">Estrutura(Use linguagem HTML)</label>
                           <textarea rows="4" id="textarea-value-update" className="form-control textarea" placeholder="<span>Ola</span>....." defaultValue='   <h3>TEMPLATE EXEMPLO</h3>
                           <p><a href="https://elojobhigh.com.br/app/perfil/Alan" title="Lanzin"><img src="https://elojobhigh.com.br/app/assets/imagens/avatares/e12e001a130b4df0eea2df5a5772a456.png" alt="CRIADOR" class="img-circle" style="max-height: 50px;"><br><small>CRIADOR</small></a></p>
                           <p>12/01/2021 19:52:00</p>' style={{background: "#202124", height: "450px"}}></textarea>
                              </div>
                           </div>
                     </div>
                     <div className="header pb-6 d-flex align-items-center">
                     <button type="button" className="btn btn-info" onClick={(e) => LoggedAuthM.preViewUpdate(e)}>Previa</button>
                     <button type="button" className="btn btn-success" onClick={(e) => LoggedAuthM.criarUpdate(cxt.final.c._AuthorizationJobx,cxt.final.a.Final[0].usuario[0].user)}>Criar Noticia</button></div>

                     <div className="header pb-6 d-flex align-items-center">
         <iframe id="framepre" src={"/development/news/new/view/preview/"} height="500" width="100%" title="Iframe Example"></iframe>
         </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
   
      <div className="alert alert-success new" role="alert">
      <strong>Pronto!</strong> A sua noticia foi publicada com sucesso!
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
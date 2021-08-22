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

  const newss = typeof ctx.req.__NEXT_INIT_QUERY.id !== 'undefined' ? ctx.req.__NEXT_INIT_QUERY.id:  ctx.req.url.split("/")[4]

  const newsDetails = await LoggedAuthM.newsSearch(cookies._AuthorizationJobx,newss)
  
  if(newsDetails.status === false){

   ctx.res.writeHead(302, { Location: '/development/news/list' });
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
   nd: newsDetails
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
                           <span className="heading">{cxt.final.nd.News[0].title}</span>
                           <span className="description">Titulo</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div className="pl-lg-4"><div className="row">
                  <div className="col-lg-6"><div className="form-group"><label className="form-control-label" for="input-username">Titulo</label>

                  <input type="text" id="input-titulo-update" className="form-control" defaultValue={cxt.final.nd.News[0].title} placeholder="Titulo"/>
                  
                  </div>
                  </div>
                  <div className="col-lg-6"><div className="form-group">
                     <label className="form-control-label" for="input-email">ID</label>
                     <input type="email" id="input-id-update" className="form-control" defaultValue={cxt.final.nd.News[0].id} placeholder="id" disabled/>
                     
                     </div></div></div>

                     <div className="row">
                        <div className="col-lg-12">
                           <div className="form-group">
                           <label className="form-control-label" for="input-first-name">Estrutura(Use linguagem HTML)</label>
                           <textarea rows="4" id="textarea-value-update"className="form-control textarea" placeholder="<span>Ola</span>....." defaultValue={cxt.final.nd.News[0].text} style={{background: "#202124", height: "450px"}}></textarea>
                              </div>
                           </div>
                     </div>
                     <div className="header pb-6 d-flex align-items-center">
                     <button type="button" className="btn btn-info" onClick={(e) => LoggedAuthM.preViewUpdate(e)}>Previa</button>
                     <button type="button" className="btn btn-success" onClick={(e) => LoggedAuthM.atualizarUpdate(cxt.final.c._AuthorizationJobx)}>Salvar Alterações</button>
                     <button type="button" className="btn btn-danger"  data-toggle="modal" data-target="#modal-delete-banner">Apagar Noticia</button></div>

                     <div className="header pb-6 d-flex align-items-center">
         <iframe id="framepre" src={"/development/news/view/preview/"+cxt.final.nd.News[0].id} height="500" width="100%" title="Iframe Example"></iframe>
         </div>
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


   <div className="modal fade" id="modal-delete-banner" tabindex="-1" role="dialog" aria-labelledby="modal-delete-banner" aria-hidden="true">
        <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div className="modal-content">
        	
            <div className="modal-header">
                <h6 className="modal-title" id="modal-title-default">Aviso</h6>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div className="modal-body">
            	
                <p>Você deseja realmente apagar a pubicão <strong id="inserirusername">{cxt.final.nd.News[0].id}</strong></p>
                <p>Ao continuar, você deve estar ciente que, <strong style={{color: 'red', fontSize: '13px'}}>NÃO SERA POSSÍVEL REVERTER ESTÁ AÇÃO</strong></p><p>Este anuncio sera apagado eternamente</p>
            </div>
            <div className="modal-footer">
                <button onClick={(e) => LoggedAuthM.updatesDelete(cxt.final.c._AuthorizationJobx)}type="button"  className="btn btn-primary">Continuar</button>
                <button type="button" className="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
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
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

  const theme = typeof ctx.req.__NEXT_INIT_QUERY.theme !== 'undefined' ? ctx.req.__NEXT_INIT_QUERY.theme:  ctx.req.url.split("/")[4]

  const themeDetails = await LoggedAuthM.temasSearch(cookies._AuthorizationJobx,theme)
  
  if(themeDetails.status === false){

   ctx.res.writeHead(302, { Location: '/development/themes/list' });
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
   th: themeDetails
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
         <div className="header pb-6 d-flex align-items-center" style={{minHeight: '300px',backgroundColor: cxt.final.th.Theme[0].ref_color,backgroundSize:'cover',backgroundPosition:'center top'}}>
            <span className="mask bg-gradient opacity-8"></span>
         </div>
          
         
            <div className="card-body pt-0">
               <div className="row">
                  <div className="col">
                     <div className="card-profile-stats d-flex justify-content-center">
                        <div>
                           <span className="heading">{cxt.final.th.Theme[0].name}</span>
                           <span className="description">Nome</span>
                        </div>
                        <div>
                           <span className="heading">{cxt.final.th.Theme[0].id}</span>
                           <span className="description">ID</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div className="pl-lg-4"><div className="row">
                  <div className="col-lg-6"><div className="form-group"><label className="form-control-label" for="input-username">Nome</label>

                  <input type="text" id="input-nome-theme" className="form-control" defaultValue={cxt.final.th.Theme[0].name} placeholder="Nome"/>
                  
                  </div>
                  </div>
                  <div className="col-lg-6"><div className="form-group">
                     <label className="form-control-label" for="input-email">ID</label>
                     <input type="email" id="input-id-theme" className="form-control" defaultValue={cxt.final.th.Theme[0].id} placeholder="id" disabled/>
                     
                     </div></div>
                     
                     </div>

                     <div className="row">
                        <div className="col-lg-6">
                           <div className="form-group">
                           <label className="form-control-label" for="input-first-name">Url (Site Principal: /Template/css/themes/VALUE.css)</label>
                           <input type="text" id="input-url-theme" defaultValue={cxt.final.th.Theme[0].file} className="form-control" placeholder="image.jpg"/>
                              </div>
                           </div>
                           <div className="col-lg-5"><div className="form-group">
                     <label className="form-control-label" for="input-email">Cor de Referencia <a href="https://htmlcolorcodes.com" style={{fontSize: '12px'}} target="_blank">Ver tabela de cores</a></label>
                     <input type="email" id="input-css-theme" className="form-control" defaultValue={cxt.final.th.Theme[0].ref_color} placeholder="css"/>
                     
                     </div></div>
                     </div>
                     <button type="button" className="btn btn-success" onClick={(e) => LoggedAuthM.atualizarTheme(cxt.final.c._AuthorizationJobx)}>Salvar Alterações</button>
                     <button type="button" className="btn btn-danger"  data-toggle="modal" data-target="#modal-delete-theme">Apagar Tema</button>

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


   <div className="modal fade" id="modal-delete-theme" tabindex="-1" role="dialog" aria-labelledby="modal-delete-theme" aria-hidden="true">
        <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div className="modal-content">
        	
            <div className="modal-header">
                <h6 className="modal-title" id="modal-title-default">Aviso</h6>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div className="modal-body">
            	
                <p>Você deseja realmente apagar o tema <strong id="inserirusername">{cxt.final.th.Theme[0].name}</strong></p>
                <p>Ao continuar, você deve estar ciente que, <strong style={{color: 'red', fontSize: '13px'}}>NÃO SERA POSSÍVEL REVERTER ESTÁ AÇÃO</strong></p><p>Caso hajá algum usuario usando este tema,sera trocado pelo tema normal de id 1.</p>
            </div>
            <div className="modal-footer">
                <button onClick={(e) => LoggedAuthM.deleteTheme(cxt.final.c._AuthorizationJobx,cxt.final.th.Theme[0].id)} type="button"  className="btn btn-primary">Continuar</button>
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
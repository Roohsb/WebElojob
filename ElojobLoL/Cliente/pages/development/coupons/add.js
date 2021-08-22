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
   a: userDetails
   }

 return {
   props: {
     final,
   },
 }
  
}


export default function Coupon(cxt)
{
    return (
    <>
      {Essential2.header("Teste")}
      {Essential2.navbarMenu({page: "coupon",cxt})}
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
                           <span className="heading">CUPOM</span>
                           <span className="description">CRIAR</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div className="pl-lg-4">
                  <div className="row">
                     <div className="col-lg-6">
                        <div className="form-group"><label className="form-control-label" for="input-username">Codigo</label>
                           <input type="text" id="input-codigo-coupon" className="form-control" placeholder="BEMVINDO"/>
                        </div>
                     </div>
                     <div className="col-lg-6">
                        <div className="form-group">
                           <label className="form-control-label" for="input-email">Desconto %</label>
                           <input type="number" id="input-desconto-coupon" className="form-control"  placeholder="20"/>
                        </div>
                     </div>
                  </div>
                  <div className="row">
                     <div className="col-lg-6">
                        <div className="form-group">
                           <label className="form-control-label" for="input-email">Expiracao</label>
                           <input type="text" id="input-expiracao-coupon" className="form-control" defaultValue="2021-05-19T06:27:28.000Z" placeholder="id"/>
                           <span style={{fontSize: '14px', color: 'red'}}>O Formato da data deve ser legivel a database, use o valor padrao como base</span>
                        </div>
                      
                     </div>
                  </div>
                  <div className="header pb-6 d-flex align-items-center">
                     <button type="button" className="btn btn-success" onClick={(e) => LoggedAuthM.criarCoupon(cxt.final.c._AuthorizationJobx)}>Criar Cupom</button>
                  </div>
                  <div className="header pb-6 d-flex align-items-center">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div className="alert alert-success new" role="alert">
      <strong>Pronto!</strong> Cupom criado com sucesso!
   </div>
   <div className="alert alert-danger new" role="alert">
      <strong>Opa!</strong> Algo deu incrivelmente errado (Cupom existente ou Erro interno)
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
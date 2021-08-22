import nookies   from 'nookies'
import Devoloper from '../components/front/essential'
import Logged    from '../components/front/logged/class'
import {More}      from '../components/front/more/more'

const Essential2 = new Devoloper.Essential();
const LoggedAuth = new Logged()

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

 

const Graphics = await LoggedAuth.Commom(cookies._AuthorizationJobx)

const UltimasMensagens = await LoggedAuth.LastMessages(cookies._AuthorizationJobx)


const Comum = Graphics.Comum
const CanvasUser = Graphics.Users
const CanvasOrders = Graphics.Orders

const final = {
  c: cookies, 
  b: boxAlert, 
  a: userDetails,
  tsc: {Comum,CanvasUser,CanvasOrders},
  um: UltimasMensagens
  }

return {
  props: {
    final,
  },
}

}

export default function Home(cxt) {
  return (
    <>
     {Essential2.header("Teste")}
     {Essential2.navbarMenu({page: "home",cxt})}
    <div className="main-content" id="panel">
    {Essential2.navbar(cxt)}
    <div className="header bg-primary pb-6">
      <div className="container-fluid">
        <div className="header-body">
          <div className="row align-items-center py-4">
            <div className="col-lg-6 col-7">
              <h6 className="h2 text-white d-inline-block mb-0">Gerenciamento</h6>
              <nav aria-label="breadcrumb" className="d-none d-md-inline-block ml-md-4">
                <ol className="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li className="breadcrumb-item"><a href="#"><i className="fas fa-home"></i></a></li>
                  <li className="breadcrumb-item"><a href="#">EloJobx</a></li>
                  <li className="breadcrumb-item active" aria-current="page">Inicio</li>
                </ol>
              </nav>
            </div>
          </div>
          <div className="row">
            <div className="col-xl-3 col-md-6">
              <div className="card card-stats">
                <div className="card-body">
                  <div className="row">
                    <div className="col">
                      <h5 className="card-title text-uppercase text-muted mb-0">Total Clientes</h5>
                      <span className="h2 font-weight-bold mb-0">{Number(cxt.final.tsc.Comum[0].users)}</span>
                    </div>
                    <div className="col-auto">
                      <div className="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i className="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
            <div className="col-xl-3 col-md-6">
              <div className="card card-stats">
                <div className="card-body">
                  <div className="row">
                    <div className="col">
                      <h5 className="card-title text-uppercase text-muted mb-0">Pedidos</h5>
                      <span className="h2 font-weight-bold mb-0">{Number(cxt.final.tsc.Comum[0].orders)}</span>
                    </div>
                    <div className="col-auto">
                      <div className="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i className="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-xl-3 col-md-6">
              <div className="card card-stats">
                <div className="card-body">
                  <div className="row">
                    <div className="col">
                      <h5 className="card-title text-uppercase text-muted mb-0">Pedidos Finalizados</h5>
                      <span className="h2 font-weight-bold mb-0">{Number(cxt.final.tsc.Comum[0].ordersfinish)}</span>
                    </div>
                    <div className="col-auto">
                      <div className="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i className="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-xl-3 col-md-6">
              <div className="card card-stats">
                <div className="card-body">
                  <div className="row">
                    <div className="col">
                      <h5 className="card-title text-uppercase text-muted mb-0">Pedidos Abertos</h5>
                      <span className="h2 font-weight-bold mb-0">{cxt.final.tsc.Comum[0].ordersopen}</span>
                    </div>
                    <div className="col-auto">
                      <div className="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i className="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div className="container-fluid mt--6">
      <div className="row">
        <div className="col-xl-8">
          <div className="card bg-default">
            <div className="card-header bg-transparent">
              <div className="row align-items-center">
                <div className="col">
                  <h6 className="text-light text-uppercase ls-1 mb-1">Grafico Anual</h6>
                  <h5 className="h3 text-white mb-0">Pedidos Feitos</h5>
                </div>
                <div className="col">
                
                </div>
              </div>
            </div>
            <div className="card-body">
              <div className="chart">
              {Moree.LoadGraphic2(cxt.final.tsc.CanvasOrders[0])}
              </div>
            </div>
          </div>
        </div>
        <div className="col-xl-4">
          <div className="card">
            <div className="card-header bg-transparent">
              <div className="row align-items-center">
                <div className="col">
                  <h6 className="text-uppercase text-muted ls-1 mb-1">Grafico semanal</h6>
                  <h5 className="h3 mb-0">Usuarios Cadastrados</h5>
                </div>
              </div>
            </div>
            <div className="card-body">
              <div className="chart">
              {Moree.LoadGraphic1(cxt.final.tsc.CanvasUser[0])}
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="row">
        <div className="col-xl-8">
          <div className="card">
            <div className="card-header border-0">
              <div className="row align-items-center">
                <div className="col">
                  <h3 className="mb-0">Ultimas Mensagens</h3>
                </div>
              </div>
            </div>
            <div className="table-responsive">
              <table className="table align-items-center table-flush">
                <thead className="thead-light">
                </thead>
                <tbody>
                 { Moree.LastMessage(cxt.final.um)}
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div className="col-xl-4">
          <div className="card">
            <div className="card-header border-0">
              <div className="row align-items-center">
                <div className="col">
                  <h3 className="mb-0">Social traffic</h3>
                </div>
                <div className="col text-right">
                  <a href="#!" className="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div className="table-responsive">
              <table className="table align-items-center table-flush">
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Referral</th>
                    <th scope="col">Visitors</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      Facebook
                    </th>
                    <td>
                      1,480
                    </td>
                    <td>
                      <div className="d-flex align-items-center">
                        <span className="mr-2">60%</span>
                        <div>
                          <div className="progress">
                            <div className="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style={{width: '60%'}}></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Facebook
                    </th>
                    <td>
                      5,480
                    </td>
                    <td>
                      <div className="d-flex align-items-center">
                        <span className="mr-2">70%</span>
                        <div>
                          <div className="progress">
                            <div className="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style={{width: '70%'}}></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Google
                    </th>
                    <td>
                      4,807
                    </td>
                    <td>
                      <div className="d-flex align-items-center">
                        <span className="mr-2">80%</span>
                        <div>
                          <div className="progress">
                            <div className="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style={{width: '80%'}}></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Instagram
                    </th>
                    <td>
                      3,678
                    </td>
                    <td>
                      <div className="d-flex align-items-center">
                        <span className="mr-2">75%</span>
                        <div>
                          <div className="progress">
                            <div className="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style={{width: '75%'}}></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      twitter
                    </th>
                    <td>
                      2,645
                    </td>
                    <td>
                      <div className="d-flex align-items-center">
                        <span className="mr-2">30%</span>
                        <div>
                          <div className="progress">
                            <div className="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style={{width: 30}}></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      {cxt.final.b === false ?
      Moree.alertBox(cxt.final.c._AlertBox):
      false
      }
      <footer className="footer pt-0">
        <div className="row align-items-center justify-content-lg-between">
          <div className="col-lg-6">
            <div className="copyright text-center  text-lg-left  text-muted">
              © 2020 <a href="https://www.creative-tim.com" className="font-weight-bold ml-1" target="_blank">Creative Tim</a>
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
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <script src="/assets/js/argon.js?v=1.9.0"></script>
    <script src="/assets/js/jobx.js"></script>
    </div>

    </>
  )
}

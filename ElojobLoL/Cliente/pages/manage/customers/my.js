import Devoloper from '../../../components/front/essential'
import Logged    from '../../../components/front/logged/class'
import {More}      from '../../../components/front/more/more'
import {renderClient} from '../../../components/front/render/@clients'
import nookies   from 'nookies'


const Essential2 = new Devoloper.Essential()

const RenderCli = new renderClient()

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


    const L = Number.isNaN(parseInt(ctx.req.__NEXT_INIT_QUERY.l)) === false ? parseInt(ctx.req.__NEXT_INIT_QUERY.l) : 1
    const CustomersMY = await LoggedAuth.ClientAwaitMy(cookies._AuthorizationJobx,userDetails.Final[0].usuario[0].id)

    var Limite = L * 20
    var Limite2 = Limite - 20

    const Paginando = {status: true, page: L, count: CustomersMY.compras.length, compras: CustomersMY.compras.slice(Limite2, Limite)}

  

  const final = {
    c: cookies, 
    b: boxAlert, 
    a: userDetails,
    ca: Paginando
    }

  return {
    props: {
      final,
    },
  }
  
}

export default function Clients(cxt)
{
  return (
    <>
    {Essential2.header("Teste")}
    {Essential2.navbarMenu({page: "clients", cxt})}
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
                  <li className="breadcrumb-item"><a href="#">Clientes</a></li>
                  <li className="breadcrumb-item active" aria-current="page">Meus clientes</li>
                </ol>
              </nav>
            </div>
            <div className="col-lg-6 col-5 text-right">
              <a href="#" className="btn btn-sm btn-neutral">New</a>
              <a href="#" className="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div className="container-fluid mt--6">
      <div className="row">
        <div className="col">
          <div className="card bg-default shadow">
            <div className="card-header bg-transparent border-0">
              <h3 className="text-white mb-0">Aguardando um Booster</h3>
            </div>
            <div className="table-responsive">
              <table className="table align-items-center table-dark table-flush">
                <thead className="thead-dark">
                  <tr>
                    <th scope="col" className="sort" data-sort="idorder">ID</th>
                    <th scope="col" className="sort" data-sort="name">Serviço</th>
                    <th scope="col" className="sort" data-sort="budget">Produto</th>
                    <th scope="col" className="sort" data-sort="status">Status</th>
                    <th scope="col">Valor</th>
                    <th scope="col" className="sort" data-sort="completion">Progresso</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody className="list">
               {RenderCli.clientsAllAwaitMy(cxt.final.ca.compras)}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      {cxt.final.ca.count > 20 ? <nav aria-label="Page navigation example">
       <ul className="pagination justify-content-center">
       {Moree.paginationScr(cxt.final.ca,"/manage/customers/my")}
       </ul>
      </nav> : ''}
      {cxt.final.b === false ?
      Moree.alertBox(cxt.final.c._AlertBox):
      false
      }
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

   </>
  )
}



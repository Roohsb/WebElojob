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

  const L = Number.isNaN(parseInt(ctx.req.__NEXT_INIT_QUERY.l)) === false ? parseInt(ctx.req.__NEXT_INIT_QUERY.l) : 1
  var Users = await LoggedAuthM.usersLista(cookies._AuthorizationJobx)

  var Limite = L * 20
  var Limite2 = Limite - 20

  const Paginando = {status: true, page: L, count: Users.users.length, users: Users.users.slice(Limite2, Limite)}



  const final = {
    c: cookies, 
    b: boxAlert, 
    a: userDetails,
    l: Paginando
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
    {Essential2.header("Teste list")}
    {Essential2.navbarMenu({page: "development", cxt})}
   <div className="main-content" id="panel">
   {Essential2.navbar(cxt)}
   <div className="header bg-primary pb-6">
   <div className="container-fluid">
        <div className="header-body">
          <div className="row align-items-center py-4">
            <div className="col-lg-6 col-7">
              <h6 className="h2 text-white d-inline-block mb-0">Desenvolvimento</h6>
              <nav aria-label="breadcrumb" className="d-none d-md-inline-block ml-md-4">
                <ol className="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li className="breadcrumb-item"><a href="#"><i className="fas fa-home"></i></a></li>
                  <li className="breadcrumb-item"><a href="#">Usuarios</a></li>
                  <li className="breadcrumb-item active" aria-current="page">Lista</li>
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
              <h3 className="text-white mb-0">Lista de Usuarios</h3>
            </div>
            <div className="table-responsive">
              <table className="table align-items-center table-dark table-flush">
                <thead className="thead-dark">
                  <tr>
                    <th scope="col" className="sort" data-sort="idorder">ID</th>
                    <th scope="col" className="sort" data-sort="name">Usuario</th>
                    <th scope="col" className="sort" data-sort="budget">Nome</th>
                    <th scope="col" className="sort" data-sort="status">Nivel</th>
                    <th scope="col">Curtidas</th>
                    <th scope="col" className="sort" data-sort="completion">Acoes</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody className="list">
                {RenderCli.usersList(cxt)}
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
      {cxt.final.l.count > 20 ? <nav aria-label="Page navigation example">
       <ul className="pagination justify-content-center">
       {Moree.paginationScr(cxt.final.l,"/development/users/list")}
       </ul>
      </nav> : ''}
      {cxt.final.b === false ?
      Moree.alertBox(cxt.final.c._AlertBox):
      false
      }

      <div className="col-md-4">
      <div className="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div className="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div className="modal-content">
        	
            <div className="modal-header">
                <h6 className="modal-title" id="modal-title-default">Aviso</h6>
                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div className="modal-body">
            	
                <p>Você deseja realmente apagar os dados de <strong id="inserirusername">INSERIR USUARIO</strong></p>
                <p>Ao continuar, você deve estar ciente que, <strong style={{color: 'red', fontSize: '13px'}}>NÃO SERA POSSÍVEL REVERTER ESTÁ AÇÃO</strong></p><p>Todos os dados do usuário serão apagados, como se nunca houvesse existido.</p>
            </div>
            <div className="modal-footer">
                <button onClick={(e) => LoggedAuthM.deleteUser(cxt.final.c._AuthorizationJobx)} type="button"  className="btn btn-primary">Continuar</button>
                <button type="button" className="btn btn-link  ml-auto" data-dismiss="modal">Cancelar</button>
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
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

   </>
  )
}



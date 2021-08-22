import React     from 'react'
import Devoloper from '../../components/front/essential'
import Recognize from '../../components/front/auth/process'
import Logged    from '../../components/front/logged/class'
import nookies   from 'nookies'

const LoggedAuth = new Logged()
const Essential2 = new Devoloper.EssentialAuth();

export default function Auth() {
  return (
    <>
    {Essential2.header()}
    <style jsx global>{`body { background-color: #172b4d!important;}`}</style>
    <nav id="navbar-main" className="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div className="container">
      <a className="navbar-brand" href="dashboard.html">
        <img src="../assets/img/brand/white.png"/>
      </a>
      <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span className="navbar-toggler-icon"></span>
      </button>
      <div className="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div className="navbar-collapse-header">
          <div className="row">
            <div className="col-6 collapse-brand">
              <a href="dashboard.html">
                <img src="../assets/img/brand/blue.png"/>
              </a>
            </div>
            <div className="col-6 collapse-close">
              <button type="button" className="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul className="navbar-nav mr-auto">
        </ul>
        <hr className="d-lg-none" />
      </div>
    </div>
  </nav>
  <div className="main-content">
    <div className="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div className="container">
        <div className="header-body text-center mb-7">
          <div className="row justify-content-center">
            <div className="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 className="text-white">Welcome!</h1>
              <p className="text-lead text-white">Use these awesome forms to login or create new account in your project for free.</p>
            </div>
          </div>
        </div>
      </div>
      <div className="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon className="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <div className="container mt--8 pb-5">
      <div className="row justify-content-center">
        <div className="col-lg-5 col-md-7">
          <div className="card bg-secondary border-0 mb-0">
            <div className="card-header bg-transparent pb-5">
              <div className="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
              <div className="btn-wrapper text-center">
              </div>
            </div>
            <span id="error" style={{color: 'red', textAlign: 'center'}}></span>
            <div className="card-body px-lg-5 py-lg-5">
              <form role="form">
                <div className="form-group mb-3">
                  <div className="input-group input-group-merge input-group-alternative">
                    <div className="input-group-prepend">
                      <span className="input-group-text"><i className="ni ni-email-83"></i></span>
                    </div>
                    <input className="form-control" placeholder="Usuario" id="usuario" type="text"/>
                  </div>
                </div>
                <div className="form-group">
                  <div className="input-group input-group-merge input-group-alternative">
                    <div className="input-group-prepend">
                      <span className="input-group-text"><i className="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input className="form-control" placeholder="Password" id="senha" type="password"/>

                    <div className="input-group-prepend">
                      <span className="input-group-text" id="glasses"> <i className="ni ni-glasses-2"></i></span>
                    </div>

                  </div>
                </div>

                <div className="text-center">
                  <button onClick={Recognize} type="button" className="btn btn-primary my-4">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <img src="https://assinei.digital/wp-content/uploads/2021/04/load2.gif" id="loadscren" style={{
            position: 'absolute', left: '130px',top: '110px', visibility: 'hidden'}}></img>
            <img src="https://innovativesecurities.com/images/icons/success-2-once.gif" id="donescreen" style={{position:'absolute',left: '150px',top:'110px', visibility:'hidden', width: '165px'}}></img>
          <div className="row mt-3">
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer className="py-5" id="footer-main">
    <div className="container">
      <div className="row align-items-center justify-content-xl-between">
        <div className="col-xl-6">
          <div className="copyright text-center text-xl-left text-muted">
            &copy; 2020 <a href="https://www.creative-tim.com" className="font-weight-bold ml-1" target="_blank">Creative Tim</a>
          </div>
        </div>
        <div className="col-xl-6">
          <ul className="nav nav-footer justify-content-center justify-content-xl-end">
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
    </div>
  </footer>
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="/assets/js/argon.js?v=1.2.0"></script>
  <script src="/assets/js/jobx.js?v=1.3.0"></script>
    </>
  )
}


export async function getServerSideProps(ctx) {

  const cookies = nookies.get(ctx)


  if(cookies._AuthorizationJobx)
  {

    if(LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx) === 0)
    {
      return {
        props: {
        cookies,
        },
      }
    }
    else
    {
        ctx.res.writeHead(302, { Location: '/' });
        ctx.res.end();
        return {
          props: {
          cookies,
        },
      }
    }
  }
  
  
  return {
    props: {
      cookies,
    },
  }
  
}
import Head  from 'next/head'
import Link  from 'next/link'

class EssDocs{

  Header = (title) => { return(
  <Head> <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4."/>
  <meta name="author" content="Creative Tim"/>
  <title>{title}</title>
  <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard"/>
  <meta name="keywords" content="dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, argon, argon ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, argon dashboard"/>
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4."/>
  <meta itemprop="name" content="Argon - Free Dashboard for Bootstrap 4 by Creative Tim"/>
  <meta itemprop="description" content="Start your development with a Dashboard for Bootstrap 4."/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"/>
  <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css"/>
  <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css"/>
  <link rel="stylesheet" href="/docs/css/argon.min.css?v=1.2.0" type="text/css"/>
</Head>)
  }

  NavBar(){
    return(<>
    <nav className="collapse ct-links" id="ct-docs-nav">
          <div className="ct-toc-item active">
          <span className="ct-toc-link">Conhecendo</span>
            <ul className="nav ct-sidenav">
              <li className="ct-sidenav-active">
                <Link href="/docs/welcome"><a>Entrada</a></Link></li>
              <li>
                <Link href="/docs/navigation/lisence"><a>Licença</a></Link>
              </li>
            </ul>
          </div>
          <div className="ct-toc-item active">
            <span className="ct-toc-link">Configuração</span>
            <ul className="nav ct-sidenav">
              <li>
              <Link href="/docs/navigation/config/key-server"><a>Chaves - Servidor</a></Link>
              </li>
              <li>
              <Link href="/docs/navigation/config/key-client"><a>Chaves - Client</a></Link>
              </li>
            </ul>
          </div>
          <div className="ct-toc-item active">
            <span className="ct-toc-link">Servidor</span>
            <ul className="nav ct-sidenav">
              <li>
              <Link href="/docs/navigation/server/intro"><a>Introdução</a></Link>
              </li>
              <li>
              <Link href="/docs/navigation/server/cron"><a>Servidor 24Horas</a></Link>
              </li>
              <li>
              <Link href="/docs/navigation/server/inicializacao"><a>Inicializacao</a></Link>
              </li>
              <li>
              <Link href="/docs/navigation/server/mail"><a>NodeMailer</a></Link>
              </li>
            </ul>
          </div>
          <div className="ct-toc-item active">
            <span className="ct-toc-link">Tutorial</span>
            <ul className="nav ct-sidenav">
              <li>
              <Link href="/docs/navigation/examples/avatar/how-to-add"><a>Como adicionar Avatar</a></Link>
              </li>
              <li>
              <Link href="/docs/navigation/examples/banner/how-to-add"><a>Como adicionar Banner</a></Link>
              </li>
              <li>
              <Link href="/docs/navigation/examples/themes/how-to-add"><a>Como adicionar Tema</a></Link>
              </li>
            </ul>
          </div>
        </nav>
    </>)
  }

}

module.exports = {
  EssDocs : EssDocs,
}
import AddImport from '../../components/front-docs/essential'

const Addons = new AddImport.EssDocs();

export default function Welcome(){ 
return(<>
{Addons.Header('Doc Title1')}
<div className="container-fluid">
    <div className="row flex-xl-nowrap">
      <div className="col-12 col-md-3 col-xl-2 ct-sidebar">
        {Addons.NavBar()}
      </div>

      <main className="col-12 col-md-8 col-xl-7 py-md-3 pl-md-5 ct-content" role="main">
        <div className="ct-page-title">
          <h1 className="ct-title" id="content">
            EloJobx Painel Administrativo
          </h1>
          <div className="avatar-group mt-3">
          </div>
        </div>
        <p className="ct-lead">
          Nessa pagina você encontrará todos os detalhes importantes do Back-end do site
        </p>
        <hr/>
        <div className="text-center mb-5">
          <img src="https://demos.creative-tim.com/argon-dashboard/assets/img/docs/getting-started/overview.svg" className="img-fluid img-center shadow"/>
        </div>
        <p>Documentação referente as funcões,apis dentre outras funcionalidades do site e do Servidor (Server/Server-Side)</p>
        
        <h3 id="resources-and-credits">Aviso/Creditos</h3>
        <p>Não se deve retirar quaisquer avisos de direitos autorais do site a remoção resultara em uma quebra de contrato, <a href="asd"> Leia mais Aqui</a> Caso adicione alguma pagina, lembre-se de pôr <a href="ad"> O Aviso de Direitos Autorais</a></p>
        <p>Este modelo de site pertence totalmente a Creative Tim, o Back-End foi feito totalmente por Eduardo Castro (CastroMS). </p>
        <p>Conheca mais a Creative Tim: </p>
        <ul>
          <li>Follow <a href="https://twitter.com/creativetim" target="_blank" rel="nofollow">Creative Tim on Twitter</a>.</li>
          <li>Read and subscribe to <a href="http://blog.creative-tim.com" target="_blank" rel="nofollow">The Official Creative Tim Blog</a>.</li>
          <li>Follow <a href="https://www.instagram.com/creativetimofficial" target="_blank" rel="nofollow">Creative Tim on Instagram</a>.</li>
          <li>Follow <a href="https://www.facebook.com/creativetim" target="_blank" rel="nofollow">Creative Tim on Facebook</a>.</li>
        </ul>
      </main>
    </div>
  </div>
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="/assets/vendor/anchor-js/anchor.min.js"></script>
  <script src="/assets/vendor/clipboard/dist/clipboard.min.js"></script>
  <script src="/assets/vendor/holderjs/holder.min.js"></script>
  <script src="/assets/vendor/prismjs/prism.js"></script>
  <script src="/assets/js/argon.min.js?v=1.2.0"></script>
</>)
}
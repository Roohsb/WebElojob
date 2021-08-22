import AddImport from '../../../../../components/front-docs/essential'

const Addons = new AddImport.EssDocs();

export default function Lenceca(){ 
return(<>
{Addons.Header('Doc Title1')}
<div className="container-fluid">
    <div className="row flex-xl-nowrap">
      <div className="col-12 col-md-3 col-xl-2 ct-sidebar">
        {Addons.NavBar()}
      </div>
      <div className="d-none d-xl-block col-xl-2 ct-toc">
        <ul className="section-nav">
          <li className="toc-entry toc-h3"><a href="#tutorial">Tutorial</a></li>
        </ul>
      </div>
      <main className="col-12 col-md-8 col-xl-7 py-md-3 pl-md-5 ct-content" role="main">
        <div className="ct-page-title">
          <h1 className="ct-title" id="content">
          Exemplo - Banner
          </h1>
          <div className="avatar-group mt-3">
          </div>
        </div>
        <p className="ct-lead">
        Abaixo você saberá como adicionar um banner no site corretamente.
        </p>
        <hr/>
        <h2 id="introducao">Introdução</h2>
        <video _ngcontent-wwx-c41="" width="907" height="478"  tabIndex="0" preload="metadata" role="video" autoPlay={true} loop={true} muted={true}>
          <source src="/docs/movies/add-banner.mp4" type="video/mp4"/>
          </video>
          <p className="ct-lead" style={{color: "orange"}}>
          * Exemplo de como adicionar um banner.
        </p>

        <p>Você vai precisar ter acesso aos arquivos do Dashboard e do site Elo<br/></p>
     
        <hr/>
        <h2 id="tutorial">Tutorial</h2>
          <p>Você precisa ir em <a href="/development/banners/add" target="_blank">Adicionar Banner</a> Em,  <strong style={{color: "orange"}}>Nome</strong> Defina o nome do banner, em <strong style={{color: "orange"}}>Url (/lol/profiles/banners/VALUE)</strong> Defina o arquivo, exemplo:<strong style={{color: "orange"}}> imagem.png</strong><br/></p><br/>
          <p>Lembrando, você deve por a imagem nos 2 diretorios dos sites</p>
          <ul>
            <li>DashBoard: <strong style={{color: "orange"}}>Dashboard/template/lol/profiles/banners/</strong></li>
            <li>Elo: <strong style={{color: "orange"}}>Elo/Template/imagens/profiles/banners/</strong></li>
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
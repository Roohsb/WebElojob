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
          Exemplo - Tema
          </h1>
          <div className="avatar-group mt-3">
          </div>
        </div>
        <p className="ct-lead">
        Abaixo você saberá como adicionar um Tema no site corretamente.
        </p>
        <hr/>
        <h2 id="tutorial">Tutorial</h2>
          <p>Você precisa ir em <a href="/development/themes/add" target="_blank">Adicionar Tema</a> Em,  <strong style={{color: "orange"}}>Nome</strong> Defina o nome do tema, em <strong style={{color: "orange"}}>Url (/Template/css/themes/VALUE.css)</strong> Defina o arquivo, exemplo:<strong style={{color: "orange"}}> theme-red.css</strong> No campo <strong style={{color: "orange"}}>Cor de Referencia</strong> seria uma cor que sera mostrada na seleção, um "preview" do tema, uma referencia.. Exemplo: <strong style={{color: "orange"}}>#FFF</strong> ou <strong style={{color: "orange"}}>rgb(255, 0, 55)</strong><br/></p><br/>
          <p>Obtenha exemplo de template aqui: <a href="https://drive.google.com/file/d/1Rik4IjfU6W4GY3IWNWUeAVEeU5uuWxTf/view?usp=sharing" target="_blank">Baixe Aqui</a></p>
          <p>Para finalizar, adicione o tema no seguinte diretorio:</p>
          <ul>
            <li>DashBoard: <strong style={{color: "orange"}}>Dashboard/template/css/themes/</strong></li>
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
import AddImport from '../../../../components/front-docs/essential'

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
          <li className="toc-entry toc-h3"><a href="#introducao">Introdução</a></li>
        </ul>
      </div>
      <main className="col-12 col-md-8 col-xl-7 py-md-3 pl-md-5 ct-content" role="main">
        <div className="ct-page-title">
          <h1 className="ct-title" id="content">
          Incializacao do Servidor
          </h1>
          <div className="avatar-group mt-3">
          </div>
        </div>
        <p className="ct-lead">
        Feito para o funcionamento normal do servidor, seria teste de funções antes da produção.
        </p>
        <hr/>
        <h2 id="introducao">Introdução</h2>
        <img src="/docs/imgs/inicializacao1.jpg" width="890px"/>
        <p className="ct-lead">
        A imagem mostra um log de uma inicializacao em modo seguro, com tudo funcionando corretamente.
        </p>

        <p>No codigo existe uma pré analise do sistema, independente do nivel, essa checagem é feita.<br/>Para uma analise completa do sistema, você deve iniciar o servidor no <strong style={{color: "orange"}}>Nivel 1 (Modo Segurança)</strong>. Abaixo uma lista completa do que sera testado neste nivel<br/>
        <strong className="ct-lead" style={{color: "orange"}}>
          Você pode encontrar os codigos no arquivo /Server/server/boot.js
        </strong></p>
     
        <ul>
          <li>Nivel Selecionado</li>
          <li>Chaves Para Criptografia</li>
          <li>Chave Riot</li>
          <li>Chave MercadoPago </li>
          <li>Email de Pedidos</li>
          <li>Banco de Dados MYSQL</li>
          <li><strong className="ct-lead" style={{color: "orange"}}>
            Conexao MYSQL [Nivel 1]
            </strong></li>
          <li><strong className="ct-lead" style={{color: "orange"}}>
            Acesso a Riot [Nivel 1]
          </strong></li>
          <li><strong className="ct-lead" style={{color: "orange"}}>
            Acesso ao MercadoPago [Nivel 1]
          </strong></li>
          <li><strong className="ct-lead" style={{color: "orange"}}>
            Envio De Email [Nivel 1]
          </strong></li>
          </ul>
          <p>O Envio de Email, você deve configurar o email de teste no arquivo <strong style={{color: "orange"}}>/Server/development/@Start.js</strong> Na classe <strong style={{color: "orange"}}>Starting</strong> Dentro da função <strong style={{color: "orange"}}>Email</strong><br/></p>
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
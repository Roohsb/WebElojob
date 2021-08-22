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
          <li className="toc-entry toc-h3"><a href="#structure">Estrutura</a></li>
          <li className="toc-entry toc-h3"><a href="#erroslist">Lista de Erros</a></li>
        </ul>
      </div>
      <main className="col-12 col-md-8 col-xl-7 py-md-3 pl-md-5 ct-content" role="main">
        <div className="ct-page-title">
          <h1 className="ct-title" id="content">
            Servidor
          </h1>
          <div className="avatar-group mt-3">
          </div>
        </div>
        <p className="ct-lead">
          Servidor responsavel pelo Dashboard e Site principal, veja tudo (ou quase tudo) sobre o servidor.
        </p>
        <video _ngcontent-wwx-c41="" width="907" height="478"  tabIndex="0" preload="metadata" role="video" autoPlay={true} loop={true} muted={true}>
          <source src="/docs/movies/intro.mp4" type="video/mp4"/>
          </video>
          <p className="ct-lead" style={{color: "orange"}}>
          * Acima um video do servidor (1.0.5) rodando no nivel 2. A parti da versão 1.0.6 o formato dos logs foram trocados.
        </p>
          <hr/>
      <h2 id="structure">Arquitetura</h2>
      <p>O servidor deve conter todas essas pastas/arquivos:</p>
      <figure className="highlight">
        <pre className=" language-plaintext" style={{background: '#191621'}}>
          <code className=" language-plaintext" data-lang="plaintext" style={{background: '#191621'}}>
            <span>Servidor/</span><br/>
            <span>├── StartServer.js</span><br/>
            <span>├── .env</span><br/>
            <span>│── controller/</span><br/>
            <span>│    └─────── authorization/</span><br/>
            <span>│    │        └───── jwt.js</span><br/>
            <span>│    ├─────── database/</span><br/>
            <span>│    │        └───── auth.js</span><br/>
            <span>│    ├─────── development/</span><br/>
            <span>│    │        │───── @Mail.js</span><br/>
            <span>│    │        └───── @Start.js</span><br/>
            <span>│    ├─────── league/</span><br/>
            <span>│    │        └───── auth.js</span><br/>
            <span>│    └─────── payments/</span><br/>
            <span>│             └───── Fire.json</span><br/>
            <span>├── src/</span><br/>
            <span>│    └─────── routes/</span><br/>
            <span>│    │         └───── api/</span><br/>
            <span>│    │         │      └─── approve-order.js</span><br/>
            <span>│    │         │      ├─── authenticate.js</span><br/>
            <span>│    │         │      ├─── checktoken.js</span><br/>
            <span>│    │         │      ├─── mercadopago.js</span><br/>
            <span>│    │         │      └─── teste.js</span><br/>
            <span>│    │         └───── post/</span><br/>
            <span>│    │                └──── league.js</span><br/>
            <span>│    └─────── server/</span><br/>
            <span>│    │         │──── boot.js</span><br/>
            <span>│    │         └──── run.js</span><br/>
            <span>│    └─────── App.js</span><br/>
            </code>
            </pre>
            </figure>
            <hr/>
      <h2 id="erroslist">Lista de Erros</h2>
      <p>Codigo mostrado no Client</p>
      <p className="ct-lead">Se você estiver recebendo algum desses codigos, olhe o console do servidor para mais detalhes <strong>Lembrete: </strong>Se por acaso não estiver recebendo logs, inicie o servidor com um nivel acima de 0</p>
      <table>
          <thead>
            <tr>
              <th style={{width: '10%'}}>Codigo</th>
              <th>Descricao</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>100</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Parâmetros insuficientes</span></td>
            </tr>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>101</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Token Invalido</span></td>
            </tr>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>102</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Não encontrado</span></td>
            </tr>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>103</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Invalido/Incorreto</span></td>
            </tr>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>142</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Chave Invalida/Vencida</span></td>
            </tr>
            <tr>
            <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>143</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Conflito</span></td>
            </tr>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>144</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Erro na conexão com a DataBase</span></td>
            </tr>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>145</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Erro Interno</span></td>
            </tr>
          </tbody>
        </table>
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
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
          <li className="toc-entry toc-h3"><a href="#transporter">Transporter</a></li>
          <li className="toc-entry toc-h3"><a href="#type">Tipo de Email</a></li>
        </ul>
      </div>
      <main className="col-12 col-md-8 col-xl-7 py-md-3 pl-md-5 ct-content" role="main">
        <div className="ct-page-title">
          <h1 className="ct-title" id="content">
            NodeMailer
          </h1>
          <div className="avatar-group mt-3">
          </div>
        </div>
        <p className="ct-lead">
          Modulo para envio de emails. Leia mais sobre o NodeMailer <a href="https://www.npmjs.com/package/nodemailer" target="_blank">Aqui</a>
        </p>
        <img src="/docs/imgs/mail.jpg" width="890px"/>
          <p className="ct-lead" style={{color: "orange"}}>
          * Acima uma imagem do servidor (1.0.5) no arquivo @Mail.js, você pode localizar em <strong style={{color: "orange"}}>/Server/controller/development/@Mail.js</strong>.
        </p>
          <hr/>
      <h2 id="transporter">Transporter:: Acesso ao SendMail</h2>
      <p>Para configurar o acesso ao SendMail, edite o arquivo <strong style={{color: "orange"}}>@Mail.js</strong> em <strong style={{color: "orange"}}>/Server/controller/development/@Mail.js</strong> configure corretamente</p>
      <br/>
        <p style={{color: "white"}}>Detalhes de cada variavel</p>
        <span><strong style={{color: "#ff298c"}}>var</strong> Titulo :<span style={{color: "orange"}}> Titulo do Email</span></span><br/>
        <span><strong style={{color: "#ff298c"}}>var</strong> Texto :<span style={{color: "orange"}}> Conteudo do Email em texto</span></span><br/>
        <span><strong style={{color: "#ff298c"}}>var</strong> Html :<span style={{color: "orange"}}> Conteudo do Email em Html</span></span><br/>
        <span><strong style={{color: "#ff298c"}}>var</strong> Nome :<span style={{color: "orange"}}> Nome do Remetente</span></span><br/>
            <hr/>

      <h2 id="type">Tipos de Emails</h2>
      <table>
          <thead>
            <tr>
              <th style={{width: '10%'}}>Tipo</th>
              <th>Descrição</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>Sem</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Se o type for diferente de 1 e 2, as variaveis declaradas não são modificadas, este conteudo é enviado para o Email Master para notificações de pagamentos recebidos.</span></td>
            </tr>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>1</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Type 1, Este conteudo é enviado para o email do cliente.</span></td>
            </tr>
            <tr>
              <td>
                <p><code className="highlighter-rouge" style={{color: 'rgb(255, 117, 19)', whiteSpace: 'break-spaces'}}>2</code></p>
              </td>
              <td><span className="h4" style={{color: 'white'}}>Type 2, o conteudo é enviado para o email teste, é usado somente quando o servidor é iniciado no modo segurança, para teste de envio de emails.</span></td>
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
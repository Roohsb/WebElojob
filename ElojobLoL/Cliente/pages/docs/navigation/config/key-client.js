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
          <li className="toc-entry toc-h2"><a href="#chaves">Chaves</a></li>
          <li className="toc-entry toc-h2"><a href="#chaves-descricao">Descrição</a></li>
        </ul>
      </div>
      <main className="col-12 col-md-8 col-xl-7 py-md-3 pl-md-5 ct-content" role="main">
      <div className="ct-page-title">
          <h1 className="ct-title" id="content">
            Configuração de Chaves para o Client
          </h1>
          <div className="avatar-group mt-3">
          </div>
        </div>
        <p className="ct-lead">
          Configuração importante para o funcionamento do client, chaves de acesso para apis e configurações internas.
        </p>
        <hr/>

        <h2 id="chaves">Chaves</h2>
        <p>Abaixo um exemplo de como o arquivo NEXT.CONFIG.JS deve ser feito, com todas as chaves que seram usadas.</p>
        <p>Ops: Lembre-se de configurar todas as chaves de acordo com o Servidor.</p>
        <div className="ct-example">
          <div className="tab-content">
            <div id="buttons-html" className="tab-pane fade active show" role="tabpanel" aria-labelledby="buttons-html-tab">
              <figure className="highlight">
                <pre className=" language-html" style={{background: '#191621'}}>
                <code className=" language-html" data-lang="html" style={{background: '#191621'}}>
                <span className="token tag">module.exports  = {"{"}</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  node<span className="token attr-name">: </span>{"{"}</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>   fs<span className="token attr-name">:</span> <span className="token attr-value">'empty'</span>,</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>   net<span className="token attr-name">:</span> <span className="token attr-value">'empty'</span>,</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>   tls<span className="token attr-name">:</span> <span className="token attr-value">'empty'</span>,</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>   {"}"},</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  env<span className="token attr-name">:</span> {"{"}</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  PRIVATE_JWT<span className="token attr-name">: </span><span className="token attr-value">'ELOJOBXSERVERJWTTOKENTOCLIENT'</span>,</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  PRIVATE_PTS<span className="token attr-name">: </span><span className="token attr-value">'ELOJOBXSERVERPTSTOKENTOCLIENT'</span>,</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  PRIVATE_STRING<span className="token attr-name">: </span><span className="token attr-value">'STRINPLITAQUI'</span>,</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  DATABASE<span className="token attr-name">:</span> [<span className="token attr-value">'localhost'</span>,<span className="token attr-value">'root'</span>,<span className="token attr-value">'elojobx'</span>,<span className="token attr-value">''</span>]</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  URLSERVER<span className="token attr-name">: </span><span className="token attr-value">'http://localhost:8080'</span>,</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  URLSERVERSIDE<span className="token attr-name">: </span><span className="token attr-value">'http://localhost:3000'</span></span><br/>
                <span className="token punctuation" style={{color: 'white'}}>  {"}"},</span><br/>
                <span className="token punctuation" style={{color: 'white'}}>{"}"}</span><br/>
                </code>
                </pre>
              </figure>
            </div>
          </div>
        </div>
        
        <h2 id="chaves-descricao">Descrições das chaves</h2>
        <table>
          <thead>
            <tr>
              <th>Chave</th>
              <th>Descrição</th>
            </tr>
          </thead>
          <tbody>
 
            <tr>
            <td><code className="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>DATABASE<br/>Default value: NONE</code></td>
            <td>Define a conexão do MySQL, são 4 objetos. O <strong>FORMATO ARRAY</strong> mantenha o mesmo formato<br/>
            <strong>FORMATO: </strong> [<code className="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>'HOST'</strong></code>,<code className="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>'USUARIO'</strong></code>,<code className="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>'DATABASE'</strong></code>,<code className="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>'SENHA'</strong></code>]
            </td>
            </tr>

            <tr>
            <td>
              <code className="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>PRIVATE_JWT<br/>Default value: NONE</code></td>
              <td>Seria uma serie de palavras que sera usado para Codificar/Descriptografar tokens do Client para o Servidor, voce pode usar qualquer valor (<code className="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>String</strong></code>) Mas lembre-se de que o mesmo valor setado no servidor, tem que ser setado no Client<br/>
              Leia mais sobre o <a target="_blank" href="https://www.npmjs.com/package/jsonwebtoken">JsonWebToken</a>
              </td>
            </tr>

            <tr>
            <td>
              <code className="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>PRIVATE_PTS<br/>Default value: NONE</code></td>
              <td>Seria uma serie de palavras que sera usado para Codificar/Descriptografar tokens do Client para o Servidor, voce pode usar qualquer valor (<code className="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>String</strong></code>) Mas lembre-se de que o mesmo valor setado no servidor, tem que ser setado no Client<br/>
              Leia mais sobre o <a target="_blank" href="https://www.npmjs.com/package/cryptr">Cryptr</a><br/>
              Diferente do JWT,Essa chave é uma String que fica entre o JWT-SPLIT, é usado somente na area de Login.
              </td>
            </tr>

            <tr>
            <td>
              <code className="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>PRIVATE_STRING<br/>Default value: NONE</code></td>
              <td>Bom, o token ele junta o JWT e o PTS, para separa-los, precisamos de 1 separador para identificar, essa chave seria para isso<br/>
              Novamente, lembre-se de que os valores devem ser igual no Client e no Servidor
              </td>
            </tr>

            <tr>
            <td>
              <code className="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>URLSERVER<br/>Default value: http://localhost:8080</code></td>
              <td>Url do Servidor.
              </td>
            </tr>

            <tr>
            <td>
              <code className="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>URLSERVERSIDE<br/>Default value: http://localhost:3000</code></td>
              <td>URL do servidor dentro do client, você precisa apontar para o domínio em que o dashboard esta rodando.
              </td>
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
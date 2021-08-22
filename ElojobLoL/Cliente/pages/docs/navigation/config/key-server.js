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
      <div class="d-none d-xl-block col-xl-2 ct-toc">
        <ul class="section-nav">
          <li class="toc-entry toc-h2"><a href="#chaves">Chaves</a></li>
          <li class="toc-entry toc-h2"><a href="#chaves-descricao">Descrição</a></li>
        </ul>
      </div>
      <main class="col-12 col-md-8 col-xl-7 py-md-3 pl-md-5 ct-content" role="main">
      <div class="ct-page-title">
          <h1 class="ct-title" id="content">
            Configuração de Chaves para o Servidor
          </h1>
          <div class="avatar-group mt-3">
          </div>
        </div>
        <p class="ct-lead">
          Configuração importante para o funcionamento do servidor, chaves de acesso para apis e configurações internas.
        </p>
        <hr/>

        <h2 id="chaves">Chaves</h2>
        <p>Abaixo um exemplo de como o arquivo .ENV deve ser feito, com todas as chaves que seram usadas.</p>
        <p>Emojis Significado:</p>
        <p>👨‍💻: Se não ativado, usara o valor padrao do servidor<br/>❌: Chave obrigatoria, não pode ser excluida, desativada</p>
        <p>Ops: chaves setadas dentro do servidor podem já está vencidas/invalidas.</p>
        <div class="ct-example">
          <div class="tab-content">
            <div id="buttons-html" class="tab-pane fade active show" role="tabpanel" aria-labelledby="buttons-html-tab">
              <figure class="highlight">
                <pre class=" language-html" style={{background: '#191621'}}>
                <code class=" language-html" data-lang="html" style={{background: '#191621'}}>
                <span class="token punctuation"># Metodo De Inicializacao 👨‍💻 * <span className="token attr-name">Int</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}} >START_MODE=0</span><br/>
                <span class="token punctuation">##################################################</span><br/>
                <span class="token punctuation"># Porta em que o servidor irar rodar 👨‍💻 * <span className="token attr-name">Int</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}}>SERVER_PORT=8080</span><br/>
                <span class="token punctuation">##################################################</span><br/>
                <span class="token punctuation"># Conexao MYSQL 👨‍💻 * <span className="token attr-name">4 Objetos</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}}>MYSQL=host||usuario||database||senha</span><br/>
                <span class="token punctuation">##################################################</span><br/>
                <span class="token punctuation"># Uma String de acesso a criptografia <strong>JWT</strong>❌ * <span className="token attr-name">String</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}}>PRIVATE_JWT=UmaStringAleatoriaVoceDecide</span><br/>
                <span class="token punctuation">##################################################</span><br/>
                <span class="token punctuation"># Uma String de acesso a criptografia <strong>Cryptr</strong>❌ * <span className="token attr-name">String</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}}>PRIVATE_PTS=UmaStringAleatoriaVoceDecide</span><br/>
                <span class="token punctuation">##################################################</span> <br/>
                <span class="token punctuation"># O Separador do Token JWT/PTS ❌ * <span className="token attr-name">String</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}}>PRIVATE_STRING=STRINPLITAQUI</span><br/>
                <span class="token punctuation">##################################################</span><br/>
                <span class="token punctuation"># Email que receberar notificações de pagamentos 👨‍💻 * <span className="token attr-name">String</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}}>MASTER_EMAIL=email@seudominio.com</span><br/>
                <span class="token punctuation">################################################## </span><br/>
                <span class="token punctuation"># Chave de Acesso a RIOTApi 👨‍💻 * <span className="token attr-name">String</span> </span><br/>
                <span class="token punctuation" style={{color: 'white'}}>LEAGUE_KEY=SUACHAVEDEACESSO</span><br/>
                <span class="token punctuation">##################################################</span><br/>
                <span class="token punctuation"># Chave de Acesso MercadoPago 👨‍💻 * <span className="token attr-name">String</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}}>MERCADO_KEY=SUACHAVEDEACESSO</span><br/>
                <span class="token punctuation">##################################################</span><br/>
                <span class="token punctuation"># WebSite livre para Post/Get❌ * <span className="token attr-name">String</span></span><br/>
                <span class="token punctuation" style={{color: 'white'}}>ALLOW_WEBSITE=http://localhost:3000</span><br/>
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
              <td><code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>START_MODE<br/>Default value: 0</code></td>
              <td>
              <code class="highlighter-rouge" style={{color: "#ff7513"}}><strong style={{fontSize: "18px"}}>@ </strong></code>* Modo de Incializacao :: Existe 3 modos de inicializacao no servidor<br/>
              <code class="highlighter-rouge" style={{color: "#ff7513"}}><strong style={{fontSize: "18px"}}>0 </strong></code>* <strong>NORMAL:</strong> Inicia normalmente (Mostra apenas informacões nescessarias)<br/>
              <code class="highlighter-rouge" style={{color: "#ff7513"}}><strong style={{fontSize: "18px"}}>1 </strong></code>* <strong>SEGURO:</strong> 1ª Inicializacão verifica todos os arquivos e funcões e logs ativos no console.<br/>
              <code class="highlighter-rouge" style={{color: "#ff7513"}}><strong style={{fontSize: "18px"}}>2 </strong></code>* <strong>DEVOLOPER:</strong> Todos os resultados são mostrados no console<br/></td>
            </tr>

            <tr>
            <td>
              <code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>SERVER_PORT<br/>Default value: 8080</code></td>
              <td>Define a porta em que o servidor irar rodar<br/></td>
            </tr>

            <tr>
            <td><code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>MYSQL<br/>Default value: localhost||root||elojobx||</code></td>
            <td>Define a conexão do MySQL, são 4 objetos. O <strong>||</strong> é o separador de cada objeto, mantenha o mesmo formato<br/>
            <strong>FORMATO: </strong> <code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}> HOST</strong></code>||<code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>USUARIO</strong></code>||<code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>DATABASE</strong></code>||<code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>SENHA</strong></code>
            </td>
            </tr>

            <tr>
            <td>
              <code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>PRIVATE_JWT<br/>Default value: NONE</code></td>
              <td>Seria uma serie de palavras que sera usado para Codificar/Descriptografar tokens do Client para o Servidor, voce pode usar qualquer valor (<code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>String</strong></code>) Mas lembre-se de que o mesmo valor setado no servidor, tem que ser setado no Client<br/>
              Leia mais sobre o <a target="_blank" href="https://www.npmjs.com/package/jsonwebtoken">JsonWebToken</a>
              </td>
            </tr>

            <tr>
            <td>
              <code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>PRIVATE_PTS<br/>Default value: NONE</code></td>
              <td>Seria uma serie de palavras que sera usado para Codificar/Descriptografar tokens do Client para o Servidor, voce pode usar qualquer valor (<code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>String</strong></code>) Mas lembre-se de que o mesmo valor setado no servidor, tem que ser setado no Client<br/>
              Leia mais sobre o <a target="_blank" href="https://www.npmjs.com/package/cryptr">Cryptr</a><br/>
              Diferente do JWT,Essa chave é uma String que fica entre o JWT-SPLIT, é usado somente na area de Login.
              </td>
            </tr>

            <tr>
            <td>
              <code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>PRIVATE_STRING<br/>Default value: NONE</code></td>
              <td>Bom, o token ele junta o JWT e o PTS, para separa-los, precisamos de 1 separador para identificar, essa chave seria para isso<br/>
              Novamente, lembre-se de que os valores devem ser igual no Client e no Servidor
              </td>
            </tr>

            <tr>
            <td>
              <code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>MASTER_EMAIL<br/>Default value: suporte@elojobx.com</code></td>
              <td>Email que receberá notificações de pagamentos feitos no site, este email pode ser de qualquer dominio.
              </td>
            </tr>

            <tr>
              <td>
              <code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>LEAGUE_KEY<br/>Default value: RGAPI-79dc7fd8-a24d-4810-8d8f-6d233b3e5afe</code></td>
              <td>Chave de acesso a RiotApi, para consultas de contas/partidas.<br/>
              <code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>Aviso </strong></code>Caso voce nao tenha obtido uma Chave De acesso eterna, deverar trocar essa Chave a cada 24H, <a target="_blank" href="https://developer.riotgames.com/docs/portal#web-apis_api-keys">leia mais sobre</a>
              </td>
            </tr>

            <tr>
              <td>
              <code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>MERCADO_KEY<br/>Default value: Olhe dentro do Servidor!</code></td>
              <td>Chave de acesso ao MercadoPagoAPI, para consultas de pedidos.<br/>
              <code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>Aviso </strong></code>Essa Chave seria algo importante, possivelmente se voce pegou este site de terceiros, a chave padrão nao funcionara.<br/>
              Obtenha sua chave MercadoPago <a target="_blank" href="https://www.mercadopago.com.br/developers/pt/guides/overview">Clique aqui</a>
              </td>
            </tr>
            <tr>
              <td>
              <code class="highlighter-rouge" style={{color: "#ff7513", whiteSpace: 'break-spaces'}}>ALLOW_WEBSITE<br/>Default value: None!</code></td>
              <td>Defina um dominio que é livre para acessar o servidor.<br/>
              <code class="highlighter-rouge" style={{color: "#ff7513"}}><strong  style={{fontSize: "18px"}}>Aviso </strong></code>
              O Dominio deve ser o que está rodando o dashboard
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
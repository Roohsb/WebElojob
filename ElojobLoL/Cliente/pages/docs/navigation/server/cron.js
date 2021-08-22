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
          Node-Cron
          </h1>
          <div className="avatar-group mt-3">
          </div>
        </div>
        <img src="https://avatars.githubusercontent.com/u/43762977?s=200&v=4"/>
        <p className="ct-lead">
         Um sistema feito para verificar novos pedidos e verificar pagamentos.
        </p>
        <hr/>
        <h2 id="introducao">Introdução</h2>
        <p>Eu precisava de um sistema para tornar pagamentos automaticos, depois de uma breve busca, achei o modulo perfeito para isso. O <strong><a href="https://www.npmjs.com/package/node-cron" target="_blank">NodeCron</a></strong> Quer saber como funciona? Vamos lá</p
        >
       
        <figure className="highlight">
        <pre className=" language-html" style={{background: '#191621'}}>
        <code className=" language-html" data-lang="html" style={{background: '#191621'}}>
        <span className="token punctuation" style={{color: 'white'}}>
        <span style={{color: "pink"}}>const</span>
        <span style={{color: "green"}}> Check</span>
        <span style={{color: "pink"}}> = </span>
        <span style={{color: "pink"}}> async</span>
        <span> () </span>
        <span style={{color: "pink"}}> {"=>"} </span>
        <span>{"{"}</span><br/>
        <span style={{color: "pink"}}>  var <span style={{color: "white"}}>d</span><span> = </span><span style={{color: "#7171ff"}}>0</span></span><br/>
        <span style={{color: "pink"}}>  var <span style={{color: "white"}}>o</span><span> = </span><span style={{color: "#7171ff"}}>0</span></span><br/>
        <span style={{color: "pink"}}>    for</span>(
        <span style={{color: "pink"}}>var </span>p
        <span style={{color: "pink"}}> of </span>Fire.
        <span style={{color: "green"}}>Value</span>){"{"}<br/>
        <span style={{color: "pink"}}>        if</span>(p.Checkagens
        <span style={{color: "pink"}}> {"<"}</span> 144){'{'} <br/>
        <span>          o<span style={{color: "pink"}}>++</span></span><br/>        {"}"}<br/>
        <span style={{color: "pink"}}>        if</span>(p.Checkagens
        <span style={{color: "pink"}}> {"==="}</span> 144){'{'} <br/>
        <span>          d<span style={{color: "pink"}}>++</span>;</span><br/>
        <span style={{color: "pink"}}>        await </span>mysql.<span>
        <span style={{color: "green"}}>prepareQuery</span>(<span style={{color: "yellow"}}>"UPDATE elo_users_invoices SET payment_id = ? WHERE id = ?</span>,[null,p.Order])<br/>
        <span>        fire.</span><span style={{color: "green"}}>remove</span>(
        <span style={{color: "pink"}}>{"{"}</span>Order: p.Order
        <span style={{color: "pink"}}>{"}"}</span>).write()<br/>
        <span>        {"}"}</span></span>
        <br/>{"}"}
        </span>
        <br/>
        <br/>
        <span className="token punctuation" style={{color: 'white'}}>cron.
        <span style={{color: "green"}}>schedule</span>(
        <span style={{color:"yellow"}}>'*/2 * * * *'</span>, () 
        <span style={{color: "pink"}}> {"=>"}</span> {"{"}</span><br/>
        <span className="token punctuation" style={{color: 'white'}}>
        <span style={{color: "green"}}>   Check</span>();</span><br/>
        <span className="token punctuation" style={{color: 'white'}}>{"});"}</span><br/>
                </code>
                </pre>
        </figure>
        <p>
         O Codigo acima roda a função <strong>Check</strong>. Vai ser rodado de  <strong style={{color: "orange"}}>2</strong> em <strong style={{color: "orange"}}>2</strong> minutos, está função esta verificando o arquivo <strong>Fire.json</strong> Verificando se algum pagamento ja foi vencido.
         </p>
         <p>
           <strong style={{color: "orange"}}>144</strong>? Este numero é a quantidade de 10 minutos tem em 24 horas, todos os pedidos abertos devem ser pagos dentro de um prazo de 24 horas apos a criação de um pedido no MercadoPago. Pedidos que atingem o numero 144 são deletados do arquivo Fire.json
        </p>
        
        <hr/>
          <img src="/docs/imgs/run1.jpg" width="890px"/>
          <p className="ct-lead">
         Arquivo <span style={{color: "orange"}}>run.js</span>, pode ser encontrado em /Server/server/run.js.
        </p>
          <p>
         O Codigo acima roda a função <strong>PaymentDone</strong>. Vai ser rodado de  <strong style={{color: "orange"}}>10</strong> em <strong style={{color: "orange"}}>10</strong> minutos, irar pesquisar por pagamentos na api do MercadoPago, se pago ele atualiza a database, caso contrario irar esperar mais 10minutos. Somente pedidos encontrados no arquivo Fire.Json são rodados
         </p>
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
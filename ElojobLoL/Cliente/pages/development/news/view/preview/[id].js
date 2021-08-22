import Head  from 'next/head'
import Devoloper from '../../../../../components/front/essential'
import LoggedM    from '../../../../../components/front-master/logged/@class'
import Logged    from '../../../../../components/front/logged/class'
import {More}      from '../../../../../components/front/more/more'
import nookies   from 'nookies'

const Essential2 = new Devoloper.Essential();

const LoggedAuth = new Logged()

const LoggedAuthM = new LoggedM()

const Moree = new More();




export async function getServerSideProps(ctx) {
  
   const cookies = nookies.get(ctx) 

  /**
   * Verificando o BoxAlert
   * 
   */
  var boxAlert = true;
  if(!cookies._AlertBox)
  {
    boxAlert = false
  }

  /**
   * Verificando Token de autorização
   */
  if(!cookies._AuthorizationJobx || LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx) === 0)
  {
    ctx.res.writeHead(302, { Location: '/auth/acess' });
    ctx.res.end();
    return {
      props: {
        cookies,
      },
  }
  }

  const newss = typeof ctx.req.__NEXT_INIT_QUERY.id !== 'undefined' ? ctx.req.__NEXT_INIT_QUERY.id:  ctx.req.url.split("/")[5]

  const newsDetails = await LoggedAuthM.newsSearch(cookies._AuthorizationJobx,newss)
  
  if(newsDetails.status === false){

   ctx.res.writeHead(302, { Location: '/development/news/list' });
   ctx.res.end();
   return {
     props: {
       cookies,
     },
   }
  }


  const userDetails = await LoggedAuth.Details(
   cookies._AuthorizationJobx,
   LoggedAuth.VerifyCookie(ctx.res,cookies._AuthorizationJobx).userID,['style'])

  


 const final = {
   c: cookies, 
   b: boxAlert,
   a: userDetails,
   nd: newsDetails
   }

 return {
   props: {
     final,
   },
 }
  
}


export default function Preview(cxt){

  return(<>
     <Head><meta charset="utf-8"/>
   <title>ELOJOB HIGH - Dashboard</title>
   <meta name="description" content="A maneira mais fácil e rápida de subir de ELO! Adquira já o seu serviço conosco!"/>
   <meta name="author" content="Diego Trindade"/>
   <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0"/>
   <link rel="shortcut icon" href="https://elojobhigh.com.br/app/favicon.ico"/>
   <link rel="stylesheet" href="/Clone/css/user/bootstrap.min.css"/>
   <link rel="stylesheet" href="/Clone/css/user/plugins.css"/>
   <link href="/Clone/css/user/vex.css" rel="stylesheet"/>
   <link href="/Clone/css/user/vex-theme-os.css" rel="stylesheet"/>
   <link rel="stylesheet" href="/Clone/css/user/main.css"/>
   <link id="theme-link" rel="stylesheet" href="/Clone/css/themes/fancy.css"/>
   <link rel="stylesheet" href="/Clone/css/user/themes.css"/>
   <script src="/Clone/js/user/modernizr.min.js" type="86d7530037d1dd452fe77e2e-text/javascript"></script></Head>
   <div id="page-content" style={{minHeight: '513px'}}>
   <div class="block">
      <div class="block-title">
         <h3>Visualizar <strong>Aviso</strong></h3>
      </div>
      <div class="text-center preview" id="previewhtml" dangerouslySetInnerHTML={{ __html: cxt.final.nd.News[0].text }}>
        
      </div>
   </div>
</div>
  </>)
}
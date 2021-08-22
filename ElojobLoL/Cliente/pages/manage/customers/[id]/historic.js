import Head  from 'next/head'
import nookies   from 'nookies'
import Logged    from '../../../../components/front/logged/class'
import {renderClient} from '../../../../components/front/render/@clients'


const RenderCli = new renderClient()

const LoggedAuth = new Logged()



export async function getServerSideProps(ctx) {


   const cookies = nookies.get(ctx) 

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
 
   const url = isNaN(ctx.req.url.split("/")[3]) === false ? ctx.req.url.split("/")[3]: ctx.req.__NEXT_INIT_QUERY.id;
   const historicDetail = await LoggedAuth.matchHistoric(cookies._AuthorizationJobx,parseInt(url))
   
   const final = {
     c: cookies,
     h: historicDetail
     }
 
   return {
     props: {
       final,
     },
   }
    
 }


 export default function Historico(cxt){
   return (<>
   <Head>
      <title>Historico</title>
      <link rel="stylesheet" href="/assets/css/historic/common.css"/>
      <link rel="stylesheet" href="/assets/css/historic/summoner.css"/>
   </Head>
   <div className="GameItemList">
      {
     cxt.final.h.status !== false ? RenderCli.matchsHistoric(cxt): <span>Ainda sem Historico</span>
      }
   </div>
   </>)
}
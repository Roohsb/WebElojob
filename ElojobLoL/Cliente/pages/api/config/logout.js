import nookies from 'nookies'
export default function Logout(req,res)
{
  try
  {
    const cookies = nookies.get({req: req, res: res})

    if(typeof cookies._AuthorizationJobx === 'undefined')
    {
      res.json({redirect: false})
      return res.end()
    }else{
      nookies.destroy({req: req, res: res},'_AuthorizationJobx',{
        path : '/' ,
      })
      res.send({redirect: true})
      return res.end()
    } 

  }catch(e){
    console.log(e)
    res.json({redirect: false})
    return res.end()
  }
}
import nookies from 'nookies'

export default async function(req,res){
  if (req.method === 'POST')
  {
    if(req.body.config === 'alertbox')
    {
    async function UpdateCookie(token) 
    {
      const Forumalario = new URLSearchParams();
      Forumalario.append('authorization', token);
      const Api = await fetch(process.env.URLSERVER+'/api/checktoken', {
        method: 'POST',
        body: Forumalario
      })
      const Resultado = await Api.text()
      return Resultado
    }

    try{
    const cookies = nookies.get({req: req, res: res})

    if(typeof cookies._AlertBox !== 'undefined')
    {
      res.json({ 
        result: true,
        code: 0
        })
      return res.end()
    }

    const Teori = await UpdateCookie(cookies._AuthorizationJobx)
    const Final = JSON.parse(Teori)

    if(Final.errorcod > 0)
    {
      res.status(401).json({
        result: false,
        code: 401
      })
      return res.end()
    }

    nookies.set({res}, '_AlertBox', 'ok', {
      maxAge: 30 * 24 * 60 * 60,
      path: '/',
      })

    res.json({ 
      result: true,
      code: 0
      })
    return res.end()

    }catch(e){
    console.log({erro: e})
    res.json({ result: false,
      code: 103})
    return res.end()
    }
  }
}

}

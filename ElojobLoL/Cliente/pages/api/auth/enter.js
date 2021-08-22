const {setCookie} = require('nookies');
import jwt from 'jsonwebtoken';
const jwtSecret = process.env.PRIVATE_JWT;
export const config = {
  api: {
      externalResolver: true,
  },
}
export default async (req, res) => {
  if (req.method === 'POST')
  {

    async function LoginApi(token) 
    {
      const Forumalario = new URLSearchParams();
      Forumalario.append('authorization', token);
      const Api = await fetch(process.env.URLSERVER+'/api/authenticate', {
        method: 'POST',
        body: Forumalario
      })
      const Resultado = await Api.text()
      return Resultado
    }

    try {
      const Teori = await LoginApi(req.body.authorization)
      const Final = JSON.parse(Teori)
      

      if(Final.errorcod === 102 || Final.errorcod === 103)
        {
           res.status(200).json({
            result: false,
            code: 200
          })
          return res.end()
        }

        if(Final.errorcod === 101)
        {
           res.status(200).json({
            result: false,
            code: 201
          })
          return res.end()
        }

        if(Final.errorcod === 104)
        {
           res.status(200).json({
            result: false,
            code: 203
          })
          return res.end()
        }

        if(Final.errorcod === 0){
          const token = jwt.sign({ "userID": Final.user, "userID2": Final.userid}, jwtSecret, { expiresIn: 3600 })
          
          setCookie({res}, '_AuthorizationJobx', token, {
            maxAge: 30 * 24 * 60 * 60,
            path: '/',
          })  
          res.status(200).json({
            result: true,
            code: 0
          })
          return res.end()   
        }

    
    } catch (e) {
      console.log(e)
      res.status(200).json({
        result: false,
        code: 205
      })
        return res.end()
    }

  }
}
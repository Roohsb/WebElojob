import jwt from 'jsonwebtoken';
const Cryptr =    require('cryptr');
const jwtSecret = process.env.PRIVATE_JWT;
const cryptr =    new Cryptr(process.env.PRIVATE_PTS);



async function Entrar(User,Pass)
{
  const token = jwt.sign({ "userID": User, "PassWord": Pass}, jwtSecret, { expiresIn: 60 })
  const secret = cryptr.encrypt(process.env.PRIVATE_STRING);
  const formData = new URLSearchParams();
  formData.append('authorization', token+'//5Y1RI'+secret)
  const res = await fetch('/api/auth/enter', {
      method: 'POST',
      body: formData
    })
    const json = await res.json()
    return json
}

async function Resulte(U,P)
{
  const Auth = await Entrar(U,P)
  console.log(Auth)
  if(Auth.code === 200){
    document.getElementById('error').innerHTML = 'Usuario invalido!'
    document.getElementById('loadscren').style.visibility = 'hidden'
    return
  }
  if(Auth.code === 201){
    document.getElementById('error').innerHTML = 'Preencha todos os campos!'
    document.getElementById('loadscren').style.visibility = 'hidden'
    return
  }
  if(Auth.code === 202){
    document.getElementById('error').innerHTML = 'Token Incorreto!'
    document.getElementById('loadscren').style.visibility = 'hidden'
    return
  }
  if(Auth.code === 203){
    document.getElementById('error').innerHTML = 'Erro interno!'
    document.getElementById('loadscren').style.visibility = 'hidden'
    return
  }
  if(Auth.code === 0){
   
    try{      
      document.getElementById('error').innerHTML = ''
      document.getElementById('loadscren').style.visibility = 'hidden'
      document.getElementById('donescreen').style.visibility = 'visible'
      localStorage.setItem('loginDate', 3600);
      setTimeout(() => {
        window.location.href = "/";
      }, 2000);
    }catch (e){
      console.log(e)
      alert('error')
      return
    }
  }
}

const Recognize = () =>{

  const User =  document.getElementById("usuario").value
  const Pass =  document.getElementById("senha").value
  document.getElementById('loadscren').style.visibility = 'visible'

  if(User === undefined || 
    User === null       || 
    Pass === undefined  ||
    Pass === null       ||
    Pass.length === 0   ||
    User.length === 0    )
    {
      document.getElementById('error').innerHTML = 'Preencha tudo antes de enviar!'
      document.getElementById('loadscren').style.visibility = 'hidden'
      return 0
    }
    setTimeout(() => {
      Resulte(User,Pass)
    }, 100); 
}




export default Recognize


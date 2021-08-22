const dotenv = require('dotenv');
const Cryptr = require('cryptr');
const bcrypt   = require('bcrypt');
const jwt = require('jsonwebtoken');
dotenv.config();
module.exports = class JWTAuth{

    /**
     * @const secretSplit
     *
     * Separador do JWT Com o PST Cryptr ,Identifica qual é qual.
     * Deve ser semelhante ao da cliente
     */
    secretSplit = process.env.PRIVATE_STRING

    /**
     * Token
     * Verificando token
     *
     * @description Composto por duas Keys privadas, a PRIVATE_STRING é uma chave unica
     * ela é criptografada no cliente e decryptografa aqui. PRIVATE_JWT É o token do JWT,
     * ele guarda todas os dados do post. PRIVATE_PTS É a chave privada para o encry/decry
     * da PRIVATE_STRING.
     *
     * @param {Token} Key
     * @returns 0 ou 1;
     */
    Token(Key){
      const cryptr = new Cryptr(process.env.PRIVATE_PTS);
      let Decodado
      try{
        var Splitado = Key.split(this.secretSplit)
        if(cryptr.decrypt(Splitado[1]) == process.env.PRIVATE_STRING){
        Decodado = jwt.verify(Splitado[0], process.env.PRIVATE_JWT);
        }
        else
        {
          Decodado = 1
        }
      }catch (e){
       Decodado = 1
      }
      return Decodado
    }

    /**
     * Verificando Token sem Split
     *
     * @param {Token} T
     * @returns Error or 1
     */
    CheckToken(T){
      let Decodado
      try{
        Decodado = jwt.verify(T, process.env.PRIVATE_JWT);
      }catch (e){
       Decodado = 1
      }
      return Decodado
    }

    /**
     * passwordVerify
     *
     * @param {PasswordNormal} T
     * @param {PasswordHash} P
     * @returns boolean
     */
    passwordVerify = async (T,P) => {
          return await bcrypt.compare(T, P.replace('$2y$', '$2a$'));
    }

}

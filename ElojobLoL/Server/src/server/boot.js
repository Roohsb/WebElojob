module.exports = function Boot(dev, s, l, m, e, p, my, lol, Email){
  const Inicializacao =  new dev.Starting()

    if(Inicializacao.checkLevel(s))
    {
      console.log('Servidor nao pode ser iniciado')
      console.log('Erro encontrado:' + Inicializacao.checkLevel(s))
      process.exit()
    }
    if(Inicializacao.checkKeys())
    {
      console.log('Servidor nao pode ser iniciado')
      console.log('Erro encontrado:' + Inicializacao.checkKeys(s))
      process.exit()
    }
    if(Inicializacao.checkLeague(l))
    {
      console.log('Servidor nao pode ser iniciado')
      console.log('Erro encontrado:' + Inicializacao.checkLeague(l))
      process.exit()
    }
    if(Inicializacao.checkMpKey(m))
    {
      console.log('Servidor nao pode ser iniciado')
      console.log('Erro encontrado:' + Inicializacao.checkMpKey(m))
      process.exit()
    }
    if(Inicializacao.checkMailMaster(e))
    {
      console.log('Servidor nao pode ser iniciado')
      console.log('Erro encontrado:' + Inicializacao.checkMailMaster(e))
      process.exit()
    }
    if(Inicializacao.checkMYSQL(my))
    {
      console.log('Servidor nao pode ser iniciado')
      console.log('Erro encontrado:' + Inicializacao.checkMYSQL(my))
      process.exit()
    }

    console.log('Servidor Iniciado')
    console.log('\x1b[33m%s\x1b[0m', `AVISO: Porta usada: ${p}`)
    console.log('\x1b[33m%s\x1b[0m', `AVISO: Nivel Escolhido: ${s}`)

    if(s > 0)
    {
      console.log('\x1b[33m%s\x1b[0m', `CONFIG: KEY/MercadoPago: ${m.substring(0, 10)}...`)
      console.log('\x1b[33m%s\x1b[0m', `CONFIG: KEY/RiotApi: ${l.substring(0, 10)}...`)
      console.log('\x1b[33m%s\x1b[0m', `CONFIG: KEY/EMAILMaster: ${e.substring(0, 10)}...`)
    }

    if(s === 1){
      console.log('\x1b[32m%s\x1b[0m', `MODO SEGURO ATIVO [Dentro de 5 segundos todos os sistemas começaram a ser testados]`)
      console.log('\x1b[32m%s\x1b[0m', `AVISO: É Recomendado ativar esse modo apenas se estiver enfrentando problemas no servidor`)
      console.log('\x1b[32m%s\x1b[0m', `AVISO: Este modo não testa todas as Tabelas/Colunas, caso o erro seja referente a isso, leia a documentação e reescreva a database`)

      setTimeout(async function(){
        await Inicializacao.advanceCheck.MySQL(my)
        await Inicializacao.advanceCheck.League(lol)
        await Inicializacao.advanceCheck.MercadoP(m)
        await Inicializacao.advanceCheck.Email(Email)
      },5000)
    }

}

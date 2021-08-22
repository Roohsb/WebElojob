module.exports = function Teste(app, assist , mysql, email){
  app.post("/api/teste", async function(req, res){
      res.setHeader('Access-Control-Allow-Origin', '*')
      res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
      res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type')
      res.setHeader('Access-Control-Allow-Credentials', true)

    console.log(req.body)
    res.json({
      status:false,
      errorcode: 1,
      errormsg: "Token invalido"
    })
    return res.end();

})
}

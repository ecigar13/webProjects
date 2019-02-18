var express = require("express");
var app = express();
var router = express.Router();
 
var path = __dirname + '/views/';
var port = 3000;
 
router.use(function (req,res,next) {
  console.log("/" + req.method);
  next();
});
 
router.get("/",function(req,res){
  res.sendFile(path + "index.html");
});

app.use(express.static('img'))

app.use("/",router);

 
app.listen(port, function () {
  console.log('Example app listening on port '+port);
});
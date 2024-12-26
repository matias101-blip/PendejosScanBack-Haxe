import php.FilesystemIterator;
import haxe.io.Bytes;
import sys.io.File;
import php.Const;
import php.Global;
import haxe.Json;
import tjson.TJSON;
import tink.http.Client;
import tink.http.containers.*;
import tink.http.Response;
import tink.web.routing.*;

typedef Proyectos = {
    var nombre:String;
    var portada:String;
    var resumen:String;
} 

class Server{
    static function main() {
        Global.header("Access-Control-Allow-Origin: *");
        Global.header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        Global.header("Access-Control-Allow-Headers: Content-Type, Authorization");
        var container = PhpContainer.inst; 
        var router = new Router<Root>(new Root());
        container.run(function(req) {
            return router.route(Context.ofRequest(req))
                .recover(OutgoingResponse.reportError);
        });
    }
}

class Root {
    public function new() {}

    @:get('/')
    public function home() {
       return "Estas en el inicio";
    }
  

    // Ruta que maneja la peticion de informacion
    @:get('/proyectos')
    @:get('/proyectos/$name')
    public function manga(name:String = "") {
        final url = 'https://my-json-server.typicode.com/matias101-blip/PendejosScanBack-Haxe/Proyectos';
        return Client.fetch(url).all().map(function(o) switch o {
            case Success(res):
                var resBody:Array<Proyectos> = TJSON.parse(res.body.toBytes().toString());
                if (name.length != 0){
                    for (obj in resBody){
                        if (obj.nombre == name){
                            return TJSON.encode(obj,'fancy');
                        }
                    }
                    return Json.stringify({'nope':false});
                }else{
                    return TJSON.encode(resBody, 'fancy');
                }
            case Failure(error):
                return 'Fail!!!: $error';
        });
    }

    @:get('/img/$nombre/$capitulo/$pag')
    public function Leer(nombre:String,capitulo:Int,pag:String) {
        var dataImg:Bytes;
        var imgDir:String = Const.__DIR__ + '/public/$nombre/$capitulo/$pag'+".svg";
        if (Global.file_exists(imgDir)){
            dataImg = File.getBytes(imgDir);
        }
        else{ 
            dataImg = File.getBytes(Const.__DIR__ + '/public/errors/oops.svg');
            Global.error_log("AAAAAAA Monikaa");
        }
        
        Global.header("Content-Type: image/svg+xml");
        return dataImg;
    

    }

    @:get('api/$nombre/$capitulo')
    public function Hojas(nombre:String,capitulo:Int) {
        var hojas:Array<Int> = [];
        final baseDir:String = Const.__DIR__ + '/public/$nombre/$capitulo';
        if (Global.is_dir(baseDir)){
            var iterator = new FilesystemIterator(baseDir);
            while (iterator.valid()){
               hojas.push(Std.parseInt(iterator.getFilename().split(".")[0]));
               iterator.next();
            }
            hojas.sort((a,b) -> a-b);
            return Json.stringify({"Succes":true,"Hojas":hojas});
        }else{
            return Json.stringify({"Succes":false});
        }

    }

}
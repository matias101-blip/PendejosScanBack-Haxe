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
        var container = PhpContainer.inst; 
        //var container =  PhpContainer.inst; //use PhpContainer instead of NodeContainer when targeting PHP
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

    @:get('/api/user')
    public function Usuario() {
        var user = {
            name:"Matias",
            apellido:"Murcia"
        }

        return user;
    }

    @:get('/api/hola')
    public function Trace() {
        return '<h1>Hola mundo</h1>';
    }
}
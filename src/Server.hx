import tink.http.containers.*;
import tink.http.Response;
import tink.web.routing.*;

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
    
    @:get('/$name')
    public function hello(name = 'World')
        return 'Hello, $name! como andamos';

    @:get('/proyectos/Mangas')
    public function manga(name="Elden ring") {
        return 'Esto es el manga de $name!!! :3';
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
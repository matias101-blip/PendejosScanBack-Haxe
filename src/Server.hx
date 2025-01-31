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
import BaseData;

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
        final Root = "/mnt/proyectos";
        var exist = Global.file_exists(Root + "/Moscow_2160/1");
        return "Esta carpeta existe? " + Std.string(exist);
    }
  

    // Ruta que maneja la peticion de informacion
    @:get('/proyectos')
    @:get('/proyectos/$name')
    public function manga(name:String = null) {
        return (name == null) ? BaseData.Home() : BaseData.getProyect(name);
    }

    @:get('/img/$nombre/$portada')
    @:get('/img/$nombre/$capitulo/$pag')
    public function Leer(nombre:String,capitulo:String = null,pag:String = null,portada:String = null) { 
        final Root = "/mnt/proyectos";
        var imgDir:String = "";
        var dataImg:Bytes;
        nombre = StringTools.replace(nombre," ","_");
        if (capitulo == null){
            portada = StringTools.replace(portada,"-",".");
            imgDir = Root + '/$nombre/$portada';
        }else{
            capitulo = StringTools.replace(capitulo,"-",".");
            pag = StringTools.replace(pag,"-",".");
            imgDir = Root + '/$nombre/$capitulo/$pag';
        }

        if (Global.file_exists(imgDir)){
            dataImg = File.getBytes(imgDir);
        }
        else{ 
            dataImg = File.getBytes(Root + '/errors/oops.svg');
            Global.error_log("AAAAAAA Monikaa");
        }
        
        var type: String = "";
        switch (Global.pathinfo(imgDir,4)){
            case "png":
                type = "png";
            case "jpg":
                type = "jpg";
            case "webp":
                type ="webp";
            case "svg":
                type = "svg+xml";
        }
        Global.header('Content-Type: image/$type');
        return dataImg;
    

    }

    @:get('api/$nombre/$capitulo')
    public function Hojas(nombre:String,capitulo:String) {
        final Root = "/mnt/proyectos";
        var hojas:Array<Int> = [];
        capitulo = StringTools.replace(capitulo, "-",".");
        nombre = StringTools.replace(nombre," ","_");
        final baseDir:String = Root + '/$nombre/$capitulo';
        if (Global.is_dir(baseDir)){
            var iterator = new FilesystemIterator(baseDir);
            while (iterator.valid()){
               hojas.push(Std.parseInt(iterator.getFilename().split(".")[0]));
               iterator.next();
            }
            hojas.sort((a,b) -> a-b);
            final ListCaps = BaseData.ListCaps(StringTools.replace(nombre,"_"," "));
            return Json.stringify({"Succes":true,"Hojas":hojas,"name":nombre, "capitulos":ListCaps});
        }else{
            return Json.stringify({"Succes":false});
        }

    }

}
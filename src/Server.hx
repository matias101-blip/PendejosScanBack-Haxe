import tink.web.Response;
import php.FilesystemIterator;
import haxe.io.Bytes;
import sys.io.File;
import php.Global;
import haxe.Json;
import tink.http.containers.*;
import tink.http.Response;
import tink.web.routing.*;
import BaseData;
import haxe.Template;

typedef Proyectos = {
    var nombre:String;
    var portada:String;
    var resumen:String;
} 

typedef MangaData ={
    var name:String;
    var resumen:String;
    var generos:Array<String>;
    var status:Int;
    var portada:String;
    var folder:Bool;
}

typedef InfoUpdate = {
    var name:String;
    var filter:String;
    var value:String;
    var clear:Bool;
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
        return "Hola loli UwU, xd";
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
        final Root = "/home/thehunter101/Documents/Developer-Software/Haxe/Pendejos-Back/ignorar/proyectos";
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
        final Root = "/home/thehunter101/Documents/Developer-Software/Haxe/Pendejos-Back/ignorar/proyectos";
        var hojas:Array<String> = [];
        capitulo = StringTools.replace(capitulo, "-",".");
        nombre = StringTools.replace(nombre," ","_");
        final baseDir:String = Root + '/$nombre/$capitulo';
        if (Global.is_dir(baseDir)){
            var iterator = new FilesystemIterator(baseDir);
            while (iterator.valid()){
               hojas.push(iterator.getFilename());
               iterator.next();
            }
            hojas.sort(function(a,b){
                var A = Std.parseInt(a.split(".")[0]);
                var B = Std.parseInt(b.split(".")[0]);
                return A - B;
            });

            final ListCaps = BaseData.ListCaps(StringTools.replace(nombre,"_"," "));
            return Json.stringify({"Succes":true,"Hojas":hojas,"name":nombre, "capitulos":ListCaps});
        }else{
            return Json.stringify({"Succes":false});
        }

    }


    //Post pata la base data
    @:post('api/InsertManga')
    @:bodyParam
    public function recibirData(body:MangaData){
        final Insert = BaseData.InserData(body);
        if(Insert){
            final nameFolder:String = StringTools.replace(body.name," ","-");
            if (body.folder)
                Global.mkdir('/home/thehunter101/Documents/Developer-Software/Haxe/Pendejos-Back/ignorar/proyectos/${nameFolder}');
            return "Mission Complete UwU";
        }else{
            return "Hey tu codigo de mrd no funkaaaa!!!";
        }
    }

    @:delete('api/DeleteManga')
    public function Delate(query:{name:String, folder:Bool}) {
        final delete = BaseData.DelateData(query.name);
        final nameFolder = StringTools.replace(query.name," ","-");
        if(delete){
            if(query.folder)
                Global.rmdir('/home/thehunter101/Documents/Developer-Software/Haxe/Pendejos-Back/ignorar/proyectos/${nameFolder}'); 
            return "Borrado del mapa UnU";
        }else{
            return "no se borro nada, no se encontro UnU";
        }
    }

    @:patch('api/updateInfo')
    @:bodyParam
    public function Update(body:InfoUpdate) {
        final response = BaseData.UpdateData(body);
        return 'respuesta: ${response}';
    }

}
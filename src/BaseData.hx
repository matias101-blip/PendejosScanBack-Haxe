import php.NativeAssocArray;
import haxe.extern.EitherType;
import php.db.SQLite3Result;
import php.Global;
import haxe.Json;
import php.Const;
import php.db.SQLite3;
import tjson.TJSON;


class BaseData{
    static final dbProyectos = new SQLite3("/home/sinherani/PendejosScanBack-Haxe/public/Proyectos.db");
    public static function Select() {
        var resultado:SQLite3Result = dbProyectos.querySingle("SELECT Capitulos FROM Proyectos WHERE Nombre ='Aizawa Koharu tiene prisa por morir'");
        Global.error_log(Std.string(resultado));
        return "Vamos bien";
    }

    public static function Home() {
        var resultado:SQLite3Result = dbProyectos.query("SELECT Nombre, Portada FROM Proyectos");
        var data: Array<NativeAssocArray<String>> = [];
        var row:EitherType<Bool,NativeAssocArray<String>> = resultado.fetchArray(1);
        while (row != false){
            data.push(row);
            row = resultado.fetchArray(1);
        }

        var datos:Array<Map<String,Any>> = [];
        for(item in data){
            var Item: Map<String, Any> = new Map();
            var iteradorKey = item.keyValueIterator();
            while(iteradorKey.hasNext()){
                var pair = iteradorKey.next();
                Item.set(pair.key.toLowerCase(),pair.value);
            }
            datos.push(Item);  
        }
        return Std.string(TJSON.encode(datos, "fancy"));
    }

    public static function getProyect(name:String) {
        var consulta:SQLite3Result = dbProyectos.query('SELECT * FROM Proyectos WHERE Nombre = "$name"');
        var data:NativeAssocArray<String> = consulta.fetchArray(1);
        consulta.finalize();
        var Item:Map<String,Any> = new Map();
        var iteratorKey = data.keyValueIterator();
        while (iteratorKey.hasNext()){
            var pair = iteratorKey.next();
            if (pair.key == "Capitulos"|| pair.key == "Generos"){
                    Item.set(pair.key.toLowerCase(),TJSON.parse(pair.value));
            }else{
                    Item.set(pair.key.toLowerCase(),pair.value);
            }
        }
        return Std.string(TJSON.encode(Item,"fancy"));
    }

    public static function ListCaps(Nombre:String) {
        var consulta = dbProyectos.querySingle("SELECT Capitulos FROM Proyectos WHERE Nombre = '"
        +Nombre +"'");
        return consulta;
    }
}
import Server.InfoUpdate;
import Server.MangaData;
import php.NativeAssocArray;
import haxe.extern.EitherType;
import php.db.SQLite3Result;
import php.Global;
import haxe.Json;
import php.db.SQLite3;
import tjson.TJSON;



class BaseData{
    static final dbProyectos = new SQLite3("/home/sinherani/database/Proyectos.db");
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

    public static function InserData(dataManga:MangaData):Bool {
        final query = 'INSERT INTO Proyectos (Nombre, Resumen, Generos,Status,Capitulos,Vistas,Portada) VALUES (?,?,?,?,?,?,?)';
        final stmt = dbProyectos.prepare(query);
        stmt.bindValue(1,dataManga.name);
        stmt.bindValue(2,dataManga.resumen);
        stmt.bindValue(3,Json.stringify(dataManga.generos));
        stmt.bindValue(4,dataManga.status);
        stmt.bindValue(5,[]);
        stmt.bindValue(6,0);
        stmt.bindValue(7,dataManga.portada);
        stmt.execute();
        return true;
    }

    public static function DelateData(name:String) {
       final query:String = 'DELETE FROM Proyectos WHERE Nombre = "${name}";';
       final Execute = dbProyectos.exec(query);
       return Execute;
    }

    public static function UpdateData(data:InfoUpdate) {
        final query:String = 'SELECT "${data.filter}" FROM Proyectos WHERE Nombre = "${data.name}"'; 
        final Response = dbProyectos.querySingle(query);
        if(Response == null){
            return 'La informacion solicitada no existe...';
        }else{
            final Caps:Array<Int> = Json.parse(Response);
            final upDate:Array<Int> = Json.parse(data.value);
            final query = dbProyectos.prepare('UPDATE Proyectos SET "${data.filter}" = :filter WHERE Nombre = :name');
            if(data.filter == 'Capitulos' || data.filter == 'Generos'){
                if(!data.clear){
                    final newValue = Std.string(Caps.concat(upDate));
                    query.bindValue(':filter',newValue);
                    query.bindValue(':name',data.name);
                    query.execute();
                    return 'Capitulos update';
                }else{
                    final newValue = Caps.filter(x -> upDate.indexOf(x)==-1);
                    query.bindValue(':filter',newValue);
                    query.bindValue(':name',data.name);
                    query.execute();
                    return 'Capitulos Delete';
                }
            }else{
                query.bindValue(':filter',Std.string(data.value));
                query.bindValue(':name',data.name);
                return 'update param';
            }
            return Response;
        }
    }
}
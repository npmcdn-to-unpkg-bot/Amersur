<?php namespace Amersur\Repositories;

use Illuminate\Http\Request;

use Jenssegers\Date\Date;

abstract class BaseRepo {

    abstract public function getModel();

    //BUSCAR POR ID Y URL
    public function findIdUrl($id, $url)
    {
        return $this->getModel()->where('id', $id)->where('slug_url', $url)->first();
    }

    //BUSCAR POR URL
    public function findUrl($url)
    {
        return $this->getModel()->where('slug_url', $url)->first();
    }

    //BUSCAR Y MOSTRAR ERROR
    public function findOrFail($id)
    {
        return $this->getModel()->findOrFail($id);
    }

    //ORDENAR
    public function orderBy($field, $order)
    {
        return $this->getModel()->orderBy($field, $order)->get();
    }

    //PAGINACION
    public function paginate($value)
    {
        return $this->getModel()->paginate($value);
    }

    //LISTAR
    public function lists($field, $id)
    {
        return $this->getModel()->lists($field, $id);
    }

    //MOSTRAR
    public function all(){
        return $this->getModel()->all();
    }

    //ORDERNAR Y PAGINAR
    public function orderByPagination($field, $order, $value)
    {
        return $this->getModel()->orderBy($field, $order)->paginate($value);
    }

    //SELECT
    public function where($field, $value)
    {
        return $this->getModel()->where($field, $value);
    }

    public function create($entity, array $data)
    {
        $entity->save();
        return $entity;
    }

    public function update($entity, array $data)
    {
        $entity->fill($data);
        $entity->save();
        return $entity;
    }

    public function delete($entity)
    {
        if (is_numeric($entity))
        {
            $entity = $this->findOrFail($entity);
        }
        $entity->delete();
        return $entity;
    }

    public function findTrash($id)
    {
        return $this->getModel()->onlyTrashed()->findOrFail($id);
    }

    //CARPETA CON NOMBRE DEL MES ACTUAL
    public function FechaCarpeta()
    {
        $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $mes = date('n')-1; // devuelve el número del mes
        $ano = date('Y'); // devuelve el año
        $fechaCarpeta = $meses[$mes]."".$ano."/";
        return $fechaCarpeta;
    }

    /* CREACION DE CARPETA */
    public function CrearCarpeta(){
        $nombre_carpeta=$this->FechaCarpeta();
        $ruta = public_path("upload/".$nombre_carpeta);
        if(!is_dir($ruta)){
            @mkdir($ruta, 0755);
            $carpeta=$ruta;
        }else{
            $carpeta=$ruta;
        }
        return $carpeta;
    }

    /* FECHA ACTUAL */
    public function fechaActual(){
        $fechaActual = date('Y-m-d H:i:s');
        return $fechaActual;
    }

    /* FECHA TEXTO */
    public function fechaTexto($datetime)
    {
        Date::setLocale('es');
        $fecha = Date::create($datetime->year, $datetime->month, $datetime->day, $datetime->hour, $datetime->minute, $datetime->second);
        $fecha = $fecha->format('d \\d\\e F \\d\\e\\l Y');
        return $fecha;
    }

    /* URL AMIGABLE */
    public function SlugUrl($texto){
        return $this->getUrlAmigable($this->eliminarTextoURL($texto));
    }

    public function eliminarTextoURL($str) {
        $search = array('&lt;', '&gt;', '&quot;', '&amp;');
        $str = str_replace($search, '', $str);
        $search = array('&aacute;','&Aacute;','&eacute;','&Eacute;','&iacute;','&Iacute;','&oacute;','&Oacute;','&uacute;','&Uacute;','&ntilde;','&Ntilde;');
        $replace = array('a','a','e','e','i','i','o','o','u','u','n','n');
        $search = array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ü', 'ü', 'Ñ', 'ñ', '_', '-');
        $replace = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'u', 'u', 'n', 'n', ' ', ' ');
        $str = str_replace($search, $replace, $str);
        $str = preg_replace('/&(?!#[0-9]+;)/s', '', $str);
        $search = array(' a ', ' de ', ' con ', ' por ', ' en ', ' y ', ' e ', ' o ', ' u ', ' la ', ' el ', ' lo ', ' las ', ' los ', ' fue ', ' del ', ' se ', ' su ', ' una ');
        $str = str_replace($search, ' ', strtolower($str));
        $str = str_replace($search, $replace, strtolower(trim($str)));
        $str = preg_replace("/[^a-zA-Z0-9\s]/", '', $str);
        $str = preg_replace('/\s\s+/', ' ', $str);
        $str = str_replace(' ', '-', $str);
        return  $str;
    }

    public function getUrlAmigable($s){
        $s = strtolower($s);
        $s = preg_replace("[áàâãäª@]","a",$s);
        $s = preg_replace("[éèêë]","e",$s);
        $s = preg_replace("[íìîï]","i",$s);
        $s = preg_replace("[óòôõºö]","o",$s);
        $s = preg_replace("[úùûü]","u",$s);
        $s = preg_replace("[ç]","c",$s);
        $s = preg_replace("[ñ]","n",$s);
        $s = preg_replace( "/[^a-zA-Z0-9\-]/", "-", $s );
        $s = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $s);

        return trim($s, '-');
    }

    //GENERAR CODIGO ALEATORIO
    public function CodigoAleatorio($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
    {
        $source = 'abcdefghijklmnopqrstuvwxyz';
        if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if($n==1) $source .= '1234567890';
        if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
        if($length>0){
            $rstr = "";
            $source = str_split($source,1);
            for($i=1; $i<=$length; $i++){
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1,count($source));
                $rstr .= $source[$num-1];
            }
        }
        return $rstr;
    }

    //GENERAR CODIGO ALEATORIO
    public function CodigoAleatorioUpp($length=10,$n=TRUE,$sc=FALSE)
    {
        $source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if($n==1) $source .= '1234567890';
        if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
        if($length>0){
            $rstr = "";
            $source = str_split($source,1);
            for($i=1; $i<=$length; $i++){
                mt_srand((double)microtime() * 1000000);
                $num = mt_rand(1,count($source));
                $rstr .= $source[$num-1];
            }
        }
        return $rstr;
    }

    //MOVER ARCHIVO
    public function FileMove($file, $path)
    {
        $name = $file->getClientOriginalName();                 //NOMBRE Y EXTENSION DE ARCHIVO
        $extension = $file->getClientOriginalExtension();       //EXTENSION DE ARCHIVO
        $archive = basename($name, ".".$extension);             //NOMBRE DE ARCHIVO
        $pathName = $this->SlugUrl($archive)."-".date('YmdHi');        //CONVERTIR NOMBRE SIN ESPACIOS
        $filename = $pathName.".".$extension;                   //NOMBRE Y EXTENSION SIN ESPACIOS
        $file->move($path, $filename);                          //MOVER ARCHIVO A NUEVA CARPETA
        return $filename;
    }

    //BUSQUEDA DE REGISTROS
    public function findAndPaginate(Request $request)
    {
        return $this->getModel()
                    ->titulo($request->get('titulo'))
                    ->publicar($request->get('publicar'))
                    ->orderBy('titulo', 'asc')
                    ->paginate();
    }

    //BUSQUEDAS DE REGISTROS ELIMINADOS
    public function findAndPaginateDeletes(Request $request)
    {
        return $this->getModel()
                    ->onlyTrashed()
                    ->titulo($request->get('titulo'))
                    ->orderBy('deleted_at', 'desc')
                    ->paginate();
    }

}

<?php




$serverName = ""; 


$username ="";
$password ="";
$database ="";

$conn = mssql_connect($serverName, $username, $password);


function dumpToJson($var, $encode = true, array $recursionCache = array()) {
    $tmp = serialize($var);
    if (isset($recursionCache[$tmp])) {
        return 'recursion';
    }
    $recursionCache[$tmp] = true;
    $result = array();
    $result['type'] = gettype($var);
    switch ($result['type']) {

        case 'resource':
            $result['resourceType'] = get_resource_type($var);
        case 'boolean':
            $result['value'] = (int) $var;
            break;
        case 'array':
            $result['value'] = array();
            foreach ($var as $key => $value) {
                $result['value'][$key] = dumpToJson($value, false, $recursionCache);
            }
            break;
        case 'object':
            $r = new ReflectionObject($var);
            $result['class'] = $r->getName();
            $result['value'] = array();
            foreach ($r->getProperties() as $prop) {
                $prop->setAccessable(true);
                $result['value'][$prop->getName()] = dumpToJson($prop->getValue($var), false, $recursionCache);
            }
            break;
        case 'integer':
        case 'double':
        case 'string':
        case 'NULL':
        default:
            $result['value'] = $var;
            break;
    }
    if ($encode) {
        return json_encode($result);
    }
    return $result;
}




$stmt = mssql_init('[dbo].[pkg_Silo.DatosDispositivo]');




$id_silo=$_GET['id'];






mssql_bind($stmt, '@IdSilo',   $id_silo,   SQLINT1 ,false,false,3);

$result=mssql_execute($stmt);

$Array = array();
while ( $record = mssql_fetch_array($result) )
{
	array_push($Array, $record);
}
 
$test=dumpToJson($Array);


echo $test;





?>
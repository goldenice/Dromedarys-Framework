<?hh
namespace Modules\System;
use PDO;

class Database extends Singleton {
    private PDO $handler;
    private string $dbtype = 'mysql';
    
    function __construct(string $host = DB_HOST, string $user = DB_USER, string $pass = DB_PASS, string $name = DB_NAME) {
        $this->handler = new PDO($this->dbtype.':dbname='.$name.';host='.$host, $user, $pass);
        $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        if ($this->handler == null or $this->handler == false) {
            $this->handler = null;
        }
    }
    
    function query(string $query): ?mixed {
        return $this->handler->query($query);
    }
    
    function fetchAssoc(mixed $input): ?Array {
        return $input->fetch(PDO::FETCH_ASSOC);
    }
    
    function numRows(mixed $input): ?int {
		return $input->rowCount();
	}
    
    function toArray(mixed $input): ?Array {
        return $input->fetchAll();
    }
	
	function mysqlError(?string $input = null): mixed {
		if ($input != null) {
            return $input->errorInfo();
		}
        return $this->handler->errorInfo();
	}
    
    function safeQuery(string $query, Array $input = array()): mixed {
        $prep = $this->handler->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        foreach ($input as $k=>$v) {
            $input[':'.$k] = $v;
            unset($input[$k]);
        }
        $prep->execute($input);
        return $prep;
    }
}
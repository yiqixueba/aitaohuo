<?php
class spModelMulti extends spModel
{
	var $_db_default = null;
	var $_db_bbs = null;

	public function __construct(){
		$bbs_param = $GLOBALS['G_SP']['bbs'];
		$this->dbpre = ($this->bbs)?$GLOBALS['G_SP']['bbs']['prefix']:$GLOBALS['G_SP']['db']['prefix'];
		if( null == $this->tbl_name )$this->tbl_name = $this->dbpre . $this->table;
		if( '' == $GLOBALS['G_SP']['db_driver_path'] ){
			$GLOBALS['G_SP']['db_driver_path'] = $GLOBALS['G_SP']['sp_drivers_path'].'/'.$GLOBALS['G_SP']['db']['driver'].'.php';
		}
		$this->_db_default = spClass('db_'.$GLOBALS['G_SP']['db']['driver'], array(0=>$GLOBALS['G_SP']['db']), $GLOBALS['G_SP']['db_driver_path']);
		if($bbs_param&&$bbs_param['open'])
		$this->_db_bbs = spClass('db_'.$GLOBALS['G_SP']['bbs']['driver'], array(0=>$GLOBALS['G_SP']['bbs']), $GLOBALS['G_SP']['db_driver_path'],false,'bbs');

	}

	public function chooseDB(){
		return ($this->bbs)?$this->_db_bbs:$this->_db_default;
	}

	public function find($conditions = null, $sort = null, $fields = null)
	{
		$this->_db = $this->chooseDB();
		return parent::find($conditions,$sort,$fields);
	}

	public function findAll($conditions = null, $sort = null, $fields = null, $limit = null)
	{
		$this->_db = $this->chooseDB();
		return parent::findAll($conditions,$sort,$fields,$limit);
	}

	public function findAllSql($conditions = null, $sort = null, $fields = null, $limit = null){
		$this->_db = $this->chooseDB();
		return parent::findAllSql($conditions,$sort,$fields,$limit);
	}

	public function findJoin($conditions = null, $sort = null, $fields = null)
	{
		$this->_db = $this->chooseDB();
		return parent::findJoin($conditions,$sort,$fields);
	}

	public function findAllJoin($conditions = null, $sort = null, $fields = null, $limit = null)
	{
		$this->_db = $this->chooseDB();
		return parent::findAllJoin($conditions,$sort,$fields,$limit);
	}

	public function dumpSql()
	{
		$this->_db = $this->chooseDB();
		return parent::dumpSql();
	}

	public function create($row)
	{
		$this->_db = $this->chooseDB();
		return parent::create($row);
	}

	public function createAll($rows)
	{
		$this->_db = $this->chooseDB();
		return parent::createAll($rows);
	}

	public function delete($conditions)
	{
		$this->_db = $this->chooseDB();
		return parent::delete($conditions);
	}

	public function findBy($field, $value)
	{
		$this->_db = $this->chooseDB();
		return parent::findBy($field,$value);
	}

	public function updateField($conditions, $field, $value)
	{
		$this->_db = $this->chooseDB();
		return parent::updateField($conditions,$field,$value);
	}

	public function findSql($sql)
	{
		$this->_db = $this->chooseDB();
		return parent::findSql($sql);
	}

	public function runSql($sql)
	{
		$this->_db = $this->chooseDB();
		return parent::runSql($sql);
	}

	public function query($sql){
		$this->_db = $this->chooseDB();
		return parent::query($sql);
	}

	public function findCount($conditions = null)
	{
		$this->_db = $this->chooseDB();
		return parent::findCount($conditions);
	}

	public function findCountJoin($conditions = null)
	{
		$this->_db = $this->chooseDB();
		return parent::findCountJoin($conditions);
	}

	public function update($conditions, $row)
	{
		$this->_db = $this->chooseDB();
		return parent::update($conditions,$row);
	}

	public function replace($conditions, $row)
	{
		$this->_db = $this->chooseDB();
		return parent::replace($conditions,$row);
	}

	public function incrField($conditions, $field, $optval = 1)
	{
		$this->_db = $this->chooseDB();
		return parent::incrField($conditions,$field,$optval);
	}


	public function decrField($conditions, $field, $optval = 1)
	{
		$this->_db = $this->chooseDB();
		return parent::decrField($conditions,$field,$optval);
	}

	public function escape($value)
	{
		$this->_db = $this->chooseDB();
		return parent::escape($value);
	}


	public static function quote($str, $noarray = false) {
		if (is_string($str))
		return '\'' . addcslashes($str, "\n\r\\'\"\032") . '\'';
		if (is_int($str) or is_float($str))
		return '\'' . $str . '\'';
		if (is_array($str)) {
			if($noarray === false) {
				foreach ($str as &$v) {
					$v = self::quote($v, true);
				}
				return $str;
			} else {
				return '\'\'';
			}
		}
		if (is_bool($str))
		return $str ? '1' : '0';
		return '\'\'';
	}

	public function deleteByPk($pk)
	{
		$this->_db = $this->chooseDB();
		return parent::deleteByPk($pk);
	}

}

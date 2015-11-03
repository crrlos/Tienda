<?php

namespace Map;

use \Usuarios;
use \UsuariosQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'usuarios' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsuariosTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UsuariosTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'usuarios';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Usuarios';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Usuarios';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the idusuario field
     */
    const COL_IDUSUARIO = 'usuarios.idusuario';

    /**
     * the column name for the nombreusuario field
     */
    const COL_NOMBREUSUARIO = 'usuarios.nombreusuario';

    /**
     * the column name for the nombres field
     */
    const COL_NOMBRES = 'usuarios.nombres';

    /**
     * the column name for the apellidos field
     */
    const COL_APELLIDOS = 'usuarios.apellidos';

    /**
     * the column name for the telefono field
     */
    const COL_TELEFONO = 'usuarios.telefono';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'usuarios.email';

    /**
     * the column name for the direccion field
     */
    const COL_DIRECCION = 'usuarios.direccion';

    /**
     * the column name for the iddepartamento field
     */
    const COL_IDDEPARTAMENTO = 'usuarios.iddepartamento';

    /**
     * the column name for the idmunicipio field
     */
    const COL_IDMUNICIPIO = 'usuarios.idmunicipio';

    /**
     * the column name for the fecharegistro field
     */
    const COL_FECHAREGISTRO = 'usuarios.fecharegistro';

    /**
     * the column name for the idrol field
     */
    const COL_IDROL = 'usuarios.idrol';

    /**
     * the column name for the clave field
     */
    const COL_CLAVE = 'usuarios.clave';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Idusuario', 'Nombreusuario', 'Nombres', 'Apellidos', 'Telefono', 'Email', 'Direccion', 'Iddepartamento', 'Idmunicipio', 'Fecharegistro', 'Idrol', 'Clave', ),
        self::TYPE_CAMELNAME     => array('idusuario', 'nombreusuario', 'nombres', 'apellidos', 'telefono', 'email', 'direccion', 'iddepartamento', 'idmunicipio', 'fecharegistro', 'idrol', 'clave', ),
        self::TYPE_COLNAME       => array(UsuariosTableMap::COL_IDUSUARIO, UsuariosTableMap::COL_NOMBREUSUARIO, UsuariosTableMap::COL_NOMBRES, UsuariosTableMap::COL_APELLIDOS, UsuariosTableMap::COL_TELEFONO, UsuariosTableMap::COL_EMAIL, UsuariosTableMap::COL_DIRECCION, UsuariosTableMap::COL_IDDEPARTAMENTO, UsuariosTableMap::COL_IDMUNICIPIO, UsuariosTableMap::COL_FECHAREGISTRO, UsuariosTableMap::COL_IDROL, UsuariosTableMap::COL_CLAVE, ),
        self::TYPE_FIELDNAME     => array('idusuario', 'nombreusuario', 'nombres', 'apellidos', 'telefono', 'email', 'direccion', 'iddepartamento', 'idmunicipio', 'fecharegistro', 'idrol', 'clave', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idusuario' => 0, 'Nombreusuario' => 1, 'Nombres' => 2, 'Apellidos' => 3, 'Telefono' => 4, 'Email' => 5, 'Direccion' => 6, 'Iddepartamento' => 7, 'Idmunicipio' => 8, 'Fecharegistro' => 9, 'Idrol' => 10, 'Clave' => 11, ),
        self::TYPE_CAMELNAME     => array('idusuario' => 0, 'nombreusuario' => 1, 'nombres' => 2, 'apellidos' => 3, 'telefono' => 4, 'email' => 5, 'direccion' => 6, 'iddepartamento' => 7, 'idmunicipio' => 8, 'fecharegistro' => 9, 'idrol' => 10, 'clave' => 11, ),
        self::TYPE_COLNAME       => array(UsuariosTableMap::COL_IDUSUARIO => 0, UsuariosTableMap::COL_NOMBREUSUARIO => 1, UsuariosTableMap::COL_NOMBRES => 2, UsuariosTableMap::COL_APELLIDOS => 3, UsuariosTableMap::COL_TELEFONO => 4, UsuariosTableMap::COL_EMAIL => 5, UsuariosTableMap::COL_DIRECCION => 6, UsuariosTableMap::COL_IDDEPARTAMENTO => 7, UsuariosTableMap::COL_IDMUNICIPIO => 8, UsuariosTableMap::COL_FECHAREGISTRO => 9, UsuariosTableMap::COL_IDROL => 10, UsuariosTableMap::COL_CLAVE => 11, ),
        self::TYPE_FIELDNAME     => array('idusuario' => 0, 'nombreusuario' => 1, 'nombres' => 2, 'apellidos' => 3, 'telefono' => 4, 'email' => 5, 'direccion' => 6, 'iddepartamento' => 7, 'idmunicipio' => 8, 'fecharegistro' => 9, 'idrol' => 10, 'clave' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('usuarios');
        $this->setPhpName('Usuarios');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Usuarios');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idusuario', 'Idusuario', 'INTEGER', true, null, null);
        $this->addColumn('nombreusuario', 'Nombreusuario', 'VARCHAR', false, 45, null);
        $this->addColumn('nombres', 'Nombres', 'VARCHAR', false, 45, null);
        $this->addColumn('apellidos', 'Apellidos', 'VARCHAR', false, 45, null);
        $this->addColumn('telefono', 'Telefono', 'VARCHAR', false, 45, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 100, null);
        $this->addColumn('direccion', 'Direccion', 'VARCHAR', false, 45, null);
        $this->addForeignKey('iddepartamento', 'Iddepartamento', 'INTEGER', 'departamentos', 'iddepartamento', false, null, null);
        $this->addForeignKey('idmunicipio', 'Idmunicipio', 'INTEGER', 'municipios', 'idmunicipio', false, null, null);
        $this->addColumn('fecharegistro', 'Fecharegistro', 'DATE', false, null, null);
        $this->addForeignKey('idrol', 'Idrol', 'INTEGER', 'roles', 'idrol', false, null, null);
        $this->addColumn('clave', 'Clave', 'VARCHAR', false, 300, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Departamentos', '\\Departamentos', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':iddepartamento',
    1 => ':iddepartamento',
  ),
), null, null, null, false);
        $this->addRelation('Municipios', '\\Municipios', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idmunicipio',
    1 => ':idmunicipio',
  ),
), null, null, null, false);
        $this->addRelation('Roles', '\\Roles', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idrol',
    1 => ':idrol',
  ),
), null, null, null, false);
        $this->addRelation('Hash', '\\Hash', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idusuario',
    1 => ':idusuario',
  ),
), null, null, 'Hashes', false);
        $this->addRelation('Pedidos', '\\Pedidos', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idcliente',
    1 => ':idusuario',
  ),
), null, null, 'Pedidoss', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UsuariosTableMap::CLASS_DEFAULT : UsuariosTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Usuarios object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsuariosTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsuariosTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsuariosTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsuariosTableMap::OM_CLASS;
            /** @var Usuarios $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsuariosTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UsuariosTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsuariosTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Usuarios $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsuariosTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UsuariosTableMap::COL_IDUSUARIO);
            $criteria->addSelectColumn(UsuariosTableMap::COL_NOMBREUSUARIO);
            $criteria->addSelectColumn(UsuariosTableMap::COL_NOMBRES);
            $criteria->addSelectColumn(UsuariosTableMap::COL_APELLIDOS);
            $criteria->addSelectColumn(UsuariosTableMap::COL_TELEFONO);
            $criteria->addSelectColumn(UsuariosTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UsuariosTableMap::COL_DIRECCION);
            $criteria->addSelectColumn(UsuariosTableMap::COL_IDDEPARTAMENTO);
            $criteria->addSelectColumn(UsuariosTableMap::COL_IDMUNICIPIO);
            $criteria->addSelectColumn(UsuariosTableMap::COL_FECHAREGISTRO);
            $criteria->addSelectColumn(UsuariosTableMap::COL_IDROL);
            $criteria->addSelectColumn(UsuariosTableMap::COL_CLAVE);
        } else {
            $criteria->addSelectColumn($alias . '.idusuario');
            $criteria->addSelectColumn($alias . '.nombreusuario');
            $criteria->addSelectColumn($alias . '.nombres');
            $criteria->addSelectColumn($alias . '.apellidos');
            $criteria->addSelectColumn($alias . '.telefono');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.direccion');
            $criteria->addSelectColumn($alias . '.iddepartamento');
            $criteria->addSelectColumn($alias . '.idmunicipio');
            $criteria->addSelectColumn($alias . '.fecharegistro');
            $criteria->addSelectColumn($alias . '.idrol');
            $criteria->addSelectColumn($alias . '.clave');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UsuariosTableMap::DATABASE_NAME)->getTable(UsuariosTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsuariosTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsuariosTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsuariosTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Usuarios or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Usuarios object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariosTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Usuarios) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsuariosTableMap::DATABASE_NAME);
            $criteria->add(UsuariosTableMap::COL_IDUSUARIO, (array) $values, Criteria::IN);
        }

        $query = UsuariosQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsuariosTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsuariosTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the usuarios table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsuariosQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Usuarios or Criteria object.
     *
     * @param mixed               $criteria Criteria or Usuarios object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariosTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Usuarios object
        }

        if ($criteria->containsKey(UsuariosTableMap::COL_IDUSUARIO) && $criteria->keyContainsValue(UsuariosTableMap::COL_IDUSUARIO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsuariosTableMap::COL_IDUSUARIO.')');
        }


        // Set the correct dbName
        $query = UsuariosQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsuariosTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsuariosTableMap::buildTableMap();

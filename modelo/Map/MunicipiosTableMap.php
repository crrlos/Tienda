<?php

namespace Map;

use \Municipios;
use \MunicipiosQuery;
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
 * This class defines the structure of the 'municipios' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MunicipiosTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MunicipiosTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'municipios';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Municipios';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Municipios';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the idmunicipio field
     */
    const COL_IDMUNICIPIO = 'municipios.idmunicipio';

    /**
     * the column name for the iddepartamento field
     */
    const COL_IDDEPARTAMENTO = 'municipios.iddepartamento';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'municipios.nombre';

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
        self::TYPE_PHPNAME       => array('Idmunicipio', 'Iddepartamento', 'Nombre', ),
        self::TYPE_CAMELNAME     => array('idmunicipio', 'iddepartamento', 'nombre', ),
        self::TYPE_COLNAME       => array(MunicipiosTableMap::COL_IDMUNICIPIO, MunicipiosTableMap::COL_IDDEPARTAMENTO, MunicipiosTableMap::COL_NOMBRE, ),
        self::TYPE_FIELDNAME     => array('idmunicipio', 'iddepartamento', 'nombre', ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idmunicipio' => 0, 'Iddepartamento' => 1, 'Nombre' => 2, ),
        self::TYPE_CAMELNAME     => array('idmunicipio' => 0, 'iddepartamento' => 1, 'nombre' => 2, ),
        self::TYPE_COLNAME       => array(MunicipiosTableMap::COL_IDMUNICIPIO => 0, MunicipiosTableMap::COL_IDDEPARTAMENTO => 1, MunicipiosTableMap::COL_NOMBRE => 2, ),
        self::TYPE_FIELDNAME     => array('idmunicipio' => 0, 'iddepartamento' => 1, 'nombre' => 2, ),
        self::TYPE_NUM           => array(0, 1, 2, )
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
        $this->setName('municipios');
        $this->setPhpName('Municipios');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Municipios');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idmunicipio', 'Idmunicipio', 'INTEGER', true, null, null);
        $this->addForeignKey('iddepartamento', 'Iddepartamento', 'INTEGER', 'departamentos', 'iddepartamento', false, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', false, 45, null);
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
        $this->addRelation('Usuarios', '\\Usuarios', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idmunicipio',
    1 => ':idmunicipio',
  ),
), null, null, 'Usuarioss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idmunicipio', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idmunicipio', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Idmunicipio', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? MunicipiosTableMap::CLASS_DEFAULT : MunicipiosTableMap::OM_CLASS;
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
     * @return array           (Municipios object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MunicipiosTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MunicipiosTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MunicipiosTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MunicipiosTableMap::OM_CLASS;
            /** @var Municipios $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MunicipiosTableMap::addInstanceToPool($obj, $key);
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
            $key = MunicipiosTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MunicipiosTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Municipios $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MunicipiosTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(MunicipiosTableMap::COL_IDMUNICIPIO);
            $criteria->addSelectColumn(MunicipiosTableMap::COL_IDDEPARTAMENTO);
            $criteria->addSelectColumn(MunicipiosTableMap::COL_NOMBRE);
        } else {
            $criteria->addSelectColumn($alias . '.idmunicipio');
            $criteria->addSelectColumn($alias . '.iddepartamento');
            $criteria->addSelectColumn($alias . '.nombre');
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
        return Propel::getServiceContainer()->getDatabaseMap(MunicipiosTableMap::DATABASE_NAME)->getTable(MunicipiosTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MunicipiosTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MunicipiosTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MunicipiosTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Municipios or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Municipios object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(MunicipiosTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Municipios) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MunicipiosTableMap::DATABASE_NAME);
            $criteria->add(MunicipiosTableMap::COL_IDMUNICIPIO, (array) $values, Criteria::IN);
        }

        $query = MunicipiosQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MunicipiosTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MunicipiosTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the municipios table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MunicipiosQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Municipios or Criteria object.
     *
     * @param mixed               $criteria Criteria or Municipios object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MunicipiosTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Municipios object
        }

        if ($criteria->containsKey(MunicipiosTableMap::COL_IDMUNICIPIO) && $criteria->keyContainsValue(MunicipiosTableMap::COL_IDMUNICIPIO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MunicipiosTableMap::COL_IDMUNICIPIO.')');
        }


        // Set the correct dbName
        $query = MunicipiosQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MunicipiosTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MunicipiosTableMap::buildTableMap();

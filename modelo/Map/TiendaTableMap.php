<?php

namespace Map;

use \Tienda;
use \TiendaQuery;
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
 * This class defines the structure of the 'tienda' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class TiendaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.TiendaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'tienda';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Tienda';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Tienda';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the idtienda field
     */
    const COL_IDTIENDA = 'tienda.idtienda';

    /**
     * the column name for the direccion field
     */
    const COL_DIRECCION = 'tienda.direccion';

    /**
     * the column name for the iddepartamento field
     */
    const COL_IDDEPARTAMENTO = 'tienda.iddepartamento';

    /**
     * the column name for the idmunicipio field
     */
    const COL_IDMUNICIPIO = 'tienda.idmunicipio';

    /**
     * the column name for the telefono field
     */
    const COL_TELEFONO = 'tienda.telefono';

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
        self::TYPE_PHPNAME       => array('Idtienda', 'Direccion', 'Iddepartamento', 'Idmunicipio', 'Telefono', ),
        self::TYPE_CAMELNAME     => array('idtienda', 'direccion', 'iddepartamento', 'idmunicipio', 'telefono', ),
        self::TYPE_COLNAME       => array(TiendaTableMap::COL_IDTIENDA, TiendaTableMap::COL_DIRECCION, TiendaTableMap::COL_IDDEPARTAMENTO, TiendaTableMap::COL_IDMUNICIPIO, TiendaTableMap::COL_TELEFONO, ),
        self::TYPE_FIELDNAME     => array('idtienda', 'direccion', 'iddepartamento', 'idmunicipio', 'telefono', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idtienda' => 0, 'Direccion' => 1, 'Iddepartamento' => 2, 'Idmunicipio' => 3, 'Telefono' => 4, ),
        self::TYPE_CAMELNAME     => array('idtienda' => 0, 'direccion' => 1, 'iddepartamento' => 2, 'idmunicipio' => 3, 'telefono' => 4, ),
        self::TYPE_COLNAME       => array(TiendaTableMap::COL_IDTIENDA => 0, TiendaTableMap::COL_DIRECCION => 1, TiendaTableMap::COL_IDDEPARTAMENTO => 2, TiendaTableMap::COL_IDMUNICIPIO => 3, TiendaTableMap::COL_TELEFONO => 4, ),
        self::TYPE_FIELDNAME     => array('idtienda' => 0, 'direccion' => 1, 'iddepartamento' => 2, 'idmunicipio' => 3, 'telefono' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('tienda');
        $this->setPhpName('Tienda');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Tienda');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idtienda', 'Idtienda', 'INTEGER', true, null, null);
        $this->addColumn('direccion', 'Direccion', 'VARCHAR', false, 45, null);
        $this->addColumn('iddepartamento', 'Iddepartamento', 'INTEGER', false, null, null);
        $this->addColumn('idmunicipio', 'Idmunicipio', 'INTEGER', false, null, null);
        $this->addColumn('telefono', 'Telefono', 'VARCHAR', false, 45, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Inventario', '\\Inventario', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idtienda',
    1 => ':idtienda',
  ),
), null, null, 'Inventarios', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idtienda', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idtienda', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Idtienda', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TiendaTableMap::CLASS_DEFAULT : TiendaTableMap::OM_CLASS;
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
     * @return array           (Tienda object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = TiendaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TiendaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TiendaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TiendaTableMap::OM_CLASS;
            /** @var Tienda $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TiendaTableMap::addInstanceToPool($obj, $key);
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
            $key = TiendaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TiendaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Tienda $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TiendaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TiendaTableMap::COL_IDTIENDA);
            $criteria->addSelectColumn(TiendaTableMap::COL_DIRECCION);
            $criteria->addSelectColumn(TiendaTableMap::COL_IDDEPARTAMENTO);
            $criteria->addSelectColumn(TiendaTableMap::COL_IDMUNICIPIO);
            $criteria->addSelectColumn(TiendaTableMap::COL_TELEFONO);
        } else {
            $criteria->addSelectColumn($alias . '.idtienda');
            $criteria->addSelectColumn($alias . '.direccion');
            $criteria->addSelectColumn($alias . '.iddepartamento');
            $criteria->addSelectColumn($alias . '.idmunicipio');
            $criteria->addSelectColumn($alias . '.telefono');
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
        return Propel::getServiceContainer()->getDatabaseMap(TiendaTableMap::DATABASE_NAME)->getTable(TiendaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(TiendaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(TiendaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new TiendaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Tienda or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Tienda object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TiendaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Tienda) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TiendaTableMap::DATABASE_NAME);
            $criteria->add(TiendaTableMap::COL_IDTIENDA, (array) $values, Criteria::IN);
        }

        $query = TiendaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TiendaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TiendaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the tienda table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return TiendaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Tienda or Criteria object.
     *
     * @param mixed               $criteria Criteria or Tienda object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TiendaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Tienda object
        }

        if ($criteria->containsKey(TiendaTableMap::COL_IDTIENDA) && $criteria->keyContainsValue(TiendaTableMap::COL_IDTIENDA) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TiendaTableMap::COL_IDTIENDA.')');
        }


        // Set the correct dbName
        $query = TiendaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // TiendaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
TiendaTableMap::buildTableMap();

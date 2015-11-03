<?php

namespace Map;

use \Productos;
use \ProductosQuery;
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
 * This class defines the structure of the 'productos' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProductosTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ProductosTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'productos';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Productos';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Productos';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the idproducto field
     */
    const COL_IDPRODUCTO = 'productos.idproducto';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'productos.nombre';

    /**
     * the column name for the detalle field
     */
    const COL_DETALLE = 'productos.detalle';

    /**
     * the column name for the descripcion field
     */
    const COL_DESCRIPCION = 'productos.descripcion';

    /**
     * the column name for the precio field
     */
    const COL_PRECIO = 'productos.precio';

    /**
     * the column name for the idsubcategoria field
     */
    const COL_IDSUBCATEGORIA = 'productos.idsubcategoria';

    /**
     * the column name for the iddescuento field
     */
    const COL_IDDESCUENTO = 'productos.iddescuento';

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
        self::TYPE_PHPNAME       => array('Idproducto', 'Nombre', 'Detalle', 'Descripcion', 'Precio', 'Idsubcategoria', 'Iddescuento', ),
        self::TYPE_CAMELNAME     => array('idproducto', 'nombre', 'detalle', 'descripcion', 'precio', 'idsubcategoria', 'iddescuento', ),
        self::TYPE_COLNAME       => array(ProductosTableMap::COL_IDPRODUCTO, ProductosTableMap::COL_NOMBRE, ProductosTableMap::COL_DETALLE, ProductosTableMap::COL_DESCRIPCION, ProductosTableMap::COL_PRECIO, ProductosTableMap::COL_IDSUBCATEGORIA, ProductosTableMap::COL_IDDESCUENTO, ),
        self::TYPE_FIELDNAME     => array('idproducto', 'nombre', 'detalle', 'descripcion', 'precio', 'idsubcategoria', 'iddescuento', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idproducto' => 0, 'Nombre' => 1, 'Detalle' => 2, 'Descripcion' => 3, 'Precio' => 4, 'Idsubcategoria' => 5, 'Iddescuento' => 6, ),
        self::TYPE_CAMELNAME     => array('idproducto' => 0, 'nombre' => 1, 'detalle' => 2, 'descripcion' => 3, 'precio' => 4, 'idsubcategoria' => 5, 'iddescuento' => 6, ),
        self::TYPE_COLNAME       => array(ProductosTableMap::COL_IDPRODUCTO => 0, ProductosTableMap::COL_NOMBRE => 1, ProductosTableMap::COL_DETALLE => 2, ProductosTableMap::COL_DESCRIPCION => 3, ProductosTableMap::COL_PRECIO => 4, ProductosTableMap::COL_IDSUBCATEGORIA => 5, ProductosTableMap::COL_IDDESCUENTO => 6, ),
        self::TYPE_FIELDNAME     => array('idproducto' => 0, 'nombre' => 1, 'detalle' => 2, 'descripcion' => 3, 'precio' => 4, 'idsubcategoria' => 5, 'iddescuento' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('productos');
        $this->setPhpName('Productos');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Productos');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idproducto', 'Idproducto', 'INTEGER', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', false, 200, null);
        $this->addColumn('detalle', 'Detalle', 'VARCHAR', false, 5000, null);
        $this->addColumn('descripcion', 'Descripcion', 'VARCHAR', false, 500, null);
        $this->addColumn('precio', 'Precio', 'DOUBLE', false, 7, null);
        $this->addForeignKey('idsubcategoria', 'Idsubcategoria', 'INTEGER', 'subcategorias', 'idsubcategoria', false, null, null);
        $this->addForeignKey('iddescuento', 'Iddescuento', 'INTEGER', 'descuentos', 'iddescuento', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Descuentos', '\\Descuentos', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':iddescuento',
    1 => ':iddescuento',
  ),
), null, null, null, false);
        $this->addRelation('Subcategorias', '\\Subcategorias', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idsubcategoria',
    1 => ':idsubcategoria',
  ),
), null, null, null, false);
        $this->addRelation('Detallecompras', '\\Detallecompras', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idproducto',
    1 => ':idproducto',
  ),
), null, null, 'Detallecomprass', false);
        $this->addRelation('Detallepedidos', '\\Detallepedidos', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idproducto',
    1 => ':idproducto',
  ),
), null, null, 'Detallepedidoss', false);
        $this->addRelation('Inventario', '\\Inventario', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idproducto',
    1 => ':idproducto',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ProductosTableMap::CLASS_DEFAULT : ProductosTableMap::OM_CLASS;
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
     * @return array           (Productos object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProductosTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductosTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductosTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductosTableMap::OM_CLASS;
            /** @var Productos $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductosTableMap::addInstanceToPool($obj, $key);
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
            $key = ProductosTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductosTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Productos $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductosTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ProductosTableMap::COL_IDPRODUCTO);
            $criteria->addSelectColumn(ProductosTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(ProductosTableMap::COL_DETALLE);
            $criteria->addSelectColumn(ProductosTableMap::COL_DESCRIPCION);
            $criteria->addSelectColumn(ProductosTableMap::COL_PRECIO);
            $criteria->addSelectColumn(ProductosTableMap::COL_IDSUBCATEGORIA);
            $criteria->addSelectColumn(ProductosTableMap::COL_IDDESCUENTO);
        } else {
            $criteria->addSelectColumn($alias . '.idproducto');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.detalle');
            $criteria->addSelectColumn($alias . '.descripcion');
            $criteria->addSelectColumn($alias . '.precio');
            $criteria->addSelectColumn($alias . '.idsubcategoria');
            $criteria->addSelectColumn($alias . '.iddescuento');
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
        return Propel::getServiceContainer()->getDatabaseMap(ProductosTableMap::DATABASE_NAME)->getTable(ProductosTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductosTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProductosTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProductosTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Productos or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Productos object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductosTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Productos) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductosTableMap::DATABASE_NAME);
            $criteria->add(ProductosTableMap::COL_IDPRODUCTO, (array) $values, Criteria::IN);
        }

        $query = ProductosQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductosTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductosTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the productos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProductosQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Productos or Criteria object.
     *
     * @param mixed               $criteria Criteria or Productos object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductosTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Productos object
        }

        if ($criteria->containsKey(ProductosTableMap::COL_IDPRODUCTO) && $criteria->keyContainsValue(ProductosTableMap::COL_IDPRODUCTO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductosTableMap::COL_IDPRODUCTO.')');
        }


        // Set the correct dbName
        $query = ProductosQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProductosTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProductosTableMap::buildTableMap();

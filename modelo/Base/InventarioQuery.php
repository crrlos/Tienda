<?php

namespace Base;

use \Inventario as ChildInventario;
use \InventarioQuery as ChildInventarioQuery;
use \Exception;
use \PDO;
use Map\InventarioTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'inventario' table.
 *
 *
 *
 * @method     ChildInventarioQuery orderByIdinventario($order = Criteria::ASC) Order by the idinventario column
 * @method     ChildInventarioQuery orderByIdtienda($order = Criteria::ASC) Order by the idtienda column
 * @method     ChildInventarioQuery orderByIdproducto($order = Criteria::ASC) Order by the idproducto column
 * @method     ChildInventarioQuery orderByCantidad($order = Criteria::ASC) Order by the cantidad column
 *
 * @method     ChildInventarioQuery groupByIdinventario() Group by the idinventario column
 * @method     ChildInventarioQuery groupByIdtienda() Group by the idtienda column
 * @method     ChildInventarioQuery groupByIdproducto() Group by the idproducto column
 * @method     ChildInventarioQuery groupByCantidad() Group by the cantidad column
 *
 * @method     ChildInventarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildInventarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildInventarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildInventarioQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildInventarioQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildInventarioQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildInventarioQuery leftJoinProductos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Productos relation
 * @method     ChildInventarioQuery rightJoinProductos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Productos relation
 * @method     ChildInventarioQuery innerJoinProductos($relationAlias = null) Adds a INNER JOIN clause to the query using the Productos relation
 *
 * @method     ChildInventarioQuery joinWithProductos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Productos relation
 *
 * @method     ChildInventarioQuery leftJoinWithProductos() Adds a LEFT JOIN clause and with to the query using the Productos relation
 * @method     ChildInventarioQuery rightJoinWithProductos() Adds a RIGHT JOIN clause and with to the query using the Productos relation
 * @method     ChildInventarioQuery innerJoinWithProductos() Adds a INNER JOIN clause and with to the query using the Productos relation
 *
 * @method     ChildInventarioQuery leftJoinTienda($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tienda relation
 * @method     ChildInventarioQuery rightJoinTienda($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tienda relation
 * @method     ChildInventarioQuery innerJoinTienda($relationAlias = null) Adds a INNER JOIN clause to the query using the Tienda relation
 *
 * @method     ChildInventarioQuery joinWithTienda($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tienda relation
 *
 * @method     ChildInventarioQuery leftJoinWithTienda() Adds a LEFT JOIN clause and with to the query using the Tienda relation
 * @method     ChildInventarioQuery rightJoinWithTienda() Adds a RIGHT JOIN clause and with to the query using the Tienda relation
 * @method     ChildInventarioQuery innerJoinWithTienda() Adds a INNER JOIN clause and with to the query using the Tienda relation
 *
 * @method     \ProductosQuery|\TiendaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildInventario findOne(ConnectionInterface $con = null) Return the first ChildInventario matching the query
 * @method     ChildInventario findOneOrCreate(ConnectionInterface $con = null) Return the first ChildInventario matching the query, or a new ChildInventario object populated from the query conditions when no match is found
 *
 * @method     ChildInventario findOneByIdinventario(int $idinventario) Return the first ChildInventario filtered by the idinventario column
 * @method     ChildInventario findOneByIdtienda(int $idtienda) Return the first ChildInventario filtered by the idtienda column
 * @method     ChildInventario findOneByIdproducto(int $idproducto) Return the first ChildInventario filtered by the idproducto column
 * @method     ChildInventario findOneByCantidad(int $cantidad) Return the first ChildInventario filtered by the cantidad column *

 * @method     ChildInventario requirePk($key, ConnectionInterface $con = null) Return the ChildInventario by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventario requireOne(ConnectionInterface $con = null) Return the first ChildInventario matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInventario requireOneByIdinventario(int $idinventario) Return the first ChildInventario filtered by the idinventario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventario requireOneByIdtienda(int $idtienda) Return the first ChildInventario filtered by the idtienda column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventario requireOneByIdproducto(int $idproducto) Return the first ChildInventario filtered by the idproducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildInventario requireOneByCantidad(int $cantidad) Return the first ChildInventario filtered by the cantidad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildInventario[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildInventario objects based on current ModelCriteria
 * @method     ChildInventario[]|ObjectCollection findByIdinventario(int $idinventario) Return ChildInventario objects filtered by the idinventario column
 * @method     ChildInventario[]|ObjectCollection findByIdtienda(int $idtienda) Return ChildInventario objects filtered by the idtienda column
 * @method     ChildInventario[]|ObjectCollection findByIdproducto(int $idproducto) Return ChildInventario objects filtered by the idproducto column
 * @method     ChildInventario[]|ObjectCollection findByCantidad(int $cantidad) Return ChildInventario objects filtered by the cantidad column
 * @method     ChildInventario[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class InventarioQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\InventarioQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Inventario', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildInventarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildInventarioQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildInventarioQuery) {
            return $criteria;
        }
        $query = new ChildInventarioQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildInventario|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = InventarioTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(InventarioTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInventario A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idinventario, idtienda, idproducto, cantidad FROM inventario WHERE idinventario = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildInventario $obj */
            $obj = new ChildInventario();
            $obj->hydrate($row);
            InventarioTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildInventario|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(InventarioTableMap::COL_IDINVENTARIO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(InventarioTableMap::COL_IDINVENTARIO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idinventario column
     *
     * Example usage:
     * <code>
     * $query->filterByIdinventario(1234); // WHERE idinventario = 1234
     * $query->filterByIdinventario(array(12, 34)); // WHERE idinventario IN (12, 34)
     * $query->filterByIdinventario(array('min' => 12)); // WHERE idinventario > 12
     * </code>
     *
     * @param     mixed $idinventario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function filterByIdinventario($idinventario = null, $comparison = null)
    {
        if (is_array($idinventario)) {
            $useMinMax = false;
            if (isset($idinventario['min'])) {
                $this->addUsingAlias(InventarioTableMap::COL_IDINVENTARIO, $idinventario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idinventario['max'])) {
                $this->addUsingAlias(InventarioTableMap::COL_IDINVENTARIO, $idinventario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventarioTableMap::COL_IDINVENTARIO, $idinventario, $comparison);
    }

    /**
     * Filter the query on the idtienda column
     *
     * Example usage:
     * <code>
     * $query->filterByIdtienda(1234); // WHERE idtienda = 1234
     * $query->filterByIdtienda(array(12, 34)); // WHERE idtienda IN (12, 34)
     * $query->filterByIdtienda(array('min' => 12)); // WHERE idtienda > 12
     * </code>
     *
     * @see       filterByTienda()
     *
     * @param     mixed $idtienda The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function filterByIdtienda($idtienda = null, $comparison = null)
    {
        if (is_array($idtienda)) {
            $useMinMax = false;
            if (isset($idtienda['min'])) {
                $this->addUsingAlias(InventarioTableMap::COL_IDTIENDA, $idtienda['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idtienda['max'])) {
                $this->addUsingAlias(InventarioTableMap::COL_IDTIENDA, $idtienda['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventarioTableMap::COL_IDTIENDA, $idtienda, $comparison);
    }

    /**
     * Filter the query on the idproducto column
     *
     * Example usage:
     * <code>
     * $query->filterByIdproducto(1234); // WHERE idproducto = 1234
     * $query->filterByIdproducto(array(12, 34)); // WHERE idproducto IN (12, 34)
     * $query->filterByIdproducto(array('min' => 12)); // WHERE idproducto > 12
     * </code>
     *
     * @see       filterByProductos()
     *
     * @param     mixed $idproducto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function filterByIdproducto($idproducto = null, $comparison = null)
    {
        if (is_array($idproducto)) {
            $useMinMax = false;
            if (isset($idproducto['min'])) {
                $this->addUsingAlias(InventarioTableMap::COL_IDPRODUCTO, $idproducto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idproducto['max'])) {
                $this->addUsingAlias(InventarioTableMap::COL_IDPRODUCTO, $idproducto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventarioTableMap::COL_IDPRODUCTO, $idproducto, $comparison);
    }

    /**
     * Filter the query on the cantidad column
     *
     * Example usage:
     * <code>
     * $query->filterByCantidad(1234); // WHERE cantidad = 1234
     * $query->filterByCantidad(array(12, 34)); // WHERE cantidad IN (12, 34)
     * $query->filterByCantidad(array('min' => 12)); // WHERE cantidad > 12
     * </code>
     *
     * @param     mixed $cantidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function filterByCantidad($cantidad = null, $comparison = null)
    {
        if (is_array($cantidad)) {
            $useMinMax = false;
            if (isset($cantidad['min'])) {
                $this->addUsingAlias(InventarioTableMap::COL_CANTIDAD, $cantidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantidad['max'])) {
                $this->addUsingAlias(InventarioTableMap::COL_CANTIDAD, $cantidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(InventarioTableMap::COL_CANTIDAD, $cantidad, $comparison);
    }

    /**
     * Filter the query by a related \Productos object
     *
     * @param \Productos|ObjectCollection $productos The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInventarioQuery The current query, for fluid interface
     */
    public function filterByProductos($productos, $comparison = null)
    {
        if ($productos instanceof \Productos) {
            return $this
                ->addUsingAlias(InventarioTableMap::COL_IDPRODUCTO, $productos->getIdproducto(), $comparison);
        } elseif ($productos instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InventarioTableMap::COL_IDPRODUCTO, $productos->toKeyValue('PrimaryKey', 'Idproducto'), $comparison);
        } else {
            throw new PropelException('filterByProductos() only accepts arguments of type \Productos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Productos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function joinProductos($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Productos');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Productos');
        }

        return $this;
    }

    /**
     * Use the Productos relation Productos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProductosQuery A secondary query class using the current class as primary query
     */
    public function useProductosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProductos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Productos', '\ProductosQuery');
    }

    /**
     * Filter the query by a related \Tienda object
     *
     * @param \Tienda|ObjectCollection $tienda The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildInventarioQuery The current query, for fluid interface
     */
    public function filterByTienda($tienda, $comparison = null)
    {
        if ($tienda instanceof \Tienda) {
            return $this
                ->addUsingAlias(InventarioTableMap::COL_IDTIENDA, $tienda->getIdtienda(), $comparison);
        } elseif ($tienda instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(InventarioTableMap::COL_IDTIENDA, $tienda->toKeyValue('PrimaryKey', 'Idtienda'), $comparison);
        } else {
            throw new PropelException('filterByTienda() only accepts arguments of type \Tienda or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tienda relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function joinTienda($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tienda');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Tienda');
        }

        return $this;
    }

    /**
     * Use the Tienda relation Tienda object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TiendaQuery A secondary query class using the current class as primary query
     */
    public function useTiendaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTienda($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tienda', '\TiendaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildInventario $inventario Object to remove from the list of results
     *
     * @return $this|ChildInventarioQuery The current query, for fluid interface
     */
    public function prune($inventario = null)
    {
        if ($inventario) {
            $this->addUsingAlias(InventarioTableMap::COL_IDINVENTARIO, $inventario->getIdinventario(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the inventario table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InventarioTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            InventarioTableMap::clearInstancePool();
            InventarioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(InventarioTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(InventarioTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            InventarioTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            InventarioTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // InventarioQuery

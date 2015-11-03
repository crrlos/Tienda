<?php

namespace Base;

use \Ventas as ChildVentas;
use \VentasQuery as ChildVentasQuery;
use \Exception;
use \PDO;
use Map\VentasTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'ventas' table.
 *
 *
 *
 * @method     ChildVentasQuery orderByIdventa($order = Criteria::ASC) Order by the idventa column
 * @method     ChildVentasQuery orderByIdpedido($order = Criteria::ASC) Order by the idpedido column
 * @method     ChildVentasQuery orderByFecha($order = Criteria::ASC) Order by the fecha column
 * @method     ChildVentasQuery orderByFormapago($order = Criteria::ASC) Order by the formapago column
 * @method     ChildVentasQuery orderByCodigotransaccion($order = Criteria::ASC) Order by the codigotransaccion column
 *
 * @method     ChildVentasQuery groupByIdventa() Group by the idventa column
 * @method     ChildVentasQuery groupByIdpedido() Group by the idpedido column
 * @method     ChildVentasQuery groupByFecha() Group by the fecha column
 * @method     ChildVentasQuery groupByFormapago() Group by the formapago column
 * @method     ChildVentasQuery groupByCodigotransaccion() Group by the codigotransaccion column
 *
 * @method     ChildVentasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVentasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVentasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVentasQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVentasQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVentasQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVentasQuery leftJoinPedidos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedidos relation
 * @method     ChildVentasQuery rightJoinPedidos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedidos relation
 * @method     ChildVentasQuery innerJoinPedidos($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedidos relation
 *
 * @method     ChildVentasQuery joinWithPedidos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pedidos relation
 *
 * @method     ChildVentasQuery leftJoinWithPedidos() Adds a LEFT JOIN clause and with to the query using the Pedidos relation
 * @method     ChildVentasQuery rightJoinWithPedidos() Adds a RIGHT JOIN clause and with to the query using the Pedidos relation
 * @method     ChildVentasQuery innerJoinWithPedidos() Adds a INNER JOIN clause and with to the query using the Pedidos relation
 *
 * @method     \PedidosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildVentas findOne(ConnectionInterface $con = null) Return the first ChildVentas matching the query
 * @method     ChildVentas findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVentas matching the query, or a new ChildVentas object populated from the query conditions when no match is found
 *
 * @method     ChildVentas findOneByIdventa(int $idventa) Return the first ChildVentas filtered by the idventa column
 * @method     ChildVentas findOneByIdpedido(int $idpedido) Return the first ChildVentas filtered by the idpedido column
 * @method     ChildVentas findOneByFecha(string $fecha) Return the first ChildVentas filtered by the fecha column
 * @method     ChildVentas findOneByFormapago(string $formapago) Return the first ChildVentas filtered by the formapago column
 * @method     ChildVentas findOneByCodigotransaccion(string $codigotransaccion) Return the first ChildVentas filtered by the codigotransaccion column *

 * @method     ChildVentas requirePk($key, ConnectionInterface $con = null) Return the ChildVentas by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVentas requireOne(ConnectionInterface $con = null) Return the first ChildVentas matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVentas requireOneByIdventa(int $idventa) Return the first ChildVentas filtered by the idventa column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVentas requireOneByIdpedido(int $idpedido) Return the first ChildVentas filtered by the idpedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVentas requireOneByFecha(string $fecha) Return the first ChildVentas filtered by the fecha column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVentas requireOneByFormapago(string $formapago) Return the first ChildVentas filtered by the formapago column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVentas requireOneByCodigotransaccion(string $codigotransaccion) Return the first ChildVentas filtered by the codigotransaccion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVentas[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVentas objects based on current ModelCriteria
 * @method     ChildVentas[]|ObjectCollection findByIdventa(int $idventa) Return ChildVentas objects filtered by the idventa column
 * @method     ChildVentas[]|ObjectCollection findByIdpedido(int $idpedido) Return ChildVentas objects filtered by the idpedido column
 * @method     ChildVentas[]|ObjectCollection findByFecha(string $fecha) Return ChildVentas objects filtered by the fecha column
 * @method     ChildVentas[]|ObjectCollection findByFormapago(string $formapago) Return ChildVentas objects filtered by the formapago column
 * @method     ChildVentas[]|ObjectCollection findByCodigotransaccion(string $codigotransaccion) Return ChildVentas objects filtered by the codigotransaccion column
 * @method     ChildVentas[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VentasQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\VentasQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Ventas', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVentasQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVentasQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVentasQuery) {
            return $criteria;
        }
        $query = new ChildVentasQuery();
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
     * @return ChildVentas|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VentasTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VentasTableMap::DATABASE_NAME);
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
     * @return ChildVentas A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idventa, idpedido, fecha, formapago, codigotransaccion FROM ventas WHERE idventa = :p0';
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
            /** @var ChildVentas $obj */
            $obj = new ChildVentas();
            $obj->hydrate($row);
            VentasTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildVentas|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VentasTableMap::COL_IDVENTA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VentasTableMap::COL_IDVENTA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idventa column
     *
     * Example usage:
     * <code>
     * $query->filterByIdventa(1234); // WHERE idventa = 1234
     * $query->filterByIdventa(array(12, 34)); // WHERE idventa IN (12, 34)
     * $query->filterByIdventa(array('min' => 12)); // WHERE idventa > 12
     * </code>
     *
     * @param     mixed $idventa The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function filterByIdventa($idventa = null, $comparison = null)
    {
        if (is_array($idventa)) {
            $useMinMax = false;
            if (isset($idventa['min'])) {
                $this->addUsingAlias(VentasTableMap::COL_IDVENTA, $idventa['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idventa['max'])) {
                $this->addUsingAlias(VentasTableMap::COL_IDVENTA, $idventa['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentasTableMap::COL_IDVENTA, $idventa, $comparison);
    }

    /**
     * Filter the query on the idpedido column
     *
     * Example usage:
     * <code>
     * $query->filterByIdpedido(1234); // WHERE idpedido = 1234
     * $query->filterByIdpedido(array(12, 34)); // WHERE idpedido IN (12, 34)
     * $query->filterByIdpedido(array('min' => 12)); // WHERE idpedido > 12
     * </code>
     *
     * @see       filterByPedidos()
     *
     * @param     mixed $idpedido The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function filterByIdpedido($idpedido = null, $comparison = null)
    {
        if (is_array($idpedido)) {
            $useMinMax = false;
            if (isset($idpedido['min'])) {
                $this->addUsingAlias(VentasTableMap::COL_IDPEDIDO, $idpedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idpedido['max'])) {
                $this->addUsingAlias(VentasTableMap::COL_IDPEDIDO, $idpedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentasTableMap::COL_IDPEDIDO, $idpedido, $comparison);
    }

    /**
     * Filter the query on the fecha column
     *
     * Example usage:
     * <code>
     * $query->filterByFecha('2011-03-14'); // WHERE fecha = '2011-03-14'
     * $query->filterByFecha('now'); // WHERE fecha = '2011-03-14'
     * $query->filterByFecha(array('max' => 'yesterday')); // WHERE fecha > '2011-03-13'
     * </code>
     *
     * @param     mixed $fecha The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function filterByFecha($fecha = null, $comparison = null)
    {
        if (is_array($fecha)) {
            $useMinMax = false;
            if (isset($fecha['min'])) {
                $this->addUsingAlias(VentasTableMap::COL_FECHA, $fecha['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fecha['max'])) {
                $this->addUsingAlias(VentasTableMap::COL_FECHA, $fecha['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentasTableMap::COL_FECHA, $fecha, $comparison);
    }

    /**
     * Filter the query on the formapago column
     *
     * Example usage:
     * <code>
     * $query->filterByFormapago('fooValue');   // WHERE formapago = 'fooValue'
     * $query->filterByFormapago('%fooValue%'); // WHERE formapago LIKE '%fooValue%'
     * </code>
     *
     * @param     string $formapago The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function filterByFormapago($formapago = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formapago)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $formapago)) {
                $formapago = str_replace('*', '%', $formapago);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VentasTableMap::COL_FORMAPAGO, $formapago, $comparison);
    }

    /**
     * Filter the query on the codigotransaccion column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigotransaccion('fooValue');   // WHERE codigotransaccion = 'fooValue'
     * $query->filterByCodigotransaccion('%fooValue%'); // WHERE codigotransaccion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codigotransaccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function filterByCodigotransaccion($codigotransaccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigotransaccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $codigotransaccion)) {
                $codigotransaccion = str_replace('*', '%', $codigotransaccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VentasTableMap::COL_CODIGOTRANSACCION, $codigotransaccion, $comparison);
    }

    /**
     * Filter the query by a related \Pedidos object
     *
     * @param \Pedidos|ObjectCollection $pedidos The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildVentasQuery The current query, for fluid interface
     */
    public function filterByPedidos($pedidos, $comparison = null)
    {
        if ($pedidos instanceof \Pedidos) {
            return $this
                ->addUsingAlias(VentasTableMap::COL_IDPEDIDO, $pedidos->getIdpedido(), $comparison);
        } elseif ($pedidos instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VentasTableMap::COL_IDPEDIDO, $pedidos->toKeyValue('PrimaryKey', 'Idpedido'), $comparison);
        } else {
            throw new PropelException('filterByPedidos() only accepts arguments of type \Pedidos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pedidos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function joinPedidos($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pedidos');

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
            $this->addJoinObject($join, 'Pedidos');
        }

        return $this;
    }

    /**
     * Use the Pedidos relation Pedidos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PedidosQuery A secondary query class using the current class as primary query
     */
    public function usePedidosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPedidos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pedidos', '\PedidosQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVentas $ventas Object to remove from the list of results
     *
     * @return $this|ChildVentasQuery The current query, for fluid interface
     */
    public function prune($ventas = null)
    {
        if ($ventas) {
            $this->addUsingAlias(VentasTableMap::COL_IDVENTA, $ventas->getIdventa(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the ventas table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VentasTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VentasTableMap::clearInstancePool();
            VentasTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VentasTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VentasTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VentasTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VentasTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VentasQuery

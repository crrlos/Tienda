<?php

namespace Base;

use \Compras as ChildCompras;
use \ComprasQuery as ChildComprasQuery;
use \Exception;
use \PDO;
use Map\ComprasTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'compras' table.
 *
 *
 *
 * @method     ChildComprasQuery orderByIdcompra($order = Criteria::ASC) Order by the idcompra column
 * @method     ChildComprasQuery orderByFecha($order = Criteria::ASC) Order by the fecha column
 * @method     ChildComprasQuery orderByDetalle($order = Criteria::ASC) Order by the detalle column
 *
 * @method     ChildComprasQuery groupByIdcompra() Group by the idcompra column
 * @method     ChildComprasQuery groupByFecha() Group by the fecha column
 * @method     ChildComprasQuery groupByDetalle() Group by the detalle column
 *
 * @method     ChildComprasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildComprasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildComprasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildComprasQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildComprasQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildComprasQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildComprasQuery leftJoinDetallecompras($relationAlias = null) Adds a LEFT JOIN clause to the query using the Detallecompras relation
 * @method     ChildComprasQuery rightJoinDetallecompras($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Detallecompras relation
 * @method     ChildComprasQuery innerJoinDetallecompras($relationAlias = null) Adds a INNER JOIN clause to the query using the Detallecompras relation
 *
 * @method     ChildComprasQuery joinWithDetallecompras($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Detallecompras relation
 *
 * @method     ChildComprasQuery leftJoinWithDetallecompras() Adds a LEFT JOIN clause and with to the query using the Detallecompras relation
 * @method     ChildComprasQuery rightJoinWithDetallecompras() Adds a RIGHT JOIN clause and with to the query using the Detallecompras relation
 * @method     ChildComprasQuery innerJoinWithDetallecompras() Adds a INNER JOIN clause and with to the query using the Detallecompras relation
 *
 * @method     \DetallecomprasQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCompras findOne(ConnectionInterface $con = null) Return the first ChildCompras matching the query
 * @method     ChildCompras findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCompras matching the query, or a new ChildCompras object populated from the query conditions when no match is found
 *
 * @method     ChildCompras findOneByIdcompra(int $idcompra) Return the first ChildCompras filtered by the idcompra column
 * @method     ChildCompras findOneByFecha(string $fecha) Return the first ChildCompras filtered by the fecha column
 * @method     ChildCompras findOneByDetalle(string $detalle) Return the first ChildCompras filtered by the detalle column *

 * @method     ChildCompras requirePk($key, ConnectionInterface $con = null) Return the ChildCompras by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompras requireOne(ConnectionInterface $con = null) Return the first ChildCompras matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompras requireOneByIdcompra(int $idcompra) Return the first ChildCompras filtered by the idcompra column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompras requireOneByFecha(string $fecha) Return the first ChildCompras filtered by the fecha column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCompras requireOneByDetalle(string $detalle) Return the first ChildCompras filtered by the detalle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCompras[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCompras objects based on current ModelCriteria
 * @method     ChildCompras[]|ObjectCollection findByIdcompra(int $idcompra) Return ChildCompras objects filtered by the idcompra column
 * @method     ChildCompras[]|ObjectCollection findByFecha(string $fecha) Return ChildCompras objects filtered by the fecha column
 * @method     ChildCompras[]|ObjectCollection findByDetalle(string $detalle) Return ChildCompras objects filtered by the detalle column
 * @method     ChildCompras[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ComprasQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ComprasQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Compras', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildComprasQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildComprasQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildComprasQuery) {
            return $criteria;
        }
        $query = new ChildComprasQuery();
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
     * @return ChildCompras|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ComprasTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ComprasTableMap::DATABASE_NAME);
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
     * @return ChildCompras A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idcompra, fecha, detalle FROM compras WHERE idcompra = :p0';
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
            /** @var ChildCompras $obj */
            $obj = new ChildCompras();
            $obj->hydrate($row);
            ComprasTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCompras|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildComprasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ComprasTableMap::COL_IDCOMPRA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildComprasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ComprasTableMap::COL_IDCOMPRA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idcompra column
     *
     * Example usage:
     * <code>
     * $query->filterByIdcompra(1234); // WHERE idcompra = 1234
     * $query->filterByIdcompra(array(12, 34)); // WHERE idcompra IN (12, 34)
     * $query->filterByIdcompra(array('min' => 12)); // WHERE idcompra > 12
     * </code>
     *
     * @param     mixed $idcompra The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildComprasQuery The current query, for fluid interface
     */
    public function filterByIdcompra($idcompra = null, $comparison = null)
    {
        if (is_array($idcompra)) {
            $useMinMax = false;
            if (isset($idcompra['min'])) {
                $this->addUsingAlias(ComprasTableMap::COL_IDCOMPRA, $idcompra['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idcompra['max'])) {
                $this->addUsingAlias(ComprasTableMap::COL_IDCOMPRA, $idcompra['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComprasTableMap::COL_IDCOMPRA, $idcompra, $comparison);
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
     * @return $this|ChildComprasQuery The current query, for fluid interface
     */
    public function filterByFecha($fecha = null, $comparison = null)
    {
        if (is_array($fecha)) {
            $useMinMax = false;
            if (isset($fecha['min'])) {
                $this->addUsingAlias(ComprasTableMap::COL_FECHA, $fecha['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fecha['max'])) {
                $this->addUsingAlias(ComprasTableMap::COL_FECHA, $fecha['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ComprasTableMap::COL_FECHA, $fecha, $comparison);
    }

    /**
     * Filter the query on the detalle column
     *
     * Example usage:
     * <code>
     * $query->filterByDetalle('fooValue');   // WHERE detalle = 'fooValue'
     * $query->filterByDetalle('%fooValue%'); // WHERE detalle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $detalle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildComprasQuery The current query, for fluid interface
     */
    public function filterByDetalle($detalle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($detalle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $detalle)) {
                $detalle = str_replace('*', '%', $detalle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ComprasTableMap::COL_DETALLE, $detalle, $comparison);
    }

    /**
     * Filter the query by a related \Detallecompras object
     *
     * @param \Detallecompras|ObjectCollection $detallecompras the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildComprasQuery The current query, for fluid interface
     */
    public function filterByDetallecompras($detallecompras, $comparison = null)
    {
        if ($detallecompras instanceof \Detallecompras) {
            return $this
                ->addUsingAlias(ComprasTableMap::COL_IDCOMPRA, $detallecompras->getIdcompra(), $comparison);
        } elseif ($detallecompras instanceof ObjectCollection) {
            return $this
                ->useDetallecomprasQuery()
                ->filterByPrimaryKeys($detallecompras->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDetallecompras() only accepts arguments of type \Detallecompras or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Detallecompras relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildComprasQuery The current query, for fluid interface
     */
    public function joinDetallecompras($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Detallecompras');

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
            $this->addJoinObject($join, 'Detallecompras');
        }

        return $this;
    }

    /**
     * Use the Detallecompras relation Detallecompras object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DetallecomprasQuery A secondary query class using the current class as primary query
     */
    public function useDetallecomprasQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDetallecompras($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Detallecompras', '\DetallecomprasQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCompras $compras Object to remove from the list of results
     *
     * @return $this|ChildComprasQuery The current query, for fluid interface
     */
    public function prune($compras = null)
    {
        if ($compras) {
            $this->addUsingAlias(ComprasTableMap::COL_IDCOMPRA, $compras->getIdcompra(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the compras table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ComprasTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ComprasTableMap::clearInstancePool();
            ComprasTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ComprasTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ComprasTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ComprasTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ComprasTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ComprasQuery

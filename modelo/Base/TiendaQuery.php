<?php

namespace Base;

use \Tienda as ChildTienda;
use \TiendaQuery as ChildTiendaQuery;
use \Exception;
use \PDO;
use Map\TiendaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tienda' table.
 *
 *
 *
 * @method     ChildTiendaQuery orderByIdtienda($order = Criteria::ASC) Order by the idtienda column
 * @method     ChildTiendaQuery orderByDireccion($order = Criteria::ASC) Order by the direccion column
 * @method     ChildTiendaQuery orderByIddepartamento($order = Criteria::ASC) Order by the iddepartamento column
 * @method     ChildTiendaQuery orderByIdmunicipio($order = Criteria::ASC) Order by the idmunicipio column
 * @method     ChildTiendaQuery orderByTelefono($order = Criteria::ASC) Order by the telefono column
 *
 * @method     ChildTiendaQuery groupByIdtienda() Group by the idtienda column
 * @method     ChildTiendaQuery groupByDireccion() Group by the direccion column
 * @method     ChildTiendaQuery groupByIddepartamento() Group by the iddepartamento column
 * @method     ChildTiendaQuery groupByIdmunicipio() Group by the idmunicipio column
 * @method     ChildTiendaQuery groupByTelefono() Group by the telefono column
 *
 * @method     ChildTiendaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTiendaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTiendaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTiendaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTiendaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTiendaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTiendaQuery leftJoinInventario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Inventario relation
 * @method     ChildTiendaQuery rightJoinInventario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Inventario relation
 * @method     ChildTiendaQuery innerJoinInventario($relationAlias = null) Adds a INNER JOIN clause to the query using the Inventario relation
 *
 * @method     ChildTiendaQuery joinWithInventario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Inventario relation
 *
 * @method     ChildTiendaQuery leftJoinWithInventario() Adds a LEFT JOIN clause and with to the query using the Inventario relation
 * @method     ChildTiendaQuery rightJoinWithInventario() Adds a RIGHT JOIN clause and with to the query using the Inventario relation
 * @method     ChildTiendaQuery innerJoinWithInventario() Adds a INNER JOIN clause and with to the query using the Inventario relation
 *
 * @method     \InventarioQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTienda findOne(ConnectionInterface $con = null) Return the first ChildTienda matching the query
 * @method     ChildTienda findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTienda matching the query, or a new ChildTienda object populated from the query conditions when no match is found
 *
 * @method     ChildTienda findOneByIdtienda(int $idtienda) Return the first ChildTienda filtered by the idtienda column
 * @method     ChildTienda findOneByDireccion(string $direccion) Return the first ChildTienda filtered by the direccion column
 * @method     ChildTienda findOneByIddepartamento(int $iddepartamento) Return the first ChildTienda filtered by the iddepartamento column
 * @method     ChildTienda findOneByIdmunicipio(int $idmunicipio) Return the first ChildTienda filtered by the idmunicipio column
 * @method     ChildTienda findOneByTelefono(string $telefono) Return the first ChildTienda filtered by the telefono column *

 * @method     ChildTienda requirePk($key, ConnectionInterface $con = null) Return the ChildTienda by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTienda requireOne(ConnectionInterface $con = null) Return the first ChildTienda matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTienda requireOneByIdtienda(int $idtienda) Return the first ChildTienda filtered by the idtienda column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTienda requireOneByDireccion(string $direccion) Return the first ChildTienda filtered by the direccion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTienda requireOneByIddepartamento(int $iddepartamento) Return the first ChildTienda filtered by the iddepartamento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTienda requireOneByIdmunicipio(int $idmunicipio) Return the first ChildTienda filtered by the idmunicipio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTienda requireOneByTelefono(string $telefono) Return the first ChildTienda filtered by the telefono column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTienda[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTienda objects based on current ModelCriteria
 * @method     ChildTienda[]|ObjectCollection findByIdtienda(int $idtienda) Return ChildTienda objects filtered by the idtienda column
 * @method     ChildTienda[]|ObjectCollection findByDireccion(string $direccion) Return ChildTienda objects filtered by the direccion column
 * @method     ChildTienda[]|ObjectCollection findByIddepartamento(int $iddepartamento) Return ChildTienda objects filtered by the iddepartamento column
 * @method     ChildTienda[]|ObjectCollection findByIdmunicipio(int $idmunicipio) Return ChildTienda objects filtered by the idmunicipio column
 * @method     ChildTienda[]|ObjectCollection findByTelefono(string $telefono) Return ChildTienda objects filtered by the telefono column
 * @method     ChildTienda[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TiendaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\TiendaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Tienda', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTiendaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTiendaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTiendaQuery) {
            return $criteria;
        }
        $query = new ChildTiendaQuery();
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
     * @return ChildTienda|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TiendaTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TiendaTableMap::DATABASE_NAME);
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
     * @return ChildTienda A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idtienda, direccion, iddepartamento, idmunicipio, telefono FROM tienda WHERE idtienda = :p0';
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
            /** @var ChildTienda $obj */
            $obj = new ChildTienda();
            $obj->hydrate($row);
            TiendaTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildTienda|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TiendaTableMap::COL_IDTIENDA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TiendaTableMap::COL_IDTIENDA, $keys, Criteria::IN);
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
     * @param     mixed $idtienda The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function filterByIdtienda($idtienda = null, $comparison = null)
    {
        if (is_array($idtienda)) {
            $useMinMax = false;
            if (isset($idtienda['min'])) {
                $this->addUsingAlias(TiendaTableMap::COL_IDTIENDA, $idtienda['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idtienda['max'])) {
                $this->addUsingAlias(TiendaTableMap::COL_IDTIENDA, $idtienda['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TiendaTableMap::COL_IDTIENDA, $idtienda, $comparison);
    }

    /**
     * Filter the query on the direccion column
     *
     * Example usage:
     * <code>
     * $query->filterByDireccion('fooValue');   // WHERE direccion = 'fooValue'
     * $query->filterByDireccion('%fooValue%'); // WHERE direccion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $direccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function filterByDireccion($direccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($direccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $direccion)) {
                $direccion = str_replace('*', '%', $direccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TiendaTableMap::COL_DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the iddepartamento column
     *
     * Example usage:
     * <code>
     * $query->filterByIddepartamento(1234); // WHERE iddepartamento = 1234
     * $query->filterByIddepartamento(array(12, 34)); // WHERE iddepartamento IN (12, 34)
     * $query->filterByIddepartamento(array('min' => 12)); // WHERE iddepartamento > 12
     * </code>
     *
     * @param     mixed $iddepartamento The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function filterByIddepartamento($iddepartamento = null, $comparison = null)
    {
        if (is_array($iddepartamento)) {
            $useMinMax = false;
            if (isset($iddepartamento['min'])) {
                $this->addUsingAlias(TiendaTableMap::COL_IDDEPARTAMENTO, $iddepartamento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iddepartamento['max'])) {
                $this->addUsingAlias(TiendaTableMap::COL_IDDEPARTAMENTO, $iddepartamento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TiendaTableMap::COL_IDDEPARTAMENTO, $iddepartamento, $comparison);
    }

    /**
     * Filter the query on the idmunicipio column
     *
     * Example usage:
     * <code>
     * $query->filterByIdmunicipio(1234); // WHERE idmunicipio = 1234
     * $query->filterByIdmunicipio(array(12, 34)); // WHERE idmunicipio IN (12, 34)
     * $query->filterByIdmunicipio(array('min' => 12)); // WHERE idmunicipio > 12
     * </code>
     *
     * @param     mixed $idmunicipio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function filterByIdmunicipio($idmunicipio = null, $comparison = null)
    {
        if (is_array($idmunicipio)) {
            $useMinMax = false;
            if (isset($idmunicipio['min'])) {
                $this->addUsingAlias(TiendaTableMap::COL_IDMUNICIPIO, $idmunicipio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idmunicipio['max'])) {
                $this->addUsingAlias(TiendaTableMap::COL_IDMUNICIPIO, $idmunicipio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TiendaTableMap::COL_IDMUNICIPIO, $idmunicipio, $comparison);
    }

    /**
     * Filter the query on the telefono column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefono('fooValue');   // WHERE telefono = 'fooValue'
     * $query->filterByTelefono('%fooValue%'); // WHERE telefono LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefono The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function filterByTelefono($telefono = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefono)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefono)) {
                $telefono = str_replace('*', '%', $telefono);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TiendaTableMap::COL_TELEFONO, $telefono, $comparison);
    }

    /**
     * Filter the query by a related \Inventario object
     *
     * @param \Inventario|ObjectCollection $inventario the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTiendaQuery The current query, for fluid interface
     */
    public function filterByInventario($inventario, $comparison = null)
    {
        if ($inventario instanceof \Inventario) {
            return $this
                ->addUsingAlias(TiendaTableMap::COL_IDTIENDA, $inventario->getIdtienda(), $comparison);
        } elseif ($inventario instanceof ObjectCollection) {
            return $this
                ->useInventarioQuery()
                ->filterByPrimaryKeys($inventario->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByInventario() only accepts arguments of type \Inventario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Inventario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function joinInventario($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Inventario');

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
            $this->addJoinObject($join, 'Inventario');
        }

        return $this;
    }

    /**
     * Use the Inventario relation Inventario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \InventarioQuery A secondary query class using the current class as primary query
     */
    public function useInventarioQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinInventario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Inventario', '\InventarioQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTienda $tienda Object to remove from the list of results
     *
     * @return $this|ChildTiendaQuery The current query, for fluid interface
     */
    public function prune($tienda = null)
    {
        if ($tienda) {
            $this->addUsingAlias(TiendaTableMap::COL_IDTIENDA, $tienda->getIdtienda(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tienda table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TiendaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TiendaTableMap::clearInstancePool();
            TiendaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(TiendaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TiendaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TiendaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TiendaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TiendaQuery

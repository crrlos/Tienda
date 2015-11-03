<?php

namespace Base;

use \Subcategorias as ChildSubcategorias;
use \SubcategoriasQuery as ChildSubcategoriasQuery;
use \Exception;
use \PDO;
use Map\SubcategoriasTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'subcategorias' table.
 *
 *
 *
 * @method     ChildSubcategoriasQuery orderByIdsubcategoria($order = Criteria::ASC) Order by the idsubcategoria column
 * @method     ChildSubcategoriasQuery orderByIdcategoria($order = Criteria::ASC) Order by the idcategoria column
 * @method     ChildSubcategoriasQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 *
 * @method     ChildSubcategoriasQuery groupByIdsubcategoria() Group by the idsubcategoria column
 * @method     ChildSubcategoriasQuery groupByIdcategoria() Group by the idcategoria column
 * @method     ChildSubcategoriasQuery groupByNombre() Group by the nombre column
 *
 * @method     ChildSubcategoriasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSubcategoriasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSubcategoriasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSubcategoriasQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSubcategoriasQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSubcategoriasQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSubcategoriasQuery leftJoinCategorias($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categorias relation
 * @method     ChildSubcategoriasQuery rightJoinCategorias($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categorias relation
 * @method     ChildSubcategoriasQuery innerJoinCategorias($relationAlias = null) Adds a INNER JOIN clause to the query using the Categorias relation
 *
 * @method     ChildSubcategoriasQuery joinWithCategorias($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Categorias relation
 *
 * @method     ChildSubcategoriasQuery leftJoinWithCategorias() Adds a LEFT JOIN clause and with to the query using the Categorias relation
 * @method     ChildSubcategoriasQuery rightJoinWithCategorias() Adds a RIGHT JOIN clause and with to the query using the Categorias relation
 * @method     ChildSubcategoriasQuery innerJoinWithCategorias() Adds a INNER JOIN clause and with to the query using the Categorias relation
 *
 * @method     ChildSubcategoriasQuery leftJoinProductos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Productos relation
 * @method     ChildSubcategoriasQuery rightJoinProductos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Productos relation
 * @method     ChildSubcategoriasQuery innerJoinProductos($relationAlias = null) Adds a INNER JOIN clause to the query using the Productos relation
 *
 * @method     ChildSubcategoriasQuery joinWithProductos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Productos relation
 *
 * @method     ChildSubcategoriasQuery leftJoinWithProductos() Adds a LEFT JOIN clause and with to the query using the Productos relation
 * @method     ChildSubcategoriasQuery rightJoinWithProductos() Adds a RIGHT JOIN clause and with to the query using the Productos relation
 * @method     ChildSubcategoriasQuery innerJoinWithProductos() Adds a INNER JOIN clause and with to the query using the Productos relation
 *
 * @method     \CategoriasQuery|\ProductosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSubcategorias findOne(ConnectionInterface $con = null) Return the first ChildSubcategorias matching the query
 * @method     ChildSubcategorias findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSubcategorias matching the query, or a new ChildSubcategorias object populated from the query conditions when no match is found
 *
 * @method     ChildSubcategorias findOneByIdsubcategoria(int $idsubcategoria) Return the first ChildSubcategorias filtered by the idsubcategoria column
 * @method     ChildSubcategorias findOneByIdcategoria(int $idcategoria) Return the first ChildSubcategorias filtered by the idcategoria column
 * @method     ChildSubcategorias findOneByNombre(string $nombre) Return the first ChildSubcategorias filtered by the nombre column *

 * @method     ChildSubcategorias requirePk($key, ConnectionInterface $con = null) Return the ChildSubcategorias by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubcategorias requireOne(ConnectionInterface $con = null) Return the first ChildSubcategorias matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubcategorias requireOneByIdsubcategoria(int $idsubcategoria) Return the first ChildSubcategorias filtered by the idsubcategoria column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubcategorias requireOneByIdcategoria(int $idcategoria) Return the first ChildSubcategorias filtered by the idcategoria column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSubcategorias requireOneByNombre(string $nombre) Return the first ChildSubcategorias filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSubcategorias[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSubcategorias objects based on current ModelCriteria
 * @method     ChildSubcategorias[]|ObjectCollection findByIdsubcategoria(int $idsubcategoria) Return ChildSubcategorias objects filtered by the idsubcategoria column
 * @method     ChildSubcategorias[]|ObjectCollection findByIdcategoria(int $idcategoria) Return ChildSubcategorias objects filtered by the idcategoria column
 * @method     ChildSubcategorias[]|ObjectCollection findByNombre(string $nombre) Return ChildSubcategorias objects filtered by the nombre column
 * @method     ChildSubcategorias[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SubcategoriasQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\SubcategoriasQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Subcategorias', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSubcategoriasQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSubcategoriasQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSubcategoriasQuery) {
            return $criteria;
        }
        $query = new ChildSubcategoriasQuery();
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
     * @return ChildSubcategorias|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SubcategoriasTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SubcategoriasTableMap::DATABASE_NAME);
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
     * @return ChildSubcategorias A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idsubcategoria, idcategoria, nombre FROM subcategorias WHERE idsubcategoria = :p0';
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
            /** @var ChildSubcategorias $obj */
            $obj = new ChildSubcategorias();
            $obj->hydrate($row);
            SubcategoriasTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildSubcategorias|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SubcategoriasTableMap::COL_IDSUBCATEGORIA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SubcategoriasTableMap::COL_IDSUBCATEGORIA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idsubcategoria column
     *
     * Example usage:
     * <code>
     * $query->filterByIdsubcategoria(1234); // WHERE idsubcategoria = 1234
     * $query->filterByIdsubcategoria(array(12, 34)); // WHERE idsubcategoria IN (12, 34)
     * $query->filterByIdsubcategoria(array('min' => 12)); // WHERE idsubcategoria > 12
     * </code>
     *
     * @param     mixed $idsubcategoria The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function filterByIdsubcategoria($idsubcategoria = null, $comparison = null)
    {
        if (is_array($idsubcategoria)) {
            $useMinMax = false;
            if (isset($idsubcategoria['min'])) {
                $this->addUsingAlias(SubcategoriasTableMap::COL_IDSUBCATEGORIA, $idsubcategoria['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idsubcategoria['max'])) {
                $this->addUsingAlias(SubcategoriasTableMap::COL_IDSUBCATEGORIA, $idsubcategoria['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubcategoriasTableMap::COL_IDSUBCATEGORIA, $idsubcategoria, $comparison);
    }

    /**
     * Filter the query on the idcategoria column
     *
     * Example usage:
     * <code>
     * $query->filterByIdcategoria(1234); // WHERE idcategoria = 1234
     * $query->filterByIdcategoria(array(12, 34)); // WHERE idcategoria IN (12, 34)
     * $query->filterByIdcategoria(array('min' => 12)); // WHERE idcategoria > 12
     * </code>
     *
     * @see       filterByCategorias()
     *
     * @param     mixed $idcategoria The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function filterByIdcategoria($idcategoria = null, $comparison = null)
    {
        if (is_array($idcategoria)) {
            $useMinMax = false;
            if (isset($idcategoria['min'])) {
                $this->addUsingAlias(SubcategoriasTableMap::COL_IDCATEGORIA, $idcategoria['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idcategoria['max'])) {
                $this->addUsingAlias(SubcategoriasTableMap::COL_IDCATEGORIA, $idcategoria['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SubcategoriasTableMap::COL_IDCATEGORIA, $idcategoria, $comparison);
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%'); // WHERE nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombre)) {
                $nombre = str_replace('*', '%', $nombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SubcategoriasTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query by a related \Categorias object
     *
     * @param \Categorias|ObjectCollection $categorias The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function filterByCategorias($categorias, $comparison = null)
    {
        if ($categorias instanceof \Categorias) {
            return $this
                ->addUsingAlias(SubcategoriasTableMap::COL_IDCATEGORIA, $categorias->getIdcategoria(), $comparison);
        } elseif ($categorias instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SubcategoriasTableMap::COL_IDCATEGORIA, $categorias->toKeyValue('PrimaryKey', 'Idcategoria'), $comparison);
        } else {
            throw new PropelException('filterByCategorias() only accepts arguments of type \Categorias or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Categorias relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function joinCategorias($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Categorias');

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
            $this->addJoinObject($join, 'Categorias');
        }

        return $this;
    }

    /**
     * Use the Categorias relation Categorias object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CategoriasQuery A secondary query class using the current class as primary query
     */
    public function useCategoriasQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategorias($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Categorias', '\CategoriasQuery');
    }

    /**
     * Filter the query by a related \Productos object
     *
     * @param \Productos|ObjectCollection $productos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function filterByProductos($productos, $comparison = null)
    {
        if ($productos instanceof \Productos) {
            return $this
                ->addUsingAlias(SubcategoriasTableMap::COL_IDSUBCATEGORIA, $productos->getIdsubcategoria(), $comparison);
        } elseif ($productos instanceof ObjectCollection) {
            return $this
                ->useProductosQuery()
                ->filterByPrimaryKeys($productos->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildSubcategoriasQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildSubcategorias $subcategorias Object to remove from the list of results
     *
     * @return $this|ChildSubcategoriasQuery The current query, for fluid interface
     */
    public function prune($subcategorias = null)
    {
        if ($subcategorias) {
            $this->addUsingAlias(SubcategoriasTableMap::COL_IDSUBCATEGORIA, $subcategorias->getIdsubcategoria(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the subcategorias table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubcategoriasTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SubcategoriasTableMap::clearInstancePool();
            SubcategoriasTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SubcategoriasTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SubcategoriasTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SubcategoriasTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SubcategoriasTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SubcategoriasQuery

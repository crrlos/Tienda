<?php

namespace Base;

use \Departamentos as ChildDepartamentos;
use \DepartamentosQuery as ChildDepartamentosQuery;
use \Exception;
use \PDO;
use Map\DepartamentosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'departamentos' table.
 *
 *
 *
 * @method     ChildDepartamentosQuery orderByIddepartamento($order = Criteria::ASC) Order by the iddepartamento column
 * @method     ChildDepartamentosQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 *
 * @method     ChildDepartamentosQuery groupByIddepartamento() Group by the iddepartamento column
 * @method     ChildDepartamentosQuery groupByNombre() Group by the nombre column
 *
 * @method     ChildDepartamentosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDepartamentosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDepartamentosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDepartamentosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDepartamentosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDepartamentosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDepartamentosQuery leftJoinMunicipios($relationAlias = null) Adds a LEFT JOIN clause to the query using the Municipios relation
 * @method     ChildDepartamentosQuery rightJoinMunicipios($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Municipios relation
 * @method     ChildDepartamentosQuery innerJoinMunicipios($relationAlias = null) Adds a INNER JOIN clause to the query using the Municipios relation
 *
 * @method     ChildDepartamentosQuery joinWithMunicipios($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Municipios relation
 *
 * @method     ChildDepartamentosQuery leftJoinWithMunicipios() Adds a LEFT JOIN clause and with to the query using the Municipios relation
 * @method     ChildDepartamentosQuery rightJoinWithMunicipios() Adds a RIGHT JOIN clause and with to the query using the Municipios relation
 * @method     ChildDepartamentosQuery innerJoinWithMunicipios() Adds a INNER JOIN clause and with to the query using the Municipios relation
 *
 * @method     ChildDepartamentosQuery leftJoinUsuarios($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuarios relation
 * @method     ChildDepartamentosQuery rightJoinUsuarios($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuarios relation
 * @method     ChildDepartamentosQuery innerJoinUsuarios($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuarios relation
 *
 * @method     ChildDepartamentosQuery joinWithUsuarios($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuarios relation
 *
 * @method     ChildDepartamentosQuery leftJoinWithUsuarios() Adds a LEFT JOIN clause and with to the query using the Usuarios relation
 * @method     ChildDepartamentosQuery rightJoinWithUsuarios() Adds a RIGHT JOIN clause and with to the query using the Usuarios relation
 * @method     ChildDepartamentosQuery innerJoinWithUsuarios() Adds a INNER JOIN clause and with to the query using the Usuarios relation
 *
 * @method     \MunicipiosQuery|\UsuariosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDepartamentos findOne(ConnectionInterface $con = null) Return the first ChildDepartamentos matching the query
 * @method     ChildDepartamentos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDepartamentos matching the query, or a new ChildDepartamentos object populated from the query conditions when no match is found
 *
 * @method     ChildDepartamentos findOneByIddepartamento(int $iddepartamento) Return the first ChildDepartamentos filtered by the iddepartamento column
 * @method     ChildDepartamentos findOneByNombre(string $nombre) Return the first ChildDepartamentos filtered by the nombre column *

 * @method     ChildDepartamentos requirePk($key, ConnectionInterface $con = null) Return the ChildDepartamentos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDepartamentos requireOne(ConnectionInterface $con = null) Return the first ChildDepartamentos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDepartamentos requireOneByIddepartamento(int $iddepartamento) Return the first ChildDepartamentos filtered by the iddepartamento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDepartamentos requireOneByNombre(string $nombre) Return the first ChildDepartamentos filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDepartamentos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDepartamentos objects based on current ModelCriteria
 * @method     ChildDepartamentos[]|ObjectCollection findByIddepartamento(int $iddepartamento) Return ChildDepartamentos objects filtered by the iddepartamento column
 * @method     ChildDepartamentos[]|ObjectCollection findByNombre(string $nombre) Return ChildDepartamentos objects filtered by the nombre column
 * @method     ChildDepartamentos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DepartamentosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DepartamentosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Departamentos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDepartamentosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDepartamentosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDepartamentosQuery) {
            return $criteria;
        }
        $query = new ChildDepartamentosQuery();
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
     * @return ChildDepartamentos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DepartamentosTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DepartamentosTableMap::DATABASE_NAME);
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
     * @return ChildDepartamentos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT iddepartamento, nombre FROM departamentos WHERE iddepartamento = :p0';
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
            /** @var ChildDepartamentos $obj */
            $obj = new ChildDepartamentos();
            $obj->hydrate($row);
            DepartamentosTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildDepartamentos|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DepartamentosTableMap::COL_IDDEPARTAMENTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DepartamentosTableMap::COL_IDDEPARTAMENTO, $keys, Criteria::IN);
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
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByIddepartamento($iddepartamento = null, $comparison = null)
    {
        if (is_array($iddepartamento)) {
            $useMinMax = false;
            if (isset($iddepartamento['min'])) {
                $this->addUsingAlias(DepartamentosTableMap::COL_IDDEPARTAMENTO, $iddepartamento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iddepartamento['max'])) {
                $this->addUsingAlias(DepartamentosTableMap::COL_IDDEPARTAMENTO, $iddepartamento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DepartamentosTableMap::COL_IDDEPARTAMENTO, $iddepartamento, $comparison);
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
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartamentosTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query by a related \Municipios object
     *
     * @param \Municipios|ObjectCollection $municipios the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByMunicipios($municipios, $comparison = null)
    {
        if ($municipios instanceof \Municipios) {
            return $this
                ->addUsingAlias(DepartamentosTableMap::COL_IDDEPARTAMENTO, $municipios->getIddepartamento(), $comparison);
        } elseif ($municipios instanceof ObjectCollection) {
            return $this
                ->useMunicipiosQuery()
                ->filterByPrimaryKeys($municipios->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMunicipios() only accepts arguments of type \Municipios or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Municipios relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function joinMunicipios($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Municipios');

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
            $this->addJoinObject($join, 'Municipios');
        }

        return $this;
    }

    /**
     * Use the Municipios relation Municipios object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MunicipiosQuery A secondary query class using the current class as primary query
     */
    public function useMunicipiosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMunicipios($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Municipios', '\MunicipiosQuery');
    }

    /**
     * Filter the query by a related \Usuarios object
     *
     * @param \Usuarios|ObjectCollection $usuarios the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByUsuarios($usuarios, $comparison = null)
    {
        if ($usuarios instanceof \Usuarios) {
            return $this
                ->addUsingAlias(DepartamentosTableMap::COL_IDDEPARTAMENTO, $usuarios->getIddepartamento(), $comparison);
        } elseif ($usuarios instanceof ObjectCollection) {
            return $this
                ->useUsuariosQuery()
                ->filterByPrimaryKeys($usuarios->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuarios() only accepts arguments of type \Usuarios or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuarios relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function joinUsuarios($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuarios');

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
            $this->addJoinObject($join, 'Usuarios');
        }

        return $this;
    }

    /**
     * Use the Usuarios relation Usuarios object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsuariosQuery A secondary query class using the current class as primary query
     */
    public function useUsuariosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsuarios($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuarios', '\UsuariosQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDepartamentos $departamentos Object to remove from the list of results
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function prune($departamentos = null)
    {
        if ($departamentos) {
            $this->addUsingAlias(DepartamentosTableMap::COL_IDDEPARTAMENTO, $departamentos->getIddepartamento(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the departamentos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DepartamentosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DepartamentosTableMap::clearInstancePool();
            DepartamentosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DepartamentosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DepartamentosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DepartamentosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DepartamentosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DepartamentosQuery

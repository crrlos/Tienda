<?php

namespace Base;

use \Detallecompras as ChildDetallecompras;
use \DetallecomprasQuery as ChildDetallecomprasQuery;
use \Exception;
use \PDO;
use Map\DetallecomprasTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'detallecompras' table.
 *
 *
 *
 * @method     ChildDetallecomprasQuery orderByIddetallecompra($order = Criteria::ASC) Order by the iddetallecompra column
 * @method     ChildDetallecomprasQuery orderByIdcompra($order = Criteria::ASC) Order by the idcompra column
 * @method     ChildDetallecomprasQuery orderByIdproducto($order = Criteria::ASC) Order by the idproducto column
 * @method     ChildDetallecomprasQuery orderByCantidad($order = Criteria::ASC) Order by the cantidad column
 * @method     ChildDetallecomprasQuery orderByPreciocompra($order = Criteria::ASC) Order by the preciocompra column
 *
 * @method     ChildDetallecomprasQuery groupByIddetallecompra() Group by the iddetallecompra column
 * @method     ChildDetallecomprasQuery groupByIdcompra() Group by the idcompra column
 * @method     ChildDetallecomprasQuery groupByIdproducto() Group by the idproducto column
 * @method     ChildDetallecomprasQuery groupByCantidad() Group by the cantidad column
 * @method     ChildDetallecomprasQuery groupByPreciocompra() Group by the preciocompra column
 *
 * @method     ChildDetallecomprasQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDetallecomprasQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDetallecomprasQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDetallecomprasQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDetallecomprasQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDetallecomprasQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDetallecomprasQuery leftJoinCompras($relationAlias = null) Adds a LEFT JOIN clause to the query using the Compras relation
 * @method     ChildDetallecomprasQuery rightJoinCompras($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Compras relation
 * @method     ChildDetallecomprasQuery innerJoinCompras($relationAlias = null) Adds a INNER JOIN clause to the query using the Compras relation
 *
 * @method     ChildDetallecomprasQuery joinWithCompras($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Compras relation
 *
 * @method     ChildDetallecomprasQuery leftJoinWithCompras() Adds a LEFT JOIN clause and with to the query using the Compras relation
 * @method     ChildDetallecomprasQuery rightJoinWithCompras() Adds a RIGHT JOIN clause and with to the query using the Compras relation
 * @method     ChildDetallecomprasQuery innerJoinWithCompras() Adds a INNER JOIN clause and with to the query using the Compras relation
 *
 * @method     ChildDetallecomprasQuery leftJoinProductos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Productos relation
 * @method     ChildDetallecomprasQuery rightJoinProductos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Productos relation
 * @method     ChildDetallecomprasQuery innerJoinProductos($relationAlias = null) Adds a INNER JOIN clause to the query using the Productos relation
 *
 * @method     ChildDetallecomprasQuery joinWithProductos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Productos relation
 *
 * @method     ChildDetallecomprasQuery leftJoinWithProductos() Adds a LEFT JOIN clause and with to the query using the Productos relation
 * @method     ChildDetallecomprasQuery rightJoinWithProductos() Adds a RIGHT JOIN clause and with to the query using the Productos relation
 * @method     ChildDetallecomprasQuery innerJoinWithProductos() Adds a INNER JOIN clause and with to the query using the Productos relation
 *
 * @method     \ComprasQuery|\ProductosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDetallecompras findOne(ConnectionInterface $con = null) Return the first ChildDetallecompras matching the query
 * @method     ChildDetallecompras findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDetallecompras matching the query, or a new ChildDetallecompras object populated from the query conditions when no match is found
 *
 * @method     ChildDetallecompras findOneByIddetallecompra(int $iddetallecompra) Return the first ChildDetallecompras filtered by the iddetallecompra column
 * @method     ChildDetallecompras findOneByIdcompra(int $idcompra) Return the first ChildDetallecompras filtered by the idcompra column
 * @method     ChildDetallecompras findOneByIdproducto(int $idproducto) Return the first ChildDetallecompras filtered by the idproducto column
 * @method     ChildDetallecompras findOneByCantidad(int $cantidad) Return the first ChildDetallecompras filtered by the cantidad column
 * @method     ChildDetallecompras findOneByPreciocompra(double $preciocompra) Return the first ChildDetallecompras filtered by the preciocompra column *

 * @method     ChildDetallecompras requirePk($key, ConnectionInterface $con = null) Return the ChildDetallecompras by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallecompras requireOne(ConnectionInterface $con = null) Return the first ChildDetallecompras matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDetallecompras requireOneByIddetallecompra(int $iddetallecompra) Return the first ChildDetallecompras filtered by the iddetallecompra column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallecompras requireOneByIdcompra(int $idcompra) Return the first ChildDetallecompras filtered by the idcompra column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallecompras requireOneByIdproducto(int $idproducto) Return the first ChildDetallecompras filtered by the idproducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallecompras requireOneByCantidad(int $cantidad) Return the first ChildDetallecompras filtered by the cantidad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallecompras requireOneByPreciocompra(double $preciocompra) Return the first ChildDetallecompras filtered by the preciocompra column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDetallecompras[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDetallecompras objects based on current ModelCriteria
 * @method     ChildDetallecompras[]|ObjectCollection findByIddetallecompra(int $iddetallecompra) Return ChildDetallecompras objects filtered by the iddetallecompra column
 * @method     ChildDetallecompras[]|ObjectCollection findByIdcompra(int $idcompra) Return ChildDetallecompras objects filtered by the idcompra column
 * @method     ChildDetallecompras[]|ObjectCollection findByIdproducto(int $idproducto) Return ChildDetallecompras objects filtered by the idproducto column
 * @method     ChildDetallecompras[]|ObjectCollection findByCantidad(int $cantidad) Return ChildDetallecompras objects filtered by the cantidad column
 * @method     ChildDetallecompras[]|ObjectCollection findByPreciocompra(double $preciocompra) Return ChildDetallecompras objects filtered by the preciocompra column
 * @method     ChildDetallecompras[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DetallecomprasQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DetallecomprasQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Detallecompras', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDetallecomprasQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDetallecomprasQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDetallecomprasQuery) {
            return $criteria;
        }
        $query = new ChildDetallecomprasQuery();
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
     * @return ChildDetallecompras|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DetallecomprasTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DetallecomprasTableMap::DATABASE_NAME);
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
     * @return ChildDetallecompras A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT iddetallecompra, idcompra, idproducto, cantidad, preciocompra FROM detallecompras WHERE iddetallecompra = :p0';
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
            /** @var ChildDetallecompras $obj */
            $obj = new ChildDetallecompras();
            $obj->hydrate($row);
            DetallecomprasTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildDetallecompras|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DetallecomprasTableMap::COL_IDDETALLECOMPRA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DetallecomprasTableMap::COL_IDDETALLECOMPRA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the iddetallecompra column
     *
     * Example usage:
     * <code>
     * $query->filterByIddetallecompra(1234); // WHERE iddetallecompra = 1234
     * $query->filterByIddetallecompra(array(12, 34)); // WHERE iddetallecompra IN (12, 34)
     * $query->filterByIddetallecompra(array('min' => 12)); // WHERE iddetallecompra > 12
     * </code>
     *
     * @param     mixed $iddetallecompra The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByIddetallecompra($iddetallecompra = null, $comparison = null)
    {
        if (is_array($iddetallecompra)) {
            $useMinMax = false;
            if (isset($iddetallecompra['min'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_IDDETALLECOMPRA, $iddetallecompra['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iddetallecompra['max'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_IDDETALLECOMPRA, $iddetallecompra['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallecomprasTableMap::COL_IDDETALLECOMPRA, $iddetallecompra, $comparison);
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
     * @see       filterByCompras()
     *
     * @param     mixed $idcompra The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByIdcompra($idcompra = null, $comparison = null)
    {
        if (is_array($idcompra)) {
            $useMinMax = false;
            if (isset($idcompra['min'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_IDCOMPRA, $idcompra['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idcompra['max'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_IDCOMPRA, $idcompra['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallecomprasTableMap::COL_IDCOMPRA, $idcompra, $comparison);
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
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByIdproducto($idproducto = null, $comparison = null)
    {
        if (is_array($idproducto)) {
            $useMinMax = false;
            if (isset($idproducto['min'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_IDPRODUCTO, $idproducto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idproducto['max'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_IDPRODUCTO, $idproducto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallecomprasTableMap::COL_IDPRODUCTO, $idproducto, $comparison);
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
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByCantidad($cantidad = null, $comparison = null)
    {
        if (is_array($cantidad)) {
            $useMinMax = false;
            if (isset($cantidad['min'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_CANTIDAD, $cantidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantidad['max'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_CANTIDAD, $cantidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallecomprasTableMap::COL_CANTIDAD, $cantidad, $comparison);
    }

    /**
     * Filter the query on the preciocompra column
     *
     * Example usage:
     * <code>
     * $query->filterByPreciocompra(1234); // WHERE preciocompra = 1234
     * $query->filterByPreciocompra(array(12, 34)); // WHERE preciocompra IN (12, 34)
     * $query->filterByPreciocompra(array('min' => 12)); // WHERE preciocompra > 12
     * </code>
     *
     * @param     mixed $preciocompra The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByPreciocompra($preciocompra = null, $comparison = null)
    {
        if (is_array($preciocompra)) {
            $useMinMax = false;
            if (isset($preciocompra['min'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_PRECIOCOMPRA, $preciocompra['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($preciocompra['max'])) {
                $this->addUsingAlias(DetallecomprasTableMap::COL_PRECIOCOMPRA, $preciocompra['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallecomprasTableMap::COL_PRECIOCOMPRA, $preciocompra, $comparison);
    }

    /**
     * Filter the query by a related \Compras object
     *
     * @param \Compras|ObjectCollection $compras The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByCompras($compras, $comparison = null)
    {
        if ($compras instanceof \Compras) {
            return $this
                ->addUsingAlias(DetallecomprasTableMap::COL_IDCOMPRA, $compras->getIdcompra(), $comparison);
        } elseif ($compras instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DetallecomprasTableMap::COL_IDCOMPRA, $compras->toKeyValue('PrimaryKey', 'Idcompra'), $comparison);
        } else {
            throw new PropelException('filterByCompras() only accepts arguments of type \Compras or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Compras relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function joinCompras($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Compras');

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
            $this->addJoinObject($join, 'Compras');
        }

        return $this;
    }

    /**
     * Use the Compras relation Compras object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ComprasQuery A secondary query class using the current class as primary query
     */
    public function useComprasQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompras($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Compras', '\ComprasQuery');
    }

    /**
     * Filter the query by a related \Productos object
     *
     * @param \Productos|ObjectCollection $productos The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function filterByProductos($productos, $comparison = null)
    {
        if ($productos instanceof \Productos) {
            return $this
                ->addUsingAlias(DetallecomprasTableMap::COL_IDPRODUCTO, $productos->getIdproducto(), $comparison);
        } elseif ($productos instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DetallecomprasTableMap::COL_IDPRODUCTO, $productos->toKeyValue('PrimaryKey', 'Idproducto'), $comparison);
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
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
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
     * @param   ChildDetallecompras $detallecompras Object to remove from the list of results
     *
     * @return $this|ChildDetallecomprasQuery The current query, for fluid interface
     */
    public function prune($detallecompras = null)
    {
        if ($detallecompras) {
            $this->addUsingAlias(DetallecomprasTableMap::COL_IDDETALLECOMPRA, $detallecompras->getIddetallecompra(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the detallecompras table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DetallecomprasTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DetallecomprasTableMap::clearInstancePool();
            DetallecomprasTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DetallecomprasTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DetallecomprasTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DetallecomprasTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DetallecomprasTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DetallecomprasQuery

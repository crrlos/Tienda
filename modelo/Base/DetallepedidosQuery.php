<?php

namespace Base;

use \Detallepedidos as ChildDetallepedidos;
use \DetallepedidosQuery as ChildDetallepedidosQuery;
use \Exception;
use \PDO;
use Map\DetallepedidosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'detallepedidos' table.
 *
 *
 *
 * @method     ChildDetallepedidosQuery orderByIddetallepedido($order = Criteria::ASC) Order by the iddetallepedido column
 * @method     ChildDetallepedidosQuery orderByIdpedido($order = Criteria::ASC) Order by the idpedido column
 * @method     ChildDetallepedidosQuery orderByIdproducto($order = Criteria::ASC) Order by the idproducto column
 * @method     ChildDetallepedidosQuery orderByCantidad($order = Criteria::ASC) Order by the cantidad column
 * @method     ChildDetallepedidosQuery orderByPrecio($order = Criteria::ASC) Order by the precio column
 *
 * @method     ChildDetallepedidosQuery groupByIddetallepedido() Group by the iddetallepedido column
 * @method     ChildDetallepedidosQuery groupByIdpedido() Group by the idpedido column
 * @method     ChildDetallepedidosQuery groupByIdproducto() Group by the idproducto column
 * @method     ChildDetallepedidosQuery groupByCantidad() Group by the cantidad column
 * @method     ChildDetallepedidosQuery groupByPrecio() Group by the precio column
 *
 * @method     ChildDetallepedidosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDetallepedidosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDetallepedidosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDetallepedidosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDetallepedidosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDetallepedidosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDetallepedidosQuery leftJoinPedidos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedidos relation
 * @method     ChildDetallepedidosQuery rightJoinPedidos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedidos relation
 * @method     ChildDetallepedidosQuery innerJoinPedidos($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedidos relation
 *
 * @method     ChildDetallepedidosQuery joinWithPedidos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pedidos relation
 *
 * @method     ChildDetallepedidosQuery leftJoinWithPedidos() Adds a LEFT JOIN clause and with to the query using the Pedidos relation
 * @method     ChildDetallepedidosQuery rightJoinWithPedidos() Adds a RIGHT JOIN clause and with to the query using the Pedidos relation
 * @method     ChildDetallepedidosQuery innerJoinWithPedidos() Adds a INNER JOIN clause and with to the query using the Pedidos relation
 *
 * @method     ChildDetallepedidosQuery leftJoinProductos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Productos relation
 * @method     ChildDetallepedidosQuery rightJoinProductos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Productos relation
 * @method     ChildDetallepedidosQuery innerJoinProductos($relationAlias = null) Adds a INNER JOIN clause to the query using the Productos relation
 *
 * @method     ChildDetallepedidosQuery joinWithProductos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Productos relation
 *
 * @method     ChildDetallepedidosQuery leftJoinWithProductos() Adds a LEFT JOIN clause and with to the query using the Productos relation
 * @method     ChildDetallepedidosQuery rightJoinWithProductos() Adds a RIGHT JOIN clause and with to the query using the Productos relation
 * @method     ChildDetallepedidosQuery innerJoinWithProductos() Adds a INNER JOIN clause and with to the query using the Productos relation
 *
 * @method     \PedidosQuery|\ProductosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDetallepedidos findOne(ConnectionInterface $con = null) Return the first ChildDetallepedidos matching the query
 * @method     ChildDetallepedidos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDetallepedidos matching the query, or a new ChildDetallepedidos object populated from the query conditions when no match is found
 *
 * @method     ChildDetallepedidos findOneByIddetallepedido(int $iddetallepedido) Return the first ChildDetallepedidos filtered by the iddetallepedido column
 * @method     ChildDetallepedidos findOneByIdpedido(int $idpedido) Return the first ChildDetallepedidos filtered by the idpedido column
 * @method     ChildDetallepedidos findOneByIdproducto(int $idproducto) Return the first ChildDetallepedidos filtered by the idproducto column
 * @method     ChildDetallepedidos findOneByCantidad(int $cantidad) Return the first ChildDetallepedidos filtered by the cantidad column
 * @method     ChildDetallepedidos findOneByPrecio(double $precio) Return the first ChildDetallepedidos filtered by the precio column *

 * @method     ChildDetallepedidos requirePk($key, ConnectionInterface $con = null) Return the ChildDetallepedidos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallepedidos requireOne(ConnectionInterface $con = null) Return the first ChildDetallepedidos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDetallepedidos requireOneByIddetallepedido(int $iddetallepedido) Return the first ChildDetallepedidos filtered by the iddetallepedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallepedidos requireOneByIdpedido(int $idpedido) Return the first ChildDetallepedidos filtered by the idpedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallepedidos requireOneByIdproducto(int $idproducto) Return the first ChildDetallepedidos filtered by the idproducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallepedidos requireOneByCantidad(int $cantidad) Return the first ChildDetallepedidos filtered by the cantidad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallepedidos requireOneByPrecio(double $precio) Return the first ChildDetallepedidos filtered by the precio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDetallepedidos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDetallepedidos objects based on current ModelCriteria
 * @method     ChildDetallepedidos[]|ObjectCollection findByIddetallepedido(int $iddetallepedido) Return ChildDetallepedidos objects filtered by the iddetallepedido column
 * @method     ChildDetallepedidos[]|ObjectCollection findByIdpedido(int $idpedido) Return ChildDetallepedidos objects filtered by the idpedido column
 * @method     ChildDetallepedidos[]|ObjectCollection findByIdproducto(int $idproducto) Return ChildDetallepedidos objects filtered by the idproducto column
 * @method     ChildDetallepedidos[]|ObjectCollection findByCantidad(int $cantidad) Return ChildDetallepedidos objects filtered by the cantidad column
 * @method     ChildDetallepedidos[]|ObjectCollection findByPrecio(double $precio) Return ChildDetallepedidos objects filtered by the precio column
 * @method     ChildDetallepedidos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DetallepedidosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DetallepedidosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Detallepedidos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDetallepedidosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDetallepedidosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDetallepedidosQuery) {
            return $criteria;
        }
        $query = new ChildDetallepedidosQuery();
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
     * @return ChildDetallepedidos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DetallepedidosTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DetallepedidosTableMap::DATABASE_NAME);
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
     * @return ChildDetallepedidos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT iddetallepedido, idpedido, idproducto, cantidad, precio FROM detallepedidos WHERE iddetallepedido = :p0';
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
            /** @var ChildDetallepedidos $obj */
            $obj = new ChildDetallepedidos();
            $obj->hydrate($row);
            DetallepedidosTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildDetallepedidos|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DetallepedidosTableMap::COL_IDDETALLEPEDIDO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DetallepedidosTableMap::COL_IDDETALLEPEDIDO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the iddetallepedido column
     *
     * Example usage:
     * <code>
     * $query->filterByIddetallepedido(1234); // WHERE iddetallepedido = 1234
     * $query->filterByIddetallepedido(array(12, 34)); // WHERE iddetallepedido IN (12, 34)
     * $query->filterByIddetallepedido(array('min' => 12)); // WHERE iddetallepedido > 12
     * </code>
     *
     * @param     mixed $iddetallepedido The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByIddetallepedido($iddetallepedido = null, $comparison = null)
    {
        if (is_array($iddetallepedido)) {
            $useMinMax = false;
            if (isset($iddetallepedido['min'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_IDDETALLEPEDIDO, $iddetallepedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iddetallepedido['max'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_IDDETALLEPEDIDO, $iddetallepedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallepedidosTableMap::COL_IDDETALLEPEDIDO, $iddetallepedido, $comparison);
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
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByIdpedido($idpedido = null, $comparison = null)
    {
        if (is_array($idpedido)) {
            $useMinMax = false;
            if (isset($idpedido['min'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_IDPEDIDO, $idpedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idpedido['max'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_IDPEDIDO, $idpedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallepedidosTableMap::COL_IDPEDIDO, $idpedido, $comparison);
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
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByIdproducto($idproducto = null, $comparison = null)
    {
        if (is_array($idproducto)) {
            $useMinMax = false;
            if (isset($idproducto['min'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_IDPRODUCTO, $idproducto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idproducto['max'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_IDPRODUCTO, $idproducto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallepedidosTableMap::COL_IDPRODUCTO, $idproducto, $comparison);
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
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByCantidad($cantidad = null, $comparison = null)
    {
        if (is_array($cantidad)) {
            $useMinMax = false;
            if (isset($cantidad['min'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_CANTIDAD, $cantidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantidad['max'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_CANTIDAD, $cantidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallepedidosTableMap::COL_CANTIDAD, $cantidad, $comparison);
    }

    /**
     * Filter the query on the precio column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecio(1234); // WHERE precio = 1234
     * $query->filterByPrecio(array(12, 34)); // WHERE precio IN (12, 34)
     * $query->filterByPrecio(array('min' => 12)); // WHERE precio > 12
     * </code>
     *
     * @param     mixed $precio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByPrecio($precio = null, $comparison = null)
    {
        if (is_array($precio)) {
            $useMinMax = false;
            if (isset($precio['min'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_PRECIO, $precio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precio['max'])) {
                $this->addUsingAlias(DetallepedidosTableMap::COL_PRECIO, $precio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetallepedidosTableMap::COL_PRECIO, $precio, $comparison);
    }

    /**
     * Filter the query by a related \Pedidos object
     *
     * @param \Pedidos|ObjectCollection $pedidos The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByPedidos($pedidos, $comparison = null)
    {
        if ($pedidos instanceof \Pedidos) {
            return $this
                ->addUsingAlias(DetallepedidosTableMap::COL_IDPEDIDO, $pedidos->getIdpedido(), $comparison);
        } elseif ($pedidos instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DetallepedidosTableMap::COL_IDPEDIDO, $pedidos->toKeyValue('PrimaryKey', 'Idpedido'), $comparison);
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
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
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
     * Filter the query by a related \Productos object
     *
     * @param \Productos|ObjectCollection $productos The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function filterByProductos($productos, $comparison = null)
    {
        if ($productos instanceof \Productos) {
            return $this
                ->addUsingAlias(DetallepedidosTableMap::COL_IDPRODUCTO, $productos->getIdproducto(), $comparison);
        } elseif ($productos instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DetallepedidosTableMap::COL_IDPRODUCTO, $productos->toKeyValue('PrimaryKey', 'Idproducto'), $comparison);
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
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
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
     * @param   ChildDetallepedidos $detallepedidos Object to remove from the list of results
     *
     * @return $this|ChildDetallepedidosQuery The current query, for fluid interface
     */
    public function prune($detallepedidos = null)
    {
        if ($detallepedidos) {
            $this->addUsingAlias(DetallepedidosTableMap::COL_IDDETALLEPEDIDO, $detallepedidos->getIddetallepedido(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the detallepedidos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DetallepedidosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DetallepedidosTableMap::clearInstancePool();
            DetallepedidosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DetallepedidosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DetallepedidosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DetallepedidosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DetallepedidosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DetallepedidosQuery

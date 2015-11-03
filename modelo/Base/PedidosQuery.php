<?php

namespace Base;

use \Pedidos as ChildPedidos;
use \PedidosQuery as ChildPedidosQuery;
use \Exception;
use \PDO;
use Map\PedidosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pedidos' table.
 *
 *
 *
 * @method     ChildPedidosQuery orderByIdpedido($order = Criteria::ASC) Order by the idpedido column
 * @method     ChildPedidosQuery orderByIdcliente($order = Criteria::ASC) Order by the idcliente column
 * @method     ChildPedidosQuery orderByEstado($order = Criteria::ASC) Order by the estado column
 *
 * @method     ChildPedidosQuery groupByIdpedido() Group by the idpedido column
 * @method     ChildPedidosQuery groupByIdcliente() Group by the idcliente column
 * @method     ChildPedidosQuery groupByEstado() Group by the estado column
 *
 * @method     ChildPedidosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPedidosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPedidosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPedidosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPedidosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPedidosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPedidosQuery leftJoinUsuarios($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuarios relation
 * @method     ChildPedidosQuery rightJoinUsuarios($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuarios relation
 * @method     ChildPedidosQuery innerJoinUsuarios($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuarios relation
 *
 * @method     ChildPedidosQuery joinWithUsuarios($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuarios relation
 *
 * @method     ChildPedidosQuery leftJoinWithUsuarios() Adds a LEFT JOIN clause and with to the query using the Usuarios relation
 * @method     ChildPedidosQuery rightJoinWithUsuarios() Adds a RIGHT JOIN clause and with to the query using the Usuarios relation
 * @method     ChildPedidosQuery innerJoinWithUsuarios() Adds a INNER JOIN clause and with to the query using the Usuarios relation
 *
 * @method     ChildPedidosQuery leftJoinDetallepedidos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Detallepedidos relation
 * @method     ChildPedidosQuery rightJoinDetallepedidos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Detallepedidos relation
 * @method     ChildPedidosQuery innerJoinDetallepedidos($relationAlias = null) Adds a INNER JOIN clause to the query using the Detallepedidos relation
 *
 * @method     ChildPedidosQuery joinWithDetallepedidos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Detallepedidos relation
 *
 * @method     ChildPedidosQuery leftJoinWithDetallepedidos() Adds a LEFT JOIN clause and with to the query using the Detallepedidos relation
 * @method     ChildPedidosQuery rightJoinWithDetallepedidos() Adds a RIGHT JOIN clause and with to the query using the Detallepedidos relation
 * @method     ChildPedidosQuery innerJoinWithDetallepedidos() Adds a INNER JOIN clause and with to the query using the Detallepedidos relation
 *
 * @method     ChildPedidosQuery leftJoinVentas($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ventas relation
 * @method     ChildPedidosQuery rightJoinVentas($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ventas relation
 * @method     ChildPedidosQuery innerJoinVentas($relationAlias = null) Adds a INNER JOIN clause to the query using the Ventas relation
 *
 * @method     ChildPedidosQuery joinWithVentas($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Ventas relation
 *
 * @method     ChildPedidosQuery leftJoinWithVentas() Adds a LEFT JOIN clause and with to the query using the Ventas relation
 * @method     ChildPedidosQuery rightJoinWithVentas() Adds a RIGHT JOIN clause and with to the query using the Ventas relation
 * @method     ChildPedidosQuery innerJoinWithVentas() Adds a INNER JOIN clause and with to the query using the Ventas relation
 *
 * @method     \UsuariosQuery|\DetallepedidosQuery|\VentasQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPedidos findOne(ConnectionInterface $con = null) Return the first ChildPedidos matching the query
 * @method     ChildPedidos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPedidos matching the query, or a new ChildPedidos object populated from the query conditions when no match is found
 *
 * @method     ChildPedidos findOneByIdpedido(int $idpedido) Return the first ChildPedidos filtered by the idpedido column
 * @method     ChildPedidos findOneByIdcliente(int $idcliente) Return the first ChildPedidos filtered by the idcliente column
 * @method     ChildPedidos findOneByEstado(string $estado) Return the first ChildPedidos filtered by the estado column *

 * @method     ChildPedidos requirePk($key, ConnectionInterface $con = null) Return the ChildPedidos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidos requireOne(ConnectionInterface $con = null) Return the first ChildPedidos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPedidos requireOneByIdpedido(int $idpedido) Return the first ChildPedidos filtered by the idpedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidos requireOneByIdcliente(int $idcliente) Return the first ChildPedidos filtered by the idcliente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedidos requireOneByEstado(string $estado) Return the first ChildPedidos filtered by the estado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPedidos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPedidos objects based on current ModelCriteria
 * @method     ChildPedidos[]|ObjectCollection findByIdpedido(int $idpedido) Return ChildPedidos objects filtered by the idpedido column
 * @method     ChildPedidos[]|ObjectCollection findByIdcliente(int $idcliente) Return ChildPedidos objects filtered by the idcliente column
 * @method     ChildPedidos[]|ObjectCollection findByEstado(string $estado) Return ChildPedidos objects filtered by the estado column
 * @method     ChildPedidos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PedidosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PedidosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Pedidos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPedidosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPedidosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPedidosQuery) {
            return $criteria;
        }
        $query = new ChildPedidosQuery();
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
     * @return ChildPedidos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PedidosTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PedidosTableMap::DATABASE_NAME);
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
     * @return ChildPedidos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idpedido, idcliente, estado FROM pedidos WHERE idpedido = :p0';
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
            /** @var ChildPedidos $obj */
            $obj = new ChildPedidos();
            $obj->hydrate($row);
            PedidosTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildPedidos|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPedidosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PedidosTableMap::COL_IDPEDIDO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPedidosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PedidosTableMap::COL_IDPEDIDO, $keys, Criteria::IN);
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
     * @param     mixed $idpedido The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidosQuery The current query, for fluid interface
     */
    public function filterByIdpedido($idpedido = null, $comparison = null)
    {
        if (is_array($idpedido)) {
            $useMinMax = false;
            if (isset($idpedido['min'])) {
                $this->addUsingAlias(PedidosTableMap::COL_IDPEDIDO, $idpedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idpedido['max'])) {
                $this->addUsingAlias(PedidosTableMap::COL_IDPEDIDO, $idpedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidosTableMap::COL_IDPEDIDO, $idpedido, $comparison);
    }

    /**
     * Filter the query on the idcliente column
     *
     * Example usage:
     * <code>
     * $query->filterByIdcliente(1234); // WHERE idcliente = 1234
     * $query->filterByIdcliente(array(12, 34)); // WHERE idcliente IN (12, 34)
     * $query->filterByIdcliente(array('min' => 12)); // WHERE idcliente > 12
     * </code>
     *
     * @see       filterByUsuarios()
     *
     * @param     mixed $idcliente The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidosQuery The current query, for fluid interface
     */
    public function filterByIdcliente($idcliente = null, $comparison = null)
    {
        if (is_array($idcliente)) {
            $useMinMax = false;
            if (isset($idcliente['min'])) {
                $this->addUsingAlias(PedidosTableMap::COL_IDCLIENTE, $idcliente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idcliente['max'])) {
                $this->addUsingAlias(PedidosTableMap::COL_IDCLIENTE, $idcliente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidosTableMap::COL_IDCLIENTE, $idcliente, $comparison);
    }

    /**
     * Filter the query on the estado column
     *
     * Example usage:
     * <code>
     * $query->filterByEstado('fooValue');   // WHERE estado = 'fooValue'
     * $query->filterByEstado('%fooValue%'); // WHERE estado LIKE '%fooValue%'
     * </code>
     *
     * @param     string $estado The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPedidosQuery The current query, for fluid interface
     */
    public function filterByEstado($estado = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $estado)) {
                $estado = str_replace('*', '%', $estado);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PedidosTableMap::COL_ESTADO, $estado, $comparison);
    }

    /**
     * Filter the query by a related \Usuarios object
     *
     * @param \Usuarios|ObjectCollection $usuarios The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPedidosQuery The current query, for fluid interface
     */
    public function filterByUsuarios($usuarios, $comparison = null)
    {
        if ($usuarios instanceof \Usuarios) {
            return $this
                ->addUsingAlias(PedidosTableMap::COL_IDCLIENTE, $usuarios->getIdusuario(), $comparison);
        } elseif ($usuarios instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PedidosTableMap::COL_IDCLIENTE, $usuarios->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
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
     * @return $this|ChildPedidosQuery The current query, for fluid interface
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
     * Filter the query by a related \Detallepedidos object
     *
     * @param \Detallepedidos|ObjectCollection $detallepedidos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPedidosQuery The current query, for fluid interface
     */
    public function filterByDetallepedidos($detallepedidos, $comparison = null)
    {
        if ($detallepedidos instanceof \Detallepedidos) {
            return $this
                ->addUsingAlias(PedidosTableMap::COL_IDPEDIDO, $detallepedidos->getIdpedido(), $comparison);
        } elseif ($detallepedidos instanceof ObjectCollection) {
            return $this
                ->useDetallepedidosQuery()
                ->filterByPrimaryKeys($detallepedidos->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDetallepedidos() only accepts arguments of type \Detallepedidos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Detallepedidos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPedidosQuery The current query, for fluid interface
     */
    public function joinDetallepedidos($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Detallepedidos');

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
            $this->addJoinObject($join, 'Detallepedidos');
        }

        return $this;
    }

    /**
     * Use the Detallepedidos relation Detallepedidos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DetallepedidosQuery A secondary query class using the current class as primary query
     */
    public function useDetallepedidosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDetallepedidos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Detallepedidos', '\DetallepedidosQuery');
    }

    /**
     * Filter the query by a related \Ventas object
     *
     * @param \Ventas|ObjectCollection $ventas the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPedidosQuery The current query, for fluid interface
     */
    public function filterByVentas($ventas, $comparison = null)
    {
        if ($ventas instanceof \Ventas) {
            return $this
                ->addUsingAlias(PedidosTableMap::COL_IDPEDIDO, $ventas->getIdpedido(), $comparison);
        } elseif ($ventas instanceof ObjectCollection) {
            return $this
                ->useVentasQuery()
                ->filterByPrimaryKeys($ventas->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVentas() only accepts arguments of type \Ventas or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ventas relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPedidosQuery The current query, for fluid interface
     */
    public function joinVentas($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ventas');

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
            $this->addJoinObject($join, 'Ventas');
        }

        return $this;
    }

    /**
     * Use the Ventas relation Ventas object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \VentasQuery A secondary query class using the current class as primary query
     */
    public function useVentasQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVentas($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ventas', '\VentasQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPedidos $pedidos Object to remove from the list of results
     *
     * @return $this|ChildPedidosQuery The current query, for fluid interface
     */
    public function prune($pedidos = null)
    {
        if ($pedidos) {
            $this->addUsingAlias(PedidosTableMap::COL_IDPEDIDO, $pedidos->getIdpedido(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pedidos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PedidosTableMap::clearInstancePool();
            PedidosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PedidosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PedidosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PedidosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PedidosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PedidosQuery

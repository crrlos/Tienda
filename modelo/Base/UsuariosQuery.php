<?php

namespace Base;

use \Usuarios as ChildUsuarios;
use \UsuariosQuery as ChildUsuariosQuery;
use \Exception;
use \PDO;
use Map\UsuariosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'usuarios' table.
 *
 *
 *
 * @method     ChildUsuariosQuery orderByIdusuario($order = Criteria::ASC) Order by the idusuario column
 * @method     ChildUsuariosQuery orderByNombreusuario($order = Criteria::ASC) Order by the nombreusuario column
 * @method     ChildUsuariosQuery orderByNombres($order = Criteria::ASC) Order by the nombres column
 * @method     ChildUsuariosQuery orderByApellidos($order = Criteria::ASC) Order by the apellidos column
 * @method     ChildUsuariosQuery orderByTelefono($order = Criteria::ASC) Order by the telefono column
 * @method     ChildUsuariosQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsuariosQuery orderByDireccion($order = Criteria::ASC) Order by the direccion column
 * @method     ChildUsuariosQuery orderByFecharegistro($order = Criteria::ASC) Order by the fecharegistro column
 * @method     ChildUsuariosQuery orderByIdrol($order = Criteria::ASC) Order by the idrol column
 * @method     ChildUsuariosQuery orderByClave($order = Criteria::ASC) Order by the clave column
 *
 * @method     ChildUsuariosQuery groupByIdusuario() Group by the idusuario column
 * @method     ChildUsuariosQuery groupByNombreusuario() Group by the nombreusuario column
 * @method     ChildUsuariosQuery groupByNombres() Group by the nombres column
 * @method     ChildUsuariosQuery groupByApellidos() Group by the apellidos column
 * @method     ChildUsuariosQuery groupByTelefono() Group by the telefono column
 * @method     ChildUsuariosQuery groupByEmail() Group by the email column
 * @method     ChildUsuariosQuery groupByDireccion() Group by the direccion column
 * @method     ChildUsuariosQuery groupByFecharegistro() Group by the fecharegistro column
 * @method     ChildUsuariosQuery groupByIdrol() Group by the idrol column
 * @method     ChildUsuariosQuery groupByClave() Group by the clave column
 *
 * @method     ChildUsuariosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsuariosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsuariosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsuariosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsuariosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsuariosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsuariosQuery leftJoinRoles($relationAlias = null) Adds a LEFT JOIN clause to the query using the Roles relation
 * @method     ChildUsuariosQuery rightJoinRoles($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Roles relation
 * @method     ChildUsuariosQuery innerJoinRoles($relationAlias = null) Adds a INNER JOIN clause to the query using the Roles relation
 *
 * @method     ChildUsuariosQuery joinWithRoles($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Roles relation
 *
 * @method     ChildUsuariosQuery leftJoinWithRoles() Adds a LEFT JOIN clause and with to the query using the Roles relation
 * @method     ChildUsuariosQuery rightJoinWithRoles() Adds a RIGHT JOIN clause and with to the query using the Roles relation
 * @method     ChildUsuariosQuery innerJoinWithRoles() Adds a INNER JOIN clause and with to the query using the Roles relation
 *
 * @method     ChildUsuariosQuery leftJoinHash($relationAlias = null) Adds a LEFT JOIN clause to the query using the Hash relation
 * @method     ChildUsuariosQuery rightJoinHash($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Hash relation
 * @method     ChildUsuariosQuery innerJoinHash($relationAlias = null) Adds a INNER JOIN clause to the query using the Hash relation
 *
 * @method     ChildUsuariosQuery joinWithHash($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Hash relation
 *
 * @method     ChildUsuariosQuery leftJoinWithHash() Adds a LEFT JOIN clause and with to the query using the Hash relation
 * @method     ChildUsuariosQuery rightJoinWithHash() Adds a RIGHT JOIN clause and with to the query using the Hash relation
 * @method     ChildUsuariosQuery innerJoinWithHash() Adds a INNER JOIN clause and with to the query using the Hash relation
 *
 * @method     ChildUsuariosQuery leftJoinPedidos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedidos relation
 * @method     ChildUsuariosQuery rightJoinPedidos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedidos relation
 * @method     ChildUsuariosQuery innerJoinPedidos($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedidos relation
 *
 * @method     ChildUsuariosQuery joinWithPedidos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pedidos relation
 *
 * @method     ChildUsuariosQuery leftJoinWithPedidos() Adds a LEFT JOIN clause and with to the query using the Pedidos relation
 * @method     ChildUsuariosQuery rightJoinWithPedidos() Adds a RIGHT JOIN clause and with to the query using the Pedidos relation
 * @method     ChildUsuariosQuery innerJoinWithPedidos() Adds a INNER JOIN clause and with to the query using the Pedidos relation
 *
 * @method     \RolesQuery|\HashQuery|\PedidosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsuarios findOne(ConnectionInterface $con = null) Return the first ChildUsuarios matching the query
 * @method     ChildUsuarios findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsuarios matching the query, or a new ChildUsuarios object populated from the query conditions when no match is found
 *
 * @method     ChildUsuarios findOneByIdusuario(int $idusuario) Return the first ChildUsuarios filtered by the idusuario column
 * @method     ChildUsuarios findOneByNombreusuario(string $nombreusuario) Return the first ChildUsuarios filtered by the nombreusuario column
 * @method     ChildUsuarios findOneByNombres(string $nombres) Return the first ChildUsuarios filtered by the nombres column
 * @method     ChildUsuarios findOneByApellidos(string $apellidos) Return the first ChildUsuarios filtered by the apellidos column
 * @method     ChildUsuarios findOneByTelefono(string $telefono) Return the first ChildUsuarios filtered by the telefono column
 * @method     ChildUsuarios findOneByEmail(string $email) Return the first ChildUsuarios filtered by the email column
 * @method     ChildUsuarios findOneByDireccion(string $direccion) Return the first ChildUsuarios filtered by the direccion column
 * @method     ChildUsuarios findOneByFecharegistro(string $fecharegistro) Return the first ChildUsuarios filtered by the fecharegistro column
 * @method     ChildUsuarios findOneByIdrol(int $idrol) Return the first ChildUsuarios filtered by the idrol column
 * @method     ChildUsuarios findOneByClave(string $clave) Return the first ChildUsuarios filtered by the clave column *

 * @method     ChildUsuarios requirePk($key, ConnectionInterface $con = null) Return the ChildUsuarios by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOne(ConnectionInterface $con = null) Return the first ChildUsuarios matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuarios requireOneByIdusuario(int $idusuario) Return the first ChildUsuarios filtered by the idusuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByNombreusuario(string $nombreusuario) Return the first ChildUsuarios filtered by the nombreusuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByNombres(string $nombres) Return the first ChildUsuarios filtered by the nombres column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByApellidos(string $apellidos) Return the first ChildUsuarios filtered by the apellidos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByTelefono(string $telefono) Return the first ChildUsuarios filtered by the telefono column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByEmail(string $email) Return the first ChildUsuarios filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByDireccion(string $direccion) Return the first ChildUsuarios filtered by the direccion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByFecharegistro(string $fecharegistro) Return the first ChildUsuarios filtered by the fecharegistro column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByIdrol(int $idrol) Return the first ChildUsuarios filtered by the idrol column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuarios requireOneByClave(string $clave) Return the first ChildUsuarios filtered by the clave column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuarios[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsuarios objects based on current ModelCriteria
 * @method     ChildUsuarios[]|ObjectCollection findByIdusuario(int $idusuario) Return ChildUsuarios objects filtered by the idusuario column
 * @method     ChildUsuarios[]|ObjectCollection findByNombreusuario(string $nombreusuario) Return ChildUsuarios objects filtered by the nombreusuario column
 * @method     ChildUsuarios[]|ObjectCollection findByNombres(string $nombres) Return ChildUsuarios objects filtered by the nombres column
 * @method     ChildUsuarios[]|ObjectCollection findByApellidos(string $apellidos) Return ChildUsuarios objects filtered by the apellidos column
 * @method     ChildUsuarios[]|ObjectCollection findByTelefono(string $telefono) Return ChildUsuarios objects filtered by the telefono column
 * @method     ChildUsuarios[]|ObjectCollection findByEmail(string $email) Return ChildUsuarios objects filtered by the email column
 * @method     ChildUsuarios[]|ObjectCollection findByDireccion(string $direccion) Return ChildUsuarios objects filtered by the direccion column
 * @method     ChildUsuarios[]|ObjectCollection findByFecharegistro(string $fecharegistro) Return ChildUsuarios objects filtered by the fecharegistro column
 * @method     ChildUsuarios[]|ObjectCollection findByIdrol(int $idrol) Return ChildUsuarios objects filtered by the idrol column
 * @method     ChildUsuarios[]|ObjectCollection findByClave(string $clave) Return ChildUsuarios objects filtered by the clave column
 * @method     ChildUsuarios[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsuariosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsuariosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Usuarios', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsuariosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsuariosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsuariosQuery) {
            return $criteria;
        }
        $query = new ChildUsuariosQuery();
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
     * @return ChildUsuarios|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsuariosTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuariosTableMap::DATABASE_NAME);
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
     * @return ChildUsuarios A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idusuario, nombreusuario, nombres, apellidos, telefono, email, direccion, fecharegistro, idrol, clave FROM usuarios WHERE idusuario = :p0';
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
            /** @var ChildUsuarios $obj */
            $obj = new ChildUsuarios();
            $obj->hydrate($row);
            UsuariosTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildUsuarios|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuariosTableMap::COL_IDUSUARIO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuariosTableMap::COL_IDUSUARIO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idusuario column
     *
     * Example usage:
     * <code>
     * $query->filterByIdusuario(1234); // WHERE idusuario = 1234
     * $query->filterByIdusuario(array(12, 34)); // WHERE idusuario IN (12, 34)
     * $query->filterByIdusuario(array('min' => 12)); // WHERE idusuario > 12
     * </code>
     *
     * @param     mixed $idusuario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (is_array($idusuario)) {
            $useMinMax = false;
            if (isset($idusuario['min'])) {
                $this->addUsingAlias(UsuariosTableMap::COL_IDUSUARIO, $idusuario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idusuario['max'])) {
                $this->addUsingAlias(UsuariosTableMap::COL_IDUSUARIO, $idusuario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariosTableMap::COL_IDUSUARIO, $idusuario, $comparison);
    }

    /**
     * Filter the query on the nombreusuario column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreusuario('fooValue');   // WHERE nombreusuario = 'fooValue'
     * $query->filterByNombreusuario('%fooValue%'); // WHERE nombreusuario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreusuario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByNombreusuario($nombreusuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreusuario)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreusuario)) {
                $nombreusuario = str_replace('*', '%', $nombreusuario);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuariosTableMap::COL_NOMBREUSUARIO, $nombreusuario, $comparison);
    }

    /**
     * Filter the query on the nombres column
     *
     * Example usage:
     * <code>
     * $query->filterByNombres('fooValue');   // WHERE nombres = 'fooValue'
     * $query->filterByNombres('%fooValue%'); // WHERE nombres LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombres The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByNombres($nombres = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombres)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombres)) {
                $nombres = str_replace('*', '%', $nombres);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuariosTableMap::COL_NOMBRES, $nombres, $comparison);
    }

    /**
     * Filter the query on the apellidos column
     *
     * Example usage:
     * <code>
     * $query->filterByApellidos('fooValue');   // WHERE apellidos = 'fooValue'
     * $query->filterByApellidos('%fooValue%'); // WHERE apellidos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apellidos The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByApellidos($apellidos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellidos)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $apellidos)) {
                $apellidos = str_replace('*', '%', $apellidos);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuariosTableMap::COL_APELLIDOS, $apellidos, $comparison);
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
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UsuariosTableMap::COL_TELEFONO, $telefono, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuariosTableMap::COL_EMAIL, $email, $comparison);
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
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(UsuariosTableMap::COL_DIRECCION, $direccion, $comparison);
    }

    /**
     * Filter the query on the fecharegistro column
     *
     * Example usage:
     * <code>
     * $query->filterByFecharegistro('2011-03-14'); // WHERE fecharegistro = '2011-03-14'
     * $query->filterByFecharegistro('now'); // WHERE fecharegistro = '2011-03-14'
     * $query->filterByFecharegistro(array('max' => 'yesterday')); // WHERE fecharegistro > '2011-03-13'
     * </code>
     *
     * @param     mixed $fecharegistro The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByFecharegistro($fecharegistro = null, $comparison = null)
    {
        if (is_array($fecharegistro)) {
            $useMinMax = false;
            if (isset($fecharegistro['min'])) {
                $this->addUsingAlias(UsuariosTableMap::COL_FECHAREGISTRO, $fecharegistro['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fecharegistro['max'])) {
                $this->addUsingAlias(UsuariosTableMap::COL_FECHAREGISTRO, $fecharegistro['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariosTableMap::COL_FECHAREGISTRO, $fecharegistro, $comparison);
    }

    /**
     * Filter the query on the idrol column
     *
     * Example usage:
     * <code>
     * $query->filterByIdrol(1234); // WHERE idrol = 1234
     * $query->filterByIdrol(array(12, 34)); // WHERE idrol IN (12, 34)
     * $query->filterByIdrol(array('min' => 12)); // WHERE idrol > 12
     * </code>
     *
     * @see       filterByRoles()
     *
     * @param     mixed $idrol The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByIdrol($idrol = null, $comparison = null)
    {
        if (is_array($idrol)) {
            $useMinMax = false;
            if (isset($idrol['min'])) {
                $this->addUsingAlias(UsuariosTableMap::COL_IDROL, $idrol['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idrol['max'])) {
                $this->addUsingAlias(UsuariosTableMap::COL_IDROL, $idrol['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariosTableMap::COL_IDROL, $idrol, $comparison);
    }

    /**
     * Filter the query on the clave column
     *
     * Example usage:
     * <code>
     * $query->filterByClave('fooValue');   // WHERE clave = 'fooValue'
     * $query->filterByClave('%fooValue%'); // WHERE clave LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clave The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByClave($clave = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clave)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $clave)) {
                $clave = str_replace('*', '%', $clave);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuariosTableMap::COL_CLAVE, $clave, $comparison);
    }

    /**
     * Filter the query by a related \Roles object
     *
     * @param \Roles|ObjectCollection $roles The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByRoles($roles, $comparison = null)
    {
        if ($roles instanceof \Roles) {
            return $this
                ->addUsingAlias(UsuariosTableMap::COL_IDROL, $roles->getIdrol(), $comparison);
        } elseif ($roles instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuariosTableMap::COL_IDROL, $roles->toKeyValue('PrimaryKey', 'Idrol'), $comparison);
        } else {
            throw new PropelException('filterByRoles() only accepts arguments of type \Roles or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Roles relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function joinRoles($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Roles');

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
            $this->addJoinObject($join, 'Roles');
        }

        return $this;
    }

    /**
     * Use the Roles relation Roles object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RolesQuery A secondary query class using the current class as primary query
     */
    public function useRolesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRoles($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Roles', '\RolesQuery');
    }

    /**
     * Filter the query by a related \Hash object
     *
     * @param \Hash|ObjectCollection $hash the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByHash($hash, $comparison = null)
    {
        if ($hash instanceof \Hash) {
            return $this
                ->addUsingAlias(UsuariosTableMap::COL_IDUSUARIO, $hash->getIdusuario(), $comparison);
        } elseif ($hash instanceof ObjectCollection) {
            return $this
                ->useHashQuery()
                ->filterByPrimaryKeys($hash->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByHash() only accepts arguments of type \Hash or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Hash relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function joinHash($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Hash');

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
            $this->addJoinObject($join, 'Hash');
        }

        return $this;
    }

    /**
     * Use the Hash relation Hash object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \HashQuery A secondary query class using the current class as primary query
     */
    public function useHashQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinHash($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Hash', '\HashQuery');
    }

    /**
     * Filter the query by a related \Pedidos object
     *
     * @param \Pedidos|ObjectCollection $pedidos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsuariosQuery The current query, for fluid interface
     */
    public function filterByPedidos($pedidos, $comparison = null)
    {
        if ($pedidos instanceof \Pedidos) {
            return $this
                ->addUsingAlias(UsuariosTableMap::COL_IDUSUARIO, $pedidos->getIdcliente(), $comparison);
        } elseif ($pedidos instanceof ObjectCollection) {
            return $this
                ->usePedidosQuery()
                ->filterByPrimaryKeys($pedidos->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
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
     * @param   ChildUsuarios $usuarios Object to remove from the list of results
     *
     * @return $this|ChildUsuariosQuery The current query, for fluid interface
     */
    public function prune($usuarios = null)
    {
        if ($usuarios) {
            $this->addUsingAlias(UsuariosTableMap::COL_IDUSUARIO, $usuarios->getIdusuario(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the usuarios table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuariosTableMap::clearInstancePool();
            UsuariosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsuariosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsuariosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsuariosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsuariosQuery

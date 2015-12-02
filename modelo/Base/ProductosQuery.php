<?php

namespace Base;

use \Productos as ChildProductos;
use \ProductosQuery as ChildProductosQuery;
use \Exception;
use \PDO;
use Map\ProductosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'productos' table.
 *
 *
 *
 * @method     ChildProductosQuery orderByIdproducto($order = Criteria::ASC) Order by the idproducto column
 * @method     ChildProductosQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildProductosQuery orderByDetalle($order = Criteria::ASC) Order by the detalle column
 * @method     ChildProductosQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 * @method     ChildProductosQuery orderByPrecio($order = Criteria::ASC) Order by the precio column
 * @method     ChildProductosQuery orderByIdsubcategoria($order = Criteria::ASC) Order by the idsubcategoria column
 * @method     ChildProductosQuery orderByIddescuento($order = Criteria::ASC) Order by the iddescuento column
 *
 * @method     ChildProductosQuery groupByIdproducto() Group by the idproducto column
 * @method     ChildProductosQuery groupByNombre() Group by the nombre column
 * @method     ChildProductosQuery groupByDetalle() Group by the detalle column
 * @method     ChildProductosQuery groupByDescripcion() Group by the descripcion column
 * @method     ChildProductosQuery groupByPrecio() Group by the precio column
 * @method     ChildProductosQuery groupByIdsubcategoria() Group by the idsubcategoria column
 * @method     ChildProductosQuery groupByIddescuento() Group by the iddescuento column
 *
 * @method     ChildProductosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductosQuery leftJoinDescuentos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Descuentos relation
 * @method     ChildProductosQuery rightJoinDescuentos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Descuentos relation
 * @method     ChildProductosQuery innerJoinDescuentos($relationAlias = null) Adds a INNER JOIN clause to the query using the Descuentos relation
 *
 * @method     ChildProductosQuery joinWithDescuentos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Descuentos relation
 *
 * @method     ChildProductosQuery leftJoinWithDescuentos() Adds a LEFT JOIN clause and with to the query using the Descuentos relation
 * @method     ChildProductosQuery rightJoinWithDescuentos() Adds a RIGHT JOIN clause and with to the query using the Descuentos relation
 * @method     ChildProductosQuery innerJoinWithDescuentos() Adds a INNER JOIN clause and with to the query using the Descuentos relation
 *
 * @method     ChildProductosQuery leftJoinSubcategorias($relationAlias = null) Adds a LEFT JOIN clause to the query using the Subcategorias relation
 * @method     ChildProductosQuery rightJoinSubcategorias($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Subcategorias relation
 * @method     ChildProductosQuery innerJoinSubcategorias($relationAlias = null) Adds a INNER JOIN clause to the query using the Subcategorias relation
 *
 * @method     ChildProductosQuery joinWithSubcategorias($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Subcategorias relation
 *
 * @method     ChildProductosQuery leftJoinWithSubcategorias() Adds a LEFT JOIN clause and with to the query using the Subcategorias relation
 * @method     ChildProductosQuery rightJoinWithSubcategorias() Adds a RIGHT JOIN clause and with to the query using the Subcategorias relation
 * @method     ChildProductosQuery innerJoinWithSubcategorias() Adds a INNER JOIN clause and with to the query using the Subcategorias relation
 *
 * @method     ChildProductosQuery leftJoinDetallepedidos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Detallepedidos relation
 * @method     ChildProductosQuery rightJoinDetallepedidos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Detallepedidos relation
 * @method     ChildProductosQuery innerJoinDetallepedidos($relationAlias = null) Adds a INNER JOIN clause to the query using the Detallepedidos relation
 *
 * @method     ChildProductosQuery joinWithDetallepedidos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Detallepedidos relation
 *
 * @method     ChildProductosQuery leftJoinWithDetallepedidos() Adds a LEFT JOIN clause and with to the query using the Detallepedidos relation
 * @method     ChildProductosQuery rightJoinWithDetallepedidos() Adds a RIGHT JOIN clause and with to the query using the Detallepedidos relation
 * @method     ChildProductosQuery innerJoinWithDetallepedidos() Adds a INNER JOIN clause and with to the query using the Detallepedidos relation
 *
 * @method     \DescuentosQuery|\SubcategoriasQuery|\DetallepedidosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProductos findOne(ConnectionInterface $con = null) Return the first ChildProductos matching the query
 * @method     ChildProductos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProductos matching the query, or a new ChildProductos object populated from the query conditions when no match is found
 *
 * @method     ChildProductos findOneByIdproducto(int $idproducto) Return the first ChildProductos filtered by the idproducto column
 * @method     ChildProductos findOneByNombre(string $nombre) Return the first ChildProductos filtered by the nombre column
 * @method     ChildProductos findOneByDetalle(string $detalle) Return the first ChildProductos filtered by the detalle column
 * @method     ChildProductos findOneByDescripcion(string $descripcion) Return the first ChildProductos filtered by the descripcion column
 * @method     ChildProductos findOneByPrecio(double $precio) Return the first ChildProductos filtered by the precio column
 * @method     ChildProductos findOneByIdsubcategoria(int $idsubcategoria) Return the first ChildProductos filtered by the idsubcategoria column
 * @method     ChildProductos findOneByIddescuento(int $iddescuento) Return the first ChildProductos filtered by the iddescuento column *

 * @method     ChildProductos requirePk($key, ConnectionInterface $con = null) Return the ChildProductos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductos requireOne(ConnectionInterface $con = null) Return the first ChildProductos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductos requireOneByIdproducto(int $idproducto) Return the first ChildProductos filtered by the idproducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductos requireOneByNombre(string $nombre) Return the first ChildProductos filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductos requireOneByDetalle(string $detalle) Return the first ChildProductos filtered by the detalle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductos requireOneByDescripcion(string $descripcion) Return the first ChildProductos filtered by the descripcion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductos requireOneByPrecio(double $precio) Return the first ChildProductos filtered by the precio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductos requireOneByIdsubcategoria(int $idsubcategoria) Return the first ChildProductos filtered by the idsubcategoria column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProductos requireOneByIddescuento(int $iddescuento) Return the first ChildProductos filtered by the iddescuento column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProductos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProductos objects based on current ModelCriteria
 * @method     ChildProductos[]|ObjectCollection findByIdproducto(int $idproducto) Return ChildProductos objects filtered by the idproducto column
 * @method     ChildProductos[]|ObjectCollection findByNombre(string $nombre) Return ChildProductos objects filtered by the nombre column
 * @method     ChildProductos[]|ObjectCollection findByDetalle(string $detalle) Return ChildProductos objects filtered by the detalle column
 * @method     ChildProductos[]|ObjectCollection findByDescripcion(string $descripcion) Return ChildProductos objects filtered by the descripcion column
 * @method     ChildProductos[]|ObjectCollection findByPrecio(double $precio) Return ChildProductos objects filtered by the precio column
 * @method     ChildProductos[]|ObjectCollection findByIdsubcategoria(int $idsubcategoria) Return ChildProductos objects filtered by the idsubcategoria column
 * @method     ChildProductos[]|ObjectCollection findByIddescuento(int $iddescuento) Return ChildProductos objects filtered by the iddescuento column
 * @method     ChildProductos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProductosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Productos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductosQuery) {
            return $criteria;
        }
        $query = new ChildProductosQuery();
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
     * @return ChildProductos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProductosTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductosTableMap::DATABASE_NAME);
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
     * @return ChildProductos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idproducto, nombre, detalle, descripcion, precio, idsubcategoria, iddescuento FROM productos WHERE idproducto = :p0';
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
            /** @var ChildProductos $obj */
            $obj = new ChildProductos();
            $obj->hydrate($row);
            ProductosTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProductos|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductosTableMap::COL_IDPRODUCTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductosTableMap::COL_IDPRODUCTO, $keys, Criteria::IN);
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
     * @param     mixed $idproducto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function filterByIdproducto($idproducto = null, $comparison = null)
    {
        if (is_array($idproducto)) {
            $useMinMax = false;
            if (isset($idproducto['min'])) {
                $this->addUsingAlias(ProductosTableMap::COL_IDPRODUCTO, $idproducto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idproducto['max'])) {
                $this->addUsingAlias(ProductosTableMap::COL_IDPRODUCTO, $idproducto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductosTableMap::COL_IDPRODUCTO, $idproducto, $comparison);
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
     * @return $this|ChildProductosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProductosTableMap::COL_NOMBRE, $nombre, $comparison);
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
     * @return $this|ChildProductosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProductosTableMap::COL_DETALLE, $detalle, $comparison);
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%'); // WHERE descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descripcion)) {
                $descripcion = str_replace('*', '%', $descripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductosTableMap::COL_DESCRIPCION, $descripcion, $comparison);
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
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function filterByPrecio($precio = null, $comparison = null)
    {
        if (is_array($precio)) {
            $useMinMax = false;
            if (isset($precio['min'])) {
                $this->addUsingAlias(ProductosTableMap::COL_PRECIO, $precio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precio['max'])) {
                $this->addUsingAlias(ProductosTableMap::COL_PRECIO, $precio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductosTableMap::COL_PRECIO, $precio, $comparison);
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
     * @see       filterBySubcategorias()
     *
     * @param     mixed $idsubcategoria The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function filterByIdsubcategoria($idsubcategoria = null, $comparison = null)
    {
        if (is_array($idsubcategoria)) {
            $useMinMax = false;
            if (isset($idsubcategoria['min'])) {
                $this->addUsingAlias(ProductosTableMap::COL_IDSUBCATEGORIA, $idsubcategoria['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idsubcategoria['max'])) {
                $this->addUsingAlias(ProductosTableMap::COL_IDSUBCATEGORIA, $idsubcategoria['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductosTableMap::COL_IDSUBCATEGORIA, $idsubcategoria, $comparison);
    }

    /**
     * Filter the query on the iddescuento column
     *
     * Example usage:
     * <code>
     * $query->filterByIddescuento(1234); // WHERE iddescuento = 1234
     * $query->filterByIddescuento(array(12, 34)); // WHERE iddescuento IN (12, 34)
     * $query->filterByIddescuento(array('min' => 12)); // WHERE iddescuento > 12
     * </code>
     *
     * @see       filterByDescuentos()
     *
     * @param     mixed $iddescuento The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function filterByIddescuento($iddescuento = null, $comparison = null)
    {
        if (is_array($iddescuento)) {
            $useMinMax = false;
            if (isset($iddescuento['min'])) {
                $this->addUsingAlias(ProductosTableMap::COL_IDDESCUENTO, $iddescuento['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iddescuento['max'])) {
                $this->addUsingAlias(ProductosTableMap::COL_IDDESCUENTO, $iddescuento['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductosTableMap::COL_IDDESCUENTO, $iddescuento, $comparison);
    }

    /**
     * Filter the query by a related \Descuentos object
     *
     * @param \Descuentos|ObjectCollection $descuentos The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductosQuery The current query, for fluid interface
     */
    public function filterByDescuentos($descuentos, $comparison = null)
    {
        if ($descuentos instanceof \Descuentos) {
            return $this
                ->addUsingAlias(ProductosTableMap::COL_IDDESCUENTO, $descuentos->getIddescuento(), $comparison);
        } elseif ($descuentos instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductosTableMap::COL_IDDESCUENTO, $descuentos->toKeyValue('PrimaryKey', 'Iddescuento'), $comparison);
        } else {
            throw new PropelException('filterByDescuentos() only accepts arguments of type \Descuentos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Descuentos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function joinDescuentos($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Descuentos');

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
            $this->addJoinObject($join, 'Descuentos');
        }

        return $this;
    }

    /**
     * Use the Descuentos relation Descuentos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DescuentosQuery A secondary query class using the current class as primary query
     */
    public function useDescuentosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinDescuentos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Descuentos', '\DescuentosQuery');
    }

    /**
     * Filter the query by a related \Subcategorias object
     *
     * @param \Subcategorias|ObjectCollection $subcategorias The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductosQuery The current query, for fluid interface
     */
    public function filterBySubcategorias($subcategorias, $comparison = null)
    {
        if ($subcategorias instanceof \Subcategorias) {
            return $this
                ->addUsingAlias(ProductosTableMap::COL_IDSUBCATEGORIA, $subcategorias->getIdsubcategoria(), $comparison);
        } elseif ($subcategorias instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductosTableMap::COL_IDSUBCATEGORIA, $subcategorias->toKeyValue('PrimaryKey', 'Idsubcategoria'), $comparison);
        } else {
            throw new PropelException('filterBySubcategorias() only accepts arguments of type \Subcategorias or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Subcategorias relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function joinSubcategorias($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Subcategorias');

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
            $this->addJoinObject($join, 'Subcategorias');
        }

        return $this;
    }

    /**
     * Use the Subcategorias relation Subcategorias object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SubcategoriasQuery A secondary query class using the current class as primary query
     */
    public function useSubcategoriasQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSubcategorias($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Subcategorias', '\SubcategoriasQuery');
    }

    /**
     * Filter the query by a related \Detallepedidos object
     *
     * @param \Detallepedidos|ObjectCollection $detallepedidos the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductosQuery The current query, for fluid interface
     */
    public function filterByDetallepedidos($detallepedidos, $comparison = null)
    {
        if ($detallepedidos instanceof \Detallepedidos) {
            return $this
                ->addUsingAlias(ProductosTableMap::COL_IDPRODUCTO, $detallepedidos->getIdproducto(), $comparison);
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
     * @return $this|ChildProductosQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildProductos $productos Object to remove from the list of results
     *
     * @return $this|ChildProductosQuery The current query, for fluid interface
     */
    public function prune($productos = null)
    {
        if ($productos) {
            $this->addUsingAlias(ProductosTableMap::COL_IDPRODUCTO, $productos->getIdproducto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the productos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductosTableMap::clearInstancePool();
            ProductosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductosQuery

<?php

namespace Base;

use \Imagenes as ChildImagenes;
use \ImagenesQuery as ChildImagenesQuery;
use \Exception;
use \PDO;
use Map\ImagenesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'imagenes' table.
 *
 *
 *
 * @method     ChildImagenesQuery orderByIdimagen($order = Criteria::ASC) Order by the idimagen column
 * @method     ChildImagenesQuery orderByIdproducto($order = Criteria::ASC) Order by the idproducto column
 * @method     ChildImagenesQuery orderByUrl($order = Criteria::ASC) Order by the url column
 *
 * @method     ChildImagenesQuery groupByIdimagen() Group by the idimagen column
 * @method     ChildImagenesQuery groupByIdproducto() Group by the idproducto column
 * @method     ChildImagenesQuery groupByUrl() Group by the url column
 *
 * @method     ChildImagenesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildImagenesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildImagenesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildImagenesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildImagenesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildImagenesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildImagenes findOne(ConnectionInterface $con = null) Return the first ChildImagenes matching the query
 * @method     ChildImagenes findOneOrCreate(ConnectionInterface $con = null) Return the first ChildImagenes matching the query, or a new ChildImagenes object populated from the query conditions when no match is found
 *
 * @method     ChildImagenes findOneByIdimagen(int $idimagen) Return the first ChildImagenes filtered by the idimagen column
 * @method     ChildImagenes findOneByIdproducto(int $idproducto) Return the first ChildImagenes filtered by the idproducto column
 * @method     ChildImagenes findOneByUrl(string $url) Return the first ChildImagenes filtered by the url column *

 * @method     ChildImagenes requirePk($key, ConnectionInterface $con = null) Return the ChildImagenes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImagenes requireOne(ConnectionInterface $con = null) Return the first ChildImagenes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildImagenes requireOneByIdimagen(int $idimagen) Return the first ChildImagenes filtered by the idimagen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImagenes requireOneByIdproducto(int $idproducto) Return the first ChildImagenes filtered by the idproducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImagenes requireOneByUrl(string $url) Return the first ChildImagenes filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildImagenes[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildImagenes objects based on current ModelCriteria
 * @method     ChildImagenes[]|ObjectCollection findByIdimagen(int $idimagen) Return ChildImagenes objects filtered by the idimagen column
 * @method     ChildImagenes[]|ObjectCollection findByIdproducto(int $idproducto) Return ChildImagenes objects filtered by the idproducto column
 * @method     ChildImagenes[]|ObjectCollection findByUrl(string $url) Return ChildImagenes objects filtered by the url column
 * @method     ChildImagenes[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ImagenesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ImagenesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Imagenes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildImagenesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildImagenesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildImagenesQuery) {
            return $criteria;
        }
        $query = new ChildImagenesQuery();
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
     * @return ChildImagenes|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ImagenesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ImagenesTableMap::DATABASE_NAME);
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
     * @return ChildImagenes A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idimagen, idproducto, url FROM imagenes WHERE idimagen = :p0';
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
            /** @var ChildImagenes $obj */
            $obj = new ChildImagenes();
            $obj->hydrate($row);
            ImagenesTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildImagenes|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildImagenesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ImagenesTableMap::COL_IDIMAGEN, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildImagenesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ImagenesTableMap::COL_IDIMAGEN, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idimagen column
     *
     * Example usage:
     * <code>
     * $query->filterByIdimagen(1234); // WHERE idimagen = 1234
     * $query->filterByIdimagen(array(12, 34)); // WHERE idimagen IN (12, 34)
     * $query->filterByIdimagen(array('min' => 12)); // WHERE idimagen > 12
     * </code>
     *
     * @param     mixed $idimagen The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImagenesQuery The current query, for fluid interface
     */
    public function filterByIdimagen($idimagen = null, $comparison = null)
    {
        if (is_array($idimagen)) {
            $useMinMax = false;
            if (isset($idimagen['min'])) {
                $this->addUsingAlias(ImagenesTableMap::COL_IDIMAGEN, $idimagen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idimagen['max'])) {
                $this->addUsingAlias(ImagenesTableMap::COL_IDIMAGEN, $idimagen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImagenesTableMap::COL_IDIMAGEN, $idimagen, $comparison);
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
     * @return $this|ChildImagenesQuery The current query, for fluid interface
     */
    public function filterByIdproducto($idproducto = null, $comparison = null)
    {
        if (is_array($idproducto)) {
            $useMinMax = false;
            if (isset($idproducto['min'])) {
                $this->addUsingAlias(ImagenesTableMap::COL_IDPRODUCTO, $idproducto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idproducto['max'])) {
                $this->addUsingAlias(ImagenesTableMap::COL_IDPRODUCTO, $idproducto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImagenesTableMap::COL_IDPRODUCTO, $idproducto, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImagenesQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ImagenesTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildImagenes $imagenes Object to remove from the list of results
     *
     * @return $this|ChildImagenesQuery The current query, for fluid interface
     */
    public function prune($imagenes = null)
    {
        if ($imagenes) {
            $this->addUsingAlias(ImagenesTableMap::COL_IDIMAGEN, $imagenes->getIdimagen(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the imagenes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ImagenesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ImagenesTableMap::clearInstancePool();
            ImagenesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ImagenesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ImagenesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ImagenesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ImagenesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ImagenesQuery

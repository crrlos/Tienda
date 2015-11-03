<?php

namespace Base;

use \Descuentos as ChildDescuentos;
use \DescuentosQuery as ChildDescuentosQuery;
use \Detallecompras as ChildDetallecompras;
use \DetallecomprasQuery as ChildDetallecomprasQuery;
use \Detallepedidos as ChildDetallepedidos;
use \DetallepedidosQuery as ChildDetallepedidosQuery;
use \Inventario as ChildInventario;
use \InventarioQuery as ChildInventarioQuery;
use \Productos as ChildProductos;
use \ProductosQuery as ChildProductosQuery;
use \Subcategorias as ChildSubcategorias;
use \SubcategoriasQuery as ChildSubcategoriasQuery;
use \Exception;
use \PDO;
use Map\ProductosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'productos' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Productos implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ProductosTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the idproducto field.
     *
     * @var        int
     */
    protected $idproducto;

    /**
     * The value for the nombre field.
     *
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the detalle field.
     *
     * @var        string
     */
    protected $detalle;

    /**
     * The value for the descripcion field.
     *
     * @var        string
     */
    protected $descripcion;

    /**
     * The value for the precio field.
     *
     * @var        double
     */
    protected $precio;

    /**
     * The value for the idsubcategoria field.
     *
     * @var        int
     */
    protected $idsubcategoria;

    /**
     * The value for the iddescuento field.
     *
     * @var        int
     */
    protected $iddescuento;

    /**
     * @var        ChildDescuentos
     */
    protected $aDescuentos;

    /**
     * @var        ChildSubcategorias
     */
    protected $aSubcategorias;

    /**
     * @var        ObjectCollection|ChildDetallecompras[] Collection to store aggregation of ChildDetallecompras objects.
     */
    protected $collDetallecomprass;
    protected $collDetallecomprassPartial;

    /**
     * @var        ObjectCollection|ChildDetallepedidos[] Collection to store aggregation of ChildDetallepedidos objects.
     */
    protected $collDetallepedidoss;
    protected $collDetallepedidossPartial;

    /**
     * @var        ObjectCollection|ChildInventario[] Collection to store aggregation of ChildInventario objects.
     */
    protected $collInventarios;
    protected $collInventariosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDetallecompras[]
     */
    protected $detallecomprassScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDetallepedidos[]
     */
    protected $detallepedidossScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildInventario[]
     */
    protected $inventariosScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Productos object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Productos</code> instance.  If
     * <code>obj</code> is an instance of <code>Productos</code>, delegates to
     * <code>equals(Productos)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Productos The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [idproducto] column value.
     *
     * @return int
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Get the [nombre] column value.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the [detalle] column value.
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Get the [descripcion] column value.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the [precio] column value.
     *
     * @return double
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Get the [idsubcategoria] column value.
     *
     * @return int
     */
    public function getIdsubcategoria()
    {
        return $this->idsubcategoria;
    }

    /**
     * Get the [iddescuento] column value.
     *
     * @return int
     */
    public function getIddescuento()
    {
        return $this->iddescuento;
    }

    /**
     * Set the value of [idproducto] column.
     *
     * @param int $v new value
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function setIdproducto($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idproducto !== $v) {
            $this->idproducto = $v;
            $this->modifiedColumns[ProductosTableMap::COL_IDPRODUCTO] = true;
        }

        return $this;
    } // setIdproducto()

    /**
     * Set the value of [nombre] column.
     *
     * @param string $v new value
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[ProductosTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [detalle] column.
     *
     * @param string $v new value
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function setDetalle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->detalle !== $v) {
            $this->detalle = $v;
            $this->modifiedColumns[ProductosTableMap::COL_DETALLE] = true;
        }

        return $this;
    } // setDetalle()

    /**
     * Set the value of [descripcion] column.
     *
     * @param string $v new value
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[ProductosTableMap::COL_DESCRIPCION] = true;
        }

        return $this;
    } // setDescripcion()

    /**
     * Set the value of [precio] column.
     *
     * @param double $v new value
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function setPrecio($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->precio !== $v) {
            $this->precio = $v;
            $this->modifiedColumns[ProductosTableMap::COL_PRECIO] = true;
        }

        return $this;
    } // setPrecio()

    /**
     * Set the value of [idsubcategoria] column.
     *
     * @param int $v new value
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function setIdsubcategoria($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idsubcategoria !== $v) {
            $this->idsubcategoria = $v;
            $this->modifiedColumns[ProductosTableMap::COL_IDSUBCATEGORIA] = true;
        }

        if ($this->aSubcategorias !== null && $this->aSubcategorias->getIdsubcategoria() !== $v) {
            $this->aSubcategorias = null;
        }

        return $this;
    } // setIdsubcategoria()

    /**
     * Set the value of [iddescuento] column.
     *
     * @param int $v new value
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function setIddescuento($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->iddescuento !== $v) {
            $this->iddescuento = $v;
            $this->modifiedColumns[ProductosTableMap::COL_IDDESCUENTO] = true;
        }

        if ($this->aDescuentos !== null && $this->aDescuentos->getIddescuento() !== $v) {
            $this->aDescuentos = null;
        }

        return $this;
    } // setIddescuento()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductosTableMap::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idproducto = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductosTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductosTableMap::translateFieldName('Detalle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->detalle = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductosTableMap::translateFieldName('Descripcion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descripcion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductosTableMap::translateFieldName('Precio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->precio = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductosTableMap::translateFieldName('Idsubcategoria', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idsubcategoria = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductosTableMap::translateFieldName('Iddescuento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iddescuento = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = ProductosTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Productos'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aSubcategorias !== null && $this->idsubcategoria !== $this->aSubcategorias->getIdsubcategoria()) {
            $this->aSubcategorias = null;
        }
        if ($this->aDescuentos !== null && $this->iddescuento !== $this->aDescuentos->getIddescuento()) {
            $this->aDescuentos = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductosTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductosQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDescuentos = null;
            $this->aSubcategorias = null;
            $this->collDetallecomprass = null;

            $this->collDetallepedidoss = null;

            $this->collInventarios = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Productos::setDeleted()
     * @see Productos::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductosTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductosQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductosTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ProductosTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aDescuentos !== null) {
                if ($this->aDescuentos->isModified() || $this->aDescuentos->isNew()) {
                    $affectedRows += $this->aDescuentos->save($con);
                }
                $this->setDescuentos($this->aDescuentos);
            }

            if ($this->aSubcategorias !== null) {
                if ($this->aSubcategorias->isModified() || $this->aSubcategorias->isNew()) {
                    $affectedRows += $this->aSubcategorias->save($con);
                }
                $this->setSubcategorias($this->aSubcategorias);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->detallecomprassScheduledForDeletion !== null) {
                if (!$this->detallecomprassScheduledForDeletion->isEmpty()) {
                    foreach ($this->detallecomprassScheduledForDeletion as $detallecompras) {
                        // need to save related object because we set the relation to null
                        $detallecompras->save($con);
                    }
                    $this->detallecomprassScheduledForDeletion = null;
                }
            }

            if ($this->collDetallecomprass !== null) {
                foreach ($this->collDetallecomprass as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->detallepedidossScheduledForDeletion !== null) {
                if (!$this->detallepedidossScheduledForDeletion->isEmpty()) {
                    foreach ($this->detallepedidossScheduledForDeletion as $detallepedidos) {
                        // need to save related object because we set the relation to null
                        $detallepedidos->save($con);
                    }
                    $this->detallepedidossScheduledForDeletion = null;
                }
            }

            if ($this->collDetallepedidoss !== null) {
                foreach ($this->collDetallepedidoss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->inventariosScheduledForDeletion !== null) {
                if (!$this->inventariosScheduledForDeletion->isEmpty()) {
                    foreach ($this->inventariosScheduledForDeletion as $inventario) {
                        // need to save related object because we set the relation to null
                        $inventario->save($con);
                    }
                    $this->inventariosScheduledForDeletion = null;
                }
            }

            if ($this->collInventarios !== null) {
                foreach ($this->collInventarios as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ProductosTableMap::COL_IDPRODUCTO] = true;
        if (null !== $this->idproducto) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProductosTableMap::COL_IDPRODUCTO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductosTableMap::COL_IDPRODUCTO)) {
            $modifiedColumns[':p' . $index++]  = 'idproducto';
        }
        if ($this->isColumnModified(ProductosTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'nombre';
        }
        if ($this->isColumnModified(ProductosTableMap::COL_DETALLE)) {
            $modifiedColumns[':p' . $index++]  = 'detalle';
        }
        if ($this->isColumnModified(ProductosTableMap::COL_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = 'descripcion';
        }
        if ($this->isColumnModified(ProductosTableMap::COL_PRECIO)) {
            $modifiedColumns[':p' . $index++]  = 'precio';
        }
        if ($this->isColumnModified(ProductosTableMap::COL_IDSUBCATEGORIA)) {
            $modifiedColumns[':p' . $index++]  = 'idsubcategoria';
        }
        if ($this->isColumnModified(ProductosTableMap::COL_IDDESCUENTO)) {
            $modifiedColumns[':p' . $index++]  = 'iddescuento';
        }

        $sql = sprintf(
            'INSERT INTO productos (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idproducto':
                        $stmt->bindValue($identifier, $this->idproducto, PDO::PARAM_INT);
                        break;
                    case 'nombre':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'detalle':
                        $stmt->bindValue($identifier, $this->detalle, PDO::PARAM_STR);
                        break;
                    case 'descripcion':
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
                        break;
                    case 'precio':
                        $stmt->bindValue($identifier, $this->precio, PDO::PARAM_STR);
                        break;
                    case 'idsubcategoria':
                        $stmt->bindValue($identifier, $this->idsubcategoria, PDO::PARAM_INT);
                        break;
                    case 'iddescuento':
                        $stmt->bindValue($identifier, $this->iddescuento, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdproducto($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdproducto();
                break;
            case 1:
                return $this->getNombre();
                break;
            case 2:
                return $this->getDetalle();
                break;
            case 3:
                return $this->getDescripcion();
                break;
            case 4:
                return $this->getPrecio();
                break;
            case 5:
                return $this->getIdsubcategoria();
                break;
            case 6:
                return $this->getIddescuento();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Productos'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Productos'][$this->hashCode()] = true;
        $keys = ProductosTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdproducto(),
            $keys[1] => $this->getNombre(),
            $keys[2] => $this->getDetalle(),
            $keys[3] => $this->getDescripcion(),
            $keys[4] => $this->getPrecio(),
            $keys[5] => $this->getIdsubcategoria(),
            $keys[6] => $this->getIddescuento(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDescuentos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'descuentos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'descuentos';
                        break;
                    default:
                        $key = 'Descuentos';
                }

                $result[$key] = $this->aDescuentos->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSubcategorias) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'subcategorias';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'subcategorias';
                        break;
                    default:
                        $key = 'Subcategorias';
                }

                $result[$key] = $this->aSubcategorias->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDetallecomprass) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'detallecomprass';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'detallecomprass';
                        break;
                    default:
                        $key = 'Detallecomprass';
                }

                $result[$key] = $this->collDetallecomprass->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collDetallepedidoss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'detallepedidoss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'detallepedidoss';
                        break;
                    default:
                        $key = 'Detallepedidoss';
                }

                $result[$key] = $this->collDetallepedidoss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collInventarios) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'inventarios';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'inventarios';
                        break;
                    default:
                        $key = 'Inventarios';
                }

                $result[$key] = $this->collInventarios->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Productos
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Productos
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdproducto($value);
                break;
            case 1:
                $this->setNombre($value);
                break;
            case 2:
                $this->setDetalle($value);
                break;
            case 3:
                $this->setDescripcion($value);
                break;
            case 4:
                $this->setPrecio($value);
                break;
            case 5:
                $this->setIdsubcategoria($value);
                break;
            case 6:
                $this->setIddescuento($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ProductosTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdproducto($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNombre($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDetalle($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDescripcion($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPrecio($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIdsubcategoria($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIddescuento($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Productos The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProductosTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductosTableMap::COL_IDPRODUCTO)) {
            $criteria->add(ProductosTableMap::COL_IDPRODUCTO, $this->idproducto);
        }
        if ($this->isColumnModified(ProductosTableMap::COL_NOMBRE)) {
            $criteria->add(ProductosTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(ProductosTableMap::COL_DETALLE)) {
            $criteria->add(ProductosTableMap::COL_DETALLE, $this->detalle);
        }
        if ($this->isColumnModified(ProductosTableMap::COL_DESCRIPCION)) {
            $criteria->add(ProductosTableMap::COL_DESCRIPCION, $this->descripcion);
        }
        if ($this->isColumnModified(ProductosTableMap::COL_PRECIO)) {
            $criteria->add(ProductosTableMap::COL_PRECIO, $this->precio);
        }
        if ($this->isColumnModified(ProductosTableMap::COL_IDSUBCATEGORIA)) {
            $criteria->add(ProductosTableMap::COL_IDSUBCATEGORIA, $this->idsubcategoria);
        }
        if ($this->isColumnModified(ProductosTableMap::COL_IDDESCUENTO)) {
            $criteria->add(ProductosTableMap::COL_IDDESCUENTO, $this->iddescuento);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildProductosQuery::create();
        $criteria->add(ProductosTableMap::COL_IDPRODUCTO, $this->idproducto);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdproducto();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdproducto();
    }

    /**
     * Generic method to set the primary key (idproducto column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdproducto($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdproducto();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Productos (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNombre($this->getNombre());
        $copyObj->setDetalle($this->getDetalle());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setPrecio($this->getPrecio());
        $copyObj->setIdsubcategoria($this->getIdsubcategoria());
        $copyObj->setIddescuento($this->getIddescuento());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDetallecomprass() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDetallecompras($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getDetallepedidoss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDetallepedidos($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getInventarios() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addInventario($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdproducto(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Productos Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildDescuentos object.
     *
     * @param  ChildDescuentos $v
     * @return $this|\Productos The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDescuentos(ChildDescuentos $v = null)
    {
        if ($v === null) {
            $this->setIddescuento(NULL);
        } else {
            $this->setIddescuento($v->getIddescuento());
        }

        $this->aDescuentos = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDescuentos object, it will not be re-added.
        if ($v !== null) {
            $v->addProductos($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDescuentos object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDescuentos The associated ChildDescuentos object.
     * @throws PropelException
     */
    public function getDescuentos(ConnectionInterface $con = null)
    {
        if ($this->aDescuentos === null && ($this->iddescuento !== null)) {
            $this->aDescuentos = ChildDescuentosQuery::create()->findPk($this->iddescuento, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDescuentos->addProductoss($this);
             */
        }

        return $this->aDescuentos;
    }

    /**
     * Declares an association between this object and a ChildSubcategorias object.
     *
     * @param  ChildSubcategorias $v
     * @return $this|\Productos The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSubcategorias(ChildSubcategorias $v = null)
    {
        if ($v === null) {
            $this->setIdsubcategoria(NULL);
        } else {
            $this->setIdsubcategoria($v->getIdsubcategoria());
        }

        $this->aSubcategorias = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSubcategorias object, it will not be re-added.
        if ($v !== null) {
            $v->addProductos($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSubcategorias object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSubcategorias The associated ChildSubcategorias object.
     * @throws PropelException
     */
    public function getSubcategorias(ConnectionInterface $con = null)
    {
        if ($this->aSubcategorias === null && ($this->idsubcategoria !== null)) {
            $this->aSubcategorias = ChildSubcategoriasQuery::create()->findPk($this->idsubcategoria, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSubcategorias->addProductoss($this);
             */
        }

        return $this->aSubcategorias;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Detallecompras' == $relationName) {
            return $this->initDetallecomprass();
        }
        if ('Detallepedidos' == $relationName) {
            return $this->initDetallepedidoss();
        }
        if ('Inventario' == $relationName) {
            return $this->initInventarios();
        }
    }

    /**
     * Clears out the collDetallecomprass collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDetallecomprass()
     */
    public function clearDetallecomprass()
    {
        $this->collDetallecomprass = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDetallecomprass collection loaded partially.
     */
    public function resetPartialDetallecomprass($v = true)
    {
        $this->collDetallecomprassPartial = $v;
    }

    /**
     * Initializes the collDetallecomprass collection.
     *
     * By default this just sets the collDetallecomprass collection to an empty array (like clearcollDetallecomprass());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDetallecomprass($overrideExisting = true)
    {
        if (null !== $this->collDetallecomprass && !$overrideExisting) {
            return;
        }
        $this->collDetallecomprass = new ObjectCollection();
        $this->collDetallecomprass->setModel('\Detallecompras');
    }

    /**
     * Gets an array of ChildDetallecompras objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProductos is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDetallecompras[] List of ChildDetallecompras objects
     * @throws PropelException
     */
    public function getDetallecomprass(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDetallecomprassPartial && !$this->isNew();
        if (null === $this->collDetallecomprass || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDetallecomprass) {
                // return empty collection
                $this->initDetallecomprass();
            } else {
                $collDetallecomprass = ChildDetallecomprasQuery::create(null, $criteria)
                    ->filterByProductos($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDetallecomprassPartial && count($collDetallecomprass)) {
                        $this->initDetallecomprass(false);

                        foreach ($collDetallecomprass as $obj) {
                            if (false == $this->collDetallecomprass->contains($obj)) {
                                $this->collDetallecomprass->append($obj);
                            }
                        }

                        $this->collDetallecomprassPartial = true;
                    }

                    return $collDetallecomprass;
                }

                if ($partial && $this->collDetallecomprass) {
                    foreach ($this->collDetallecomprass as $obj) {
                        if ($obj->isNew()) {
                            $collDetallecomprass[] = $obj;
                        }
                    }
                }

                $this->collDetallecomprass = $collDetallecomprass;
                $this->collDetallecomprassPartial = false;
            }
        }

        return $this->collDetallecomprass;
    }

    /**
     * Sets a collection of ChildDetallecompras objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $detallecomprass A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProductos The current object (for fluent API support)
     */
    public function setDetallecomprass(Collection $detallecomprass, ConnectionInterface $con = null)
    {
        /** @var ChildDetallecompras[] $detallecomprassToDelete */
        $detallecomprassToDelete = $this->getDetallecomprass(new Criteria(), $con)->diff($detallecomprass);


        $this->detallecomprassScheduledForDeletion = $detallecomprassToDelete;

        foreach ($detallecomprassToDelete as $detallecomprasRemoved) {
            $detallecomprasRemoved->setProductos(null);
        }

        $this->collDetallecomprass = null;
        foreach ($detallecomprass as $detallecompras) {
            $this->addDetallecompras($detallecompras);
        }

        $this->collDetallecomprass = $detallecomprass;
        $this->collDetallecomprassPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Detallecompras objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Detallecompras objects.
     * @throws PropelException
     */
    public function countDetallecomprass(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDetallecomprassPartial && !$this->isNew();
        if (null === $this->collDetallecomprass || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDetallecomprass) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDetallecomprass());
            }

            $query = ChildDetallecomprasQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductos($this)
                ->count($con);
        }

        return count($this->collDetallecomprass);
    }

    /**
     * Method called to associate a ChildDetallecompras object to this object
     * through the ChildDetallecompras foreign key attribute.
     *
     * @param  ChildDetallecompras $l ChildDetallecompras
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function addDetallecompras(ChildDetallecompras $l)
    {
        if ($this->collDetallecomprass === null) {
            $this->initDetallecomprass();
            $this->collDetallecomprassPartial = true;
        }

        if (!$this->collDetallecomprass->contains($l)) {
            $this->doAddDetallecompras($l);
        }

        return $this;
    }

    /**
     * @param ChildDetallecompras $detallecompras The ChildDetallecompras object to add.
     */
    protected function doAddDetallecompras(ChildDetallecompras $detallecompras)
    {
        $this->collDetallecomprass[]= $detallecompras;
        $detallecompras->setProductos($this);
    }

    /**
     * @param  ChildDetallecompras $detallecompras The ChildDetallecompras object to remove.
     * @return $this|ChildProductos The current object (for fluent API support)
     */
    public function removeDetallecompras(ChildDetallecompras $detallecompras)
    {
        if ($this->getDetallecomprass()->contains($detallecompras)) {
            $pos = $this->collDetallecomprass->search($detallecompras);
            $this->collDetallecomprass->remove($pos);
            if (null === $this->detallecomprassScheduledForDeletion) {
                $this->detallecomprassScheduledForDeletion = clone $this->collDetallecomprass;
                $this->detallecomprassScheduledForDeletion->clear();
            }
            $this->detallecomprassScheduledForDeletion[]= $detallecompras;
            $detallecompras->setProductos(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Productos is new, it will return
     * an empty collection; or if this Productos has previously
     * been saved, it will retrieve related Detallecomprass from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Productos.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDetallecompras[] List of ChildDetallecompras objects
     */
    public function getDetallecomprassJoinCompras(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDetallecomprasQuery::create(null, $criteria);
        $query->joinWith('Compras', $joinBehavior);

        return $this->getDetallecomprass($query, $con);
    }

    /**
     * Clears out the collDetallepedidoss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDetallepedidoss()
     */
    public function clearDetallepedidoss()
    {
        $this->collDetallepedidoss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDetallepedidoss collection loaded partially.
     */
    public function resetPartialDetallepedidoss($v = true)
    {
        $this->collDetallepedidossPartial = $v;
    }

    /**
     * Initializes the collDetallepedidoss collection.
     *
     * By default this just sets the collDetallepedidoss collection to an empty array (like clearcollDetallepedidoss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDetallepedidoss($overrideExisting = true)
    {
        if (null !== $this->collDetallepedidoss && !$overrideExisting) {
            return;
        }
        $this->collDetallepedidoss = new ObjectCollection();
        $this->collDetallepedidoss->setModel('\Detallepedidos');
    }

    /**
     * Gets an array of ChildDetallepedidos objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProductos is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDetallepedidos[] List of ChildDetallepedidos objects
     * @throws PropelException
     */
    public function getDetallepedidoss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDetallepedidossPartial && !$this->isNew();
        if (null === $this->collDetallepedidoss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDetallepedidoss) {
                // return empty collection
                $this->initDetallepedidoss();
            } else {
                $collDetallepedidoss = ChildDetallepedidosQuery::create(null, $criteria)
                    ->filterByProductos($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDetallepedidossPartial && count($collDetallepedidoss)) {
                        $this->initDetallepedidoss(false);

                        foreach ($collDetallepedidoss as $obj) {
                            if (false == $this->collDetallepedidoss->contains($obj)) {
                                $this->collDetallepedidoss->append($obj);
                            }
                        }

                        $this->collDetallepedidossPartial = true;
                    }

                    return $collDetallepedidoss;
                }

                if ($partial && $this->collDetallepedidoss) {
                    foreach ($this->collDetallepedidoss as $obj) {
                        if ($obj->isNew()) {
                            $collDetallepedidoss[] = $obj;
                        }
                    }
                }

                $this->collDetallepedidoss = $collDetallepedidoss;
                $this->collDetallepedidossPartial = false;
            }
        }

        return $this->collDetallepedidoss;
    }

    /**
     * Sets a collection of ChildDetallepedidos objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $detallepedidoss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProductos The current object (for fluent API support)
     */
    public function setDetallepedidoss(Collection $detallepedidoss, ConnectionInterface $con = null)
    {
        /** @var ChildDetallepedidos[] $detallepedidossToDelete */
        $detallepedidossToDelete = $this->getDetallepedidoss(new Criteria(), $con)->diff($detallepedidoss);


        $this->detallepedidossScheduledForDeletion = $detallepedidossToDelete;

        foreach ($detallepedidossToDelete as $detallepedidosRemoved) {
            $detallepedidosRemoved->setProductos(null);
        }

        $this->collDetallepedidoss = null;
        foreach ($detallepedidoss as $detallepedidos) {
            $this->addDetallepedidos($detallepedidos);
        }

        $this->collDetallepedidoss = $detallepedidoss;
        $this->collDetallepedidossPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Detallepedidos objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Detallepedidos objects.
     * @throws PropelException
     */
    public function countDetallepedidoss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDetallepedidossPartial && !$this->isNew();
        if (null === $this->collDetallepedidoss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDetallepedidoss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDetallepedidoss());
            }

            $query = ChildDetallepedidosQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductos($this)
                ->count($con);
        }

        return count($this->collDetallepedidoss);
    }

    /**
     * Method called to associate a ChildDetallepedidos object to this object
     * through the ChildDetallepedidos foreign key attribute.
     *
     * @param  ChildDetallepedidos $l ChildDetallepedidos
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function addDetallepedidos(ChildDetallepedidos $l)
    {
        if ($this->collDetallepedidoss === null) {
            $this->initDetallepedidoss();
            $this->collDetallepedidossPartial = true;
        }

        if (!$this->collDetallepedidoss->contains($l)) {
            $this->doAddDetallepedidos($l);
        }

        return $this;
    }

    /**
     * @param ChildDetallepedidos $detallepedidos The ChildDetallepedidos object to add.
     */
    protected function doAddDetallepedidos(ChildDetallepedidos $detallepedidos)
    {
        $this->collDetallepedidoss[]= $detallepedidos;
        $detallepedidos->setProductos($this);
    }

    /**
     * @param  ChildDetallepedidos $detallepedidos The ChildDetallepedidos object to remove.
     * @return $this|ChildProductos The current object (for fluent API support)
     */
    public function removeDetallepedidos(ChildDetallepedidos $detallepedidos)
    {
        if ($this->getDetallepedidoss()->contains($detallepedidos)) {
            $pos = $this->collDetallepedidoss->search($detallepedidos);
            $this->collDetallepedidoss->remove($pos);
            if (null === $this->detallepedidossScheduledForDeletion) {
                $this->detallepedidossScheduledForDeletion = clone $this->collDetallepedidoss;
                $this->detallepedidossScheduledForDeletion->clear();
            }
            $this->detallepedidossScheduledForDeletion[]= $detallepedidos;
            $detallepedidos->setProductos(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Productos is new, it will return
     * an empty collection; or if this Productos has previously
     * been saved, it will retrieve related Detallepedidoss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Productos.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDetallepedidos[] List of ChildDetallepedidos objects
     */
    public function getDetallepedidossJoinPedidos(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDetallepedidosQuery::create(null, $criteria);
        $query->joinWith('Pedidos', $joinBehavior);

        return $this->getDetallepedidoss($query, $con);
    }

    /**
     * Clears out the collInventarios collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addInventarios()
     */
    public function clearInventarios()
    {
        $this->collInventarios = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collInventarios collection loaded partially.
     */
    public function resetPartialInventarios($v = true)
    {
        $this->collInventariosPartial = $v;
    }

    /**
     * Initializes the collInventarios collection.
     *
     * By default this just sets the collInventarios collection to an empty array (like clearcollInventarios());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initInventarios($overrideExisting = true)
    {
        if (null !== $this->collInventarios && !$overrideExisting) {
            return;
        }
        $this->collInventarios = new ObjectCollection();
        $this->collInventarios->setModel('\Inventario');
    }

    /**
     * Gets an array of ChildInventario objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProductos is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildInventario[] List of ChildInventario objects
     * @throws PropelException
     */
    public function getInventarios(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collInventariosPartial && !$this->isNew();
        if (null === $this->collInventarios || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collInventarios) {
                // return empty collection
                $this->initInventarios();
            } else {
                $collInventarios = ChildInventarioQuery::create(null, $criteria)
                    ->filterByProductos($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collInventariosPartial && count($collInventarios)) {
                        $this->initInventarios(false);

                        foreach ($collInventarios as $obj) {
                            if (false == $this->collInventarios->contains($obj)) {
                                $this->collInventarios->append($obj);
                            }
                        }

                        $this->collInventariosPartial = true;
                    }

                    return $collInventarios;
                }

                if ($partial && $this->collInventarios) {
                    foreach ($this->collInventarios as $obj) {
                        if ($obj->isNew()) {
                            $collInventarios[] = $obj;
                        }
                    }
                }

                $this->collInventarios = $collInventarios;
                $this->collInventariosPartial = false;
            }
        }

        return $this->collInventarios;
    }

    /**
     * Sets a collection of ChildInventario objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $inventarios A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProductos The current object (for fluent API support)
     */
    public function setInventarios(Collection $inventarios, ConnectionInterface $con = null)
    {
        /** @var ChildInventario[] $inventariosToDelete */
        $inventariosToDelete = $this->getInventarios(new Criteria(), $con)->diff($inventarios);


        $this->inventariosScheduledForDeletion = $inventariosToDelete;

        foreach ($inventariosToDelete as $inventarioRemoved) {
            $inventarioRemoved->setProductos(null);
        }

        $this->collInventarios = null;
        foreach ($inventarios as $inventario) {
            $this->addInventario($inventario);
        }

        $this->collInventarios = $inventarios;
        $this->collInventariosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Inventario objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Inventario objects.
     * @throws PropelException
     */
    public function countInventarios(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collInventariosPartial && !$this->isNew();
        if (null === $this->collInventarios || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collInventarios) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getInventarios());
            }

            $query = ChildInventarioQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductos($this)
                ->count($con);
        }

        return count($this->collInventarios);
    }

    /**
     * Method called to associate a ChildInventario object to this object
     * through the ChildInventario foreign key attribute.
     *
     * @param  ChildInventario $l ChildInventario
     * @return $this|\Productos The current object (for fluent API support)
     */
    public function addInventario(ChildInventario $l)
    {
        if ($this->collInventarios === null) {
            $this->initInventarios();
            $this->collInventariosPartial = true;
        }

        if (!$this->collInventarios->contains($l)) {
            $this->doAddInventario($l);
        }

        return $this;
    }

    /**
     * @param ChildInventario $inventario The ChildInventario object to add.
     */
    protected function doAddInventario(ChildInventario $inventario)
    {
        $this->collInventarios[]= $inventario;
        $inventario->setProductos($this);
    }

    /**
     * @param  ChildInventario $inventario The ChildInventario object to remove.
     * @return $this|ChildProductos The current object (for fluent API support)
     */
    public function removeInventario(ChildInventario $inventario)
    {
        if ($this->getInventarios()->contains($inventario)) {
            $pos = $this->collInventarios->search($inventario);
            $this->collInventarios->remove($pos);
            if (null === $this->inventariosScheduledForDeletion) {
                $this->inventariosScheduledForDeletion = clone $this->collInventarios;
                $this->inventariosScheduledForDeletion->clear();
            }
            $this->inventariosScheduledForDeletion[]= $inventario;
            $inventario->setProductos(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Productos is new, it will return
     * an empty collection; or if this Productos has previously
     * been saved, it will retrieve related Inventarios from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Productos.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildInventario[] List of ChildInventario objects
     */
    public function getInventariosJoinTienda(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildInventarioQuery::create(null, $criteria);
        $query->joinWith('Tienda', $joinBehavior);

        return $this->getInventarios($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aDescuentos) {
            $this->aDescuentos->removeProductos($this);
        }
        if (null !== $this->aSubcategorias) {
            $this->aSubcategorias->removeProductos($this);
        }
        $this->idproducto = null;
        $this->nombre = null;
        $this->detalle = null;
        $this->descripcion = null;
        $this->precio = null;
        $this->idsubcategoria = null;
        $this->iddescuento = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collDetallecomprass) {
                foreach ($this->collDetallecomprass as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collDetallepedidoss) {
                foreach ($this->collDetallepedidoss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collInventarios) {
                foreach ($this->collInventarios as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDetallecomprass = null;
        $this->collDetallepedidoss = null;
        $this->collInventarios = null;
        $this->aDescuentos = null;
        $this->aSubcategorias = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductosTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}

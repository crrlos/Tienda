<?php

namespace Base;

use \Detallepedidos as ChildDetallepedidos;
use \DetallepedidosQuery as ChildDetallepedidosQuery;
use \Pedidos as ChildPedidos;
use \PedidosQuery as ChildPedidosQuery;
use \Usuarios as ChildUsuarios;
use \UsuariosQuery as ChildUsuariosQuery;
use \Ventas as ChildVentas;
use \VentasQuery as ChildVentasQuery;
use \Exception;
use \PDO;
use Map\PedidosTableMap;
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
 * Base class that represents a row from the 'pedidos' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Pedidos implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\PedidosTableMap';


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
     * The value for the idpedido field.
     *
     * @var        int
     */
    protected $idpedido;

    /**
     * The value for the idcliente field.
     *
     * @var        int
     */
    protected $idcliente;

    /**
     * The value for the estado field.
     *
     * @var        string
     */
    protected $estado;

    /**
     * @var        ChildUsuarios
     */
    protected $aUsuarios;

    /**
     * @var        ObjectCollection|ChildDetallepedidos[] Collection to store aggregation of ChildDetallepedidos objects.
     */
    protected $collDetallepedidoss;
    protected $collDetallepedidossPartial;

    /**
     * @var        ObjectCollection|ChildVentas[] Collection to store aggregation of ChildVentas objects.
     */
    protected $collVentass;
    protected $collVentassPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDetallepedidos[]
     */
    protected $detallepedidossScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildVentas[]
     */
    protected $ventassScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Pedidos object.
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
     * Compares this with another <code>Pedidos</code> instance.  If
     * <code>obj</code> is an instance of <code>Pedidos</code>, delegates to
     * <code>equals(Pedidos)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Pedidos The current object, for fluid interface
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
     * Get the [idpedido] column value.
     *
     * @return int
     */
    public function getIdpedido()
    {
        return $this->idpedido;
    }

    /**
     * Get the [idcliente] column value.
     *
     * @return int
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    /**
     * Get the [estado] column value.
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of [idpedido] column.
     *
     * @param int $v new value
     * @return $this|\Pedidos The current object (for fluent API support)
     */
    public function setIdpedido($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idpedido !== $v) {
            $this->idpedido = $v;
            $this->modifiedColumns[PedidosTableMap::COL_IDPEDIDO] = true;
        }

        return $this;
    } // setIdpedido()

    /**
     * Set the value of [idcliente] column.
     *
     * @param int $v new value
     * @return $this|\Pedidos The current object (for fluent API support)
     */
    public function setIdcliente($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idcliente !== $v) {
            $this->idcliente = $v;
            $this->modifiedColumns[PedidosTableMap::COL_IDCLIENTE] = true;
        }

        if ($this->aUsuarios !== null && $this->aUsuarios->getIdusuario() !== $v) {
            $this->aUsuarios = null;
        }

        return $this;
    } // setIdcliente()

    /**
     * Set the value of [estado] column.
     *
     * @param string $v new value
     * @return $this|\Pedidos The current object (for fluent API support)
     */
    public function setEstado($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->estado !== $v) {
            $this->estado = $v;
            $this->modifiedColumns[PedidosTableMap::COL_ESTADO] = true;
        }

        return $this;
    } // setEstado()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PedidosTableMap::translateFieldName('Idpedido', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idpedido = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PedidosTableMap::translateFieldName('Idcliente', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idcliente = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PedidosTableMap::translateFieldName('Estado', TableMap::TYPE_PHPNAME, $indexType)];
            $this->estado = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = PedidosTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Pedidos'), 0, $e);
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
        if ($this->aUsuarios !== null && $this->idcliente !== $this->aUsuarios->getIdusuario()) {
            $this->aUsuarios = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PedidosTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPedidosQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUsuarios = null;
            $this->collDetallepedidoss = null;

            $this->collVentass = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Pedidos::setDeleted()
     * @see Pedidos::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidosTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPedidosQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PedidosTableMap::DATABASE_NAME);
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
                PedidosTableMap::addInstanceToPool($this);
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

            if ($this->aUsuarios !== null) {
                if ($this->aUsuarios->isModified() || $this->aUsuarios->isNew()) {
                    $affectedRows += $this->aUsuarios->save($con);
                }
                $this->setUsuarios($this->aUsuarios);
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

            if ($this->ventassScheduledForDeletion !== null) {
                if (!$this->ventassScheduledForDeletion->isEmpty()) {
                    foreach ($this->ventassScheduledForDeletion as $ventas) {
                        // need to save related object because we set the relation to null
                        $ventas->save($con);
                    }
                    $this->ventassScheduledForDeletion = null;
                }
            }

            if ($this->collVentass !== null) {
                foreach ($this->collVentass as $referrerFK) {
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

        $this->modifiedColumns[PedidosTableMap::COL_IDPEDIDO] = true;
        if (null !== $this->idpedido) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PedidosTableMap::COL_IDPEDIDO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PedidosTableMap::COL_IDPEDIDO)) {
            $modifiedColumns[':p' . $index++]  = 'idpedido';
        }
        if ($this->isColumnModified(PedidosTableMap::COL_IDCLIENTE)) {
            $modifiedColumns[':p' . $index++]  = 'idcliente';
        }
        if ($this->isColumnModified(PedidosTableMap::COL_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = 'estado';
        }

        $sql = sprintf(
            'INSERT INTO pedidos (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idpedido':
                        $stmt->bindValue($identifier, $this->idpedido, PDO::PARAM_INT);
                        break;
                    case 'idcliente':
                        $stmt->bindValue($identifier, $this->idcliente, PDO::PARAM_INT);
                        break;
                    case 'estado':
                        $stmt->bindValue($identifier, $this->estado, PDO::PARAM_STR);
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
        $this->setIdpedido($pk);

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
        $pos = PedidosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdpedido();
                break;
            case 1:
                return $this->getIdcliente();
                break;
            case 2:
                return $this->getEstado();
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

        if (isset($alreadyDumpedObjects['Pedidos'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Pedidos'][$this->hashCode()] = true;
        $keys = PedidosTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdpedido(),
            $keys[1] => $this->getIdcliente(),
            $keys[2] => $this->getEstado(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUsuarios) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'usuarios';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'usuarios';
                        break;
                    default:
                        $key = 'Usuarios';
                }

                $result[$key] = $this->aUsuarios->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collVentass) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ventass';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ventass';
                        break;
                    default:
                        $key = 'Ventass';
                }

                $result[$key] = $this->collVentass->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Pedidos
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PedidosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Pedidos
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdpedido($value);
                break;
            case 1:
                $this->setIdcliente($value);
                break;
            case 2:
                $this->setEstado($value);
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
        $keys = PedidosTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdpedido($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdcliente($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEstado($arr[$keys[2]]);
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
     * @return $this|\Pedidos The current object, for fluid interface
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
        $criteria = new Criteria(PedidosTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PedidosTableMap::COL_IDPEDIDO)) {
            $criteria->add(PedidosTableMap::COL_IDPEDIDO, $this->idpedido);
        }
        if ($this->isColumnModified(PedidosTableMap::COL_IDCLIENTE)) {
            $criteria->add(PedidosTableMap::COL_IDCLIENTE, $this->idcliente);
        }
        if ($this->isColumnModified(PedidosTableMap::COL_ESTADO)) {
            $criteria->add(PedidosTableMap::COL_ESTADO, $this->estado);
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
        $criteria = ChildPedidosQuery::create();
        $criteria->add(PedidosTableMap::COL_IDPEDIDO, $this->idpedido);

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
        $validPk = null !== $this->getIdpedido();

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
        return $this->getIdpedido();
    }

    /**
     * Generic method to set the primary key (idpedido column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdpedido($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdpedido();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Pedidos (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdcliente($this->getIdcliente());
        $copyObj->setEstado($this->getEstado());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDetallepedidoss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDetallepedidos($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getVentass() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addVentas($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdpedido(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Pedidos Clone of current object.
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
     * Declares an association between this object and a ChildUsuarios object.
     *
     * @param  ChildUsuarios $v
     * @return $this|\Pedidos The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsuarios(ChildUsuarios $v = null)
    {
        if ($v === null) {
            $this->setIdcliente(NULL);
        } else {
            $this->setIdcliente($v->getIdusuario());
        }

        $this->aUsuarios = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsuarios object, it will not be re-added.
        if ($v !== null) {
            $v->addPedidos($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsuarios object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsuarios The associated ChildUsuarios object.
     * @throws PropelException
     */
    public function getUsuarios(ConnectionInterface $con = null)
    {
        if ($this->aUsuarios === null && ($this->idcliente !== null)) {
            $this->aUsuarios = ChildUsuariosQuery::create()->findPk($this->idcliente, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsuarios->addPedidoss($this);
             */
        }

        return $this->aUsuarios;
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
        if ('Detallepedidos' == $relationName) {
            return $this->initDetallepedidoss();
        }
        if ('Ventas' == $relationName) {
            return $this->initVentass();
        }
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
     * If this ChildPedidos is new, it will return
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
                    ->filterByPedidos($this)
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
     * @return $this|ChildPedidos The current object (for fluent API support)
     */
    public function setDetallepedidoss(Collection $detallepedidoss, ConnectionInterface $con = null)
    {
        /** @var ChildDetallepedidos[] $detallepedidossToDelete */
        $detallepedidossToDelete = $this->getDetallepedidoss(new Criteria(), $con)->diff($detallepedidoss);


        $this->detallepedidossScheduledForDeletion = $detallepedidossToDelete;

        foreach ($detallepedidossToDelete as $detallepedidosRemoved) {
            $detallepedidosRemoved->setPedidos(null);
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
                ->filterByPedidos($this)
                ->count($con);
        }

        return count($this->collDetallepedidoss);
    }

    /**
     * Method called to associate a ChildDetallepedidos object to this object
     * through the ChildDetallepedidos foreign key attribute.
     *
     * @param  ChildDetallepedidos $l ChildDetallepedidos
     * @return $this|\Pedidos The current object (for fluent API support)
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
        $detallepedidos->setPedidos($this);
    }

    /**
     * @param  ChildDetallepedidos $detallepedidos The ChildDetallepedidos object to remove.
     * @return $this|ChildPedidos The current object (for fluent API support)
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
            $detallepedidos->setPedidos(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Pedidos is new, it will return
     * an empty collection; or if this Pedidos has previously
     * been saved, it will retrieve related Detallepedidoss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Pedidos.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDetallepedidos[] List of ChildDetallepedidos objects
     */
    public function getDetallepedidossJoinProductos(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDetallepedidosQuery::create(null, $criteria);
        $query->joinWith('Productos', $joinBehavior);

        return $this->getDetallepedidoss($query, $con);
    }

    /**
     * Clears out the collVentass collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addVentass()
     */
    public function clearVentass()
    {
        $this->collVentass = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collVentass collection loaded partially.
     */
    public function resetPartialVentass($v = true)
    {
        $this->collVentassPartial = $v;
    }

    /**
     * Initializes the collVentass collection.
     *
     * By default this just sets the collVentass collection to an empty array (like clearcollVentass());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initVentass($overrideExisting = true)
    {
        if (null !== $this->collVentass && !$overrideExisting) {
            return;
        }
        $this->collVentass = new ObjectCollection();
        $this->collVentass->setModel('\Ventas');
    }

    /**
     * Gets an array of ChildVentas objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPedidos is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildVentas[] List of ChildVentas objects
     * @throws PropelException
     */
    public function getVentass(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collVentassPartial && !$this->isNew();
        if (null === $this->collVentass || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collVentass) {
                // return empty collection
                $this->initVentass();
            } else {
                $collVentass = ChildVentasQuery::create(null, $criteria)
                    ->filterByPedidos($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collVentassPartial && count($collVentass)) {
                        $this->initVentass(false);

                        foreach ($collVentass as $obj) {
                            if (false == $this->collVentass->contains($obj)) {
                                $this->collVentass->append($obj);
                            }
                        }

                        $this->collVentassPartial = true;
                    }

                    return $collVentass;
                }

                if ($partial && $this->collVentass) {
                    foreach ($this->collVentass as $obj) {
                        if ($obj->isNew()) {
                            $collVentass[] = $obj;
                        }
                    }
                }

                $this->collVentass = $collVentass;
                $this->collVentassPartial = false;
            }
        }

        return $this->collVentass;
    }

    /**
     * Sets a collection of ChildVentas objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $ventass A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPedidos The current object (for fluent API support)
     */
    public function setVentass(Collection $ventass, ConnectionInterface $con = null)
    {
        /** @var ChildVentas[] $ventassToDelete */
        $ventassToDelete = $this->getVentass(new Criteria(), $con)->diff($ventass);


        $this->ventassScheduledForDeletion = $ventassToDelete;

        foreach ($ventassToDelete as $ventasRemoved) {
            $ventasRemoved->setPedidos(null);
        }

        $this->collVentass = null;
        foreach ($ventass as $ventas) {
            $this->addVentas($ventas);
        }

        $this->collVentass = $ventass;
        $this->collVentassPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Ventas objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Ventas objects.
     * @throws PropelException
     */
    public function countVentass(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collVentassPartial && !$this->isNew();
        if (null === $this->collVentass || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collVentass) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getVentass());
            }

            $query = ChildVentasQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPedidos($this)
                ->count($con);
        }

        return count($this->collVentass);
    }

    /**
     * Method called to associate a ChildVentas object to this object
     * through the ChildVentas foreign key attribute.
     *
     * @param  ChildVentas $l ChildVentas
     * @return $this|\Pedidos The current object (for fluent API support)
     */
    public function addVentas(ChildVentas $l)
    {
        if ($this->collVentass === null) {
            $this->initVentass();
            $this->collVentassPartial = true;
        }

        if (!$this->collVentass->contains($l)) {
            $this->doAddVentas($l);
        }

        return $this;
    }

    /**
     * @param ChildVentas $ventas The ChildVentas object to add.
     */
    protected function doAddVentas(ChildVentas $ventas)
    {
        $this->collVentass[]= $ventas;
        $ventas->setPedidos($this);
    }

    /**
     * @param  ChildVentas $ventas The ChildVentas object to remove.
     * @return $this|ChildPedidos The current object (for fluent API support)
     */
    public function removeVentas(ChildVentas $ventas)
    {
        if ($this->getVentass()->contains($ventas)) {
            $pos = $this->collVentass->search($ventas);
            $this->collVentass->remove($pos);
            if (null === $this->ventassScheduledForDeletion) {
                $this->ventassScheduledForDeletion = clone $this->collVentass;
                $this->ventassScheduledForDeletion->clear();
            }
            $this->ventassScheduledForDeletion[]= $ventas;
            $ventas->setPedidos(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUsuarios) {
            $this->aUsuarios->removePedidos($this);
        }
        $this->idpedido = null;
        $this->idcliente = null;
        $this->estado = null;
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
            if ($this->collDetallepedidoss) {
                foreach ($this->collDetallepedidoss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collVentass) {
                foreach ($this->collVentass as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDetallepedidoss = null;
        $this->collVentass = null;
        $this->aUsuarios = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PedidosTableMap::DEFAULT_STRING_FORMAT);
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

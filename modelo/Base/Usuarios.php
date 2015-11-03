<?php

namespace Base;

use \Departamentos as ChildDepartamentos;
use \DepartamentosQuery as ChildDepartamentosQuery;
use \Hash as ChildHash;
use \HashQuery as ChildHashQuery;
use \Municipios as ChildMunicipios;
use \MunicipiosQuery as ChildMunicipiosQuery;
use \Pedidos as ChildPedidos;
use \PedidosQuery as ChildPedidosQuery;
use \Roles as ChildRoles;
use \RolesQuery as ChildRolesQuery;
use \Usuarios as ChildUsuarios;
use \UsuariosQuery as ChildUsuariosQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\UsuariosTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'usuarios' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Usuarios implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UsuariosTableMap';


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
     * The value for the idusuario field.
     *
     * @var        int
     */
    protected $idusuario;

    /**
     * The value for the nombreusuario field.
     *
     * @var        string
     */
    protected $nombreusuario;

    /**
     * The value for the nombres field.
     *
     * @var        string
     */
    protected $nombres;

    /**
     * The value for the apellidos field.
     *
     * @var        string
     */
    protected $apellidos;

    /**
     * The value for the telefono field.
     *
     * @var        string
     */
    protected $telefono;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the direccion field.
     *
     * @var        string
     */
    protected $direccion;

    /**
     * The value for the iddepartamento field.
     *
     * @var        int
     */
    protected $iddepartamento;

    /**
     * The value for the idmunicipio field.
     *
     * @var        int
     */
    protected $idmunicipio;

    /**
     * The value for the fecharegistro field.
     *
     * @var        \DateTime
     */
    protected $fecharegistro;

    /**
     * The value for the idrol field.
     *
     * @var        int
     */
    protected $idrol;

    /**
     * The value for the clave field.
     *
     * @var        string
     */
    protected $clave;

    /**
     * @var        ChildDepartamentos
     */
    protected $aDepartamentos;

    /**
     * @var        ChildMunicipios
     */
    protected $aMunicipios;

    /**
     * @var        ChildRoles
     */
    protected $aRoles;

    /**
     * @var        ObjectCollection|ChildHash[] Collection to store aggregation of ChildHash objects.
     */
    protected $collHashes;
    protected $collHashesPartial;

    /**
     * @var        ObjectCollection|ChildPedidos[] Collection to store aggregation of ChildPedidos objects.
     */
    protected $collPedidoss;
    protected $collPedidossPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildHash[]
     */
    protected $hashesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPedidos[]
     */
    protected $pedidossScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Usuarios object.
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
     * Compares this with another <code>Usuarios</code> instance.  If
     * <code>obj</code> is an instance of <code>Usuarios</code>, delegates to
     * <code>equals(Usuarios)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Usuarios The current object, for fluid interface
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
     * Get the [idusuario] column value.
     *
     * @return int
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Get the [nombreusuario] column value.
     *
     * @return string
     */
    public function getNombreusuario()
    {
        return $this->nombreusuario;
    }

    /**
     * Get the [nombres] column value.
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Get the [apellidos] column value.
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Get the [telefono] column value.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [direccion] column value.
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Get the [iddepartamento] column value.
     *
     * @return int
     */
    public function getIddepartamento()
    {
        return $this->iddepartamento;
    }

    /**
     * Get the [idmunicipio] column value.
     *
     * @return int
     */
    public function getIdmunicipio()
    {
        return $this->idmunicipio;
    }

    /**
     * Get the [optionally formatted] temporal [fecharegistro] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFecharegistro($format = NULL)
    {
        if ($format === null) {
            return $this->fecharegistro;
        } else {
            return $this->fecharegistro instanceof \DateTime ? $this->fecharegistro->format($format) : null;
        }
    }

    /**
     * Get the [idrol] column value.
     *
     * @return int
     */
    public function getIdrol()
    {
        return $this->idrol;
    }

    /**
     * Get the [clave] column value.
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set the value of [idusuario] column.
     *
     * @param int $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setIdusuario($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idusuario !== $v) {
            $this->idusuario = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_IDUSUARIO] = true;
        }

        return $this;
    } // setIdusuario()

    /**
     * Set the value of [nombreusuario] column.
     *
     * @param string $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setNombreusuario($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombreusuario !== $v) {
            $this->nombreusuario = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_NOMBREUSUARIO] = true;
        }

        return $this;
    } // setNombreusuario()

    /**
     * Set the value of [nombres] column.
     *
     * @param string $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setNombres($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombres !== $v) {
            $this->nombres = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_NOMBRES] = true;
        }

        return $this;
    } // setNombres()

    /**
     * Set the value of [apellidos] column.
     *
     * @param string $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setApellidos($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->apellidos !== $v) {
            $this->apellidos = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_APELLIDOS] = true;
        }

        return $this;
    } // setApellidos()

    /**
     * Set the value of [telefono] column.
     *
     * @param string $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setTelefono($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefono !== $v) {
            $this->telefono = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_TELEFONO] = true;
        }

        return $this;
    } // setTelefono()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [direccion] column.
     *
     * @param string $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->direccion !== $v) {
            $this->direccion = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_DIRECCION] = true;
        }

        return $this;
    } // setDireccion()

    /**
     * Set the value of [iddepartamento] column.
     *
     * @param int $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setIddepartamento($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->iddepartamento !== $v) {
            $this->iddepartamento = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_IDDEPARTAMENTO] = true;
        }

        if ($this->aDepartamentos !== null && $this->aDepartamentos->getIddepartamento() !== $v) {
            $this->aDepartamentos = null;
        }

        return $this;
    } // setIddepartamento()

    /**
     * Set the value of [idmunicipio] column.
     *
     * @param int $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setIdmunicipio($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idmunicipio !== $v) {
            $this->idmunicipio = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_IDMUNICIPIO] = true;
        }

        if ($this->aMunicipios !== null && $this->aMunicipios->getIdmunicipio() !== $v) {
            $this->aMunicipios = null;
        }

        return $this;
    } // setIdmunicipio()

    /**
     * Sets the value of [fecharegistro] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setFecharegistro($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecharegistro !== null || $dt !== null) {
            if ($this->fecharegistro === null || $dt === null || $dt->format("Y-m-d") !== $this->fecharegistro->format("Y-m-d")) {
                $this->fecharegistro = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsuariosTableMap::COL_FECHAREGISTRO] = true;
            }
        } // if either are not null

        return $this;
    } // setFecharegistro()

    /**
     * Set the value of [idrol] column.
     *
     * @param int $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setIdrol($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idrol !== $v) {
            $this->idrol = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_IDROL] = true;
        }

        if ($this->aRoles !== null && $this->aRoles->getIdrol() !== $v) {
            $this->aRoles = null;
        }

        return $this;
    } // setIdrol()

    /**
     * Set the value of [clave] column.
     *
     * @param string $v new value
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function setClave($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->clave !== $v) {
            $this->clave = $v;
            $this->modifiedColumns[UsuariosTableMap::COL_CLAVE] = true;
        }

        return $this;
    } // setClave()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsuariosTableMap::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idusuario = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsuariosTableMap::translateFieldName('Nombreusuario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombreusuario = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsuariosTableMap::translateFieldName('Nombres', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombres = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsuariosTableMap::translateFieldName('Apellidos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->apellidos = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsuariosTableMap::translateFieldName('Telefono', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefono = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsuariosTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsuariosTableMap::translateFieldName('Direccion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->direccion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsuariosTableMap::translateFieldName('Iddepartamento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->iddepartamento = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsuariosTableMap::translateFieldName('Idmunicipio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idmunicipio = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsuariosTableMap::translateFieldName('Fecharegistro', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->fecharegistro = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsuariosTableMap::translateFieldName('Idrol', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idrol = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsuariosTableMap::translateFieldName('Clave', TableMap::TYPE_PHPNAME, $indexType)];
            $this->clave = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = UsuariosTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Usuarios'), 0, $e);
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
        if ($this->aDepartamentos !== null && $this->iddepartamento !== $this->aDepartamentos->getIddepartamento()) {
            $this->aDepartamentos = null;
        }
        if ($this->aMunicipios !== null && $this->idmunicipio !== $this->aMunicipios->getIdmunicipio()) {
            $this->aMunicipios = null;
        }
        if ($this->aRoles !== null && $this->idrol !== $this->aRoles->getIdrol()) {
            $this->aRoles = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(UsuariosTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsuariosQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDepartamentos = null;
            $this->aMunicipios = null;
            $this->aRoles = null;
            $this->collHashes = null;

            $this->collPedidoss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Usuarios::setDeleted()
     * @see Usuarios::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariosTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsuariosQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariosTableMap::DATABASE_NAME);
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
                UsuariosTableMap::addInstanceToPool($this);
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

            if ($this->aDepartamentos !== null) {
                if ($this->aDepartamentos->isModified() || $this->aDepartamentos->isNew()) {
                    $affectedRows += $this->aDepartamentos->save($con);
                }
                $this->setDepartamentos($this->aDepartamentos);
            }

            if ($this->aMunicipios !== null) {
                if ($this->aMunicipios->isModified() || $this->aMunicipios->isNew()) {
                    $affectedRows += $this->aMunicipios->save($con);
                }
                $this->setMunicipios($this->aMunicipios);
            }

            if ($this->aRoles !== null) {
                if ($this->aRoles->isModified() || $this->aRoles->isNew()) {
                    $affectedRows += $this->aRoles->save($con);
                }
                $this->setRoles($this->aRoles);
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

            if ($this->hashesScheduledForDeletion !== null) {
                if (!$this->hashesScheduledForDeletion->isEmpty()) {
                    foreach ($this->hashesScheduledForDeletion as $hash) {
                        // need to save related object because we set the relation to null
                        $hash->save($con);
                    }
                    $this->hashesScheduledForDeletion = null;
                }
            }

            if ($this->collHashes !== null) {
                foreach ($this->collHashes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pedidossScheduledForDeletion !== null) {
                if (!$this->pedidossScheduledForDeletion->isEmpty()) {
                    foreach ($this->pedidossScheduledForDeletion as $pedidos) {
                        // need to save related object because we set the relation to null
                        $pedidos->save($con);
                    }
                    $this->pedidossScheduledForDeletion = null;
                }
            }

            if ($this->collPedidoss !== null) {
                foreach ($this->collPedidoss as $referrerFK) {
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

        $this->modifiedColumns[UsuariosTableMap::COL_IDUSUARIO] = true;
        if (null !== $this->idusuario) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsuariosTableMap::COL_IDUSUARIO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsuariosTableMap::COL_IDUSUARIO)) {
            $modifiedColumns[':p' . $index++]  = 'idusuario';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_NOMBREUSUARIO)) {
            $modifiedColumns[':p' . $index++]  = 'nombreusuario';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_NOMBRES)) {
            $modifiedColumns[':p' . $index++]  = 'nombres';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_APELLIDOS)) {
            $modifiedColumns[':p' . $index++]  = 'apellidos';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_TELEFONO)) {
            $modifiedColumns[':p' . $index++]  = 'telefono';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = 'direccion';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_IDDEPARTAMENTO)) {
            $modifiedColumns[':p' . $index++]  = 'iddepartamento';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_IDMUNICIPIO)) {
            $modifiedColumns[':p' . $index++]  = 'idmunicipio';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_FECHAREGISTRO)) {
            $modifiedColumns[':p' . $index++]  = 'fecharegistro';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_IDROL)) {
            $modifiedColumns[':p' . $index++]  = 'idrol';
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_CLAVE)) {
            $modifiedColumns[':p' . $index++]  = 'clave';
        }

        $sql = sprintf(
            'INSERT INTO usuarios (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idusuario':
                        $stmt->bindValue($identifier, $this->idusuario, PDO::PARAM_INT);
                        break;
                    case 'nombreusuario':
                        $stmt->bindValue($identifier, $this->nombreusuario, PDO::PARAM_STR);
                        break;
                    case 'nombres':
                        $stmt->bindValue($identifier, $this->nombres, PDO::PARAM_STR);
                        break;
                    case 'apellidos':
                        $stmt->bindValue($identifier, $this->apellidos, PDO::PARAM_STR);
                        break;
                    case 'telefono':
                        $stmt->bindValue($identifier, $this->telefono, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'direccion':
                        $stmt->bindValue($identifier, $this->direccion, PDO::PARAM_STR);
                        break;
                    case 'iddepartamento':
                        $stmt->bindValue($identifier, $this->iddepartamento, PDO::PARAM_INT);
                        break;
                    case 'idmunicipio':
                        $stmt->bindValue($identifier, $this->idmunicipio, PDO::PARAM_INT);
                        break;
                    case 'fecharegistro':
                        $stmt->bindValue($identifier, $this->fecharegistro ? $this->fecharegistro->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'idrol':
                        $stmt->bindValue($identifier, $this->idrol, PDO::PARAM_INT);
                        break;
                    case 'clave':
                        $stmt->bindValue($identifier, $this->clave, PDO::PARAM_STR);
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
        $this->setIdusuario($pk);

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
        $pos = UsuariosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdusuario();
                break;
            case 1:
                return $this->getNombreusuario();
                break;
            case 2:
                return $this->getNombres();
                break;
            case 3:
                return $this->getApellidos();
                break;
            case 4:
                return $this->getTelefono();
                break;
            case 5:
                return $this->getEmail();
                break;
            case 6:
                return $this->getDireccion();
                break;
            case 7:
                return $this->getIddepartamento();
                break;
            case 8:
                return $this->getIdmunicipio();
                break;
            case 9:
                return $this->getFecharegistro();
                break;
            case 10:
                return $this->getIdrol();
                break;
            case 11:
                return $this->getClave();
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

        if (isset($alreadyDumpedObjects['Usuarios'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Usuarios'][$this->hashCode()] = true;
        $keys = UsuariosTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdusuario(),
            $keys[1] => $this->getNombreusuario(),
            $keys[2] => $this->getNombres(),
            $keys[3] => $this->getApellidos(),
            $keys[4] => $this->getTelefono(),
            $keys[5] => $this->getEmail(),
            $keys[6] => $this->getDireccion(),
            $keys[7] => $this->getIddepartamento(),
            $keys[8] => $this->getIdmunicipio(),
            $keys[9] => $this->getFecharegistro(),
            $keys[10] => $this->getIdrol(),
            $keys[11] => $this->getClave(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[9]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[9]];
            $result[$keys[9]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDepartamentos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'departamentos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'departamentos';
                        break;
                    default:
                        $key = 'Departamentos';
                }

                $result[$key] = $this->aDepartamentos->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aMunicipios) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'municipios';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'municipios';
                        break;
                    default:
                        $key = 'Municipios';
                }

                $result[$key] = $this->aMunicipios->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aRoles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'roles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'roles';
                        break;
                    default:
                        $key = 'Roles';
                }

                $result[$key] = $this->aRoles->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collHashes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hashes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hashes';
                        break;
                    default:
                        $key = 'Hashes';
                }

                $result[$key] = $this->collHashes->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPedidoss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pedidoss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pedidoss';
                        break;
                    default:
                        $key = 'Pedidoss';
                }

                $result[$key] = $this->collPedidoss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Usuarios
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsuariosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Usuarios
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdusuario($value);
                break;
            case 1:
                $this->setNombreusuario($value);
                break;
            case 2:
                $this->setNombres($value);
                break;
            case 3:
                $this->setApellidos($value);
                break;
            case 4:
                $this->setTelefono($value);
                break;
            case 5:
                $this->setEmail($value);
                break;
            case 6:
                $this->setDireccion($value);
                break;
            case 7:
                $this->setIddepartamento($value);
                break;
            case 8:
                $this->setIdmunicipio($value);
                break;
            case 9:
                $this->setFecharegistro($value);
                break;
            case 10:
                $this->setIdrol($value);
                break;
            case 11:
                $this->setClave($value);
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
        $keys = UsuariosTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdusuario($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNombreusuario($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setNombres($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setApellidos($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTelefono($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setEmail($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDireccion($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setIddepartamento($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setIdmunicipio($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setFecharegistro($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setIdrol($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setClave($arr[$keys[11]]);
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
     * @return $this|\Usuarios The current object, for fluid interface
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
        $criteria = new Criteria(UsuariosTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsuariosTableMap::COL_IDUSUARIO)) {
            $criteria->add(UsuariosTableMap::COL_IDUSUARIO, $this->idusuario);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_NOMBREUSUARIO)) {
            $criteria->add(UsuariosTableMap::COL_NOMBREUSUARIO, $this->nombreusuario);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_NOMBRES)) {
            $criteria->add(UsuariosTableMap::COL_NOMBRES, $this->nombres);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_APELLIDOS)) {
            $criteria->add(UsuariosTableMap::COL_APELLIDOS, $this->apellidos);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_TELEFONO)) {
            $criteria->add(UsuariosTableMap::COL_TELEFONO, $this->telefono);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_EMAIL)) {
            $criteria->add(UsuariosTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_DIRECCION)) {
            $criteria->add(UsuariosTableMap::COL_DIRECCION, $this->direccion);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_IDDEPARTAMENTO)) {
            $criteria->add(UsuariosTableMap::COL_IDDEPARTAMENTO, $this->iddepartamento);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_IDMUNICIPIO)) {
            $criteria->add(UsuariosTableMap::COL_IDMUNICIPIO, $this->idmunicipio);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_FECHAREGISTRO)) {
            $criteria->add(UsuariosTableMap::COL_FECHAREGISTRO, $this->fecharegistro);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_IDROL)) {
            $criteria->add(UsuariosTableMap::COL_IDROL, $this->idrol);
        }
        if ($this->isColumnModified(UsuariosTableMap::COL_CLAVE)) {
            $criteria->add(UsuariosTableMap::COL_CLAVE, $this->clave);
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
        $criteria = ChildUsuariosQuery::create();
        $criteria->add(UsuariosTableMap::COL_IDUSUARIO, $this->idusuario);

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
        $validPk = null !== $this->getIdusuario();

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
        return $this->getIdusuario();
    }

    /**
     * Generic method to set the primary key (idusuario column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdusuario($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdusuario();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Usuarios (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNombreusuario($this->getNombreusuario());
        $copyObj->setNombres($this->getNombres());
        $copyObj->setApellidos($this->getApellidos());
        $copyObj->setTelefono($this->getTelefono());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setDireccion($this->getDireccion());
        $copyObj->setIddepartamento($this->getIddepartamento());
        $copyObj->setIdmunicipio($this->getIdmunicipio());
        $copyObj->setFecharegistro($this->getFecharegistro());
        $copyObj->setIdrol($this->getIdrol());
        $copyObj->setClave($this->getClave());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getHashes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addHash($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPedidoss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPedidos($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdusuario(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Usuarios Clone of current object.
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
     * Declares an association between this object and a ChildDepartamentos object.
     *
     * @param  ChildDepartamentos $v
     * @return $this|\Usuarios The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDepartamentos(ChildDepartamentos $v = null)
    {
        if ($v === null) {
            $this->setIddepartamento(NULL);
        } else {
            $this->setIddepartamento($v->getIddepartamento());
        }

        $this->aDepartamentos = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDepartamentos object, it will not be re-added.
        if ($v !== null) {
            $v->addUsuarios($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDepartamentos object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDepartamentos The associated ChildDepartamentos object.
     * @throws PropelException
     */
    public function getDepartamentos(ConnectionInterface $con = null)
    {
        if ($this->aDepartamentos === null && ($this->iddepartamento !== null)) {
            $this->aDepartamentos = ChildDepartamentosQuery::create()->findPk($this->iddepartamento, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDepartamentos->addUsuarioss($this);
             */
        }

        return $this->aDepartamentos;
    }

    /**
     * Declares an association between this object and a ChildMunicipios object.
     *
     * @param  ChildMunicipios $v
     * @return $this|\Usuarios The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMunicipios(ChildMunicipios $v = null)
    {
        if ($v === null) {
            $this->setIdmunicipio(NULL);
        } else {
            $this->setIdmunicipio($v->getIdmunicipio());
        }

        $this->aMunicipios = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMunicipios object, it will not be re-added.
        if ($v !== null) {
            $v->addUsuarios($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMunicipios object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildMunicipios The associated ChildMunicipios object.
     * @throws PropelException
     */
    public function getMunicipios(ConnectionInterface $con = null)
    {
        if ($this->aMunicipios === null && ($this->idmunicipio !== null)) {
            $this->aMunicipios = ChildMunicipiosQuery::create()->findPk($this->idmunicipio, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMunicipios->addUsuarioss($this);
             */
        }

        return $this->aMunicipios;
    }

    /**
     * Declares an association between this object and a ChildRoles object.
     *
     * @param  ChildRoles $v
     * @return $this|\Usuarios The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRoles(ChildRoles $v = null)
    {
        if ($v === null) {
            $this->setIdrol(NULL);
        } else {
            $this->setIdrol($v->getIdrol());
        }

        $this->aRoles = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRoles object, it will not be re-added.
        if ($v !== null) {
            $v->addUsuarios($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRoles object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRoles The associated ChildRoles object.
     * @throws PropelException
     */
    public function getRoles(ConnectionInterface $con = null)
    {
        if ($this->aRoles === null && ($this->idrol !== null)) {
            $this->aRoles = ChildRolesQuery::create()->findPk($this->idrol, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRoles->addUsuarioss($this);
             */
        }

        return $this->aRoles;
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
        if ('Hash' == $relationName) {
            return $this->initHashes();
        }
        if ('Pedidos' == $relationName) {
            return $this->initPedidoss();
        }
    }

    /**
     * Clears out the collHashes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addHashes()
     */
    public function clearHashes()
    {
        $this->collHashes = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collHashes collection loaded partially.
     */
    public function resetPartialHashes($v = true)
    {
        $this->collHashesPartial = $v;
    }

    /**
     * Initializes the collHashes collection.
     *
     * By default this just sets the collHashes collection to an empty array (like clearcollHashes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initHashes($overrideExisting = true)
    {
        if (null !== $this->collHashes && !$overrideExisting) {
            return;
        }
        $this->collHashes = new ObjectCollection();
        $this->collHashes->setModel('\Hash');
    }

    /**
     * Gets an array of ChildHash objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuarios is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildHash[] List of ChildHash objects
     * @throws PropelException
     */
    public function getHashes(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collHashesPartial && !$this->isNew();
        if (null === $this->collHashes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collHashes) {
                // return empty collection
                $this->initHashes();
            } else {
                $collHashes = ChildHashQuery::create(null, $criteria)
                    ->filterByUsuarios($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collHashesPartial && count($collHashes)) {
                        $this->initHashes(false);

                        foreach ($collHashes as $obj) {
                            if (false == $this->collHashes->contains($obj)) {
                                $this->collHashes->append($obj);
                            }
                        }

                        $this->collHashesPartial = true;
                    }

                    return $collHashes;
                }

                if ($partial && $this->collHashes) {
                    foreach ($this->collHashes as $obj) {
                        if ($obj->isNew()) {
                            $collHashes[] = $obj;
                        }
                    }
                }

                $this->collHashes = $collHashes;
                $this->collHashesPartial = false;
            }
        }

        return $this->collHashes;
    }

    /**
     * Sets a collection of ChildHash objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $hashes A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuarios The current object (for fluent API support)
     */
    public function setHashes(Collection $hashes, ConnectionInterface $con = null)
    {
        /** @var ChildHash[] $hashesToDelete */
        $hashesToDelete = $this->getHashes(new Criteria(), $con)->diff($hashes);


        $this->hashesScheduledForDeletion = $hashesToDelete;

        foreach ($hashesToDelete as $hashRemoved) {
            $hashRemoved->setUsuarios(null);
        }

        $this->collHashes = null;
        foreach ($hashes as $hash) {
            $this->addHash($hash);
        }

        $this->collHashes = $hashes;
        $this->collHashesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Hash objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Hash objects.
     * @throws PropelException
     */
    public function countHashes(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collHashesPartial && !$this->isNew();
        if (null === $this->collHashes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collHashes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getHashes());
            }

            $query = ChildHashQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuarios($this)
                ->count($con);
        }

        return count($this->collHashes);
    }

    /**
     * Method called to associate a ChildHash object to this object
     * through the ChildHash foreign key attribute.
     *
     * @param  ChildHash $l ChildHash
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function addHash(ChildHash $l)
    {
        if ($this->collHashes === null) {
            $this->initHashes();
            $this->collHashesPartial = true;
        }

        if (!$this->collHashes->contains($l)) {
            $this->doAddHash($l);
        }

        return $this;
    }

    /**
     * @param ChildHash $hash The ChildHash object to add.
     */
    protected function doAddHash(ChildHash $hash)
    {
        $this->collHashes[]= $hash;
        $hash->setUsuarios($this);
    }

    /**
     * @param  ChildHash $hash The ChildHash object to remove.
     * @return $this|ChildUsuarios The current object (for fluent API support)
     */
    public function removeHash(ChildHash $hash)
    {
        if ($this->getHashes()->contains($hash)) {
            $pos = $this->collHashes->search($hash);
            $this->collHashes->remove($pos);
            if (null === $this->hashesScheduledForDeletion) {
                $this->hashesScheduledForDeletion = clone $this->collHashes;
                $this->hashesScheduledForDeletion->clear();
            }
            $this->hashesScheduledForDeletion[]= $hash;
            $hash->setUsuarios(null);
        }

        return $this;
    }

    /**
     * Clears out the collPedidoss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPedidoss()
     */
    public function clearPedidoss()
    {
        $this->collPedidoss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPedidoss collection loaded partially.
     */
    public function resetPartialPedidoss($v = true)
    {
        $this->collPedidossPartial = $v;
    }

    /**
     * Initializes the collPedidoss collection.
     *
     * By default this just sets the collPedidoss collection to an empty array (like clearcollPedidoss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPedidoss($overrideExisting = true)
    {
        if (null !== $this->collPedidoss && !$overrideExisting) {
            return;
        }
        $this->collPedidoss = new ObjectCollection();
        $this->collPedidoss->setModel('\Pedidos');
    }

    /**
     * Gets an array of ChildPedidos objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuarios is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPedidos[] List of ChildPedidos objects
     * @throws PropelException
     */
    public function getPedidoss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPedidossPartial && !$this->isNew();
        if (null === $this->collPedidoss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPedidoss) {
                // return empty collection
                $this->initPedidoss();
            } else {
                $collPedidoss = ChildPedidosQuery::create(null, $criteria)
                    ->filterByUsuarios($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPedidossPartial && count($collPedidoss)) {
                        $this->initPedidoss(false);

                        foreach ($collPedidoss as $obj) {
                            if (false == $this->collPedidoss->contains($obj)) {
                                $this->collPedidoss->append($obj);
                            }
                        }

                        $this->collPedidossPartial = true;
                    }

                    return $collPedidoss;
                }

                if ($partial && $this->collPedidoss) {
                    foreach ($this->collPedidoss as $obj) {
                        if ($obj->isNew()) {
                            $collPedidoss[] = $obj;
                        }
                    }
                }

                $this->collPedidoss = $collPedidoss;
                $this->collPedidossPartial = false;
            }
        }

        return $this->collPedidoss;
    }

    /**
     * Sets a collection of ChildPedidos objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pedidoss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuarios The current object (for fluent API support)
     */
    public function setPedidoss(Collection $pedidoss, ConnectionInterface $con = null)
    {
        /** @var ChildPedidos[] $pedidossToDelete */
        $pedidossToDelete = $this->getPedidoss(new Criteria(), $con)->diff($pedidoss);


        $this->pedidossScheduledForDeletion = $pedidossToDelete;

        foreach ($pedidossToDelete as $pedidosRemoved) {
            $pedidosRemoved->setUsuarios(null);
        }

        $this->collPedidoss = null;
        foreach ($pedidoss as $pedidos) {
            $this->addPedidos($pedidos);
        }

        $this->collPedidoss = $pedidoss;
        $this->collPedidossPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pedidos objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Pedidos objects.
     * @throws PropelException
     */
    public function countPedidoss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPedidossPartial && !$this->isNew();
        if (null === $this->collPedidoss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPedidoss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPedidoss());
            }

            $query = ChildPedidosQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuarios($this)
                ->count($con);
        }

        return count($this->collPedidoss);
    }

    /**
     * Method called to associate a ChildPedidos object to this object
     * through the ChildPedidos foreign key attribute.
     *
     * @param  ChildPedidos $l ChildPedidos
     * @return $this|\Usuarios The current object (for fluent API support)
     */
    public function addPedidos(ChildPedidos $l)
    {
        if ($this->collPedidoss === null) {
            $this->initPedidoss();
            $this->collPedidossPartial = true;
        }

        if (!$this->collPedidoss->contains($l)) {
            $this->doAddPedidos($l);
        }

        return $this;
    }

    /**
     * @param ChildPedidos $pedidos The ChildPedidos object to add.
     */
    protected function doAddPedidos(ChildPedidos $pedidos)
    {
        $this->collPedidoss[]= $pedidos;
        $pedidos->setUsuarios($this);
    }

    /**
     * @param  ChildPedidos $pedidos The ChildPedidos object to remove.
     * @return $this|ChildUsuarios The current object (for fluent API support)
     */
    public function removePedidos(ChildPedidos $pedidos)
    {
        if ($this->getPedidoss()->contains($pedidos)) {
            $pos = $this->collPedidoss->search($pedidos);
            $this->collPedidoss->remove($pos);
            if (null === $this->pedidossScheduledForDeletion) {
                $this->pedidossScheduledForDeletion = clone $this->collPedidoss;
                $this->pedidossScheduledForDeletion->clear();
            }
            $this->pedidossScheduledForDeletion[]= $pedidos;
            $pedidos->setUsuarios(null);
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
        if (null !== $this->aDepartamentos) {
            $this->aDepartamentos->removeUsuarios($this);
        }
        if (null !== $this->aMunicipios) {
            $this->aMunicipios->removeUsuarios($this);
        }
        if (null !== $this->aRoles) {
            $this->aRoles->removeUsuarios($this);
        }
        $this->idusuario = null;
        $this->nombreusuario = null;
        $this->nombres = null;
        $this->apellidos = null;
        $this->telefono = null;
        $this->email = null;
        $this->direccion = null;
        $this->iddepartamento = null;
        $this->idmunicipio = null;
        $this->fecharegistro = null;
        $this->idrol = null;
        $this->clave = null;
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
            if ($this->collHashes) {
                foreach ($this->collHashes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPedidoss) {
                foreach ($this->collPedidoss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collHashes = null;
        $this->collPedidoss = null;
        $this->aDepartamentos = null;
        $this->aMunicipios = null;
        $this->aRoles = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsuariosTableMap::DEFAULT_STRING_FORMAT);
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

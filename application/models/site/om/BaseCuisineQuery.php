<?php


/**
 * Base class that represents a query for the 'cuisine' table.
 *
 *
 *
 * @method CuisineQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CuisineQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method CuisineQuery groupById() Group by the id column
 * @method CuisineQuery groupByName() Group by the name column
 *
 * @method CuisineQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CuisineQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CuisineQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CuisineQuery leftJoinCuisine($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cuisine relation
 * @method CuisineQuery rightJoinCuisine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cuisine relation
 * @method CuisineQuery innerJoinCuisine($relationAlias = null) Adds a INNER JOIN clause to the query using the Cuisine relation
 *
 * @method Cuisine findOne(PropelPDO $con = null) Return the first Cuisine matching the query
 * @method Cuisine findOneOrCreate(PropelPDO $con = null) Return the first Cuisine matching the query, or a new Cuisine object populated from the query conditions when no match is found
 *
 * @method Cuisine findOneByName(string $name) Return the first Cuisine filtered by the name column
 *
 * @method array findById(int $id) Return Cuisine objects filtered by the id column
 * @method array findByName(string $name) Return Cuisine objects filtered by the name column
 *
 * @package    propel.generator.site.om
 */
abstract class BaseCuisineQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCuisineQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'site';
        }
        if (null === $modelName) {
            $modelName = 'Cuisine';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CuisineQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CuisineQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CuisineQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CuisineQuery) {
            return $criteria;
        }
        $query = new CuisineQuery(null, null, $modelAlias);

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
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Cuisine|Cuisine[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CuisinePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CuisinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Cuisine A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Cuisine A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name` FROM `cuisine` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Cuisine();
            $obj->hydrate($row);
            CuisinePeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Cuisine|Cuisine[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Cuisine[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return CuisineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CuisinePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CuisineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CuisinePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuisineQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CuisinePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CuisinePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CuisinePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuisineQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CuisinePeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related Restaurant object
     *
     * @param   Restaurant|PropelObjectCollection $restaurant  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CuisineQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCuisine($restaurant, $comparison = null)
    {
        if ($restaurant instanceof Restaurant) {
            return $this
                ->addUsingAlias(CuisinePeer::ID, $restaurant->getCuisineId(), $comparison);
        } elseif ($restaurant instanceof PropelObjectCollection) {
            return $this
                ->useCuisineQuery()
                ->filterByPrimaryKeys($restaurant->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCuisine() only accepts arguments of type Restaurant or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cuisine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CuisineQuery The current query, for fluid interface
     */
    public function joinCuisine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cuisine');

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
            $this->addJoinObject($join, 'Cuisine');
        }

        return $this;
    }

    /**
     * Use the Cuisine relation Restaurant object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   RestaurantQuery A secondary query class using the current class as primary query
     */
    public function useCuisineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCuisine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cuisine', 'RestaurantQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Cuisine $cuisine Object to remove from the list of results
     *
     * @return CuisineQuery The current query, for fluid interface
     */
    public function prune($cuisine = null)
    {
        if ($cuisine) {
            $this->addUsingAlias(CuisinePeer::ID, $cuisine->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

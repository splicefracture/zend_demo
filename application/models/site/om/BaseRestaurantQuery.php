<?php


/**
 * Base class that represents a query for the 'restaurant' table.
 *
 *
 *
 * @method RestaurantQuery orderById($order = Criteria::ASC) Order by the id column
 * @method RestaurantQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method RestaurantQuery orderByCuisineId($order = Criteria::ASC) Order by the cuisine_id column
 *
 * @method RestaurantQuery groupById() Group by the id column
 * @method RestaurantQuery groupByName() Group by the name column
 * @method RestaurantQuery groupByCuisineId() Group by the cuisine_id column
 *
 * @method RestaurantQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RestaurantQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RestaurantQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RestaurantQuery leftJoinCuisine($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cuisine relation
 * @method RestaurantQuery rightJoinCuisine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cuisine relation
 * @method RestaurantQuery innerJoinCuisine($relationAlias = null) Adds a INNER JOIN clause to the query using the Cuisine relation
 *
 * @method Restaurant findOne(PropelPDO $con = null) Return the first Restaurant matching the query
 * @method Restaurant findOneOrCreate(PropelPDO $con = null) Return the first Restaurant matching the query, or a new Restaurant object populated from the query conditions when no match is found
 *
 * @method Restaurant findOneById(int $id) Return the first Restaurant filtered by the id column
 * @method Restaurant findOneByName(string $name) Return the first Restaurant filtered by the name column
 * @method Restaurant findOneByCuisineId(int $cuisine_id) Return the first Restaurant filtered by the cuisine_id column
 *
 * @method array findById(int $id) Return Restaurant objects filtered by the id column
 * @method array findByName(string $name) Return Restaurant objects filtered by the name column
 * @method array findByCuisineId(int $cuisine_id) Return Restaurant objects filtered by the cuisine_id column
 *
 * @package    propel.generator.site.om
 */
abstract class BaseRestaurantQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRestaurantQuery object.
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
            $modelName = 'Restaurant';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RestaurantQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   RestaurantQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RestaurantQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RestaurantQuery) {
            return $criteria;
        }
        $query = new RestaurantQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$id, $cuisine_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Restaurant|Restaurant[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RestaurantPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RestaurantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @param     PropelPDO $con A connection object
     *
     * @return                 Restaurant A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `cuisine_id` FROM `restaurant` WHERE `id` = :p0 AND `cuisine_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Restaurant();
            $obj->hydrate($row);
            RestaurantPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return Restaurant|Restaurant[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Restaurant[]|mixed the list of results, formatted by the current formatter
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
     * @return RestaurantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(RestaurantPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(RestaurantPeer::CUISINE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RestaurantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(RestaurantPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(RestaurantPeer::CUISINE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return RestaurantQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RestaurantPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RestaurantPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RestaurantPeer::ID, $id, $comparison);
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
     * @return RestaurantQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RestaurantPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the cuisine_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCuisineId(1234); // WHERE cuisine_id = 1234
     * $query->filterByCuisineId(array(12, 34)); // WHERE cuisine_id IN (12, 34)
     * $query->filterByCuisineId(array('min' => 12)); // WHERE cuisine_id >= 12
     * $query->filterByCuisineId(array('max' => 12)); // WHERE cuisine_id <= 12
     * </code>
     *
     * @see       filterByCuisine()
     *
     * @param     mixed $cuisineId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RestaurantQuery The current query, for fluid interface
     */
    public function filterByCuisineId($cuisineId = null, $comparison = null)
    {
        if (is_array($cuisineId)) {
            $useMinMax = false;
            if (isset($cuisineId['min'])) {
                $this->addUsingAlias(RestaurantPeer::CUISINE_ID, $cuisineId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cuisineId['max'])) {
                $this->addUsingAlias(RestaurantPeer::CUISINE_ID, $cuisineId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RestaurantPeer::CUISINE_ID, $cuisineId, $comparison);
    }

    /**
     * Filter the query by a related Cuisine object
     *
     * @param   Cuisine|PropelObjectCollection $cuisine The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RestaurantQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCuisine($cuisine, $comparison = null)
    {
        if ($cuisine instanceof Cuisine) {
            return $this
                ->addUsingAlias(RestaurantPeer::CUISINE_ID, $cuisine->getId(), $comparison);
        } elseif ($cuisine instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RestaurantPeer::CUISINE_ID, $cuisine->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCuisine() only accepts arguments of type Cuisine or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cuisine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RestaurantQuery The current query, for fluid interface
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
     * Use the Cuisine relation Cuisine object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   CuisineQuery A secondary query class using the current class as primary query
     */
    public function useCuisineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCuisine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cuisine', 'CuisineQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Restaurant $restaurant Object to remove from the list of results
     *
     * @return RestaurantQuery The current query, for fluid interface
     */
    public function prune($restaurant = null)
    {
        if ($restaurant) {
            $this->addCond('pruneCond0', $this->getAliasedColName(RestaurantPeer::ID), $restaurant->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(RestaurantPeer::CUISINE_ID), $restaurant->getCuisineId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}

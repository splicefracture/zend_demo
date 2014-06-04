<?php



/**
 * This class defines the structure of the 'restaurant' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.site.map
 */
class RestaurantTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'site.map.RestaurantTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('restaurant');
        $this->setPhpName('Restaurant');
        $this->setClassname('Restaurant');
        $this->setPackage('site');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addForeignPrimaryKey('cuisine_id', 'CuisineId', 'INTEGER' , 'cuisine', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Cuisine', 'Cuisine', RelationMap::MANY_TO_ONE, array('cuisine_id' => 'id', ), null, null);
    } // buildRelations()

} // RestaurantTableMap

<?php
namespace Craft;

/**
 * Asset Count Record
 */
class AssetCountRecord extends BaseRecord
{
    /**
     * Get table name
     *
	 * @return string
     */
    public function getTableName()
    {
        return 'assetcount';
    }

    /**
     * Define table columns
     *
	 * @return array
     */
    public function defineAttributes()
    {
        return array(
            'count' => array(AttributeType::Number, 'default' => 0)
        );
    }

    /**
     * Define relationships with other tables
     *
	 * @return array
     */
    public function defineRelations()
    {
        return array(
            'asset' => array(static::BELONGS_TO, 'AssetFileRecord', 'required' => true, 'onDelete' => static::CASCADE)
        );
    }

    /**
     * Define table indexes
     *
	 * @return array
     */
    public function defineIndexes()
    {
        return array(
            array('columns' => array('assetId'))
        );
    }
}

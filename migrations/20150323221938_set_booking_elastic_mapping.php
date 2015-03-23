<?php

use Phinx\Migration\AbstractMigration;

class SetBookingElasticMapping extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {

        require_once __DIR__ . '/../vendor/autoload.php';

        $config = new \Bookings\Config();

        $es = new \Bookings\Elastic($config->es);

        $indexParams['index']  = 'booking';

        // Example Index Mapping
        $myTypeMapping = array(
            '_source' => array(
                'enabled' => true
            ),
            'properties' => array(
                'name' => array(
                    'type' => 'string',
                    'analyzer' => 'standard'
                ),
                'telephone' => array(
                    'type' => 'string'
                ),
                'e-mail' => array(
                    'type' => 'string'
                ),
                'telephone' => array(
                    'type' => 'string'
                )
            )
        );

        $indexParams['body']['mappings']['bookings'] = $myTypeMapping;

        // Create the index
        $es->client()->indices()->create($indexParams);

    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
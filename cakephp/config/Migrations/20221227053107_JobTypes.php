<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class JobTypes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('job_types');
        $table->addColumn('job_category_id', 'integer', [
            'default' => null,
            'null' => false,
        ])->addIndex('job_category_id');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('sort_order', 'integer', [
            'default' => 1,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created_by', 'integer', [
            'default' => null,
            'null' => false,
        ])->addIndex(['created_by']);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified_by', 'integer', [
            'default' => null,
            'null' => true,
        ])->addIndex(['modified_by']);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('deleted_by', 'integer', [
            'default' => null,
            'null' => true,
        ])->addIndex(['deleted_by']);
        $table->create();
    }
}

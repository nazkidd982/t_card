<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Jobs extends AbstractMigration
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
        $table = $this->table('jobs');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('media_id', 'integer', [
            'default' => null,
            'null' => false,
        ])->addIndex(['media_id']);
        $table->addColumn('job_category_id', 'integer', [
            'default' => null,
            'null' => false,
        ])->addIndex(['job_category_id']);
        $table->addColumn('job_type_id', 'integer', [
            'default' => null,
            'null' => false,
        ])->addIndex(['job_type_id']);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('detail', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('business_skill', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('knowledge', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('location', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('activity', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('academic_degree_doctor', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('academic_degree_master', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('academic_degree_professional', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('academic_degree_bachelor', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('salary_statistic_group', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('salary_range_first_year', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('salary_range_average', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('salary_range_remarks', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('restriction', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('estimated_total_workers', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('remarks', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('url', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('seo_description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('seo_keywords', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('sort_order', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('publish_status', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('version', 'string', [
            'default' => false,
            'limit' => 10,
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
        $table->addIndex(['publish_status', 'id']);
        $table->create();
    }
}

<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class JobsPersonalities extends AbstractMigration
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
        $table = $this->table('jobs_personalities', ['id' => false, 'primary_key' => ['job_id', 'personality_id']]);
        $table->addColumn('job_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('personality_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex(['job_id']);
        $table->addIndex(['personality_id']);
        $table->create();
    }
}

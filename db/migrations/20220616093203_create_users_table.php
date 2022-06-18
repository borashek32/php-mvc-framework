<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
	public function change(): void
	{
		$users = $this->table('users');
		$users->addColumn('firstname', 'string')
			->addColumn('lastname', 'string')
			->addColumn('email', 'string')
			->addColumn('password', 'string')
			->addColumn('status', 'integer')
			->addColumn('created_at', 'datetime')
			->create();
	}
}

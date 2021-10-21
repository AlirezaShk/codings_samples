<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SessionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SessionsTable Test Case
 */
class SessionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SessionsTable
     */
    protected $Sessions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Sessions',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Sessions') ? [] : ['className' => SessionsTable::class];
        $this->Sessions = $this->getTableLocator()->get('Sessions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Sessions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
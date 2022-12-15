<?php
namespace Custommodule\Design\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        if (version_compare($context->getVersion(), "1.0.0", "<")) {
        //Your upgrade script
        }
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
          $installer->getConnection()->addColumn(
                $installer->getTable('custom_designer_list'),
                'status',
                [
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					1,
					[],
					'Designer Status'
                ]
            );
        }
        if (version_compare($context->getVersion(), '1.1.2', '<')) {
            if (!$installer->tableExists('custom_designs_post')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('custom_designs_post')
                )
                    ->addColumn(
                        'page_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'Designs ID'
                    )
                    ->addColumn(
                        'page_title',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Design Page Title'
                    )
                    ->addColumn(
                        'page_name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Designs Name'
                    )
                    ->addColumn(
                        'design_image',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Designs Image'
                    )
                    ->addColumn(
                        'page_des',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Designs Description'
                    )
                    ->addColumn(
                        'page_designer',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Designer'  
                    )
                    ->addColumn(
                        'created_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                        'Created At'
                    )->addColumn(
                        'updated_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At')
                    ->setComment('Design Table');
                $installer->getConnection()->createTable($table);
                $installer->getConnection()->addIndex(
                    $installer->getTable('custom_designs_post'),
                    $setup->getIdxName(
                        $installer->getTable('custom_designs_post'),
                        ['page_title', 'page_name', 'page_des', 'page_designer'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['page_title', 'page_name', 'page_des', 'page_designer'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
        }
        $installer->endSetup();
    }
}
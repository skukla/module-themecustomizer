<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 */
namespace MagentoEse\ThemeCustomizer\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    const SKIN_TABLE = 'magentoese_themecustomizer_skin';
    const ELEMENT_TABLE  = 'magentoese_themecustomizer_elements';

    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable(self::SKIN_TABLE)
        )->addColumn(
            'skin_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Name'
        )->addIndex(
            $installer->getIdxName(
                self::SKIN_TABLE,
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['name'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )->addColumn(
            'creation_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ],
            'Creation Time'
        )->addColumn(
            'update_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE, ],
            'Modification Time'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '1', ],
            'Is Active'
        )->addColumn(
            'applied_to',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '0', ],
            'Applied To Theme'
        )->addColumn(
            'read_only',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [ 'nullable' => false, 'default' => '0', ],
            '1=read only configuration'
        )->addColumn(
            'additional_css',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            [ 'nullable' => true, ],
            'Additional CSS'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup


        //START table setup
        $table = $installer->getConnection()->newTable(
            $installer->getTable(self::ELEMENT_TABLE)
        )->addColumn(
            'element_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true, ],
            'Entity ID'
        )->addColumn(
            'element_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Unique Code'
        )->addIndex(
            $installer->getIdxName(
                self::ELEMENT_TABLE,
                ['element_code'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['element_code'],
            ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
        )->addColumn(
            'frontend_label',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [ 'nullable' => false, ],
            'Front End Label'
        )->addColumn(
            'ui',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            20,
            [ 'nullable' => false, ],
            'type of front end interface'
        )->addColumn(
            'css_code',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '2M',
            [ 'nullable' => true, ],
            'Css Code'
        );
        $installer->getConnection()->createTable($table);
        //END   table setup
        $installer->endSetup();
    }
}

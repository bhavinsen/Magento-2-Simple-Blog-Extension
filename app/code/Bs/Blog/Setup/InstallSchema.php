<?php

namespace Bs\Blog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context){
        $setup->startSetup();

        $tableName = $setup->getTable('bs_blog_post');

        if($setup->getConnection()->isTableExists($tableName) != true){
            $table = $setup->getConnection()
                        ->newTable($tableName)
                        ->addColumn(
                            'post_id',
                            Table::TYPE_INTEGER,
                            null,
                            [
                                'identity' => true,
                                'unsigned' => true,
                                'nullable' => true,
                                'primary'  => true 
                            ],
                            'ID'
                        )
                        ->addColumn(
                            'title',
                            Table::TYPE_TEXT,
                            null,
                            ['nullable' => false],
                            'Title'
                        )
                        ->addColumn(
                            'content',
                            TABLE::TYPE_TEXT,
                            null,
                            ['nullable' => false],
                            'Content'
                        )
                        ->addColumn(
                            'created_at',
                            TABLE::TYPE_TIMESTAMP,
                            null,
                            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                            'Created At'
                        )
                        ->setComment("Bhavin Blog - Posts");
            $setup->endSetup();
        }
    }
}
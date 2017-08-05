<?php

namespace Bs\Blog\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if ($context->getVersion()
            && version_compare($context->getVersion(), '0.1.1') < 0
        ) {
            $tableName = $setup->getTable('bs_blog_post');

            $data = [
                [
                    'title' => 'Post 1 Title',
                    'content' => 'Content of the first post.',
                ],
                [
                    'title' => 'Post 2 Title',
                    'content' => 'Content of the second post.',
                ],
            ];

            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }

        $setup->endSetup();        
    }
}

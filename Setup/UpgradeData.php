<?php

namespace Prince\Productattach\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * {@inheritdoc}
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     */
    public function upgrade(
      ModuleDataSetupInterface $setup,
      ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '2.0.0', '<')) {
            $this->addPrefixToFileColumn($setup);
            }

        $setup->endSetup();
    }

    /**
     * @param $setup
     */
    protected function addPrefixToFileColumn($setup)
    {
        /* @var $connection \Magento\Framework\DB\Adapter\AdapterInterface */
        $connection = $setup->getConnection();
        $connection->query('UPDATE prince_productattach
                            SET file = concat(\'productattach\', file);');
    }
}